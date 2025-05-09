<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Laporan Peminjaman Asset</title>
    <style>
        body { font-family: sans-serif; font-size: 12px; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        table, th, td { border: 1px solid #000; padding: 5px; text-align: left; }
        th { background-color: #f2f2f2; }
    </style>
</head>
<body>
    <h2>Laporan Peminjaman Asset</h2>

    <table>
        <thead>
            <tr>
                <th>Karyawan</th>
                <th>Unit Kerja</th>
                <th>Asset</th>
                <th>Kode Detail</th>
                <th>Tanggal Pinjam</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $item)
            <tr>
                <td>{{ $item->karyawan->nama }}</td>
                <td>{{ $item->karyawan->unit_kerja }}</td>
                <td>{{ $item->detailAsset->asset->nama_asset ?? '-' }}</td>
                <td>{{ $item->detailAsset->kode_asset ?? '-' }}</td>
                <td>{{ $item->tanggal_pinjam }}</td>
                <td>{{ $item->status == 1 ? 'Belum Dikembalikan' : 'Sudah Dikembalikan' }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
