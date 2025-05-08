@extends('adminlte::page')

@section('title', 'Daftar Assets')

@section('content_header')
    <h1>Daftar Assets</h1>
@stop

@section('content')
    <div class="mb-3">
        <a href="{{ route('assets.create') }}" class="btn btn-primary">
            <i class="fas fa-plus"></i> Tambah Asset
        </a>
    </div>

    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Data Assets</h3>
        </div>

        <div class="card-body">
            <table class="table table-bordered table-hover">
                <thead class="thead-light">
                    <tr>
                        <th>No</th>
                        <th>Nama Asset</th>
                        <th>Deskripsi</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($assets as $index => $asset)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $asset->nama_asset }}</td>
                            <td>{{ $asset->deskripsi }}</td>
                            <td>
                                <!-- Button ke halaman detail -->
                                <a href="{{ route('assets.show', $asset->id) }}" class="btn btn-info btn-sm">Lihat Detail</a>

                                <!-- Button ke form tambah detail -->
                                <a href="{{ route('detail-assets.create', ['asset_id' => $asset->id]) }}" class="btn btn-success btn-sm">+ Tambah Detail</a>


                                <a href="{{ route('assets.edit', $asset->id) }}" class="btn btn-sm btn-warning">Edit</a>
                                <form action="{{ route('assets.destroy', $asset->id) }}" method="POST" style="display: inline-block">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Yakin ingin menghapus asset ini?')">
                                        Delete
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center">Belum ada data asset.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@stop
