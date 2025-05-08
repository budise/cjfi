<?php

namespace App\Http\Controllers;

use App\Models\Asset;
use Illuminate\Http\Request;

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
}
