@extends('adminlte::page')

@section('title', 'Tambah Karyawan')

@section('content_header')
    <h1>Tambah Karyawan</h1>
@stop

@section('content')
    <form action="{{ route('karyawans.store') }}" method="POST">
        @csrf

        <div class="form-group">
            <label for="nama">Nama *</label>
            <input type="text" name="nama" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="nip">NIP *</label>
            <input type="text" name="nip" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="jabatan">Jabatan</label>
            <input type="text" name="jabatan" class="form-control">
        </div>

        <div class="form-group">
            <label for="unit_kerja">Unit Kerja</label>
            <input type="text" name="unit_kerja" class="form-control">
        </div>

        <button type="submit" class="btn btn-primary">Simpan</button>
        <a href="{{ route('karyawans.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
@stop
