<h1>Laporan Asset</h1>
<table border="1" cellpadding="5">
    <thead>
        <tr>
            <th>Kode Asset</th>
            <th>Nama Asset</th>
            <th>Kode Detail Asset</th>
            <th>Lokasi</th>
            <th>Tanggal Perolehan</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($data as $item)
        <tr>
            <td>{{ $item->kode_asset }}</td>
            <td>{{ $item->nama_asset }}</td>
            <td>{{ $item->kode_asset }}</td>
            <td>{{ $item->lokasi }}</td>
            <td>{{ $item->tanggal_perolehan }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
