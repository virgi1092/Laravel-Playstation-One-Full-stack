<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PS One Rental - Penyewaan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link href="{{ asset('css/rental-form.css') }}" rel="stylesheet">
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
                    @auth('penyewa')
                        <div class="user-dropdown">
                            <button onclick="toggleDropdown()"
                                class="flex items-center space-x-2 text-white hover:text-blue-200 px-4 py-2 rounded-lg font-medium transition duration-300"
                                id="userMenuButton"
                                style="display: inline-flex; align-items: center; gap: 0.5rem; background: rgba(255, 255, 255, 0.15); border: 1px solid rgba(255, 255, 255, 0.2); border-radius: 8px; backdrop-filter: blur(5px);">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                                    style="width: 20px; height: 20px;">
                                    <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z"
                                        clip-rule="evenodd"></path>
                                </svg>
                                <span>{{ Auth::guard('penyewa')->user()->name }}</span>
                                <svg class="w-4 h-4 transition-transform duration-200" id="dropdownArrow"
                                    fill="currentColor" viewBox="0 0 20 20" style="width: 16px; height: 16px;">
                                    <path fill-rule="evenodd"
                                        d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                        clip-rule="evenodd"></path>
                                </svg>
                            </button>

                            <div class="dropdown-menu" id="userDropdown">
                                <a href="">
                                    <i class="fas fa-tachometer-alt me-2"></i>Dashboard
                                </a>
                                <a href="">
                                    <i class="fas fa-user me-2"></i>Profile
                                </a>
                                <a href="">
                                    <i class="fas fa-history me-2"></i>Riwayat Sewa
                                </a>
                                <hr style="margin: 0.5rem 0; border-color: rgba(0,0,0,0.1);">
                                <a href="{{ route('logout') }}"
                                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    <i class="fas fa-sign-out-alt me-2"></i>Logout
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                            </div>
                        </div>
                    @else
                        <div style="color: white; font-size: 0.9rem;">
                            <i class="fas fa-user"></i>
                            <a href="{{ route('login') }}"
                                style="color: white; text-decoration: none; margin-left: 0.5rem;">Login</a>
                        </div>
                    @endauth
                </div>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="main-container">
            <div class="row">
                <div class="col-12 mb-4">
                    <h1 class="brand-title">PSONE<br>RENTAL</h1>
                    <h2 class="subtitle">Form Penyewaan PlayStation</h2>
                </div>
            </div>

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            <form action="{{ route('rental.store') }}" method="POST" enctype="multipart/form-data" id="rentalForm">
                @csrf

                <div class="row">
                    <div class="col-md-6">
                        <!-- Data Penyewa -->
                        <div class="form-section">
                            <h3><i class="fas fa-user me-2"></i>Data Penyewa</h3>

                            @auth('penyewa')
                                <input type="hidden" name="id_penyewa" value="{{ Auth::guard('penyewa')->user()->id }}">

                                <div class="mb-3">
                                    <label class="form-label">Nama Penyewa</label>
                                    <input type="text" class="form-control"
                                        value="{{ Auth::guard('penyewa')->user()->name }}" readonly>
                                </div>
                            @else
                                <div class="mb-3">
                                    <label class="form-label">Nama Penyewa</label>
                                    <select name="id_penyewa" class="form-select" required>
                                        <option value="">Pilih Penyewa</option>
                                        @foreach ($penyewas as $penyewa)
                                            <option value="{{ $penyewa->id }}"
                                                {{ old('id_penyewa') == $penyewa->id ? 'selected' : '' }}>
                                                {{ $penyewa->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            @endauth

                            <div class="mb-3">
                                <label class="form-label">Alamat</label>
                                <input type="text" name="alamat" class="form-control" value="{{ old('alamat') }}"
                                    required>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">No. Telepon</label>
                                <input type="tel" name="no_telpon" class="form-control"
                                    value="{{ old('no_telpon') }}" required>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Ulasan/Catatan</label>
                                <textarea name="ulasan" class="form-control" rows="3">{{ old('ulasan') }}</textarea>
                            </div>
                        </div>

                        <!-- Data Jaminan -->
                        <div class="form-section">
                            <h3><i class="fas fa-shield-alt me-2"></i>Data Jaminan</h3>

                            <div class="mb-3">
                                <label class="form-label">Pilihan Jaminan</label>
                                <select name="jaminan" class="form-select" required>
                                    <option value="">Pilih Jenis Jaminan</option>
                                    <option value="ktp" {{ old('jaminan') == 'ktp' ? 'selected' : '' }}>KTP
                                    </option>
                                    <option value="sim" {{ old('jaminan') == 'sim' ? 'selected' : '' }}>SIM
                                    </option>
                                    <option value="stnk" {{ old('jaminan') == 'stnk' ? 'selected' : '' }}>STNK
                                    </option>
                                    <option value="ijazah" {{ old('jaminan') == 'ijazah' ? 'selected' : '' }}>Ijazah
                                    </option>
                                </select>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Foto Jaminan</label>
                                <input type="file" name="foto_jaminan" class="form-control" accept="image/*"
                                    required>
                                <div class="form-text text-warning">
                                    <i class="fas fa-exclamation-triangle me-1"></i>
                                    Digunakan sebagai jaminan penyewaan dan akan dikembalikan
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <!-- Data Sewa -->
                        <div class="form-section">
                            <h3><i class="fas fa-calendar-alt me-2"></i>Data Penyewaan</h3>

                            <div class="mb-3">
                                <label class="form-label">Tanggal Sewa</label>
                                <input type="date" name="tgl_sewa" class="form-control"
                                    value="{{ old('tgl_sewa', date('Y-m-d')) }}" required id="tglSewa">
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Tanggal Kembali</label>
                                <input type="date" name="tgl_kembali" class="form-control"
                                    value="{{ old('tgl_kembali') }}" readonly id="tglKembali">
                            </div>

                            <!-- Tanggal pesan tersembunyi dengan default tanggal hari ini -->
                            <input type="hidden" name="tgl_pesan" value="{{ old('tgl_pesan', date('Y-m-d')) }}">

                            <!-- Status tersembunyi dengan default value 'pinjam' -->
                            <input type="hidden" name="status" value="{{ old('status', 'pinjam') }}">
                        </div>
                    </div>
                </div>

                <!-- Detail Penyewaan PlayStation -->
                <div class="form-section">
                    <h3><i class="fas fa-gamepad me-2"></i>Detail Penyewaan PlayStation</h3>

                    <div id="rentalItems">
                        <div class="rental-item border rounded p-3 mb-3" data-index="0">
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <h5><i class="fas fa-play-circle me-2"></i>PlayStation #1</h5>
                                <button type="button" class="btn btn-danger btn-sm remove-item-btn"
                                    onclick="removeRentalItem(0)" style="display: none;">
                                    <i class="fas fa-trash me-1"></i>Hapus
                                </button>
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">PlayStation</label>
                                    <select name="detail_penyewaans[0][id_playstation]"
                                        class="form-select playstation-select" required data-index="0">
                                        <option value="">Pilih PlayStation</option>
                                        @foreach ($playstations as $ps)
                                            <option value="{{ $ps->id }}"
                                                data-price="{{ $ps->harga_sewa_harian }}"
                                                data-stok="{{ $ps->stok }}"
                                                {{ old('detail_penyewaans.0.id_playstation') == $ps->id ? 'selected' : '' }}>
                                                {{ $ps->nama_playstation }} - Stok: {{ $ps->stok }} -
                                                Rp{{ number_format($ps->harga_sewa_harian) }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-md-3 mb-3">
                                    <label class="form-label">Jumlah</label>
                                    <div class="input-group">
                                        <button type="button" class="btn btn-outline-secondary"
                                            onclick="changeQuantity(0, -1)">-</button>
                                        <input type="number" name="detail_penyewaans[0][jumlah]"
                                            class="form-control text-center quantity-input"
                                            value="{{ old('detail_penyewaans.0.jumlah', 1) }}" min="1"
                                            required data-index="0">
                                        <button type="button" class="btn btn-outline-secondary"
                                            onclick="changeQuantity(0, 1)">+</button>
                                    </div>
                                </div>

                                <div class="col-md-3 mb-3">
                                    <label class="form-label">Durasi Sewa (Hari)</label>
                                    <input type="number" name="detail_penyewaans[0][durasi_sewa]"
                                        class="form-control duration-input"
                                        value="{{ old('detail_penyewaans.0.durasi_sewa', 1) }}" min="1"
                                        required data-index="0">
                                </div>
                            </div>

                            <div class="alert alert-info price-display" data-index="0">
                                <strong>Total: Rp <span class="total-price">0</span></strong>
                            </div>

                            <input type="hidden" name="detail_penyewaans[0][total_harga]" class="total-harga-input"
                                data-index="0" value="{{ old('detail_penyewaans.0.total_harga', 0) }}">
                        </div>
                    </div>

                    <button type="button" class="btn btn-success mb-3" onclick="addRentalItem()">
                        <i class="fas fa-plus me-2"></i>Tambah PlayStation Lain
                    </button>
                </div>

                <!-- Summary -->
                <div class="form-section">
                    <h4><i class="fas fa-calculator me-2"></i>Ringkasan Pemesanan</h4>
                    <div id="summaryContent">
                        <div class="alert alert-light">
                            <div class="d-flex justify-content-between">
                                <span>Belum ada item dipilih</span>
                                <span><strong>Rp 0</strong></span>
                            </div>
                        </div>
                    </div>
                    <div class="alert alert-primary">
                        <div class="d-flex justify-content-between">
                            <span><strong>Total Keseluruhan:</strong></span>
                            <span><strong id="grandTotal">Rp 0</strong></span>
                        </div>
                    </div>
                </div>

                <!-- Submit Button -->
                <div class="text-center">
                    <button type="submit" class="btn btn-primary btn-lg" id="submitBtn">
                        <i class="fas fa-shopping-cart me-2"></i>
                        Buat Pesanan Penyewaan
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        let itemCount = 1;

        // Toggle dropdown
        function toggleDropdown() {
            const dropdown = document.getElementById('userDropdown');
            dropdown.classList.toggle('show');
        }

        // Close dropdown when clicking outside
        document.addEventListener('click', function(event) {
            const dropdown = document.getElementById('userDropdown');
            const button = document.getElementById('userMenuButton');

            if (!button.contains(event.target) && !dropdown.contains(event.target)) {
                dropdown.classList.remove('show');
            }
        });

        // Change quantity
        function changeQuantity(index, change) {
            const input = document.querySelector(`input[data-index="${index}"].quantity-input`);
            const currentValue = parseInt(input.value);
            const newValue = Math.max(1, currentValue + change);
            input.value = newValue;
            calculateItemTotal(index);
        }

        // Add rental item
        function addRentalItem() {
            if (itemCount >= 5) {
                alert('Maksimal 5 PlayStation per transaksi');
                return;
            }

            const container = document.getElementById('rentalItems');
            const newItem = document.createElement('div');
            newItem.className = 'rental-item border rounded p-3 mb-3';
            newItem.setAttribute('data-index', itemCount);

            newItem.innerHTML = `
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h5><i class="fas fa-play-circle me-2"></i>PlayStation #${itemCount + 1}</h5>
                    <button type="button" class="btn btn-danger btn-sm remove-item-btn" 
                            onclick="removeRentalItem(${itemCount})">
                        <i class="fas fa-trash me-1"></i>Hapus
                    </button>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">PlayStation</label>
                        <select name="detail_penyewaans[${itemCount}][id_playstation]" 
                                class="form-select playstation-select" required data-index="${itemCount}">
                            <option value="">Pilih PlayStation</option>
                            @foreach ($playstations as $ps)
                                <option value="{{ $ps->id }}" 
                                        data-price="{{ $ps->harga_sewa_harian }}"
                                        data-stok="{{ $ps->stok }}">
                                    {{ $ps->nama_playstation }} - Stok: {{ $ps->stok }} - Rp{{ number_format($ps->harga_sewa_harian) }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-3 mb-3">
                        <label class="form-label">Jumlah</label>
                        <div class="input-group">
                            <button type="button" class="btn btn-outline-secondary" 
                                    onclick="changeQuantity(${itemCount}, -1)">-</button>
                            <input type="number" name="detail_penyewaans[${itemCount}][jumlah]" 
                                   class="form-control text-center quantity-input" 
                                   value="1" min="1" required data-index="${itemCount}">
                            <button type="button" class="btn btn-outline-secondary" 
                                    onclick="changeQuantity(${itemCount}, 1)">+</button>
                        </div>
                    </div>

                    <div class="col-md-3 mb-3">
                        <label class="form-label">Durasi Sewa (Hari)</label>
                        <input type="number" name="detail_penyewaans[${itemCount}][durasi_sewa]" 
                               class="form-control duration-input" 
                               value="1" min="1" required data-index="${itemCount}">
                    </div>
                </div>

                <div class="alert alert-info price-display" data-index="${itemCount}">
                    <strong>Total: Rp <span class="total-price">0</span></strong>
                </div>

                <input type="hidden" name="detail_penyewaans[${itemCount}][total_harga]" 
                       class="total-harga-input" data-index="${itemCount}" value="0">
            `;

            container.appendChild(newItem);

            // Show remove button for all items if more than 1
            if (itemCount > 0) {
                document.querySelectorAll('.remove-item-btn').forEach(btn => {
                    btn.style.display = 'inline-block';
                });
            }

            itemCount++;
            attachEventListeners();
        }

        // Remove rental item
        function removeRentalItem(index) {
            const item = document.querySelector(`[data-index="${index}"]`);
            if (item) {
                item.remove();
                calculateGrandTotal();

                // Hide remove buttons if only one item left
                const remainingItems = document.querySelectorAll('.rental-item');
                if (remainingItems.length <= 1) {
                    document.querySelectorAll('.remove-item-btn').forEach(btn => {
                        btn.style.display = 'none';
                    });
                }
            }
        }

        // Calculate item total
        function calculateItemTotal(index) {
            const selectElement = document.querySelector(`select[data-index="${index}"]`);
            const quantityInput = document.querySelector(`input[data-index="${index}"].quantity-input`);
            const durationInput = document.querySelector(`input[data-index="${index}"].duration-input`);
            const totalDisplay = document.querySelector(`.price-display[data-index="${index}"] .total-price`);
            const hiddenInput = document.querySelector(`input[data-index="${index}"].total-harga-input`);

            if (selectElement && quantityInput && durationInput && totalDisplay && hiddenInput) {
                const selectedOption = selectElement.options[selectElement.selectedIndex];
                const price = parseFloat(selectedOption.getAttribute('data-price')) || 0;
                const quantity = parseInt(quantityInput.value) || 0;
                const duration = parseInt(durationInput.value) || 0;

                const total = price * quantity * duration;
                totalDisplay.textContent = total.toLocaleString('id-ID');
                hiddenInput.value = total;

                updateReturnDate();
                calculateGrandTotal();
            }
        }

        // Update return date
        function updateReturnDate() {
            const tglSewa = document.getElementById('tglSewa').value;
            const durationInputs = document.querySelectorAll('.duration-input');

            if (tglSewa && durationInputs.length > 0) {
                // Get maximum duration
                let maxDuration = 1;
                durationInputs.forEach(input => {
                    const duration = parseInt(input.value) || 1;
                    if (duration > maxDuration) {
                        maxDuration = duration;
                    }
                });

                const sewaDate = new Date(tglSewa);
                const kembaliDate = new Date(sewaDate);
                kembaliDate.setDate(sewaDate.getDate() + maxDuration);

                document.getElementById('tglKembali').value = kembaliDate.toISOString().split('T')[0];
            }
        }

        // Calculate grand total
        function calculateGrandTotal() {
            let grandTotal = 0;
            const summaryContent = document.getElementById('summaryContent');

            // Clear summary
            summaryContent.innerHTML = '';

            // Calculate total for each item
            document.querySelectorAll('.rental-item').forEach((item, index) => {
                const totalInput = item.querySelector('.total-harga-input');
                const selectElement = item.querySelector('.playstation-select');

                if (totalInput && selectElement && selectElement.value) {
                    const total = parseFloat(totalInput.value) || 0;
                    grandTotal += total;

                    const selectedOption = selectElement.options[selectElement.selectedIndex];
                    const psName = selectedOption.text.split(' - ')[0];

                    const summaryItem = document.createElement('div');
                    summaryItem.className = 'alert alert-light';
                    summaryItem.innerHTML = `
                        <div class="d-flex justify-content-between">
                            <span>${psName}</span>
                            <span><strong>Rp ${total.toLocaleString('id-ID')}</strong></span>
                        </div>
                    `;
                    summaryContent.appendChild(summaryItem);
                }
            });

            if (grandTotal === 0) {
                summaryContent.innerHTML = `
                    <div class="alert alert-light">
                        <div class="d-flex justify-content-between">
                            <span>Belum ada item dipilih</span>
                            <span><strong>Rp 0</strong></span>
                        </div>
                    </div>
                `;
            }

            document.getElementById('grandTotal').textContent = `Rp ${grandTotal.toLocaleString('id-ID')}`;
        }

        // Attach event listeners
        function attachEventListeners() {
            // PlayStation select change
            document.querySelectorAll('.playstation-select').forEach(select => {
                select.addEventListener('change', function() {
                    const index = this.getAttribute('data-index');
                    calculateItemTotal(index);
                });
            });

            // Quantity change
            document.querySelectorAll('.quantity-input').forEach(input => {
                input.addEventListener('input', function() {
                    const index = this.getAttribute('data-index');
                    calculateItemTotal(index);
                });
            });

            // Duration change
            document.querySelectorAll('.duration-input').forEach(input => {
                input.addEventListener('input', function() {
                    const index = this.getAttribute('data-index');
                    calculateItemTotal(index);
                });
            });
        }

        // Initialize
        document.addEventListener('DOMContentLoaded', function() {
            attachEventListeners();

            // Tanggal sewa change
            document.getElementById('tglSewa').addEventListener('change', updateReturnDate);

            // Initial calculation for existing items
            document.querySelectorAll('.rental-item').forEach((item, index) => {
                calculateItemTotal(index);
            });
        });
    </script>
</body>

</html>
