<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use App\Http\Controllers\Controller;
use App\Models\Pengaduan;
use App\Models\Tanggapan;
use Illuminate\Http\Request;

class PengaduanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pengaduans = Pengaduan::where('status', 'Ditolak')
            ->where('updated_at', '<', Carbon::now()->subDay())
            ->get();

        foreach ($pengaduans as $pengaduan) {
            $pengaduan->delete();
        }

        $pengaduans = Pengaduan::with('user', 'kategori')->where('status', '!=', 'Selesai')->get();
        return view('pages.admin.pengaduan.index', compact('pengaduans'));
    }

    public function show($id)
    {
        // Menampilkan detail pengaduan dan tanggapan yang sudah ada
        $pengaduan = Pengaduan::with('tanggapan')->findOrFail($id);
        return view('pages.admin.pengaduan.show', compact('pengaduan'));
    }

    public function addTanggapan(Request $request, $id)
    {
        $validated = $request->validate([
            'tanggapan' => 'required|string',
        ]);

        // Menambahkan tanggapan
        Tanggapan::create([
            'pengaduan_id' => $id,
            'admin_id' => auth()->id(),
            'tanggapan' => $validated['tanggapan'],
        ]);

        // Mengubah status pengaduan menjadi 'Diproses'
        $pengaduan = Pengaduan::findOrFail($id);
        $pengaduan->update(['status' => 'Diproses']);

        return redirect()->route('admin.pengaduan.show', $id)->with('success', 'Tanggapan berhasil ditambahkan.');
    }

    public function markAsCompleted($id)
    {
        // Temukan pengaduan berdasarkan ID
        $pengaduan = Pengaduan::findOrFail($id);

        if ($pengaduan->status == 'Diproses') {
            $pengaduan->update(['status' => 'Selesai']);
            return redirect()->back()->with('success', 'Pengaduan telah ditandai sebagai selesai.');
        }

        return redirect()->back()->with('error', 'Pengaduan tidak dapat ditandai selesai.');
    }

    public function reject(Request $request, $id)
    {
        $request->validate([
            'reason' => 'required|string',
        ]);

        // Temukan pengaduan berdasarkan ID
        $pengaduan = Pengaduan::findOrFail($id);

        // Perbarui tanggapan yang ada dengan alasan penolakan
        $tanggapan = Tanggapan::where('pengaduan_id', $id)->first();

        // Update kolom 'reason_reject' pada tanggapan yang ada
        $tanggapan->update([
            'reason_reject' => $request->reason,
        ]);

        // Update status pengaduan menjadi 'Ditolak'
        $pengaduan->update(['status' => 'Ditolak']);

        return redirect()->back()->with('error', 'Pengaduan telah ditolak dengan alasan yang diperbarui.');
    }


}
