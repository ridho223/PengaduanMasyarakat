<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Pengaduan;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function admin_index()
    {
        $pengaduans = Pengaduan::where('status', 'Ditolak')
            ->where('updated_at', '<', Carbon::now()->subDay())
            ->get();

        foreach ($pengaduans as $pengaduan) {
            $pengaduan->delete();
        }

        $pengaduan = Pengaduan::all();

        // Statistik jumlah pengaduan per bulan
        $statistikBulanan = Pengaduan::selectRaw('MONTH(created_at) as bulan, COUNT(*) as total')
            ->groupBy('bulan')
            ->orderBy('bulan', 'asc')
            ->get()
            ->pluck('total', 'bulan');

        // Format bulan untuk chart
        $labels = collect(range(1, 12))->map(function ($bulan) {
            return Carbon::create()->month($bulan)->format('M');
        });

        // Isi jumlah pengaduan dengan nilai 0 jika tidak ada data di bulan tertentu
        $data = $labels->map(fn($label, $key) => $statistikBulanan->get($key + 1, 0));

        return view('pages.admin.dashboard', compact('pengaduan', 'labels', 'data'));
    }
    public function user_index(Request $request)
    {
        $pengaduans = Pengaduan::where('status', 'Ditolak')
            ->where('updated_at', '<', Carbon::now()->subDay())
            ->get();

        foreach ($pengaduans as $pengaduan) {
            $pengaduan->delete();
        }

        $user = auth()->user();

        $status = $request->input('status');
        $search = $request->input('search');

        $pengaduanUser = Pengaduan::where('users_id', $user->id)
            ->when($status, function ($query, $status) {
                return $query->where('status', $status);
            });

        if (!empty($search)) {
            $columns = Schema::getColumnListing('pengaduans');
            $pengaduanUser->where(function ($query) use ($search, $columns) {
                foreach ($columns as $column) {
                    $query->orWhere($column, 'LIKE', "%$search%");
                }
            });
        }

        $pengaduanUser = $pengaduanUser->get();


        return view('pages.user.dashboard', compact('pengaduanUser'));
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
