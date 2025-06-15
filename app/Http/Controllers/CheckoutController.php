<?php

namespace App\Http\Controllers;

use App\Models\Pembayaran;
use App\Models\Penyewaan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class CheckoutController extends Controller
{
    /**
     * Tampilkan halaman checkout
     */
    public function show($penyewaan_id)
    {
        try {
            // Ambil data penyewaan dengan relasi
            $penyewaan = Penyewaan::with([
                'penyewa',
                'detailPenyewaans.playstation'
            ])
                ->where('id', $penyewaan_id)
                ->where('status', 'pinjam') // Hanya penyewaan dengan status pinjam
                ->firstOrFail();

            // Pastikan hanya penyewa yang bisa akses checkout
            if (Auth::guard('penyewa')->id() !== $penyewaan->penyewa->id) {
                abort(403, 'Anda tidak memiliki akses ke halaman ini.');
            }

            // Generate ID Pembayaran
            $pby_id = Pembayaran::generateUniquePbyId();

            // Hitung total harga
            $total_harga = $penyewaan->detailPenyewaans->sum('total_harga');

            // Cek stok availability
            foreach ($penyewaan->detailPenyewaans as $detail) {
                if ($detail->playstation->stok < $detail->jumlah) {
                    return redirect()->back()->with(
                        'error',
                        "Stok {$detail->playstation->nama_playstation} tidak mencukupi! " .
                            "Tersedia: {$detail->playstation->stok}, Dibutuhkan: {$detail->jumlah}"
                    );
                }
            }

            return view('frontend.checkout.create', compact('penyewaan', 'pby_id', 'total_harga'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Penyewaan tidak ditemukan atau tidak valid.');
        }
    }

    /**
     * Proses pembayaran
     */
    /**
     * Proses pembayaran
     */
    public function store(Request $request)
    {
        // Debug: Log request data
        Log::info('Checkout store method called', [
            'request_data' => $request->all(),
            'url' => $request->url(),
            'method' => $request->method()
        ]);

        $request->validate([
            'pby_id' => 'required|string|unique:pembayarans,pby_id',
            'id_penyewaan' => 'required|exists:penyewaans,id',
            'metode_bayar' => 'required|in:Tunai,E-Wallet,Transfer',
            // 'jumlah_bayar' => 'required|numeric|min:0',
        ]);

        try {
            DB::beginTransaction();

            // Ambil data penyewaan
            $penyewaan = Penyewaan::with([
                'penyewa',
                'detailPenyewaans.playstation'
            ])->findOrFail($request->id_penyewaan);

            // Pastikan hanya penyewa yang bisa melakukan pembayaran
            if (Auth::guard('penyewa')->id() !== $penyewaan->penyewa->id) {
                abort(403, 'Anda tidak memiliki akses untuk melakukan pembayaran ini.');
            }

            // Validasi total harga
            $total_harga_penyewaan = $penyewaan->detailPenyewaans->sum('total_harga');
            // Set jumlah bayar otomatis sama dengan total harga
            $jumlah_bayar = $request->jumlah_bayar ?? $total_harga_penyewaan;
            // Cek stok sekali lagi sebelum pembayaran
            foreach ($penyewaan->detailPenyewaans as $detail) {
                if ($detail->playstation->stok < $detail->jumlah) {
                    DB::rollBack();
                    return redirect()->back()->with(
                        'error',
                        "Stok {$detail->playstation->nama_playstation} tidak mencukupi!"
                    );
                }
            }

            // Buat pembayaran
            $pembayaran = Pembayaran::create([
                'pby_id' => $request->pby_id,
                'id_penyewaan' => $request->id_penyewaan,
                'metode_bayar' => $request->metode_bayar,
                'jumlah_bayar' => $request->jumlah_bayar,
                'status' => 'pending', // Status awal pending
                'is_paid' => false,
            ]);

            DB::commit();

            // Debug: Log successful payment creation
            Log::info('Payment created successfully', [
                'pembayaran_id' => $pembayaran->id,
                'pby_id' => $pembayaran->pby_id
            ]);

            return redirect()->route('pembayaran.success', $pembayaran->id)
                ->with('success', 'Pembayaran berhasil dibuat! Menunggu konfirmasi admin.');
        } catch (\Exception $e) {
            DB::rollBack();

            // Debug: Log error
            Log::error('Checkout store error', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    /**
     * Halaman sukses pembayaran
     */
    public function __construct()
    {
        $this->middleware('auth:penyewa')->only(['detail']);
        // atau untuk semua method:
        // $this->middleware('auth:penyewa');
    }
    public function success($pembayaran_id)
    {
        $pembayaran = Pembayaran::with([
            'penyewaan.penyewa',
            'penyewaan.detailPenyewaans.playstation'
        ])->findOrFail($pembayaran_id);

        // Pastikan hanya penyewa yang bisa akses
        if (Auth::guard('penyewa')->id() !== $pembayaran->penyewaan->penyewa->id) {
            abort(403, 'Anda tidak memiliki akses ke halaman ini.');
        }

        // Ambil pby_id dari data pembayaran
        // Sesuaikan dengan nama kolom di database Anda
        $pby_id = $pembayaran->pby_id ?? $pembayaran->payment_id ?? 'PBY' . str_pad($pembayaran->id, 4, '0', STR_PAD_LEFT);

        return view('frontend.checkout.succes', compact('pembayaran', 'pby_id'));
    }
    /**
     * Tampilkan detail pembayaran berdasarkan pby_id
     */
    public function detail($pby_id)
    {
        try {
            // Pastikan user sudah login
            if (!Auth::guard('penyewa')->check()) {
                return redirect()->route('login')->with('error', 'Silakan login terlebih dahulu.');
            }

            $pembayaran = Pembayaran::with([
                'penyewaan.penyewa',
                'penyewaan.detailPenyewaans.playstation'
            ])
                ->where('pby_id', $pby_id)
                ->firstOrFail();

            // Pastikan hanya penyewa yang bisa akses detail pembayarannya
            if (Auth::guard('penyewa')->id() !== $pembayaran->penyewaan->penyewa->id) {
                abort(403, 'Anda tidak memiliki akses ke halaman ini.');
            }

            $tanggal_sewa = \Carbon\Carbon::parse($pembayaran->penyewaan->tgl_sewa);
            $tanggal_kembali = \Carbon\Carbon::parse($pembayaran->penyewaan->tgl_kembali);
            $durasi = $tanggal_sewa->diffInDays($tanggal_kembali) + 1;
            $durasi_sewa = $tanggal_sewa->diffInDays($tanggal_kembali);
            $total_harga = $pembayaran->penyewaan->detailPenyewaans->sum('total_harga');

            return view('frontend.checkout.detail', compact('pembayaran', 'pby_id', 'durasi', 'total_harga', 'durasi_sewa'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Detail pembayaran tidak ditemukan atau tidak valid.');
        }
    }
}
