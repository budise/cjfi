<?php

namespace App\Http\Controllers;

use App\Models\DetailAsset;
use App\Models\Asset;
use Illuminate\Http\Request;

class DetailAssetController extends Controller
{
    /**
     * Menampilkan daftar detail asset (opsional).
     */
    public function index()
    {
        $details = DetailAsset::with('asset')->get();
        return view('detail-assets.index', compact('details'));
    }

    /**
     * Menampilkan form untuk membuat detail asset baru.
     */
    public function create(Request $request)
    {
        $asset = Asset::findOrFail($request->asset_id); // pastikan asset valid
        return view('detail-assets.create', compact('asset'));
    }

    /**
     * Menyimpan detail asset ke database.
     */
    public function store(Request $request)
    {
        $request->validate([
            'asset_id' => 'required|exists:assets,id',
            'kode_asset' => 'required|string|max:100',
            'keterangan' => 'nullable|string',
        ]);

        DetailAsset::create($request->all());

        return redirect()->route('assets.index')->with('success', 'Detail asset berhasil ditambahkan.');
    }

    /**
     * Menampilkan satu detail asset (opsional).
     */
    public function show(DetailAsset $detailAsset)
    {
        return view('detail-assets.show', compact('detailAsset'));
    }

    /**
     * Menampilkan form untuk mengedit detail asset.
     */
    public function edit(DetailAsset $detailAsset)
    {
        return view('detail-assets.edit', compact('detailAsset'));
    }

    /**
     * Memperbarui detail asset di database.
     */
    public function update(Request $request, DetailAsset $detailAsset)
    {
        $request->validate([
            'kode_asset' => 'required|string|max:100',
            'keterangan' => 'nullable|string',
        ]);

        $detailAsset->update($request->all());

        return redirect()->route('assets.index')->with('success', 'Detail asset berhasil diperbarui.');
    }

    /**
     * Menghapus detail asset dari database.
     */
    public function destroy(DetailAsset $detailAsset)
    {
        $detailAsset->delete();

        return redirect()->route('assets.index')->with('success', 'Detail asset berhasil dihapus.');
    }
}
