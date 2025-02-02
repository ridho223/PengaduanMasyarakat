<?php

namespace App\Http\Controllers;

use App\Models\User;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;



class ProfileController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        return view('pages.profile.index', compact('user'));

    }

    public function edit()
    {
        $user = auth()->user();
        return view('pages.profile.edit', compact('user'));
    }


    public function update(Request $request)
    {
        $user = auth()->user();

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'telephone' => 'nullable|string|max:20',
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
        // dd($request->all());

        $user->name = $request->name;
        $user->email = $request->email;
        $user->telephone = $request->telephone;

        if ($request->password) {

            $user->password = bcrypt($request->password);
        }

        if ($request->hasFile('avatar')) {
            if ($user->avatar) {
                \Storage::delete($user->avatar); // Delete old avatar if exists
            }
            $extension = $request->file('avatar')->getClientOriginalExtension(); // Dapatkan ekstensi file
            $fileName = 'profile_' . $user->name . '.' . $extension; // Contoh: profile_1.jpg

            $path = $request->file('avatar')->storeAs('avatars', $fileName, 'public');
            $user->avatar = $path;
        }

        $user->save();

        return redirect()->route('admin.profile')->with('success', 'Profil berhasil diperbarui!');

    }
    public function update_user(Request $request)
    {
        $user = auth()->user();

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'telephone' => 'nullable|string|max:20',
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
        // dd($request->all());

        $user->name = $request->name;
        $user->email = $request->email;
        $user->telephone = $request->telephone;

        if ($request->password) {

            $user->password = bcrypt($request->password);
        }

        if ($request->hasFile('avatar')) {
            if ($user->avatar) {
                \Storage::delete($user->avatar); // Delete old avatar if exists
            }
            $extension = $request->file('avatar')->getClientOriginalExtension(); // Dapatkan ekstensi file
            $fileName = 'profile_' . $user->name . '.' . $extension; // Contoh: profile_1.jpg

            $path = $request->file('avatar')->storeAs('avatars', $fileName, 'public');
            $user->avatar = $path;
        }

        $user->save();


        return redirect()->back()->with('success', 'Profil berhasil diperbarui!');

    }


    public function uploadAvatar(Request $request)
    {
        $request->validate([
            'file' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $user = auth()->user();

        if ($request->hasFile('file')) {
            // Hapus avatar lama jika ada
            if ($user->avatar) {
                \Storage::delete($user->avatar);
            }

            // Simpan file avatar
            $fileName = 'profile_' . $user->id . '.' . $request->file->getClientOriginalExtension();
            $path = $request->file('file')->storeAs('avatars', $fileName, 'public');

            // Simpan ke database
            $user->avatar = $path;
            $user->save();

            return response()->json(['success' => true, 'avatar' => asset('storage/' . $path)]);
        }

        return response()->json(['success' => false, 'message' => 'Gagal mengunggah avatar'], 400);
    }


}
