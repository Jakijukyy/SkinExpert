<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Laporan Semua Diagnosa</title>
    <style>
        body { font-family: 'Helvetica', sans-serif; font-size: 11px; color: #1f2937; margin: 25px; }
        h1 { font-size: 16px; color: #0369a1; margin-bottom: 4px; }
        .subtitle { color: #6b7280; font-size: 10px; margin-bottom: 16px; }
        table { width: 100%; border-collapse: collapse; }
        th { background: #f0f9ff; text-align: left; padding: 6px 8px; font-size: 10px; color: #0369a1; }
        td { padding: 5px 8px; border-bottom: 1px solid #f3f4f6; }
        .badge-high { background: #fee2e2; color: #b91c1c; padding: 1px 6px; border-radius: 8px; font-size: 9px; }
        .badge-mid  { background: #fef3c7; color: #92400e; padding: 1px 6px; border-radius: 8px; font-size: 9px; }
        .badge-low  { background: #d1fae5; color: #065f46; padding: 1px 6px; border-radius: 8px; font-size: 9px; }
        .footer { text-align: center; color: #9ca3af; font-size: 10px; margin-top: 20px; }
    </style>
</head>
<body>

<h1>SkinExpert — Laporan Semua Diagnosa</h1>
<p class="subtitle">Dicetak: {{ now()->format('d M Y, H:i') }} &mdash; Total: {{ $diagnoses->count() }} diagnosa</p>

<table>
    <thead>
        <tr>
            <th>#ID</th>
            <th>Pengguna</th>
            <th>Penyakit Tertinggi</th>
            <th>CF</th>
            <th>Tanggal</th>
        </tr>
    </thead>
    <tbody>
        @foreach($diagnoses as $d)
        <tr>
            <td>#{{ $d->id }}</td>
            <td>{{ $d->user?->name ?? 'Guest' }}</td>
            <td>{{ $d->penyakit?->nama ?? '-' }}</td>
            <td>
                @php $cf = $d->cf_tertinggi; @endphp
                <span class="{{ $cf >= 0.7 ? 'badge-high' : ($cf >= 0.4 ? 'badge-mid' : 'badge-low') }}">
                    {{ round($cf * 100, 1) }}%
                </span>
            </td>
            <td>{{ $d->tanggal->format('d M Y') }}</td>
        </tr>
        @endforeach
    </tbody>
</table>

<div class="footer">SkinExpert — Sistem Pakar Penyakit Kulit</div>

</body>
</html>
