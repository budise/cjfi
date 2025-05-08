@extends('adminlte::page')

@section('title', 'Tambah Detail Asset')

@section('content_header')
    <h1>Tambah Detail Asset</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('detail-assets.store') }}" method="POST">
                @csrf

                <input type="hidden" name="asset_id" value="{{ request('asset_id') }}">

                <div class="form-group">
                    <label for="kode_asset">Kode Asset</label>
                    <input type="text" name="kode_asset" class="form-control" required>
                </div>

                <div class="form-group">
                    <label for="lokasi">Lokasi</label>
                    <input type="text" name="lokasi" class="form-control">
                </div>

                <div class="form-group">
                    <label for="tanggal_perolehan">Tanggal Perolehan</label>
                    <input type="date" name="tanggal_perolehan" class="form-control">
                </div>

                <div class="form-group">
                    <label for="nilai_perolehan">Nilai Perolehan</label>
                    <input type="number" name="nilai_perolehan" step="0.01" class="form-control">
                </div>

                <button type="submit" class="btn btn-primary">Simpan</button>
                <a href="{{ route('assets.show', request('asset_id')) }}" class="btn btn-secondary">Kembali</a>
            </form>
        </div>
    </div>
@stop
