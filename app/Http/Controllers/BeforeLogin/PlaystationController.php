<?php

namespace App\Http\Controllers\BeforeLogin;

use App\Http\Controllers\Controller;
use App\Models\Playstation;
use Illuminate\Http\Request;

class PlaystationController extends Controller
{
    public function index()
    {
        $latest_playstation = Playstation::all();
        return view('front.paket_harga', compact('latest_playstation'));
    }
}
