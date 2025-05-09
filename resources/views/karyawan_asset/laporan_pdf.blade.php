<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Laporan Peminjaman Asset</title>
    <style>
        body { font-family: sans-serif; font-size: 12px; margin: 0; padding: 0; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        table, th, td { border: 1px solid #000; padding: 5px; text-align: left; }
        th { background-color: #f2f2f2; }

        /* Header style */
        .header {
            text-align: center;
            margin-bottom: 20px;
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

        .border-bottom {
            border-bottom: 3px solid #000;
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
                <h2 style="margin: 0;">Laporan Peminjaman Asset</h2>
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

    <!-- Border between header and body -->
    <div class="border-top"></div>

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
