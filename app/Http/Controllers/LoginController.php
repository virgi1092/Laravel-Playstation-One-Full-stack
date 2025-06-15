<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Penyewa;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class LoginController extends Controller
{
    public function index()
    {
        // Jika sudah login, redirect ke beranda
        if (Auth::guard('penyewa')->check()) {
            return redirect()->route('beranda.login');
        }
        
        return view('front.login_cust');
    }

    public function masuk(Request $request)
    {
        try {
            $request->validate([
                'name' => 'required|string',
                'password' => 'required|string',
            ]);

            $credentials = [
                'name' => $request->name,
                'password' => $request->password
            ];

            // Debug: Log attempt
            Log::info('Login attempt for: ' . $request->name);

            // Cek apakah user exists
            $user = Penyewa::where('name', $request->name)->first();
            if (!$user) {
                Log::warning('User not found: ' . $request->name);
                return back()->withErrors([
                    'login' => 'Username tidak ditemukan.'
                ])->withInput();
            }

            // Debug: Log user found
            Log::info('User found: ' . $user->name);

            // Attempt login
            if (Auth::guard('penyewa')->attempt($credentials)) {
                $request->session()->regenerate();
                Log::info('Login successful for: ' . $user->name);
                return redirect()->route('beranda.login')->with('success', 'Login berhasil!');
            }

            Log::warning('Login failed for: ' . $request->name);
            return back()->withErrors([
                'login' => 'Username atau password salah.'
            ])->withInput();

        } catch (\Exception $e) {
            Log::error('Login error: ' . $e->getMessage());
            Log::error('Stack trace: ' . $e->getTraceAsString());
            
            return back()->withErrors([
                'login' => 'Terjadi kesalahan saat login. Silakan coba lagi.'
            ])->withInput();
        }
    }

    public function logout(Request $request)
    {
        Auth::guard('penyewa')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        
        return redirect()->route('beranda')->with('success', 'Logout berhasil!');
    }
}