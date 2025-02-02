<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $admin = User::where('status', 'Admin')->get();

        return view('pages.admin.Admin.index', compact('admin'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function create()
    {
        return view('pages.admin.Admin.create', );
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
        $data->status = 'Admin';
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

        return redirect()->route('admin.Admin.index')->with('success', 'Data Masyarakat berhasil dibuat');
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
        $admin = User::where('status', 'Admin')->findOrFail($id);
        return view('pages.admin.Admin.edit', compact('admin'));
    }
    public function update(Request $request, string $id)
    {
        $admin = User::where('status', 'Admin')->findOrFail($id);

        $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|email|',
            'telephone' => 'required',
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $admin->name = $request->name;
        $admin->email = $request->email;
        $admin->telephone = $request->telephone;


        if ($request->hasFile('avatar')) {
            if ($admin->avatar) {
                \Storage::delete($admin->avatar); // Delete old avatar if exists
            }
            $extension = $request->file('avatar')->getClientOriginalExtension(); // Dapatkan ekstensi file
            $fileName = 'profile_' . $admin->name . '.' . $extension; // Contoh: profile_1.jpg

            $path = $request->file('avatar')->storeAs('avatars', $fileName, 'public');
            $admin->avatar = $path;
        }


        $admin->save();

        return redirect()->route('admin.Admin.index')->with('success', 'Data masyarakat berhasil di edit');

    }

    public function uploadAvatar(Request $request, $id)
    {
        $request->validate([
            'file' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $admin = User::findOrFail($id);

        if ($request->hasFile('file')) {
            // Hapus avatar lama jika ada
            if ($admin->avatar) {
                \Storage::delete($admin->avatar);
            }

            // Simpan file avatar
            $fileName = 'profile_' . $admin->id . '.' . $request->file->getClientOriginalExtension();
            $path = $request->file('file')->storeAs('avatars', $fileName, 'public');

            // Simpan ke database
            $admin->avatar = $path;
            $admin->save();

            return response()->json(['success' => true, 'avatar' => asset('storage/' . $path)]);
        }

        return response()->json(['success' => false, 'message' => 'Gagal mengunggah avatar'], 400);
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $admin = User::where('status', 'Admin')->findOrFail($id);
        $admin->delete();

        return redirect()->back()->with('success', 'Data masyarakat berhasil dihapus');
    }
}
