<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pengaduan;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;


class RekapController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pengaduans = Pengaduan::with('user', 'kategori')->where('status', 'Selesai')->get();
        return view('pages.admin.rekap.index', compact('pengaduans'));
    }

    public function exportPdf()
    {
        $pengaduans = Pengaduan::with('user', 'kategori')->where('status', 'Selesai')->get();

        $pdf = Pdf::loadView('pages.admin.rekap.pdf', compact('pengaduans'))
            ->setPaper('a4', 'landscape');


        return $pdf->stream('rekap_pengaduan.pdf');
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
