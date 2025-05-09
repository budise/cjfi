@extends('adminlte::page')

@section('title', 'Laporan Asset')

@section('content_header')
    <h1>Laporan Asset</h1>
@stop

@section('content')
    <form method="GET" action="{{ route('laporan.asset') }}" class="mb-4">
        <div class="row">
            <div class="col-md-3">
                <label>Tanggal Awal</label>
                <input type="date" name="tanggal_awal" class="form-control" value="{{ request('tanggal_awal') }}">
            </div>
            <div class="col-md-3">
                <label>Tanggal Akhir</label>
                <input type="date" name="tanggal_akhir" class="form-control" value="{{ request('tanggal_akhir') }}">
            </div>
            <div class="col-md-3">
                <label>Status Asset</label>
                <select name="status" class="form-control">
                    <option value="">- Semua -</option>
                    <option value="1" {{ request('status') == '1' ? 'selected' : '' }}>Di Gudang</option>
                    <option value="2" {{ request('status') == '2' ? 'selected' : '' }}>Dipinjam</option>
                </select>
            </div>

            <div class="col-md-3 d-flex align-items-end">
                <button type="submit" class="btn btn-primary w-100">Filter</button>
            </div>
        </div>
    </form>

    <div class="card">
        <div class="card-body table-responsive">
            <a href="{{ route('laporan.asset.pdf', request()->query()) }}" class="btn btn-danger mb-3" target="_blank">
                <i class="fas fa-file-pdf"></i> Export PDF
            </a>

            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Nama Asset</th>
                        <th>Kode Asset</th>
                        <th>Lokasi</th>
                        <th>Tanggal Perolehan</th>
                        <th>Nilai Perolehan</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data as $item)
                        <tr>
                            <td>{{ $item->asset->nama_asset }}</td>
                            <td>{{ $item->kode_asset }}</td>
                            <td>{{ $item->lokasi }}</td>
                            <td>{{ $item->tanggal_perolehan }}</td>
                            <td>{{ $item->nilai_perolehan }}</td>
                            <td>
                                @if ($item->status == 1)
                                    <span class="badge badge-primary">Di Gudang</span>
                                @elseif ($item->status == 2)
                                    <span class="badge badge-warning">Dipinjam</span>
                                @else
                                    <span class="badge badge-secondary">Status Tidak Dikenal</span>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@stop
