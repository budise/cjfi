@extends('adminlte::page')

@section('title', 'Tambah Pengembalian Asset')

@section('content_header')
    <h1>Tambah Pengembalian Asset</h1>
@stop

@section('content')
    <form action="{{ route('pengembalian-asset.store') }}" method="POST">
        @csrf
        <div class="card">
            <div class="card-body">
                <div class="form-group">
                    <label for="karyawan_detail_asset_id">Peminjaman</label>
                    <select name="karyawan_detail_asset_id" class="form-control" required>
                        <option value="">-- Pilih Peminjaman --</option>
                        @foreach ($peminjamans as $item)
                            <option value="{{ $item->id }}">
                                {{ $item->karyawan->nama }} - {{ $item->detailAsset->kode_asset }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="tanggal_kembali">Tanggal Kembali</label>
                    <input type="date" name="tanggal_kembali" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="keterangan">Keterangan</label>
                    <textarea name="keterangan" class="form-control"></textarea>
                </div>
                <button type="submit" class="btn btn-success">Simpan</button>
                <a href="{{ route('pengembalian-asset.index') }}" class="btn btn-secondary">Kembali</a>
            </div>
        </div>
    </form>
@stop
