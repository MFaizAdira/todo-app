<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    // ================================
    // TAMPILAN FORM LOGIN
    // ================================
    public function showLoginForm()
    {
        return view('auth.login');
    }

    // ================================
    // PROSES LOGIN
    // ================================
    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required|string',
            'password' => 'required'
        ]);

        $user = User::where('username', $request->username)->first();

        if ($user && Hash::check($request->password, $user->password)) {
            // Simpan session manual
            $request->session()->put('user_id', $user->id);

            return redirect()->route('todos.index')->with('success', 'Login berhasil!');
        }

        return back()->withErrors(['username' => 'Username atau password salah']);
    }

    // ================================
    // TAMPILAN FORM REGISTER
    // ================================
    public function showRegisterForm()
    {
        return view('auth.register');
    }

    // ================================
    // PROSES REGISTER
    // ================================
    public function register(Request $request)
    {
        $request->validate([
            'username' => 'required|string|max:255|unique:users,username',
            'password' => 'required|min:8|confirmed'
        ]);

        User::create([
            'username' => $request->username,
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('login')->with('success', 'Register berhasil, silakan login.');
    }

    // ================================
    // LOGOUT
    // ================================
    public function logout(Request $request)
    {
        $request->session()->forget('user_id');
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login')->with('success', 'Berhasil logout.');
    }
}
