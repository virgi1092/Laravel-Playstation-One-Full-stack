<?php

namespace App\Http\Controllers\AfterLogin;

use App\Http\Controllers\Controller;
use App\Models\Penyewa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BerandaController extends Controller
{
    public function index()
    {
        // Pastikan user sudah terautentikasi
        if (!Auth::guard('penyewa')->check()) {
            return redirect()->route('login');
        }

        $penyewa = Auth::guard('penyewa')->user();
        
        return view('beranda.login', compact('penyewa'));
    }
}
