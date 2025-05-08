<?php

namespace App\Http\Controllers;

use App\Models\Karyawan;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Auth;

class KaryawanController extends Controller
{
    public function index()
    {
        $karyawans = Karyawan::all();
        return view('karyawans.index', compact('karyawans'));
    }

    public function create()
    {
        return view('karyawans.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'nip' => 'required|unique:karyawans',
        ]);

        Karyawan::create($request->all());
        return redirect()->route('karyawans.index')->with('success', 'Karyawan berhasil ditambahkan.');
    }

    public function show(Karyawan $karyawan)
    {
        return view('karyawans.show', compact('karyawan'));
    }

    public function edit(Karyawan $karyawan)
    {
        return view('karyawans.edit', compact('karyawan'));
    }

    public function update(Request $request, Karyawan $karyawan)
    {
        $request->validate([
            'nama' => 'required',
            'nip' => 'required|unique:karyawans,nip,' . $karyawan->id,
        ]);

        $karyawan->update($request->all());
        return redirect()->route('karyawans.index')->with('success', 'Data karyawan berhasil diupdate.');
    }

    public function destroy(Karyawan $karyawan)
    {
        $karyawan->delete();
        return redirect()->route('karyawans.index')->with('success', 'Data karyawan berhasil dihapus.');
    }
    public function laporan(Request $request)
    {
        $unitKerja = $request->input('unit_kerja');

        $query = Karyawan::query();

        if ($unitKerja) {
            $query->where('unit_kerja', $unitKerja);
        }

        $karyawans = $query->get();

        $unitKerjaList = Karyawan::select('unit_kerja')->distinct()->pluck('unit_kerja');

        return view('karyawans.laporan', compact('karyawans', 'unitKerjaList', 'unitKerja'));
    }
    public function exportPdf(Request $request)
    {
        $unit_kerja = $request->unit_kerja;

        $karyawans = Karyawan::when($unit_kerja, function ($query) use ($unit_kerja) {
            return $query->where('unit_kerja', $unit_kerja);
        })->get();

        $pdf = Pdf::loadView('laporan.karyawan_pdf', compact('karyawans', 'unit_kerja'))
            ->setPaper('A4', 'portrait');

        return $pdf->stream('laporan_karyawan.pdf');
    }
}
