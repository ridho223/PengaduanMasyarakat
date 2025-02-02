<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\KategoriPengaduan;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Pengaduan;

class PengaduanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pengaduans = Pengaduan::where('users_id', Auth::id())->get();
        return view('pages.user.pengaduan.index', compact('pengaduans'));
    }

    public function create()
    {
        $kategori = KategoriPengaduan::all();
        return view('pages.user.pengaduan.create', compact('kategori'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'lokasi' => 'required|string|max:255',
            'lampiran' => 'nullable|file|mimes:jpg,png,pdf|max:2048',
            'kategori_id' => 'required|exists:kategori_pengaduans,id',
        ]);

        // Menyimpan file lampiran
        $lampiran = $request->file('lampiran');
        $lampiranPath = $lampiran ? $lampiran->store('lampiran', 'public') : null;

        // Menyimpan pengaduan
        Pengaduan::create([
            'users_id' => auth()->id(),
            'judul' => $validated['judul'],
            'deskripsi' => $validated['deskripsi'],
            'lokasi' => $validated['lokasi'],
            'lampiran' => $lampiranPath,
            'kategori_id' => $validated['kategori_id'],
            'status' => 'Pending', // Status default saat pengaduan dibuat
        ]);

        return redirect()->route('user.dashboard')->with('success', 'Pengaduan berhasil dikirim.');
    }

    public function show($id)
    {
        // Menampilkan pengaduan milik user yang sedang login
        $pengaduan = Pengaduan::where('id', $id)->where('users_id', auth()->id())->firstOrFail();

        $kategori = $pengaduan->kategori;

        return view('pages.user.pengaduan.show', compact('pengaduan', 'kategori'));
    }

    public function edit($id)
    {
        $pengaduans = Pengaduan::where('users_id', Auth::id())->findOrFail($id);
        $kategori = KategoriPengaduan::all();

        return view('pages.user.pengaduan.edit', compact('pengaduans', 'kategori'));
    }

    public function update(Request $request, $id)
    {
        // Validate the incoming data
        $validated = $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'lokasi' => 'required|string|max:255',
            'lampiran' => 'nullable|file|mimes:jpg,png,pdf|max:2048',
        ]);

        // Find the pengaduan by ID
        $pengaduan = Pengaduan::findOrFail($id);

        // Save the existing lampiran (file) if no new file is uploaded
        $lampiranPath = $pengaduan->lampiran;

        if ($request->hasFile('lampiran')) {
            // Delete the old file if it exists
            if ($lampiranPath) {
                Storage::disk('public')->delete($lampiranPath);
            }

            // Save the new uploaded file
            $lampiran = $request->file('lampiran');
            $lampiranPath = $lampiran->store('lampiran', 'public');
        }

        // Update pengaduan data
        $pengaduan->update([
            'judul' => $validated['judul'],
            'deskripsi' => $validated['deskripsi'],
            'lokasi' => $validated['lokasi'],
            'lampiran' => $lampiranPath,
        ]);

        return redirect()->route('user.dashboard')->with('success', 'Pengaduan berhasil diperbarui.');
    }
    public function destroy($id)
    {
        // Menghapus pengaduan milik user yang sedang login
        $pengaduan = Pengaduan::where('id', $id)->where('users_id', auth()->id())->firstOrFail();
        $pengaduan->delete();
        return redirect()->route('user.dashboard')->with('success', 'Pengaduan berhasil dihapus.');
    }
}
