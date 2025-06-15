<?php

namespace App\Http\Controllers;

use App\Models\Penyewa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class RegisterController extends Controller 
{
    public function index()
    {
        $register = Penyewa::all();
        return view('front.register_cust');
    }

   public function store(Request $request)
{
    $validated = $request->validate([
        'email' => 'required|email|unique:penyewas,email',
        'name' => 'required|string|max:255',
        'password' => 'required|string|min:6|confirmed',
    ]);

    DB::beginTransaction();
    
    try {
        $penyewa = new Penyewa();
        $penyewa->name = $validated['name'];
        $penyewa->email = $validated['email'];
        $penyewa->password = Hash::make($validated['password']);
        $penyewa->save();
        
        DB::commit();
        
        return redirect()->route('login')->with('success', 'Pendaftaran berhasil. Silakan login.');
        
    } catch (\Exception $e) {
        DB::rollback();
        Log::error('Registration error: ' . $e->getMessage());
        return back()->withErrors(['error' => 'Terjadi kesalahan saat pendaftaran.'])->withInput();
    }
}
}