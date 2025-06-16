<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PS One Rental - Checkout Pembayaran</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link href="{{ asset('css/checkout-styles.css') }}" rel="stylesheet">
</head>

<body>
    <!-- Tambahkan di bagian atas form checkout -->
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    <!-- Header -->
    <div class="header">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <span class="follow-text">Ikuti kami di</span>
                    <a href="#" class="social-link">
                        <i class="fab fa-instagram"></i>
                    </a>
                    <a href="#" class="social-link">
                        <i class="fab fa-tiktok"></i>
                    </a>
                </div>
                <div class="col-md-6 text-end">
                    <div class="user-info">
                        <span class="notification-btn">
                            <i class="fas fa-bell"></i> Notifikasi
                        </span>
                        <span class="user-profile">
                            <i class="fas fa-user-circle"></i> {{ Auth::guard('penyewa')->user()->name }}
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="main-container">
            <!-- Header Section -->
            <div class="page-header">
                <h1 class="brand-title">
                    <span class="ps-text">PS</span><span class="one-text">ONE</span>
                    <br><span class="rental-text">RENTAL</span>
                </h1>
                <div class="checkout-badge">
                    <i class="fas fa-credit-card"></i>
                    <span>Checkout Pembayaran</span>
                </div>
            </div>

            <form action="{{ route('checkout.store') }}" method="POST">
                @csrf

                <!-- Payment ID Section -->
                <div class="info-card">
                    <div class="card-header">
                        <i class="fas fa-receipt gradient-icon"></i>
                        <h5>ID Pembayaran</h5>
                    </div>
                    <div class="payment-id-display">
                        <span class="id-text" id="pby_id">{{ $pby_id }}</span>
                    </div>
                    <input type="hidden" name="pby_id" value="{{ $pby_id }}">
                    <input type="hidden" name="id_penyewaan" value="{{ $penyewaan->id }}">
                </div>

                <!-- Data Penyewa -->
                <div class="info-card">
                    <div class="card-header">
                        <i class="fas fa-user gradient-icon"></i>
                        <h5>Data Penyewa</h5>
                    </div>
                    <div class="customer-info">
                        <div class="customer-name">{{ $penyewaan->penyewa->name }}</div>
                        <div class="customer-phone">{{ $penyewaan->no_telpon }}</div>
                    </div>
                    <div class="customer-address">
                        {{ $penyewaan->alamat }}
                    </div>
                </div>

                <!-- Detail Penyewaan -->
                <div class="info-card">
                    <div class="card-header">
                        <i class="fas fa-calendar-alt gradient-icon"></i>
                        <h5>Detail Penyewaan</h5>
                    </div>
                    <div class="rental-details">
                        <div class="detail-row">
                            <span class="detail-label">Tanggal Sewa:</span>
                            <span
                                class="detail-value">{{ \Carbon\Carbon::parse($penyewaan->tgl_sewa)->format('d M Y') }}</span>
                        </div>
                        <div class="detail-row">
                            <span class="detail-label">Tanggal Kembali:</span>
                            <span
                                class="detail-value">{{ \Carbon\Carbon::parse($penyewaan->tgl_kembali)->format('d M Y') }}</span>
                        </div>
                    </div>
                </div>

                <!-- Tabel Produk -->
                <div class="order-table">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>PlayStation yang Disewa</th>
                                <th>Harga Satuan</th>
                                <th>Jumlah</th>
                                <th>Durasi (Hari)</th>
                                <th>Subtotal</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($penyewaan->detailPenyewaans as $detail)
                                <tr>
                                    <td>
                                        <div class="product-info">
                                            <div class="product-image">
                                                <i class="fas fa-gamepad"></i>
                                            </div>
                                            <div class="product-name">{{ $detail->playstation->nama_playstation }}
                                            </div>
                                        </div>
                                    </td>
                                    <td class="price">Rp{{ number_format($detail->playstation->harga_sewa_harian) }}
                                    </td>
                                    <td>{{ $detail->jumlah }}</td>
                                    <td>{{ $detail->durasi_sewa }} hari</td>
                                    <td class="price">Rp{{ number_format($detail->total_harga) }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <input type="hidden" name="jumlah_bayar"
                    value="{{ $penyewaan->detailPenyewaans->sum('total_harga') }}">
                <!-- Status tersembunyi dengan default value 'pinjam' -->
                <input type="hidden" name="status" value="{{ old('status', 'pending') }}">
                <!-- Total Pesanan -->
                <div class="total-section">
                    <div class="total-row">
                        <span>Total Pesanan ({{ $penyewaan->detailPenyewaans->count() }} Item):</span>
                        <span
                            class="total-amount">Rp{{ number_format($penyewaan->detailPenyewaans->sum('total_harga')) }}</span>
                    </div>
                </div>

                <!-- Metode Pembayaran -->
                <div class="payment-section">
                    <div class="payment-method">
                        <h6>Metode Pembayaran</h6>
                    </div>
                    <div class="payment-options">
                        <div class="payment-option active" data-method="Tunai">
                            <i class="fas fa-money-bill-wave me-2"></i>
                            Tunai
                        </div>
                        <div class="payment-option" data-method="E-Wallet">
                            <i class="fas fa-mobile-alt me-2"></i>
                            E-Wallet
                        </div>
                        <div class="payment-option" data-method="Transfer">
                            <i class="fas fa-university me-2"></i>
                            Transfer Bank
                        </div>
                    </div>
                    <input type="hidden" name="metode_bayar" id="metode_bayar" value="Tunai">
                </div>

                <!-- Tombol Konfirmasi -->
                <div class="text-center">
                    <button type="submit" class="confirm-btn">
                        <i class="fas fa-check-circle me-2"></i>
                        Konfirmasi Pembayaran
                    </button>
                </div>
            </form>

            <!-- Success Modal -->
            <div class="modal fade" id="successModal" tabindex="-1">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-body text-center">
                            <div class="success-icon">
                                <i class="fas fa-check-circle"></i>
                            </div>
                            <h4>Pembayaran Berhasil!</h4>
                            <p>Pesanan Anda telah dikonfirmasi dan sedang diproses.</p>
                            <button type="button" class="btn btn-primary" data-bs-dismiss="modal">
                                Tutup
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <script>
                // JavaScript untuk menangani pemilihan metode pembayaran
                document.addEventListener('DOMContentLoaded', function() {
                    const paymentOptions = document.querySelectorAll('.payment-option');
                    const metodeBayarInput = document.getElementById('metode_bayar');

                    paymentOptions.forEach(option => {
                        option.addEventListener('click', function() {
                            // Hapus class active dari semua option
                            paymentOptions.forEach(opt => opt.classList.remove('active'));

                            // Tambah class active ke option yang dipilih
                            this.classList.add('active');

                            // Update nilai input hidden
                            const selectedMethod = this.getAttribute('data-method');
                            metodeBayarInput.value = selectedMethod;

                            // Debug - untuk memastikan nilai ter-update (bisa dihapus nanti)
                            console.log('Metode pembayaran dipilih:', selectedMethod);
                        });
                    });

                    // Optional: Tambahkan event listener untuk form submit untuk debug
                    const form = document.querySelector('form'); // Sesuaikan dengan selector form Anda
                    if (form) {
                        form.addEventListener('submit', function(e) {
                            console.log('Nilai metode_bayar saat submit:', metodeBayarInput.value);
                            // Jangan preventDefault() jika ingin form ter-submit normal
                        });
                    }
                });
            </script>
        </div>
    </div>



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <link href="{{ asset('js/checkout-form.css') }}" rel="stylesheet">
</body>

</html>
