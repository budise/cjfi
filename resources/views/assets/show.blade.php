@extends('adminlte::page')

@section('title', 'Detail Asset')

@section('content_header')
    <h1>Detail Asset</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Informasi Asset</h3>
        </div>
        <div class="card-body">
            <p><strong>Nama Asset:</strong> {{ $asset->nama_asset }}</p>
            <p><strong>Deskripsi:</strong> {{ $asset->deskripsi ?? '-' }}</p>
        </div>
    </div>

    <div class="card mt-4">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h3 class="card-title mb-0">Detail Assets</h3>
            <a href="{{ route('detail-assets.create', ['asset_id' => $asset->id]) }}" class="btn btn-primary btn-sm">
                <i class="fas fa-plus"></i> Tambah Detail
            </a>
        </div>
        <div class="card-body p-0">
            @if ($asset->detailAssets->count() > 0)
                <table class="table table-bordered mb-0">
                    <thead>
                        <tr>
                            <th>Kode Asset</th>
                            <th>Lokasi</th>
                            <th>Tanggal Perolehan</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($asset->detailAssets as $detail)
                            <tr>
                                <td>{{ $detail->kode_asset }}</td>
                                <td>{{ $detail->lokasi }}</td>
                                <td>{{ $detail->tanggal_perolehan }}</td>
                                <td>
                                    <a href="{{ route('detail-assets.edit', $detail->id) }}" class="btn btn-sm btn-warning">
                                        Edit
                                    </a>
                                    <form action="{{ route('detail-assets.destroy', $detail->id) }}" method="POST" style="display:inline-block;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Yakin ingin menghapus detail ini?')">
                                            Hapus
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <div class="p-3">
                    <p class="text-muted">Belum ada detail asset.</p>
                </div>
            @endif
        </div>
    </div>
@stop
