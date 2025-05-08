<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Laporan Data Karyawan</title>
    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 12px;
            line-height: 1.5;
        }
        .header {
            text-align: center;
        }
        .header h2, .header p {
            margin: 0;
            padding: 0;
        }
        .info {
            margin-top: 10px;
            margin-bottom: 20px;
        }
        .info strong {
            display: inline-block;
            width: 120px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }
        th, td {
            border: 1px solid #000;
            padding: 6px;
            text-align: left;
        }
        th {
            background-color: #eaeaea;
        }
    </style>
</head>
<body>
    <div class="header">
        <h2>LAPORAN DATA KARYAWAN</h2>
        <p>Sistem Informasi Manajemen Kepegawaian</p>
    </div>

    <div class="info">
        @if($unit_kerja)
            <p><strong>Unit Kerja:</strong> {{ $unit_kerja }}</p>
        @else
            <p><strong>Unit Kerja:</strong> Semua Unit</p>
        @endif
        <p><strong>Tanggal Cetak:</strong> {{ \Carbon\Carbon::now()->format('d-m-Y H:i') }}</p>
    </div>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>NIP</th>
                <th>Jabatan</th>
                <th>Unit Kerja</th>
            </tr>
        </thead>
        <tbody>
            @forelse($karyawans as $karyawan)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $karyawan->nama }}</td>
                    <td>{{ $karyawan->nip }}</td>
                    <td>{{ $karyawan->jabatan }}</td>
                    <td>{{ $karyawan->unit_kerja }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" style="text-align: center;">Tidak ada data.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</body>
</html>
