<?php

namespace App\Http\Controllers\AfterLogin;

use App\Http\Controllers\Controller;
use App\Models\Playstation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PlaystationAfterController extends Controller
{
    public function index()
    {
         $latest_playstation = Playstation::all();
        
        // Bisa menambahkan data user yang login jika diperlukan
        $user = Auth::guard('penyewa')->user();
        
        return view('frontend.paket_harga', compact('latest_playstation', 'user'));
    }
}
