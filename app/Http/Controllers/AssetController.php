<?php

namespace App\Http\Controllers;

use App\Models\Asset;
use App\Models\DetailAsset;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class AssetController extends Controller
{
    public function index()
    {
        $assets = Asset::all(); // ambil semua data asset
        return view('assets.index', compact('assets'));
    }

    public function destroy($id)
    {
        $asset = Asset::findOrFail($id);
        $asset->delete();

        return redirect()->route('assets.index')->with('success', 'Asset berhasil dihapus');
    }

    public function edit($id)
    {
        $asset = Asset::with('detailAssets')->findOrFail($id);
        return view('assets.edit', compact('asset'));
    }

    public function update(Request $request, $id)
    {
        $asset = Asset::findOrFail($id);
        $asset->update($request->only(['nama_asset', 'deskripsi']));

        return redirect()->route('assets.index')->with('success', 'Asset berhasil diperbarui');
    }

    // Menampilkan form untuk menambah asset
    public function create()
    {
        return view('assets.create');  // Menampilkan form tambah asset
    }

    public function show($id)
    {
        $asset = Asset::with('detailAssets')->findOrFail($id);
        return view('assets.show', compact('asset'));
    }

    // Menyimpan asset baru ke dalam database
    public function store(Request $request)
    {
        $request->validate([
            'nama_asset' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
        ]);

        Asset::create([
            'nama_asset' => $request->nama_asset,
            'deskripsi' => $request->deskripsi,
        ]);

        return redirect()->route('assets.index')->with('success', 'Asset berhasil ditambahkan');
    }
    public function laporan(Request $request)
    {
        $query = DetailAsset::with('asset')
            ->join('assets', 'detail_assets.asset_id', '=', 'assets.id'); // Menggabungkan detail_assets dengan assets

        // Filter berdasarkan tanggal perolehan (periode)
        if ($request->has('tanggal_awal') && $request->has('tanggal_akhir')) {
            $query->whereBetween('detail_assets.tanggal_perolehan', [
                $request->tanggal_awal,
                $request->tanggal_akhir,
            ]);
        }

        // Mendapatkan hasil query
        $data = $query->get();

        // Mengirimkan data ke view laporan
        return view('assets.laporan', compact('data'));
    }

    // Fungsi untuk export laporan ke PDF
    public function exportPdf(Request $request)
    {
        // Query yang sama dengan laporan biasa
        $query = DetailAsset::with('asset')
            ->join('assets', 'assets.id', '=', 'detail_assets.asset_id')
            ->select('detail_assets.*', 'assets.nama_asset', 'assets.deskripsi');

        // Filter berdasarkan periode tanggal perolehan
        if ($request->has('tanggal_awal') && $request->has('tanggal_akhir')) {
            $query->whereBetween('detail_assets.tanggal_perolehan', [
                $request->tanggal_awal,
                $request->tanggal_akhir
            ]);
        }

        // Ambil data laporan
        $data = $query->get();

        // Menggunakan DomPDF untuk export PDF
        $pdf = Pdf::loadView('assets.laporan_pdf', compact('data'));

        return $pdf->stream('laporan-asset.pdf');

    }
}
