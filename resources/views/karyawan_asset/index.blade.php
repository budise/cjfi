@extends('adminlte::page')

@section('title', 'Peminjaman Aset')

@section('content_header')
    <h1>Peminjaman Aset oleh Karyawan</h1>
@stop

@section('content')
    <a href="{{ route('karyawan_asset.create') }}" class="btn btn-success mb-3">Tambah Peminjaman</a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="card">
        <div class="card-body">
            <table class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Karyawan</th>
                        <th>Detail Aset</th>
                        <th>Tanggal Pinjam</th>
                        <th>Tanggal Kembali</th>
                        <th>Keterangan</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($peminjamans as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $item->karyawan->nama }}</td>
                            <td>{{ $item->detailAsset->kode_asset }} - {{ $item->detailAsset->lokasi }}</td>
                            <td>{{ $item->tanggal_pinjam }}</td>
                            <td>{{ $item->tanggal_kembali ?? '-' }}</td>
                            <td>{{ $item->keterangan }}</td>
                            <td>
                                @if ($item->status == 1)
                                    <span class="badge bg-warning">Dipinjam</span>
                                @else
                                    <span class="badge bg-success">Dikembalikan</span>
                                @endif
                            </td>

                            <td>
                                <a href="{{ route('karyawan_asset.edit', $item->id) }}" class="btn btn-sm btn-warning">Edit</a>
                                <form action="{{ route('karyawan_asset.destroy', $item->id) }}" method="POST" class="d-inline"
                                      onsubmit="return confirm('Yakin ingin menghapus data ini?')">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    @if($peminjamans->isEmpty())
                        <tr><td colspan="7" class="text-center">Belum ada data peminjaman.</td></tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>
@stop
