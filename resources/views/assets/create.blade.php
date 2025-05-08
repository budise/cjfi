@extends('adminlte::page')

@section('title', 'Tambah Asset')

@section('content_header')
    <h1>Tambah Asset</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('assets.store') }}" method="POST">
                @csrf

                <div class="form-group">
                    <label for="nama_asset">Nama Asset</label>
                    <input type="text" name="nama_asset" class="form-control" required>
                </div>

                <div class="form-group">
                    <label for="deskripsi">Deskripsi</label>
                    <textarea name="deskripsi" class="form-control"></textarea>
                </div>

                <button type="submit" class="btn btn-primary">Simpan</button>
            </form>
        </div>
    </div>
@stop
