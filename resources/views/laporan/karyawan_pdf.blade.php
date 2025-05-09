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
            margin-bottom: 20px;
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
        .header img {
            width: 100px;
            height: auto;
        }
        .address {
            font-size: 10px;
            margin-top: 10px;
        }

        /* Border for header */
        .border-top {
            border-top: 3px solid #000;
            margin-top: 10px;
        }

    </style>
</head>
<body>
   
    <!-- Header with logo and address -->
    <div class="header">
    <table width="100%" border="0" style="border: none;">
        <tr>
            <td style="width: 50px; text-align: left; border: none;">
                <img src="{{ public_path('images/logo_cjfi.png') }}" alt="Logo CJFI" style="width: 50px;">
            </td>
            <td style="text-align: center; border: none;">
                <h2 style="margin: 0;">Laporan Data Asset</h2>
                <div class="address">
                    <p style="margin: 0;">PT. Chang Jui Fang Indonesia</p>
                    <p style="margin: 0;">Komplek Pluit Mas Real Estate Blok AA No.1,<br>
                        Jl. Jembatan Tiga, RT.1/RW.18, Pejagalan, Kec. Penjaringan,<br>
                        Jkt Utara, Daerah Khusus Ibukota Jakarta 14450
                    </p>
                </div>
            </td>
        </tr>
    </table>
    </div>
    <div class="border-top"></div>

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
