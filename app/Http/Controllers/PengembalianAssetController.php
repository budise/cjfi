<?php

namespace App\Http\Controllers;

use App\Models\PengembalianAsset;
use App\Models\KaryawanDetailAsset;
use Illuminate\Http\Request;

class PengembalianAssetController extends Controller
{
    public function index()
    {
        $pengembalians = PengembalianAsset::with('karyawanDetailAsset.karyawan', 'karyawanDetailAsset.detailAsset')->get();
        return view('pengembalian_asset.index', compact('pengembalians'));
    }

    public function create()
    {
        $peminjamans = KaryawanDetailAsset::with('karyawan', 'detailAsset')->get();
        return view('pengembalian_asset.create', compact('peminjamans'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'karyawan_detail_asset_id' => 'required|exists:karyawan_detail_asset,id',
            'tanggal_kembali' => 'required|date',
            'keterangan' => 'nullable|string',
        ]);

        // Simpan pengembalian
        $pengembalian = PengembalianAsset::create($request->all());

        // Update status detail_asset jadi "di gudang"
        $detailAsset = $pengembalian->karyawanDetailAsset->detailAsset;
        $detailAsset->status = '1';
        $detailAsset->save();

        // Update status peminjaman ke "dikembalikan"
        $pengembalian->karyawanDetailAsset->update(['status' => 2]);

        return redirect()->route('pengembalian-asset.index')->with('success', 'Data pengembalian ditambahkan');
    }


    public function edit(PengembalianAsset $pengembalianAsset)
    {
        $peminjamans = KaryawanDetailAsset::with('karyawan', 'detailAsset')->get();
        return view('pengembalian_asset.edit', compact('pengembalianAsset', 'peminjamans'));
    }

    public function update(Request $request, PengembalianAsset $pengembalianAsset)
    {
        $request->validate([
            'karyawan_detail_asset_id' => 'required|exists:karyawan_detail_assets,id',
            'tanggal_kembali' => 'required|date',
            'keterangan' => 'nullable|string',
        ]);

        $pengembalianAsset->update($request->all());

        // Update status detail_asset tetap "di gudang"
        $detailAsset = $pengembalianAsset->karyawanDetailAsset->detailAsset;
        $detailAsset->status = 'di gudang';
        $detailAsset->save();

        return redirect()->route('pengembalian-asset.index')->with('success', 'Data pengembalian diperbarui');
    }


    public function destroy(PengembalianAsset $pengembalianAsset)
    {
        $pengembalianAsset->delete();
        return redirect()->route('pengembalian-asset.index')->with('success', 'Data pengembalian dihapus');
    }
}
