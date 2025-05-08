@extends('adminlte::page')

@section('title', 'Pengembalian Asset')

@section('content_header')
    <h1>Daftar Pengembalian Asset</h1>
@stop

@section('content')
    <a href="{{ route('pengembalian-asset.create') }}" class="btn btn-primary mb-3">Tambah Pengembalian</a>

    <div class="card">
        <div class="card-body">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Karyawan</th>
                        <th>Asset</th>
                        <th>Tanggal Kembali</th>
                        <th>Keterangan</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($pengembalians as $pengembalian)
                        <tr>
                            <td>{{ $pengembalian->karyawanDetailAsset->karyawan->nama }}</td>
                            <td>{{ $pengembalian->karyawanDetailAsset->detailAsset->kode_asset }}</td>
                            <td>{{ $pengembalian->tanggal_kembali }}</td>
                            <td>{{ $pengembalian->keterangan }}</td>
                            <td>
                                <a href="{{ route('pengembalian-asset.edit', $pengembalian->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                <form action="{{ route('pengembalian-asset.destroy', $pengembalian->id) }}" method="POST" style="display:inline-block">
                                    @csrf @method('DELETE')
                                    <button onclick="return confirm('Yakin hapus?')" class="btn btn-danger btn-sm">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@stop
