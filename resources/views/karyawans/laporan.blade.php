@extends('adminlte::page')

@section('title', 'Laporan Karyawan')

@section('content_header')
    <h1>Laporan Karyawan</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-header">
            <form method="GET" action="{{ route('karyawan.laporan') }}" class="form-inline">
                <label for="unit_kerja" class="mr-2">Unit Kerja:</label>
                <select name="unit_kerja" id="unit_kerja" class="form-control mr-2">
                    <option value="">-- Semua Unit --</option>
                    @foreach ($unitKerjaList as $unit)
                        <option value="{{ $unit }}" {{ $unitKerja == $unit ? 'selected' : '' }}>
                            {{ $unit }}
                        </option>
                    @endforeach
                </select>
                <button type="submit" class="btn btn-primary">Filter</button>
            </form>
        </div>

        <div class="card-body">
            
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>NIP</th>
                        <th>Nama</th>
                        <th>Jabatan</th>
                        <th>Unit Kerja</th>
                        <th>Tanggal Dibuat</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($karyawans as $karyawan)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $karyawan->nip }}</td>
                            <td>{{ $karyawan->nama }}</td>
                            <td>{{ $karyawan->jabatan }}</td>
                            <td>{{ $karyawan->unit_kerja }}</td>
                            <td>{{ $karyawan->created_at->format('d-m-Y') }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6">Tidak ada data.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
            <hr/>
            <form action="{{ route('laporan.karyawan.pdf') }}" method="GET" target="_blank" class="d-inline">
                <input type="hidden" name="unit_kerja" value="{{ request('unit_kerja') }}">
                <button type="submit" class="btn btn-danger ml-2">
                    <i class="fas fa-file-pdf"></i> Export PDF
                </button>
            </form>
        </div>
    </div>
@stop
