@extends('adminlte::page')

@section('title', 'Edit Asset')

@section('content_header')
    <h1>Edit Asset</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('assets.update', $asset->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label for="nama_asset">Nama Asset</label>
                    <input type="text" name="nama_asset" id="nama_asset" class="form-control" value="{{ old('nama_asset', $asset->nama_asset) }}" required>
                </div>

                <div class="form-group">
                    <label for="deskripsi">Deskripsi</label>
                    <textarea name="deskripsi" id="deskripsi" class="form-control">{{ old('deskripsi', $asset->deskripsi) }}</textarea>
                </div>

                <button type="submit" class="btn btn-primary">Update</button>
                <a href="{{ route('assets.index') }}" class="btn btn-secondary">Batal</a>
            </form>
        </div>
    </div>
@stop
