<?php

namespace App\Http\Controllers;

use App\Models\Karyawan;
use App\Models\DetailAsset;
use App\Models\KaryawanDetailAsset;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class KaryawanAssetController extends Controller
{
    public function index()
    {
        $peminjamans = KaryawanDetailAsset::with('karyawan', 'detailAsset')->get();
        return view('karyawan_asset.index', compact('peminjamans'));
    }

    public function create()
    {
        $karyawans = Karyawan::all();
        $detailAssets = DetailAsset::where('status', '1')->get(); // hanya yang tersedia
        return view('karyawan_asset.create', compact('karyawans', 'detailAssets'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'karyawan_id' => 'required',
            'detail_asset_id' => 'required',
            'tanggal_pinjam' => 'required|date',
        ]);

        // status peminjaman = 1 (dipinjam)
        $request->merge(['status' => 1]);

        $peminjaman = KaryawanDetailAsset::create($request->all());

        // Update status detail asset menjadi 'Dipinjam' (2)
        $detailAsset = DetailAsset::find($request->detail_asset_id);
        if ($detailAsset) {
            $detailAsset->status = 2;
            $detailAsset->save();
        }

        return redirect()->route('karyawan_asset.index')->with('success', 'Data peminjaman ditambahkan');
    }

    public function edit(KaryawanDetailAsset $karyawanAsset)
    {
        $karyawans = Karyawan::all();
        $detailAssets = DetailAsset::all();
        return view('karyawan_asset.edit', compact('karyawanAsset', 'karyawans', 'detailAssets'));
    }

    public function update(Request $request, KaryawanDetailAsset $karyawanAsset)
    {
        $request->validate([
            'karyawan_id' => 'required',
            'detail_asset_id' => 'required',
            'tanggal_pinjam' => 'required|date',
        ]);

        $karyawanAsset->update($request->all());
        return redirect()->route('karyawan_asset.index')->with('success', 'Data peminjaman diperbarui');
    }

    public function destroy(KaryawanDetailAsset $karyawanAsset)
    {
        // Kembalikan status detail asset ke 'Di Gudang' (1)
        $detailAsset = DetailAsset::find($karyawanAsset->detail_asset_id);
        if ($detailAsset) {
            $detailAsset->status = 1;
            $detailAsset->save();
        }

        $karyawanAsset->delete();
        return redirect()->route('karyawan_asset.index')->with('success', 'Data peminjaman dihapus');
    }

    public function laporan(Request $request)
    {
        $karyawans = Karyawan::all();
        $query = KaryawanDetailAsset::with(['karyawan', 'detailAsset.asset']);

        if ($request->karyawan_id) {
            $query->where('karyawan_id', $request->karyawan_id);
        }

        if ($request->unit_kerja) {
            $query->whereHas('karyawan', function ($q) use ($request) {
                $q->where('unit_kerja', 'like', '%' . $request->unit_kerja . '%');
            });
        }

        if ($request->status) {
            $query->where('status', $request->status);
        }

        $data = $query->get();

        return view('karyawan_asset.laporan', [
            'data' => $data,
            'karyawans' => $karyawans,
            'filters' => $request->only('karyawan_id', 'unit_kerja', 'status'),
        ]);
    }

    public function exportPdf(Request $request)
    {
        $query = KaryawanDetailAsset::with(['karyawan', 'detailAsset.asset']);

        if ($request->karyawan_id) {
            $query->where('karyawan_id', $request->karyawan_id);
        }

        if ($request->unit_kerja) {
            $query->whereHas('karyawan', function ($q) use ($request) {
                $q->where('unit_kerja', $request->unit_kerja);
            });
        }

        if ($request->status) {
            $query->where('status', $request->status);
        }

        $data = $query->get();

        $pdf = Pdf::loadView('karyawan_asset.laporan_pdf', compact('data'));
        return $pdf->stream('laporan_peminjaman.pdf');
    }
}
