<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cek Pesanan - PBone Rental</title>
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
            position: relative;
            overflow-x: hidden;
        }

        .check-container {
            max-width: 500px;
            width: 100%;
            background: white;
            border-radius: 25px;
            box-shadow: 0 25px 80px rgba(0, 0, 0, 0.15);
            overflow: hidden;
            animation: slideUp 0.8s ease-out;
            position: relative;
            z-index: 10;
        }

        @keyframes slideUp {
            from {
                opacity: 0;
                transform: translateY(50px) scale(0.9);
            }

            to {
                opacity: 1;
                transform: translateY(0) scale(1);
            }
        }

        .header {
            background: linear-gradient(135deg, #4ecdc4, #44a08d);
            color: white;
            padding: 40px 30px;
            text-align: center;
            position: relative;
            overflow: hidden;
        }

        .header::before {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: radial-gradient(circle, rgba(255, 255, 255, 0.1) 0%, transparent 70%);
            animation: rotate 20s linear infinite;
        }

        @keyframes rotate {
            0% {
                transform: rotate(0deg);
            }

            100% {
                transform: rotate(360deg);
            }
        }

        .brand-container {
            position: relative;
            z-index: 2;
        }

        .brand-icon {
            font-size: 48px;
            margin-bottom: 15px;
            animation: pulse 2s ease-in-out infinite;
        }

        @keyframes pulse {

            0%,
            100% {
                transform: scale(1);
            }

            50% {
                transform: scale(1.1);
            }
        }

        .brand-title {
            font-size: 32px;
            font-weight: 800;
            letter-spacing: 3px;
            text-transform: uppercase;
            margin-bottom: 8px;
        }

        .brand-subtitle {
            font-size: 16px;
            opacity: 0.9;
            font-weight: 400;
            letter-spacing: 1px;
        }

        .content {
            padding: 50px 40px;
        }

        .page-title {
            text-align: center;
            margin-bottom: 40px;
        }

        .page-title h1 {
            font-size: 28px;
            font-weight: 700;
            color: #2c3e50;
            margin-bottom: 10px;
        }

        .page-title p {
            color: #7f8c8d;
            font-size: 16px;
            line-height: 1.6;
        }

        .search-form {
            margin-bottom: 30px;
        }

        .form-group {
            position: relative;
            margin-bottom: 25px;
        }

        .form-label {
            display: block;
            font-weight: 600;
            color: #2c3e50;
            margin-bottom: 10px;
            font-size: 14px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .form-input {
            width: 100%;
            padding: 18px 25px;
            padding-left: 55px;
            border: 2px solid #e9ecef;
            border-radius: 15px;
            font-size: 16px;
            font-weight: 500;
            background: #f8f9fa;
            transition: all 0.3s ease;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .form-input:focus {
            outline: none;
            border-color: #4ecdc4;
            background: white;
            box-shadow: 0 0 0 3px rgba(78, 205, 196, 0.1);
            transform: translateY(-2px);
        }

        .form-input::placeholder {
            color: #adb5bd;
            text-transform: none;
            letter-spacing: normal;
        }

        .input-icon {
            position: absolute;
            left: 20px;
            top: 50%;
            transform: translateY(-50%);
            color: #4ecdc4;
            font-size: 18px;
            z-index: 2;
        }

        .search-btn {
            width: 100%;
            padding: 18px 30px;
            background: linear-gradient(135deg, #4ecdc4, #44a08d);
            color: white;
            border: none;
            border-radius: 15px;
            font-size: 16px;
            font-weight: 700;
            cursor: pointer;
            transition: all 0.3s ease;
            text-transform: uppercase;
            letter-spacing: 1px;
            position: relative;
            overflow: hidden;
        }

        .search-btn::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
            transition: left 0.5s ease;
        }

        .search-btn:hover::before {
            left: 100%;
        }

        .search-btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 15px 40px rgba(78, 205, 196, 0.4);
        }

        .search-btn:active {
            transform: translateY(-1px);
        }

        .search-btn i {
            margin-right: 10px;
        }

        .result-container {
            margin-top: 30px;
            padding: 25px;
            background: #f8f9fa;
            border-radius: 15px;
            border: 1px solid #e9ecef;
            display: none;
            animation: fadeIn 0.5s ease-out;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .result-found {
            border-left: 4px solid #27ae60;
            background: linear-gradient(135deg, #d4edda, #c3e6cb);
        }

        .result-not-found {
            border-left: 4px solid #e74c3c;
            background: linear-gradient(135deg, #f8d7da, #f5c6cb);
        }

        .result-icon {
            font-size: 32px;
            margin-bottom: 15px;
            text-align: center;
        }

        .result-found .result-icon {
            color: #27ae60;
        }

        .result-not-found .result-icon {
            color: #e74c3c;
        }

        .result-title {
            font-size: 18px;
            font-weight: 700;
            margin-bottom: 10px;
            text-align: center;
        }

        .result-found .result-title {
            color: #155724;
        }

        .result-not-found .result-title {
            color: #721c24;
        }

        .result-desc {
            font-size: 14px;
            line-height: 1.6;
            margin-bottom: 20px;
            text-align: center;
        }

        .result-found .result-desc {
            color: #155724;
        }

        .result-not-found .result-desc {
            color: #721c24;
        }

        .order-summary {
            background: white;
            padding: 20px;
            border-radius: 10px;
            margin-bottom: 20px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        }

        .summary-row {
            display: flex;
            justify-content: space-between;
            padding: 8px 0;
            border-bottom: 1px solid #e9ecef;
        }

        .summary-row:last-child {
            border-bottom: none;
            font-weight: 700;
            color: #2c3e50;
        }

        .summary-label {
            font-weight: 600;
            color: #495057;
        }

        .summary-value {
            color: #2c3e50;
        }

        .status-badge {
            padding: 5px 12px;
            border-radius: 15px;
            font-size: 11px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .status-pending {
            background: #fff3cd;
            color: #856404;
        }

        .view-detail-btn {
            width: 100%;
            padding: 15px 25px;
            background: linear-gradient(135deg, #667eea, #764ba2);
            color: white;
            border: none;
            border-radius: 10px;
            font-size: 14px;
            font-weight: 600;
            cursor: pointer;
            text-decoration: none;
            display: inline-block;
            text-align: center;
            transition: all 0.3s ease;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .view-detail-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(102, 126, 234, 0.3);
        }

        .back-home {
            text-align: center;
            margin-top: 30px;
        }

        .back-home a {
            color: #4ecdc4;
            text-decoration: none;
            font-weight: 600;
            font-size: 14px;
            transition: all 0.3s ease;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .back-home a:hover {
            color: #44a08d;
            transform: translateY(-1px);
        }

        .back-home i {
            margin-right: 8px;
        }

        .floating-shapes {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            pointer-events: none;
            z-index: 1;
        }

        .shape {
            position: absolute;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 50%;
            animation: floatShapes 15s infinite linear;
        }

        .shape:nth-child(1) {
            width: 100px;
            height: 100px;
            left: 10%;
            animation-delay: -2s;
        }

        .shape:nth-child(2) {
            width: 150px;
            height: 150px;
            left: 80%;
            animation-delay: -8s;
        }

        .shape:nth-child(3) {
            width: 80px;
            height: 80px;
            left: 50%;
            animation-delay: -15s;
        }

        .shape:nth-child(4) {
            width: 120px;
            height: 120px;
            left: 20%;
            animation-delay: -20s;
        }

        @keyframes floatShapes {
            0% {
                transform: translateY(100vh) scale(0) rotate(0deg);
                opacity: 0;
            }

            10% {
                opacity: 1;
            }

            90% {
                opacity: 1;
            }

            100% {
                transform: translateY(-100px) scale(1) rotate(360deg);
                opacity: 0;
            }
        }

        .loading {
            display: none;
            text-align: center;
            padding: 20px;
        }

        .loading-spinner {
            width: 40px;
            height: 40px;
            border: 4px solid #e9ecef;
            border-top: 4px solid #4ecdc4;
            border-radius: 50%;
            animation: spin 1s linear infinite;
            margin: 0 auto 15px;
        }

        @keyframes spin {
            0% {
                transform: rotate(0deg);
            }

            100% {
                transform: rotate(360deg);
            }
        }

        .loading-text {
            color: #7f8c8d;
            font-size: 14px;
        }
    </style>
</head>

<body>
    <div class="floating-shapes">
        <div class="shape"></div>
        <div class="shape"></div>
        <div class="shape"></div>
        <div class="shape"></div>
    </div>

    <div class="check-container">
        <div class="header">
            <div class="brand-container">
                <div class="brand-icon">
                    <i class="fas fa-gamepad"></i>
                </div>
                <div class="brand-title">PSOne</div>
                <div class="brand-subtitle">PlayStation Rental Service</div>
            </div>
        </div>

        <div class="content">
            <div class="page-title">
                <h1>Cek Pesanan</h1>
                <p>Masukkan ID Pemesanan untuk melihat status dan detail pesanan Anda</p>
            </div>

            <form class="search-form" id="searchForm">
                <div class="form-group">
                    <label class="form-label" for="orderId">ID Pemesanan</label>
                    <div style="position: relative;">
                        <i class="fas fa-search input-icon"></i>
                        <input type="text" class="form-input" id="orderId" name="orderId"
                            placeholder="Contoh: PBY0001" required maxlength="10">
                    </div>
                </div>

                <button type="submit" class="search-btn">
                    <i class="fas fa-search"></i>
                    Cari Pesanan
                </button>
            </form>

            <div class="loading" id="loading">
                <div class="loading-spinner"></div>
                <div class="loading-text">Mencari pesanan...</div>
            </div>

            <div class="result-container" id="resultContainer">
                <!-- Results will be inserted here -->
            </div>

            <div class="back-home">
                <a href="{{ route('beranda.login') }}" onclick="goToHome()">
                    <i class="fas fa-home"></i>
                    Kembali ke Beranda
                </a>
            </div>
        </div>
    </div>

    <script>
        document.getElementById('searchForm').addEventListener('submit', function(e) {
            e.preventDefault(); // Mencegah form submit default

            const orderId = document.getElementById('orderId').value.trim();
            const loading = document.getElementById('loading');
            const resultContainer = document.getElementById('resultContainer');

            // Validasi input
            if (!orderId) {
                alert('Mohon masukkan ID Pemesanan');
                return;
            }

            // Tampilkan loading
            loading.style.display = 'block';
            resultContainer.style.display = 'none';

            // Simulasi delay untuk loading (opsional)
            setTimeout(function() {
                // Redirect ke halaman detail checkout
                // Ganti 'checkout.detail' dengan nama route yang sesuai
                const detailUrl = `{{ route('checkout.detail', ':pby_id') }}`.replace(':pby_id', orderId);
                window.location.href = detailUrl;
            }, 1000);
        });

        // Fungsi untuk kembali ke beranda
        function goToHome() {
            return true; // Biarkan link berfungsi normal
        }

        // Auto-format input ID (opsional)
        document.getElementById('orderId').addEventListener('input', function(e) {
            let value = e.target.value.toUpperCase();
            // Hapus karakter yang tidak diinginkan
            value = value.replace(/[^A-Z0-9]/g, '');
            e.target.value = value;
        });
    </script>
</body>

</html>
