<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    // =============================================
    // LOGIN
    // =============================================
    public function showLogin()
    {
        if (Auth::check()) {
            return redirect()->route('dashboard.admin');
        }
        return view('auth.loginadmin');
    }

    public function login(Request $request)
    {
        return $this->attemptLogin($request, 'dashboard.admin');
    }

    public function loginPetugas(Request $request)
    {
        return $this->attemptLogin($request, 'dashboard.petugas');
    }

    public function loginUser(Request $request)
    {
        return $this->attemptLogin($request, 'dashboard.user');
    }

    protected function attemptLogin(Request $request, string $redirectRoute)
    {
        $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ], [
            'username.required' => 'Nama pengguna wajib diisi.',
            'password.required' => 'Kata sandi wajib diisi.',
        ]);

        $credentials = [
            'username' => $request->username,
            'password' => $request->password,
        ];

        if (Auth::attempt($credentials, $request->boolean('remember'))) {
            $request->session()->regenerate();
            return redirect()->route($redirectRoute)
                ->with('success', 'Berhasil masuk! Selamat datang, ' . Auth::user()->name);
        }

        return back()
            ->withInput($request->only('username'))
            ->withErrors(['username' => 'Nama pengguna atau password salah.']);
    }

    public function logout(Request $request)
    {
        $redirectRoute = match ($request->input('redirect_to')) {
            'login.user' => 'login.user',
            'login.petugas' => 'login.petugas',
            default => 'login',
        };

        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route($redirectRoute)->with('success', 'Anda berhasil keluar.');
    }

    // =============================================
    // REGISTER
    // =============================================
    public function showRegister()
    {
        if (Auth::check()) {
            return redirect()->route('dashboard.admin');
        }
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'username' => 'required|string|max:50|unique:users,username',
            'email'    => 'required|email|unique:users,email',
            'password' => 'required|string|min:6',
            'alamat'   => 'nullable|string|max:255',
        ], [
            'username.required' => 'Nama pengguna wajib diisi.',
            'username.unique'   => 'Nama pengguna sudah digunakan.',
            'email.required'    => 'Surel wajib diisi.',
            'email.email'       => 'Format surel tidak valid.',
            'email.unique'      => 'Surel sudah terdaftar.',
            'password.required' => 'Kata sandi wajib diisi.',
            'password.min'      => 'Kata sandi minimal 6 karakter.',
        ]);

        User::create([
            'name'     => $request->username,
            'username' => $request->username,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
            'alamat'   => $request->alamat,
            'role'     => 'anggota',
        ]);

        return redirect()->route('login.user')
            ->with('success', 'Pendaftaran berhasil! Silakan masuk.');
    }
}
