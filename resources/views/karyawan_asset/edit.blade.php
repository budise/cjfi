@extends('adminlte::page')

@section('title', 'Edit Peminjaman')

@section('content_header')
    <h1>Edit Peminjaman Aset</h1>
@stop

@section('content')
    <form action="{{ route('karyawan-asset.update', $karyawanAsset->id) }}" method="POST">
        @csrf @method('PUT')

        <div class="card">
            <div class="card-body">

                <div class="form-group">
                    <label for="karyawan_id">Karyawan</label>
                    <select name="karyawan_id" id="karyawan_id" class="form-control" required>
                        @foreach($karyawans as $karyawan)
                            <option value="{{ $karyawan->id }}" {{ $karyawanAsset->karyawan_id == $karyawan->id ? 'selected' : '' }}>
                                {{ $karyawan->nama }} ({{ $karyawan->nip }})
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="detail_asset_id">Detail Aset</label>
                    <select name="detail_asset_id" id="detail_asset_id" class="form-control" required>
                        @foreach($detailAssets as $asset)
                            <option value="{{ $asset->id }}" {{ $karyawanAsset->detail_asset_id == $asset->id ? 'selected' : '' }}>
                                {{ $asset->kode_asset }} - {{ $asset->lokasi }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="tanggal_pinjam">Tanggal Pinjam</label>
                    <input type="date" name="tanggal_pinjam" id="tanggal_pinjam" class="form-control" value="{{ $karyawanAsset->tanggal_pinjam }}" required>
                </div>

                <div class="form-group">
                    <label for="tanggal_kembali">Tanggal Kembali</label>
                    <input type="date" name="tanggal_kembali" id="tanggal_kembali" class="form-control" value="{{ $karyawanAsset->tanggal_kembali }}">
                </div>

                <div class="form-group">
                    <label for="keterangan">Keterangan</label>
                    <textarea name="keterangan" id="keterangan" rows="3" class="form-control">{{ $karyawanAsset->keterangan }}</textarea>
                </div>

            </div>
            <div class="card-footer">
                <a href="{{ route('karyawan-asset.index') }}" class="btn btn-secondary">Batal</a>
                <button type="submit" class="btn btn-primary">Perbarui</button>
            </div>
        </div>
    </form>
@stop
