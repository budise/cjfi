@extends('adminlte::page')

@section('title', 'Tambah Peminjaman')

@section('content_header')
    <h1>Tambah Peminjaman Aset</h1>
@stop

@section('content')
    <form action="{{ route('karyawan_asset.store') }}" method="POST">
        @csrf
        <div class="card">
            <div class="card-body">

                <div class="form-group">
                    <label for="karyawan_id">Karyawan</label>
                    <select name="karyawan_id" id="karyawan_id" class="form-control" required>
                        <option value="">-- Pilih Karyawan --</option>
                        @foreach($karyawans as $karyawan)
                            <option value="{{ $karyawan->id }}">{{ $karyawan->nama }} ({{ $karyawan->nip }})</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="detail_asset_id">Detail Aset</label>
                    <select name="detail_asset_id" id="detail_asset_id" class="form-control" required>
                        <option value="">-- Pilih Aset --</option>
                        @foreach($detailAssets as $asset)
                            <option value="{{ $asset->id }}">{{ $asset->kode_asset }} - {{ $asset->lokasi }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="tanggal_pinjam">Tanggal Pinjam</label>
                    <input type="date" name="tanggal_pinjam" id="tanggal_pinjam" class="form-control" required>
                </div>

                <div class="form-group">
                    <label for="tanggal_kembali">Tanggal Kembali</label>
                    <input type="date" name="tanggal_kembali" id="tanggal_kembali" class="form-control">
                </div>

                <div class="form-group">
                    <label for="keterangan">Keterangan</label>
                    <textarea name="keterangan" id="keterangan" rows="3" class="form-control"></textarea>
                </div>

            </div>
            <div class="card-footer">
                <a href="{{ route('karyawan_asset.index') }}" class="btn btn-secondary">Kembali</a>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
        </div>
    </form>
@stop
