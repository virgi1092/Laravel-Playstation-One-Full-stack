<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PS One Rental - Penyewaan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        
        .header {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            padding: 1rem 0;
            margin-bottom: 2rem;
        }
        
        .header .social-links a {
            color: white;
            text-decoration: none;
            margin-right: 0.5rem;
            padding: 0.4rem 0.6rem;
            background: rgba(255, 255, 255, 0.15);
            border-radius: 6px;
            display: inline-block;
            font-size: 0.9rem;
            backdrop-filter: blur(5px);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }
        
        .header .user-info {
            color: white;
        }
        
        .main-container {
            background: white;
            border-radius: 20px;
            padding: 2rem;
            margin: 0 auto;
            max-width: 1000px;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
        }
        
        .brand-title {
            background: linear-gradient(45deg, #4a90e2, #357abd);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            font-weight: bold;
            font-size: 1.8rem;
            margin-bottom: 0.5rem;
            line-height: 1.2;
        }
        
        .subtitle {
            color: #666;
            font-size: 1.2rem;
            margin-bottom: 2rem;
        }
        
        .form-section {
            background: #4a90e2;
            color: white;
            padding: 1.5rem;
            border-radius: 15px;
            margin-bottom: 1.5rem;
        }
        
        .form-section h3 {
            margin-bottom: 1rem;
            font-size: 1.2rem;
        }
        
        .form-control {
            border-radius: 10px;
            border: none;
            padding: 0.75rem 1rem;
            margin-bottom: 1rem;
        }
        
        .form-select {
            border-radius: 10px;
            border: none;
            padding: 0.75rem 1rem;
        }
        
        .file-upload {
            position: relative;
            overflow: hidden;
            display: inline-block;
            background: rgba(255, 255, 255, 0.2);
            border-radius: 10px;
            padding: 0.75rem 1rem;
            cursor: pointer;
            border: none;
            color: white;
        }
        
        .file-upload input[type=file] {
            position: absolute;
            left: -9999px;
        }
        
        .rental-summary {
            background: #f8f9fa;
            border-radius: 15px;
            padding: 1.5rem;
            margin-bottom: 1.5rem;
        }
        
        .price-info {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1rem;
        }
        
        .checkout-btn {
            background: #ffc107;
            border: none;
            border-radius: 15px;
            padding: 1rem 3rem;
            font-weight: bold;
            font-size: 1.2rem;
            color: #333;
            width: 100%;
        }
        
        .checkout-btn:hover {
            background: #ffb300;
            transform: translateY(-2px);
            transition: all 0.3s ease;
        }
        
        .date-input {
            position: relative;
        }
        
        .duration-control {
            display: flex;
            align-items: center;
            gap: 1rem;
        }
        
        .duration-control input {
            width: 80px;
            text-align: center;
        }
        
        .warning-text {
            font-size: 0.9rem;
            color: #ffc107;
            margin-top: 0.5rem;
        }
    </style>
</head>
<body>
    <!-- Header -->
    <div class="header">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <span style="color: white; margin-right: 1rem; font-size: 0.9rem;">Ikuti kami di</span>
                    <a href="#" class="social-links">
                        <i class="fab fa-instagram"></i>
                    </a>
                    <a href="#" class="social-links">
                        <i class="fab fa-tiktok"></i>
                    </a>
                </div>
                <div class="col-md-6 text-end">
                    <div class="user-info" style="font-size: 0.9rem;">
                        <i class="fas fa-bell"></i> Notifikasi
                        <i class="fas fa-user-circle ms-3"></i> User 01
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="main-container">
            <div class="row">
                <div class="col-12 mb-4">
                    <h1 class="brand-title">PSONE<br>RENTAL</h1>
                    <h2 class="subtitle">Penyewaan</h2>
                </div>
            </div>

            <form action="{{ route('rental.store') }}" method="POST" enctype="multipart/form-data">
                <div class="row">
                    <div class="col-md-6">
                        <!-- Data Penyewa -->
                        <div class="form-section">
                            <h3>Data penyewa</h3>
                            <input type="text" name="nama_lengkap" class="form-control" placeholder="Nama Lengkap" required>
                            <input type="text" name="no_hp" class="form-control" placeholder="NO.Hp / WhatsApp" required>
                            <input type="text" name="alamat_lengkap" class="form-control" placeholder="Alamat Lengkap" required>
                            
                            <h3 class="mt-4">Unggah Foto E-KTP</h3>
                            <label class="file-upload">
                                <input type="file" name="foto_ktp" accept="image/*" required>
                                <i class="fas fa-upload me-2"></i> Pilih file
                            </label>
                            <div class="warning-text">
                                *Digunakan sebagai jaminan penyewaan
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <!-- Jenis PlayStation -->
                        <div class="form-section">
                            <h3>Jenis Playstation</h3>
                            <select name="jenis_playstation" class="form-select" required>
                                <option value="">Pilih PlayStation</option>
                                <option value="playstation-3">Playstation 3</option>
                                <option value="playstation-4">Playstation 4</option>
                            </select>
                            
                            <h3 class="mt-4">Detail pemesanan</h3>
                            <label style="color: white; margin-bottom: 0.5rem;">Tanggal sewa</label>
                            <div class="date-input">
                                <input type="date" name="tanggal_sewa" class="form-control" value="2025-05-29" required>
                            </div>
                            
                            <label style="color: white; margin-bottom: 0.5rem; margin-top: 1rem;">Lama sewa</label>
                            <div class="duration-control">
                                <input type="number" name="lama_sewa" class="form-control" value="1" min="1" required>
                                <span style="color: white;">Hari</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Rental Summary -->
                <div class="rental-summary">
                    <h4 style="margin-bottom: 1rem;">Paket yang dipilih:</h4>
                    <div class="price-info">
                        <div>
                            <strong id="selected-package">Belum dipilih</strong>
                        </div>
                        <div>
                            <strong id="package-price">Harga: -</strong>
                        </div>
                    </div>
                    <small style="color: #666;">Untuk paket lain bisa chat melalui admin WhatsApp</small>
                </div>

                <!-- Checkout Button -->
                <div class="text-center">
                    <button type="submit" class="checkout-btn">
                        Checkout
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Update harga berdasarkan jenis PlayStation
        document.querySelector('select[name="jenis_playstation"]').addEventListener('change', function() {
            const prices = {
                'playstation-3': 85000,
                'playstation-4': 100000
            };
            
            const packageNames = {
                'playstation-3': 'Playstation 3',
                'playstation-4': 'Playstation 4'
            };
            
            const selectedPS = this.value;
            const packageElement = document.getElementById('selected-package');
            const priceElement = document.getElementById('package-price');
            
            if (selectedPS && prices[selectedPS]) {
                packageElement.textContent = packageNames[selectedPS];
                priceElement.textContent = `Harga: Rp.${prices[selectedPS].toLocaleString('id-ID')} per 24 jam`;
            } else {
                packageElement.textContent = 'Belum dipilih';
                priceElement.textContent = 'Harga: -';
            }
            
            // Update total jika ada input durasi
            updateTotalPrice();
        });

        // Update total harga berdasarkan lama sewa
        document.querySelector('input[name="lama_sewa"]').addEventListener('input', function() {
            updateTotalPrice();
        });
        
        // Function untuk update total price
        function updateTotalPrice() {
            const days = parseInt(document.querySelector('input[name="lama_sewa"]').value) || 1;
            const selectedPS = document.querySelector('select[name="jenis_playstation"]').value;
            
            const prices = {
                'playstation-3': 85000,
                'playstation-4': 100000
            };
            
            const priceElement = document.getElementById('package-price');
            
            if (selectedPS && prices[selectedPS]) {
                if (days > 1) {
                    const totalPrice = prices[selectedPS] * days;
                    priceElement.textContent = `Total: Rp.${totalPrice.toLocaleString('id-ID')} (${days} hari)`;
                } else {
                    priceElement.textContent = `Harga: Rp.${prices[selectedPS].toLocaleString('id-ID')} per 24 jam`;
                }
            }
        }

        // File upload preview
        document.querySelector('input[type="file"]').addEventListener('change', function() {
            const fileName = this.files[0]?.name || 'Tidak ada file yang dipilih';
            const label = this.parentElement;
            if (this.files[0]) {
                label.innerHTML = `<i class="fas fa-check me-2"></i> ${fileName}`;
                label.style.background = 'rgba(40, 167, 69, 0.8)';
            }
        });
    </script>
</body>
</html>