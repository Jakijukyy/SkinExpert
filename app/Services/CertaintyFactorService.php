<?php

namespace App\Services;

use App\Models\Rule;

class CertaintyFactorService
{
    /**
     * Run the Certainty Factor inference engine.
     *
     * @param  array<int, float>  $selectedSymptoms  [ gejala_id => cf_user (0.0 – 1.0) ]
     * @return array<int, array{penyakit_id: int, nama: string, kode: string, cf: float, persentase: float}>
     */
    public function calculate(array $selectedSymptoms): array
    {
        if (empty($selectedSymptoms)) {
            return [];
        }

        // Load all rules for the selected symptoms, eager-load penyakit
        $rules = Rule::with('penyakit')
            ->whereIn('gejala_id', array_keys($selectedSymptoms))
            ->get();

        // Group individual CF values per disease
        $cfPerPenyakit = [];

        foreach ($rules as $rule) {
            $cfUser   = $selectedSymptoms[$rule->gejala_id] ?? 0.0;
            $cfGejala = (float) $cfUser * (float) $rule->cf_pakar;

            $pid = $rule->penyakit_id;

            if (! isset($cfPerPenyakit[$pid])) {
                $cfPerPenyakit[$pid] = [
                    'penyakit_id' => $pid,
                    'nama'        => $rule->penyakit->nama,
                    'kode'        => $rule->penyakit->kode,
                    'cf_values'   => [],
                ];
            }

            $cfPerPenyakit[$pid]['cf_values'][] = $cfGejala;
        }

        // Combine CF values for each disease using: CF_combined = CF1 + CF2*(1-CF1)
        $results = [];

        foreach ($cfPerPenyakit as $pid => $data) {
            $combinedCF = $this->combineCF($data['cf_values']);

            $results[] = [
                'penyakit_id' => $data['penyakit_id'],
                'nama'        => $data['nama'],
                'kode'        => $data['kode'],
                'cf'          => round($combinedCF, 4),
                'persentase'  => round($combinedCF * 100, 2),
            ];
        }

        // Sort descending by CF value
        usort($results, fn ($a, $b) => $b['cf'] <=> $a['cf']);

        return $results;
    }

    /**
     * Combine an array of CF values sequentially.
     *
     * Formula: CF_combine = CF1 + CF2 * (1 - CF1)
     */
    private function combineCF(array $cfValues): float
    {
        if (empty($cfValues)) {
            return 0.0;
        }

        $combined = array_shift($cfValues);

        foreach ($cfValues as $cf) {
            $combined = $combined + $cf * (1 - $combined);
        }

        return max(0.0, min(1.0, $combined));
    }
}
