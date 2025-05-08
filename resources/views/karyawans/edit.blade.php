@extends('adminlte::page')

@section('title', 'Edit Karyawan')

@section('content_header')
    <h1>Edit Karyawan</h1>
@stop

@section('content')
    <form action="{{ route('karyawans.update', $karyawan->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="nama">Nama *</label>
            <input type="text" name="nama" class="form-control" value="{{ $karyawan->nama }}" required>
        </div>

        <div class="form-group">
            <label for="nip">NIP *</label>
            <input type="text" name="nip" class="form-control" value="{{ $karyawan->nip }}" required>
        </div>

        <div class="form-group">
            <label for="jabatan">Jabatan</label>
            <input type="text" name="jabatan" class="form-control" value="{{ $karyawan->jabatan }}">
        </div>

        <div class="form-group">
            <label for="unit_kerja">Unit Kerja</label>
            <input type="text" name="unit_kerja" class="form-control" value="{{ $karyawan->unit_kerja }}">
        </div>

        <button type="submit" class="btn btn-primary">Update</button>
        <a href="{{ route('karyawans.index') }}" class="btn btn-secondary">Batal</a>
    </form>
@stop
