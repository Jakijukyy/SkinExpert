<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Laporan Diagnosa #{{ $diagnosa->id }}</title>
    <style>
        body { font-family: 'Helvetica', sans-serif; font-size: 12px; color: #1f2937; margin: 30px; }
        h1 { font-size: 18px; color: #0369a1; margin-bottom: 4px; }
        .subtitle { color: #6b7280; font-size: 11px; margin-bottom: 20px; }
        .section { margin-bottom: 20px; }
        .section h2 { font-size: 13px; font-weight: bold; border-bottom: 1px solid #e5e7eb; padding-bottom: 4px; margin-bottom: 10px; color: #374151; }
        table { width: 100%; border-collapse: collapse; }
        th { background: #f0f9ff; text-align: left; padding: 6px 10px; font-size: 11px; color: #0369a1; }
        td { padding: 6px 10px; border-bottom: 1px solid #f3f4f6; }
        .badge-high { background: #fee2e2; color: #b91c1c; padding: 2px 8px; border-radius: 10px; font-size: 10px; }
        .badge-mid  { background: #fef3c7; color: #92400e; padding: 2px 8px; border-radius: 10px; font-size: 10px; }
        .badge-low  { background: #d1fae5; color: #065f46; padding: 2px 8px; border-radius: 10px; font-size: 10px; }
        .disclaimer { background: #fffbeb; border: 1px solid #fde68a; padding: 10px 14px; border-radius: 6px; color: #92400e; font-size: 10px; margin-top: 20px; }
        .footer { text-align: center; color: #9ca3af; font-size: 10px; margin-top: 30px; }
    </style>
</head>
<body>

<h1>SkinExpert — Laporan Diagnosa</h1>
<p class="subtitle">Sistem Pakar Penyakit Kulit berbasis Certainty Factor</p>

<div class="section">
    <h2>Informasi Diagnosa</h2>
    <table>
        <tr><td width="160"><strong>ID Diagnosa</strong></td><td>#{{ $diagnosa->id }}</td></tr>
        <tr><td><strong>Pengguna</strong></td><td>{{ $diagnosa->user?->name ?? 'Guest' }}</td></tr>
        <tr><td><strong>Email</strong></td><td>{{ $diagnosa->user?->email ?? '-' }}</td></tr>
        <tr><td><strong>Tanggal Konsultasi</strong></td><td>{{ $diagnosa->tanggal->format('d M Y, H:i') }}</td></tr>
        <tr>
            <td><strong>Hasil Tertinggi</strong></td>
            <td><strong>{{ $diagnosa->penyakit?->nama ?? '-' }}</strong>
                @php $cf = $diagnosa->cf_tertinggi; @endphp
                <span class="{{ $cf >= 0.7 ? 'badge-high' : ($cf >= 0.4 ? 'badge-mid' : 'badge-low') }}">
                    {{ round($cf * 100, 1) }}%
                </span>
            </td>
        </tr>
    </table>
</div>

<div class="section">
    <h2>Gejala yang Dilaporkan</h2>
    <table>
        <thead><tr><th>Kode</th><th>Nama Gejala</th><th>CF User</th></tr></thead>
        <tbody>
            @foreach($diagnosa->details as $d)
            <tr>
                <td>{{ $d->gejala->kode }}</td>
                <td>{{ $d->gejala->nama }}</td>
                <td>{{ round($d->cf_user * 100) }}%</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

<div class="section">
    <h2>Peringkat Kemungkinan Penyakit</h2>
    <table>
        <thead><tr><th>#</th><th>Kode</th><th>Nama Penyakit</th><th>CF Nilai</th><th>Persentase</th></tr></thead>
        <tbody>
            @foreach($diagnosa->hasil_json as $i => $r)
            <tr>
                <td>{{ $i + 1 }}</td>
                <td>{{ $r['kode'] }}</td>
                <td>{{ $r['nama'] }}</td>
                <td>{{ $r['cf'] }}</td>
                <td>
                    <span class="{{ $r['cf'] >= 0.7 ? 'badge-high' : ($r['cf'] >= 0.4 ? 'badge-mid' : 'badge-low') }}">
                        {{ $r['persentase'] }}%
                    </span>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

<div class="disclaimer">
    <strong>Disclaimer:</strong> Hasil ini adalah skrining awal berbasis sistem pakar dan <strong>bukan diagnosis medis</strong>.
    Segera konsultasikan ke dokter spesialis kulit (dermatologis) untuk pemeriksaan dan penanganan yang tepat.
</div>

<div class="footer">
    Dicetak oleh SkinExpert &mdash; {{ now()->format('d M Y, H:i') }}
</div>

</body>
</html>
