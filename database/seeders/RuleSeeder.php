<?php

namespace Database\Seeders;

use App\Models\Rule;
use Illuminate\Database\Seeder;

class RuleSeeder extends Seeder
{
    public function run(): void
    {
        // Format: [penyakit_id, gejala_id, cf_pakar]
        // P01=1 Dermatitis Atopik, P02=2 Psoriasis, P03=3 Acne Vulgaris
        // P04=4 Tinea Corporis, P05=5 Urtikaria, P06=6 Scabies
        // P07=7 Rosacea, P08=8 Vitiligo, P09=9 Herpes Zoster, P10=10 Selulitis

        $rules = [
            // --- P01 Dermatitis Atopik ---
            [1, 1,  0.8],  // kulit gatal
            [1, 2,  0.7],  // kemerahan
            [1, 3,  0.8],  // kering bersisik
            [1, 4,  0.6],  // meradang/bengkak
            [1, 7,  0.7],  // sangat kering pecah-pecah
            [1, 31, 0.5],  // kulit tebal
            [1, 34, 0.6],  // area mata/mulut terkena
            [1, 35, 0.7],  // memburuk saat stres

            // --- P02 Psoriasis ---
            [2, 1,  0.7],  // kulit gatal
            [2, 2,  0.7],  // kemerahan
            [2, 3,  0.6],  // kering bersisik
            [2, 6,  0.9],  // bercak keperakan tebal
            [2, 7,  0.6],  // sangat kering pecah-pecah
            [2, 31, 0.7],  // kulit tebal
            [2, 35, 0.6],  // memburuk saat stres

            // --- P03 Acne Vulgaris ---
            [3, 2,  0.6],  // kemerahan
            [3, 4,  0.5],  // meradang
            [3, 8,  0.9],  // komedo/whitehead
            [3, 9,  0.9],  // papul/pustul
            [3, 10, 0.8],  // kulit berminyak
            [3, 33, 0.6],  // bekas luka gelap
            [3, 35, 0.5],  // memburuk saat stres

            // --- P04 Tinea Corporis (Kurap) ---
            [4, 1,  0.7],  // gatal
            [4, 2,  0.6],  // kemerahan
            [4, 3,  0.6],  // bersisik
            [4, 11, 0.9],  // bercak bentuk cincin
            [4, 12, 0.6],  // rambut/kuku terkena
            [4, 32, 0.5],  // gatal saat berkeringat

            // --- P05 Urtikaria (Biduran) ---
            [5, 1,  0.9],  // gatal
            [5, 2,  0.7],  // kemerahan
            [5, 4,  0.6],  // bengkak
            [5, 13, 0.9],  // bentol-bentol
            [5, 14, 0.8],  // bentol berpindah
            [5, 35, 0.4],  // dipicu stres

            // --- P06 Scabies (Kudis) ---
            [6, 1,  0.7],  // gatal
            [6, 2,  0.5],  // kemerahan
            [6, 4,  0.5],  // meradang
            [6, 15, 0.9],  // gatal intens malam hari
            [6, 16, 0.9],  // liang/terowongan di kulit
            [6, 17, 0.8],  // anggota keluarga terkena
            [6, 32, 0.6],  // gatal saat berkeringat

            // --- P07 Rosacea ---
            [7, 2,  0.7],  // kemerahan
            [7, 5,  0.5],  // perih
            [7, 18, 0.9],  // kemerahan permanen di wajah
            [7, 19, 0.8],  // pembuluh darah terlihat
            [7, 20, 0.7],  // kulit wajah terbakar
            [7, 35, 0.5],  // memburuk saat stres

            // --- P08 Vitiligo ---
            [8, 21, 0.9],  // bercak putih / kehilangan pigmen
            [8, 22, 0.7],  // bercak simetris
            [8, 23, 0.6],  // rambut memutih di area terkena

            // --- P09 Herpes Zoster (Cacar Api) ---
            [9, 1,  0.5],  // gatal
            [9, 2,  0.5],  // kemerahan
            [9, 5,  0.8],  // nyeri/perih
            [9, 24, 0.9],  // lepuhan berisi cairan
            [9, 25, 0.9],  // nyeri terbakar/tertusuk
            [9, 26, 0.9],  // ruam mengikuti jalur saraf
            [9, 27, 0.6],  // area panas saat disentuh
            [9, 30, 0.5],  // demam

            // --- P10 Selulitis ---
            [10, 2,  0.7],  // kemerahan
            [10, 4,  0.8],  // bengkak
            [10, 5,  0.7],  // nyeri
            [10, 27, 0.8],  // panas saat disentuh
            [10, 28, 0.9],  // merah menyala dan panas
            [10, 29, 0.8],  // batas tidak tegas dan meluas
            [10, 30, 0.7],  // demam
        ];

        foreach ($rules as [$penyakitId, $gejalaId, $cfPakar]) {
            Rule::create([
                'penyakit_id' => $penyakitId,
                'gejala_id'   => $gejalaId,
                'cf_pakar'    => $cfPakar,
            ]);
        }
    }
}
