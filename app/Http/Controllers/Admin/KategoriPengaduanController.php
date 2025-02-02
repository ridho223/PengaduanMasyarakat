<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\KategoriPengaduan;
use Illuminate\Http\Request;

class KategoriPengaduanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $kategori = KategoriPengaduan::all();
        return view('pages.admin.kategori_pengaduan.index', compact('kategori'));
    }

    public function create()
    {
        return view('pages.admin.kategori_pengaduan.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
        ]);

        KategoriPengaduan::create([
            'nama' => $request->nama,
        ]);

        return redirect()->route('admin.kategori_pengaduan.index');
    }

    public function edit($id)
    {
        $kategori = KategoriPengaduan::findOrFail($id);
        return view('pages.admin.kategori_pengaduan.edit', compact('kategori'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
        ]);

        $kategori = KategoriPengaduan::findOrFail($id);
        $kategori->update([
            'nama' => $request->nama,
        ]);

        return redirect()->route('admin.kategori_pengaduan.index');
    }

    public function destroy($id)
    {
        $kategori = KategoriPengaduan::findOrFail($id);
        $kategori->delete();

        return redirect()->route('admin.kategori_pengaduan.index');
    }
}
