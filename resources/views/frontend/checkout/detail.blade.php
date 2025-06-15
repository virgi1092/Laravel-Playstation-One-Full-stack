<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Pemesanan - PBone Rental</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        .detail-container {
            max-width: 800px;
            width: 100%;
            background: white;
            border-radius: 20px;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.15);
            overflow: hidden;
            animation: slideUp 0.6s ease-out;
        }

        @keyframes slideUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .header {
            background: linear-gradient(135deg, #4ecdc4, #44a08d);
            color: white;
            padding: 25px 30px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            position: relative;
            overflow: hidden;
        }

        .header::before {
            content: '';
            position: absolute;
            top: -50%;
            right: -50%;
            width: 200%;
            height: 200%;
            background: radial-gradient(circle, rgba(255, 255, 255, 0.1) 0%, transparent 70%);
            animation: float 6s ease-in-out infinite;
        }

        @keyframes float {

            0%,
            100% {
                transform: translateY(0px) rotate(0deg);
            }

            50% {
                transform: translateY(-20px) rotate(180deg);
            }
        }

        .header-left {
            position: relative;
            z-index: 2;
        }

        .brand-title {
            font-size: 28px;
            font-weight: 800;
            letter-spacing: 2px;
            text-transform: uppercase;
        }

        .brand-subtitle {
            font-size: 14px;
            opacity: 0.9;
            margin-top: 5px;
            font-weight: 400;
        }

        .back-btn {
            background: rgba(255, 255, 255, 0.2);
            border: none;
            color: white;
            padding: 12px 16px;
            border-radius: 12px;
            cursor: pointer;
            font-size: 18px;
            transition: all 0.3s ease;
            position: relative;
            z-index: 2;
        }

        .back-btn:hover {
            background: rgba(255, 255, 255, 0.3);
            transform: translateX(-3px);
        }

        .content {
            padding: 40px 30px;
        }

        .page-title {
            text-align: center;
            margin-bottom: 40px;
        }

        .page-title h1 {
            font-size: 32px;
            font-weight: 700;
            color: #2c3e50;
            margin-bottom: 10px;
        }

        .page-title .order-id {
            font-size: 18px;
            color: #7f8c8d;
            font-weight: 500;
        }

        .detail-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 30px;
            margin-bottom: 40px;
        }

        .detail-section {
            background: #f8f9fa;
            border-radius: 15px;
            padding: 25px;
            border: 1px solid #e9ecef;
        }

        .section-title {
            font-size: 18px;
            font-weight: 700;
            color: #2c3e50;
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .section-icon {
            width: 24px;
            height: 24px;
            color: #4ecdc4;
        }

        .detail-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 12px 0;
            border-bottom: 1px solid #e9ecef;
        }

        .detail-row:last-child {
            border-bottom: none;
        }

        .detail-label {
            font-weight: 600;
            color: #495057;
            font-size: 14px;
        }

        .detail-value {
            font-weight: 500;
            color: #2c3e50;
            text-align: right;
        }

        .status-badge {
            padding: 6px 15px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .status-pending {
            background: #fff3cd;
            color: #856404;
            border: 1px solid #ffeaa7;
        }

        .status-confirmed {
            background: #d1ecf1;
            color: #0c5460;
            border: 1px solid #74c0fc;
        }

        .status-completed {
            background: #d4edda;
            color: #155724;
            border: 1px solid #51cf66;
        }

        .price-highlight {
            font-size: 18px;
            font-weight: 700;
            color: #e74c3c;
        }

        .full-width-section {
            grid-column: 1 / -1;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
        }

        .timeline {
            position: relative;
            padding-left: 30px;
        }

        .timeline::before {
            content: '';
            position: absolute;
            left: 10px;
            top: 0;
            bottom: 0;
            width: 2px;
            background: rgba(255, 255, 255, 0.3);
        }

        .timeline-item {
            position: relative;
            margin-bottom: 25px;
            padding-left: 20px;
        }

        .timeline-item::before {
            content: '';
            position: absolute;
            left: -25px;
            top: 5px;
            width: 12px;
            height: 12px;
            background: white;
            border-radius: 50%;
            border: 3px solid #667eea;
        }

        .timeline-item.active::before {
            background: #4ecdc4;
            border-color: white;
            box-shadow: 0 0 0 3px #4ecdc4;
        }

        .timeline-time {
            font-size: 12px;
            opacity: 0.8;
            margin-bottom: 5px;
        }

        .timeline-title {
            font-weight: 600;
            margin-bottom: 3px;
        }

        .timeline-desc {
            font-size: 14px;
            opacity: 0.9;
        }

        .action-buttons {
            display: flex;
            gap: 15px;
            justify-content: center;
            margin-top: 30px;
        }

        .btn {
            padding: 15px 30px;
            border: none;
            border-radius: 50px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 10px;
            transition: all 0.3s ease;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .btn-primary {
            background: linear-gradient(135deg, #4ecdc4, #44a08d);
            color: white;
            box-shadow: 0 6px 20px rgba(78, 205, 196, 0.3);
        }

        .btn-primary:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 30px rgba(78, 205, 196, 0.4);
        }

        .btn-secondary {
            background: white;
            color: #4ecdc4;
            border: 2px solid #4ecdc4;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        }

        .btn-secondary:hover {
            background: #4ecdc4;
            color: white;
            transform: translateY(-3px);
            box-shadow: 0 8px 25px rgba(78, 205, 196, 0.3);
        }

        .btn-danger {
            background: linear-gradient(135deg, #ff6b6b, #ee5a52);
            color: white;
            box-shadow: 0 6px 20px rgba(255, 107, 107, 0.3);
        }

        .btn-danger:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 30px rgba(255, 107, 107, 0.4);
        }

        .floating-shapes {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            pointer-events: none;
            z-index: -1;
        }

        .shape {
            position: absolute;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 50%;
            animation: floatShapes 20s infinite linear;
        }

        .shape:nth-child(1) {
            width: 80px;
            height: 80px;
            left: 10%;
            animation-delay: -2s;
        }

        .shape:nth-child(2) {
            width: 120px;
            height: 120px;
            left: 80%;
            animation-delay: -8s;
        }

        .shape:nth-child(3) {
            width: 60px;
            height: 60px;
            left: 50%;
            animation-delay: -15s;
        }

        @keyframes floatShapes {
            0% {
                transform: translateY(100vh) scale(0);
                opacity: 0;
            }

            10% {
                opacity: 1;
            }

            90% {
                opacity: 1;
            }

            100% {
                transform: translateY(-100px) scale(1);
                opacity: 0;
            }
        }
    </style>
</head>

<body>
    <div class="floating-shapes">
        <div class="shape"></div>
        <div class="shape"></div>
        <div class="shape"></div>
    </div>

    <div class="detail-container">
        <div class="header">
            <div class="header-left">
                <div class="brand-title">PSOne</div>
                <div class="brand-subtitle">PlayStation Rental Service</div>
            </div>
            <button class="back-btn" onclick="history.back()">
                <i class="fas fa-arrow-left"></i>
            </button>
        </div>

        <div class="content">
            <div class="page-title">
                <h1>Detail Pemesanan</h1>
                <div class="order-id">ID Pemesanan: <strong>{{ $pby_id }}</strong></div>
            </div>

            <div class="detail-grid">
                <!-- Informasi Pemesanan -->
                <div class="detail-section">
                    <div class="section-title">
                        <i class="fas fa-info-circle section-icon"></i>
                        Informasi Pemesanan
                    </div>
                    <div class="detail-row">
                        <span class="detail-label">Tanggal Pemesanan</span>
                        <span
                            class="detail-value">{{ \Carbon\Carbon::parse($pembayaran->created_at)->format('d F Y') }}</span>
                    </div>
                    <div class="detail-row">
                        <span class="detail-label">Status</span>
                        <span class="detail-value">
                            <span
                                class="status-badge 
                            @if ($pembayaran->status == 'selesai') status-selesai
                            @elseif($pembayaran->status == 'pending') status-pending
                            @else status-cancelled @endif">
                                @if ($pembayaran->status == 'selesai')
                                    Sudah Dibayar
                                @elseif($pembayaran->status == 'pending')
                                    Menunggu Konfirmasi
                                @else
                                    Dibatalkan
                                @endif
                            </span>
                        </span>
                    </div>
                    <div class="detail-row">
                        <span class="detail-label">Durasi Sewa</span>
                        <span class="detail-value">{{ $durasi_sewa }} Hari</span>
                    </div>
                    <div class="detail-row">
                        <span class="detail-label">Tanggal Mulai</span>
                        <span
                            class="detail-value">{{ \Carbon\Carbon::parse($pembayaran->penyewaan->tgl_sewa)->format('d F Y') }}</span>
                    </div>
                    <div class="detail-row">
                        <span class="detail-label">Tanggal Selesai</span>
                        <span
                            class="detail-value">{{ \Carbon\Carbon::parse($pembayaran->penyewaan->tgl_kembali)->format('d F Y') }}</span>
                    </div>
                </div>

                <!-- Informasi PlayStation -->
                <div class="detail-section">
                    <div class="section-title">
                        <i class="fas fa-gamepad section-icon"></i>
                        Informasi PlayStation
                    </div>
                    @php
                        $firstDetail = $pembayaran->penyewaan->detailPenyewaans->first();
                        $totalJumlah = $pembayaran->penyewaan->detailPenyewaans->sum('jumlah');
                    @endphp
                    @if ($firstDetail && $firstDetail->playstation)
                        <div class="detail-row">
                            <span class="detail-label">Tipe Konsol</span>
                            <span class="detail-value">{{ $firstDetail->playstation->nama_playstation }}</span>
                        </div>
                        <div class="detail-row">
                            <span class="detail-label">Jumlah Controller</span>
                            <span class="detail-value">2 Controller</span>
                        </div>
                        <div class="detail-row">
                            <span class="detail-label">Harga per Hari</span>
                            <span class="detail-value">Rp
                                {{ number_format($firstDetail->playstation->harga_sewa_harian, 0, ',', '.') }}</span>
                        </div>
                        <div class="detail-row">
                            <span class="detail-label">Kondisi</span>
                            <span class="detail-value">Sangat Baik</span>
                        </div>
                    @else
                        <div class="detail-row">
                            <span class="detail-label">Tipe Konsol</span>
                            <span class="detail-value">-</span>
                        </div>
                    @endif
                </div>

                <!-- Informasi Penyewa -->
                <div class="detail-section">
                    <div class="section-title">
                        <i class="fas fa-user section-icon"></i>
                        Informasi Penyewa
                    </div>
                    <div class="detail-row">
                        <span class="detail-label">Nama Lengkap</span>
                        <span class="detail-value">{{ $pembayaran->penyewaan->penyewa->name ?? 'N/A' }}</span>
                    </div>
                    <div class="detail-row">
                        <span class="detail-label">No. Telepon</span>
                        <span
                            class="detail-value">{{ $pembayaran->penyewaan->no_telpon ?? ($pembayaran->penyewaan->no_telpon ?? 'N/A') }}</span>
                    </div>
                    <div class="detail-row">
                        <span class="detail-label">Email</span>
                        <span class="detail-value">{{ $pembayaran->penyewaan->penyewa->email ?? 'N/A' }}</span>
                    </div>
                    <div class="detail-row">
                        <span class="detail-label">Alamat</span>
                        <span class="detail-value">{{ $pembayaran->penyewaan->alamat ?? 'N/A' }}</span>
                    </div>
                </div>

                <!-- Informasi Pembayaran -->
                <div class="detail-section">
                    <div class="section-title">
                        <i class="fas fa-credit-card section-icon"></i>
                        Informasi Pembayaran
                    </div>
                    @php
                        $subtotal = 0;
                    @endphp
                    @foreach ($pembayaran->penyewaan->detailPenyewaans as $detail)
                        @php
                            $subtotal += $detail->total_harga;
                        @endphp
                        <div class="detail-row">
                            <span class="detail-label">{{ $detail->playstation->nama_playstation ?? 'PlayStation' }}
                                ({{ $durasi_sewa }} hari x {{ $detail->jumlah }} unit)
                            </span>
                            <span class="detail-value">Rp {{ number_format($detail->total_harga, 0, ',', '.') }}</span>
                        </div>
                    @endforeach

                    <div class="detail-row">
                        <span class="detail-label"><strong>Total Pembayaran</strong></span>
                        <span class="detail-value price-highlight">Rp
                            {{ number_format($total_harga, 0, ',', '.') }}</span>
                    </div>
                    <div class="detail-row">
                        <span class="detail-label">Metode Pembayaran</span>
                        <span class="detail-value">{{ $pembayaran->metode_bayar }}</span>
                    </div>
                    <div class="detail-row">
                        <span class="detail-label">Status Pembayaran</span>
                        <span class="detail-value">
                            <span
                                class="status-badge 
                            @if ($pembayaran->is_paid) status-paid
                            @else status-pending @endif">
                                @if ($pembayaran->is_paid)
                                    Sudah Dibayar
                                @else
                                    Belum Dibayar
                                @endif
                            </span>
                        </span>
                    </div>
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="action-buttons">
                 <a href="{{ route('beranda.login') }}" class="btn btn-primary" onclick="goToHome()">
                    <i class="fas fa-home"></i>
                    Kembali ke Beranda
                </a>
                <a href="#" class="btn btn-secondary">
                    <i class="fas fa-print"></i>
                    Cetak Detail
                </a>
                <a href="#" class="btn btn-danger">
                    <i class="fas fa-times"></i>
                    Batalkan Pesanan
                </a>
            </div>
        </div>
    </div>

    <script>
        // Add interactive effects
        document.addEventListener('DOMContentLoaded', function() {
            // Add click effect to buttons
            const buttons = document.querySelectorAll('.btn');
            buttons.forEach(button => {
                button.addEventListener('click', function(e) {
                    e.preventDefault();
                    // Create ripple effect
                    const ripple = document.createElement('span');
                    const rect = this.getBoundingClientRect();
                    const size = Math.max(rect.width, rect.height);
                    const x = e.clientX - rect.left - size / 2;
                    const y = e.clientY - rect.top - size / 2;

                    ripple.style.cssText = `
                        position: absolute;
                        width: ${size}px;
                        height: ${size}px;
                        left: ${x}px;
                        top: ${y}px;
                        background: rgba(255, 255, 255, 0.3);
                        border-radius: 50%;
                        transform: scale(0);
                        animation: ripple 0.6s ease-out;
                        pointer-events: none;
                    `;

                    this.style.position = 'relative';
                    this.style.overflow = 'hidden';
                    this.appendChild(ripple);

                    setTimeout(() => {
                        ripple.remove();
                    }, 600);
                });
            });
            // Fungsi untuk kembali ke beranda
            function goToHome() {
                return true; // Biarkan link berfungsi normal
            }
            // Copy order ID functionality
            const orderIdElement = document.querySelector('.order-id strong');
            orderIdElement.style.cursor = 'pointer';
            orderIdElement.addEventListener('click', function() {
                navigator.clipboard.writeText(this.textContent).then(() => {
                    const originalText = this.textContent;
                    this.textContent = 'Disalin!';
                    this.style.color = '#27ae60';

                    setTimeout(() => {
                        this.textContent = originalText;
                        this.style.color = '';
                    }, 1500);
                });
            });

            // Add hover effects to detail rows
            const detailRows = document.querySelectorAll('.detail-row');
            detailRows.forEach(row => {
                row.addEventListener('mouseenter', function() {
                    this.style.backgroundColor = 'rgba(78, 205, 196, 0.05)';
                    this.style.transform = 'translateX(5px)';
                    this.style.transition = 'all 0.3s ease';
                });

                row.addEventListener('mouseleave', function() {
                    this.style.backgroundColor = '';
                    this.style.transform = '';
                });
            });
        });

        // Add ripple animation to CSS
        const style = document.createElement('style');
        style.textContent = `
            @keyframes ripple {
                to {
                    transform: scale(2);
                    opacity: 0;
                }
            }
        `;
        document.head.appendChild(style);
    </script>
</body>

</html>
