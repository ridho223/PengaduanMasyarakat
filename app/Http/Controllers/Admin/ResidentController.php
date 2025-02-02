<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class ResidentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $residents = User::where('status', 'User')->get();
        return view('pages.admin.resident.index', compact('residents'));
    }

    /**
     * Store a newly created resource in storage.
     */

    public function create()
    {
        // $residents = User::where('status', 'User')->get();
        return view('pages.admin.resident.create', );
    }
    public function store(Request $request)
    {

        $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
            'telephone' => 'required',
        ]);


        $data = new User();
        $data->name = $request->name;
        $data->email = $request->email;
        $data->telephone = $request->telephone;
        $data->status = 'User';
        $data->password = bcrypt($request->password);

        if ($request->hasFile('avatar')) {
            $extension = $request->file('avatar')->getClientOriginalExtension(); // Dapatkan ekstensi file
            $fileName = 'profile_' . $data->name . '.' . $extension; // Contoh: profile_1.jpg
            $path = $request->file('avatar')->storeAs('avatars', $fileName, 'public');
            $data->avatar = $path;
        }

        // Membuat user baru
        $data->save();

        // dd($data);

        return redirect()->route('admin.resident.index')->with('success', 'Data Masyarakat berhasil dibuat');
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

    public function edit(Request $request, $id)
    {
        $residents = User::where('status', 'User')->findOrFail($id);
        return view('pages.admin.resident.edit', compact('residents'));
    }
    public function update(Request $request, string $id)
    {
        $residents = User::where('status', 'User')->findOrFail($id);

        $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|email|',
            'telephone' => 'required',
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $residents->name = $request->name;
        $residents->email = $request->email;
        $residents->telephone = $request->telephone;


        if ($request->hasFile('avatar')) {
            if ($residents->avatar) {
                \Storage::delete($residents->avatar); // Delete old avatar if exists
            }
            $extension = $request->file('avatar')->getClientOriginalExtension(); // Dapatkan ekstensi file
            $fileName = 'profile_' . $residents->name . '.' . $extension; // Contoh: profile_1.jpg

            $path = $request->file('avatar')->storeAs('avatars', $fileName, 'public');
            $residents->avatar = $path;
        }


        $residents->save();

        return redirect()->route('admin.resident.index')->with('success', 'Data masyarakat berhasil di edit');

    }

    public function uploadAvatar(Request $request, $id)
    {
        $request->validate([
            'file' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $residents = User::findOrFail($id);

        if ($request->hasFile('file')) {
            // Hapus avatar lama jika ada
            if ($residents->avatar) {
                \Storage::delete($residents->avatar);
            }

            // Simpan file avatar
            $fileName = 'profile_' . $residents->id . '.' . $request->file->getClientOriginalExtension();
            $path = $request->file('file')->storeAs('avatars', $fileName, 'public');

            // Simpan ke database
            $residents->avatar = $path;
            $residents->save();

            return response()->json(['success' => true, 'avatar' => asset('storage/' . $path)]);
        }

        return response()->json(['success' => false, 'message' => 'Gagal mengunggah avatar'], 400);
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $residents = User::where('status', 'User')->findOrFail($id);
        $residents->delete();

        return redirect()->back()->with('success', 'Data masyarakat berhasil dihapus');
    }
}
