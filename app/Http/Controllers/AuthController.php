<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class AuthController extends Controller
{
    public function index_login(Request $request)
    {
        return view('auth.login');
    }

    public function admin_login()
    {
        return view('auth.admin-login');
    }

    public function login(Request $request)
    {
        // Validasi input
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);

        // Coba autentikasi pengguna
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            // Jika berhasil login, periksa peran pengguna
            $user = Auth::user();

            $user->update(['last_login' => now()]);

            // Cek peran pengguna dan arahkan ke halaman yang sesuai
            if ($user->status == 'Admin') {
                // Arahkan ke dashboard admin              
                return redirect()->route('admin.dashboard')->with('success', 'Berhasil login sebagai Admin!');
            } elseif ($user->status == 'User') {
                // Arahkan ke dashboard user
                return redirect()->route('user.dashboard')->with('success', 'Berhasil login sebagai User!');
            }
        }

        // Jika gagal login
        return back()->withErrors([
            'email' => 'Email atau password salah.',
        ])->withInput($request->only('email'));
    }

    public function logout(Request $request)
    {
        $user = Auth::user();

        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        if ($user->status == 'Admin') {
            return redirect('/admin')->with('success', 'Berhasil logout!');
        }

        return redirect('/')->with('success', 'Berhasil logout!');
    }

    // Proses register
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'status' => 'User',
        ]);

        Auth::login($user);

        return redirect()->route('user.dashboard')->with('success', 'Akun berhasil dibuat! Silakan login.');
    }

    // Menampilkan form lupa password
    public function index_forgot()
    {
        return view('auth.forgot-password');
    }

    // Proses lupa password
    public function sendResetLink(Request $request)
    {
        $request->validate(['email' => 'required|email|exists:users,email']);

        Password::sendResetLink($request->only('email'));

        return back()->with('status', 'Link reset password telah dikirim ke email Anda.');
    }
}
