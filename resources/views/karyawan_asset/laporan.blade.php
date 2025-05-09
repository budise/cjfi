@extends('adminlte::page')

@section('title', 'Laporan Peminjaman Asset')

@section('content_header')
    <h1>Laporan Peminjaman Asset</h1>
@stop

@section('content')
<form method="GET" class="mb-4">
    <div class="row">
        <div class="col-md-3">
            <label>Karyawan</label>
            <select name="karyawan_id" class="form-control">
                <option value="">- Semua -</option>
                @foreach ($karyawans as $karyawan)
                    <option value="{{ $karyawan->id }}" {{ old('karyawan_id', request('karyawan_id')) == $karyawan->id ? 'selected' : '' }}>
                        {{ $karyawan->nama }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="col-md-3">
            <label>Unit Kerja</label>
            <input type="text" name="unit_kerja" value="{{ old('unit_kerja', request('unit_kerja')) }}" class="form-control">
        </div>
        <div class="col-md-3">
            <label>Status Peminjaman</label>
            <select name="status" class="form-control">
                <option value="">- Semua -</option>
                <option value="1" {{ old('status', request('status')) == '1' ? 'selected' : '' }}>Belum Dikembalikan</option>
                <option value="2" {{ old('status', request('status')) == '2' ? 'selected' : '' }}>Sudah Dikembalikan</option>
            </select>
        </div>
        <div class="col-md-3 d-flex align-items-end">
            <button class="btn btn-primary w-100">Filter</button>
        </div>
    </div>
</form>

<div class="card">
    <div class="card-body table-responsive">
        <a href="{{ route('laporan.peminjaman.pdf', request()->query()) }}" class="btn btn-danger mb-3" target="_blank">
            <i class="fas fa-file-pdf"></i> Export PDF
        </a>

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Karyawan</th>
                    <th>Unit Kerja</th>
                    <th>Nama Asset</th>
                    <th>Kode Detail</th>
                    <th>Tanggal Pinjam</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data as $item)
                <tr>
                    <td>{{ $item->karyawan->nama }}</td>
                    <td>{{ $item->karyawan->unit_kerja }}</td>
                    <td>{{ $item->detailAsset->asset->nama_asset ?? '-' }}</td>
                    <td>{{ $item->detailAsset->kode_asset ?? '-' }}</td>
                    <td>{{ $item->tanggal_pinjam }}</td>
                    <td>
                        @if ($item->status == 1)
                            <span class="badge badge-warning">Belum Dikembalikan</span>
                        @else
                            <span class="badge badge-success">Sudah Dikembalikan</span>
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@stop
