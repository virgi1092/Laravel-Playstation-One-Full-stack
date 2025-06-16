<?php

namespace App\Http\Controllers;

use App\Models\Rental;
use App\Models\Playstation;
use App\Models\DetailPenyewaan;
use App\Models\Penyewaan;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class RentalController extends Controller
{
    public function index()
    {
        $rentals = Penyewaan::with(['penyewa', 'detailPenyewaans.playstation'])->latest()->paginate(10);
        return view('rental.index', compact('rentals'));
    }

    public function create()
    {
        $playstations = Playstation::where('stok', '>', 0)->get();
        return view('frontend.rental.create', compact('playstations'));
    }

    public function store(Request $request)
    {
        // Debug: Log semua data yang diterima
        Log::info('Rental Store Request:', [
            'all_data' => $request->all(),
            'files' => $request->allFiles(),
            'has_foto_jaminan' => $request->hasFile('foto_jaminan'),
            'foto_jaminan_info' => $request->file('foto_jaminan') ? [
                'name' => $request->file('foto_jaminan')->getClientOriginalName(),
                'size' => $request->file('foto_jaminan')->getSize(),
                'mime' => $request->file('foto_jaminan')->getMimeType(),
            ] : 'No file'
        ]);

        // Cek apakah user sudah login terlebih dahulu
        if (!auth('penyewa')->check()) {
            return redirect()->route('penyewa.login')->with('error', 'Silakan login terlebih dahulu');
        }

        // Custom validation dengan pesan error yang lebih jelas
        $validator = Validator::make($request->all(), [
            'alamat' => 'required|string|max:255',
            'no_telpon' => 'required|string|max:20',
            'jaminan' => 'required|in:ktp,sim,stnk,ijazah',
            'foto_jaminan' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'tgl_sewa' => 'required|date|after_or_equal:today',
            'tgl_kembali' => 'required|date|after:tgl_sewa',
            'detail_penyewaans' => 'required|array|min:1',
            'detail_penyewaans.*.id_playstation' => 'required|exists:playstations,id',
            'detail_penyewaans.*.jumlah' => 'required|integer|min:1',
            'detail_penyewaans.*.durasi_sewa' => 'required|integer|min:1',
            'detail_penyewaans.*.total_harga' => 'required|numeric|min:0',
        ], [
            'foto_jaminan.required' => 'Foto jaminan harus dipilih',
            'foto_jaminan.image' => 'File harus berupa gambar',
            'foto_jaminan.mimes' => 'Format file harus JPEG, PNG, JPG, atau GIF',
            'foto_jaminan.max' => 'Ukuran file maksimal 2MB',
            'jaminan.required' => 'Jenis jaminan harus dipilih',
            'jaminan.in' => 'Jenis jaminan tidak valid',
            'alamat.required' => 'Alamat harus diisi',
            'no_telpon.required' => 'Nomor telepon harus diisi',
            'tgl_sewa.required' => 'Tanggal sewa harus diisi',
            'tgl_sewa.after_or_equal' => 'Tanggal sewa tidak boleh kurang dari hari ini',
            'tgl_kembali.required' => 'Tanggal kembali harus diisi',
            'tgl_kembali.after' => 'Tanggal kembali harus setelah tanggal sewa',
            'detail_penyewaans.required' => 'Minimal harus memilih satu PlayStation',
            'detail_penyewaans.*.id_playstation.required' => 'PlayStation harus dipilih',
            'detail_penyewaans.*.id_playstation.exists' => 'PlayStation yang dipilih tidak valid',
            'detail_penyewaans.*.jumlah.required' => 'Jumlah harus diisi',
            'detail_penyewaans.*.jumlah.min' => 'Jumlah minimal 1',
            'detail_penyewaans.*.durasi_sewa.required' => 'Durasi sewa harus diisi',
            'detail_penyewaans.*.durasi_sewa.min' => 'Durasi sewa minimal 1 hari',
            'detail_penyewaans.*.total_harga.required' => 'Total harga harus diisi',
        ]);

        // Jika validasi gagal
        if ($validator->fails()) {
            Log::error('Validation failed:', $validator->errors()->toArray());
            return back()
                ->withErrors($validator)
                ->withInput()
                ->with('error', 'Silakan periksa kembali data yang Anda masukkan');
        }

        DB::beginTransaction();

        try {
            // Upload foto jaminan
            $fotoJaminan = null;
            if ($request->hasFile('foto_jaminan')) {
                $file = $request->file('foto_jaminan');

                // Generate nama file yang unik
                $filename = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
                $fotoJaminan = $file->storeAs('jaminan', $filename, 'public');

                Log::info('File uploaded successfully:', ['path' => $fotoJaminan]);
            } else {
                Log::error('No file found in request');
                throw new \Exception('File foto jaminan tidak ditemukan');
            }

            // Hitung total keseluruhan
            $totalKeseluruhan = collect($request->detail_penyewaans)->sum('total_harga');

            // Buat rental utama
            $penyewaan = Penyewaan::create([
                'id_penyewa' => auth('penyewa')->id(),
                'alamat' => $request->alamat,
                'no_telpon' => $request->no_telpon,
                'jaminan' => $request->jaminan,
                'foto_jaminan' => $fotoJaminan,
                'tgl_pesan' => now(),
                'tgl_sewa' => $request->tgl_sewa,
                'tgl_kembali' => $request->tgl_kembali,
                'status' => $request->status ?? 'pinjam',
                'ulasan' => $request->ulasan,
                'total_harga' => $totalKeseluruhan,
            ]);

            // Buat detail penyewaan dan kurangi stok
            // Ganti dengan:
            foreach ($request->detail_penyewaans as $detail) {
                $playstation = PlayStation::find($detail['id_playstation']);

                // Cek stok
                if ($playstation->stok < $detail['jumlah']) {
                    throw new \Exception("Stok {$playstation->nama_playstation} tidak mencukupi");
                }

                // Buat detail penyewaan saja, stok akan dikurangi oleh Observer
                DetailPenyewaan::create([
                    'id_penyewaan' => $penyewaan->id,
                    'id_playstation' => $detail['id_playstation'],
                    'jumlah' => $detail['jumlah'],
                    'durasi_sewa' => $detail['durasi_sewa'],
                    'total_harga' => $detail['total_harga'],
                ]);
            }

            DB::commit();

            Log::info('Rental created successfully:', ['id' => $penyewaan->id]);

            // Redirect ke halaman checkout
            return redirect()->route('checkout.show', $penyewaan->id)
                ->with('success', 'Penyewaan berhasil dibuat! Silakan lanjutkan ke pembayaran.');
        } catch (\Exception $e) {
            DB::rollback();

            Log::error('Rental creation failed:', ['error' => $e->getMessage()]);

            // Hapus file jika ada error
            if ($fotoJaminan && Storage::disk('public')->exists($fotoJaminan)) {
                Storage::disk('public')->delete($fotoJaminan);
            }

            return back()->withInput()->with('error', $e->getMessage());
        }
    }

    public function show($id)
    {
        $rental = Penyewaan::with(['penyewa', 'detailPenyewaans.playstation'])->findOrFail($id);
        return view('rental.show', compact('rental'));
    }

    public function edit($id)
    {
        $rental = Penyewaan::with('detailPenyewaans')->findOrFail($id);
        $playstations = PlayStation::all();
        return view('rental.edit', compact('rental', 'playstations'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'alamat' => 'required|string|max:255',
            'no_telpon' => 'required|string|max:20',
            'jaminan' => 'required|in:ktp,sim,stnk,ijazah',
            'foto_jaminan' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'tgl_sewa' => 'required|date',
            'tgl_kembali' => 'required|date|after:tgl_sewa',
            'status' => 'required|in:pinjam,kembali,selesai',
            'detail_penyewaans' => 'required|array|min:1',
            'detail_penyewaans.*.id_playstation' => 'required|exists:playstations,id',
            'detail_penyewaans.*.jumlah' => 'required|integer|min:1',
            'detail_penyewaans.*.durasi_sewa' => 'required|integer|min:1',
            'detail_penyewaans.*.total_harga' => 'required|numeric|min:0',
        ]);

        DB::beginTransaction();

        try {
            $penyewaan = Penyewaan::with('detailPenyewaans')->findOrFail($id);

            // Kembalikan stok lama
            foreach ($penyewaan->detailPenyewaans as $detail) {
                $detail->playstation->increment('stok', $detail->jumlah);
            }

            // Hapus detail penyewaan lama
            $penyewaan->detailPenyewaans()->delete();

            // Upload foto jaminan baru jika ada
            $fotoJaminan = $penyewaan->foto_jaminan;
            if ($request->hasFile('foto_jaminan')) {
                // Hapus foto lama
                if ($fotoJaminan && Storage::disk('public')->exists($fotoJaminan)) {
                    Storage::disk('public')->delete($fotoJaminan);
                }
                $fotoJaminan = $request->file('foto_jaminan')->store('jaminan', 'public');
            }

            // Hitung total keseluruhan baru
            $totalKeseluruhan = collect($request->detail_penyewaans)->sum('total_harga');

            // Update penyewaan
            $penyewaan->update([
                'alamat' => $request->alamat,
                'no_telpon' => $request->no_telpon,
                'jaminan' => $request->jaminan,
                'foto_jaminan' => $fotoJaminan,
                'tgl_sewa' => $request->tgl_sewa,
                'tgl_kembali' => $request->tgl_kembali,
                'status' => $request->status,
                'ulasan' => $request->ulasan,
                'total_harga' => $totalKeseluruhan,
            ]);

            // Buat detail penyewaan baru dan kurangi stok
            foreach ($request->detail_penyewaans as $detail) {
                $playstation = PlayStation::find($detail['id_playstation']);

                // Cek stok
                if ($playstation->stok < $detail['jumlah']) {
                    throw new \Exception("Stok {$playstation->nama_playstation} tidak mencukupi");
                }

                // Buat detail penyewaan
                DetailPenyewaan::create([
                    'id_penyewaan' => $penyewaan->id,
                    'id_playstation' => $detail['id_playstation'],
                    'jumlah' => $detail['jumlah'],
                    'durasi_sewa' => $detail['durasi_sewa'],
                    'total_harga' => $detail['total_harga'],
                ]);

                // Kurangi stok
                $playstation->decrement('stok', $detail['jumlah']);
            }

            DB::commit();

            return redirect()->route('rental.index')
                ->with('success', 'Penyewaan berhasil diupdate!');
        } catch (\Exception $e) {
            DB::rollback();
            return back()->withInput()->with('error', $e->getMessage());
        }
    }

    public function destroy($id)
    {
        $rental = Penyewaan::findOrFail($id);

        DB::beginTransaction();

        try {
            // Kembalikan stok PlayStation
            foreach ($rental->detailPenyewaans as $detail) {
                $detail->playstation->increment('stok', $detail->jumlah);
            }

            // Hapus foto jaminan
            if ($rental->foto_jaminan && Storage::disk('public')->exists($rental->foto_jaminan)) {
                Storage::disk('public')->delete($rental->foto_jaminan);
            }

            $rental->delete();

            DB::commit();

            return redirect()->route('rental.index')->with('success', 'Penyewaan berhasil dihapus');
        } catch (\Exception $e) {
            DB::rollback();
            return back()->with('error', 'Gagal menghapus penyewaan');
        }
    }

    public function getPlaystationData($id)
    {
        $playstation = PlayStation::find($id);

        if (!$playstation) {
            return response()->json(['error' => 'PlayStation tidak ditemukan'], 404);
        }

        return response()->json([
            'id' => $playstation->id,
            'nama' => $playstation->nama_playstation,
            'harga' => $playstation->harga_sewa_harian,
            'stok' => $playstation->stok,
        ]);
    }
}
