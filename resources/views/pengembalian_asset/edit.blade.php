@extends('adminlte::page')

@section('title', 'Edit Pengembalian Asset')

@section('content_header')
    <h1>Edit Pengembalian Asset</h1>
@stop

@section('content')
    <form action="{{ route('pengembalian-asset.update', $pengembalianAsset->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="card">
            <div class="card-body">
                <div class="form-group">
                    <label for="karyawan_detail_asset_id">Peminjaman</label>
                    <select name="karyawan_detail_asset_id" class="form-control" required>
                        <option value="">-- Pilih Peminjaman --</option>
                        @foreach ($peminjamans as $item)
                            <option value="{{ $item->id }}" {{ $pengembalianAsset->karyawan_detail_asset_id == $item->id ? 'selected' : '' }}>
                                {{ $item->karyawan->nama }} - {{ $item->detailAsset->kode_asset }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="tanggal_kembali">Tanggal Kembali</label>
                    <input type="date" name="tanggal_kembali" class="form-control" value="{{ $pengembalianAsset->tanggal_kembali }}" required>
                </div>
                <div class="form-group">
                    <label for="keterangan">Keterangan</label>
                    <textarea name="keterangan" class="form-control">{{ $pengembalianAsset->keterangan }}</textarea>
                </div>
                <button type="submit" class="btn btn-primary">Update</button>
                <a href="{{ route('pengembalian-asset.index') }}" class="btn btn-secondary">Kembali</a>
            </div>
        </div>
    </form>
@stop
