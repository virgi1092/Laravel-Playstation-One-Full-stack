<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Paket & Harga - PSOne Rental</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }

        .gradient-bg {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }

        .hero-gradient {
            background: linear-gradient(135deg, #1e40af 0%, #3730a3 100%);
        }

        .card-hover {
            transition: all 0.3s ease;
        }

        .card-hover:hover {
            transform: translateY(-8px);
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
        }
    </style>
</head>

<body class="bg-gray-50">
    <!-- Header -->
    <header class="gradient-bg shadow-lg">
        <div class="container mx-auto px-4">
            <nav class="flex items-center justify-between py-4">
                <!-- Logo -->
                <div class="flex items-center space-x-2">
                    <div class="bg-white bg-opacity-20 p-2 rounded-lg">
                        <svg class="w-8 h-8 text-white" fill="currentColor" viewBox="0 0 24 24">
                            <path
                                d="M21.58 16.09l-1.09-7.66A3.996 3.996 0 0 0 16.53 5H7.47C5.48 5 3.79 6.46 3.51 8.43l-1.09 7.66C2.25 17.17 3.04 18 4.04 18h.01c.7 0 1.34-.37 1.69-.97L6.5 16h11l.76 1.03c.35.6.99.97 1.69.97h.01c1-.01 1.79-.84 1.62-1.91zM9 10H7V8h2v2zm8 0h-2V8h2v2z" />
                        </svg>
                    </div>
                    <div>
                        <h1 class="text-white font-bold text-xl">PSOne</h1>
                        <p class="text-blue-200 text-sm">RENTAL</p>
                    </div>
                </div>

                <!-- Desktop Navigation -->
                @include('component.navbar')
                 <div class="hidden md:flex items-center space-x-8">
                 </div>

                <!-- Mobile menu button - GUNAKAN YANG INI SAJA -->
            <div class="md:hidden flex items-center">
                <button class="text-white p-2 hover:bg-blue-700 rounded-lg transition-colors"
                    onclick="openSimpleMobileMenu()">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16"></path>
                    </svg>
                </button>
            </div>
        </nav>
        
        <!-- Mobile menu - LETAKKAN DI SINI -->
        @include('component.navbar_mobile')
        </div>
    </header>

    <!-- Hero Section -->
    <section class="hero-gradient py-16">
        <div class="container mx-auto px-4 text-center">
            <h2 class="text-4xl lg:text-5xl font-bold text-white mb-4">
                Paket & Harga Sewa Playstation
            </h2>
            <p class="text-xl text-blue-100 max-w-3xl mx-auto">
                Pilihan Paket Sewa Playbox - Mainkan Game Favoritmu dengan Harga Terjangkau!
            </p>
        </div>
    </section>

    <!-- Pricing Cards Section -->
    <section class="py-16 bg-gray-100">
        <div class="container mx-auto px-4">
            <div class="grid md:grid-cols-3 gap-8 max-w-6xl mx-auto">

                @forelse($latest_playstation as $ilp)
                    <!-- PlayStation Card -->
                    <div class="bg-white rounded-2xl shadow-xl overflow-hidden card-hover">
                        <!-- Header with Console Image -->
                        <div class="bg-blue-600 px-6 py-8 text-center">
                            <img src="{{ Storage::url($ilp->foto_playstation) }}" alt="Foto Playstation"
                                class="mx-auto w-32 h-32 object-cover rounded-lg shadow-md mb-4">

                            <h3 class="text-2xl font-bold text-white">{{ $ilp->nama_playstation }}</h3>
                        </div>

                        <!-- Pricing -->
                        <div class="bg-blue-600 px-6 py-6 text-white">
                            <div class="space-y-2">
                                <div class="flex justify-between items-center">
                                    <span class="font-semibold">Rp
                                        {{ number_format($ilp->harga_sewa_harian, 0, ',', '.') }}</span>
                                    <span class="text-blue-200">1 Hari</span>
                                </div>
                                <div class="flex justify-between items-center">
                                    <span class="font-semibold">Rp
                                        {{ number_format($ilp->harga_sewa_harian * 3, 0, ',', '.') }}</span>
                                    <span class="text-blue-200">3 Hari</span>
                                </div>
                                <div class="flex justify-between items-center">
                                    <span class="font-semibold">Rp
                                        {{ number_format($ilp->harga_sewa_harian * 7, 0, ',', '.') }}</span>
                                    <span class="text-blue-200">7 Hari</span>
                                </div>

                                <div class="flex justify-between items-center mt-2">
                                    <span class="text-sm">Stok Tersedia:</span>
                                    <span class="font-semibold">{{ $ilp->stok }}</span>
                                </div>
                            </div>

                            <a href="{{ route('login') }}"
                                class="w-full bg-yellow-400 hover:bg-yellow-500 text-blue-900 font-bold py-3 px-6 rounded-lg mt-6 transition transform hover:scale-105 block text-center">
                                Sewa Sekarang
                            </a>

                        </div>
                    </div>
                @empty
                    <p>Belum ada Data Playstation</p>
                @endforelse


                {{-- <!-- PlayStation 4 Card -->
                <div class="bg-white rounded-2xl shadow-xl overflow-hidden card-hover">
                    <!-- Header with Console Image -->
                    <div class="bg-blue-600 px-6 py-8 text-center">
                        <div
                            class="bg-white bg-opacity-20 w-24 h-16 mx-auto rounded-lg flex items-center justify-center mb-4">
                            <svg class="w-12 h-8 text-white" fill="currentColor" viewBox="0 0 24 24">
                                <path
                                    d="M21.58 16.09l-1.09-7.66A3.996 3.996 0 0 0 16.53 5H7.47C5.48 5 3.79 6.46 3.51 8.43l-1.09 7.66C2.25 17.17 3.04 18 4.04 18h.01c.7 0 1.34-.37 1.69-.97L6.5 16h11l.76 1.03c.35.6.99.97 1.69.97h.01c1-.01 1.79-.84 1.62-1.91zM9 10H7V8h2v2zm8 0h-2V8h2v2z" />
                            </svg>
                        </div>
                        <h3 class="text-2xl font-bold text-white">Playstation 4</h3>
                    </div>

                    <!-- Pricing -->
                    <div class="bg-blue-600 px-6 py-6 text-white">
                        <div class="space-y-2">
                            <div class="flex justify-between items-center">
                                <span class="font-semibold">Rp 100.000</span>
                                <span class="text-blue-200">per 24 Jam</span>
                            </div>
                            <div class="flex justify-between items-center">
                                <span class="font-semibold">Rp 70.000</span>
                                <span class="text-blue-200">per 12 Jam Pagi</span>
                            </div>
                            <div class="flex justify-between items-center">
                                <span class="font-semibold">Rp 90.000</span>
                                <span class="text-blue-200">per 12 Jam Malam</span>
                            </div>
                        </div>

                        <button
                            class="w-full bg-yellow-400 hover:bg-yellow-500 text-blue-900 font-bold py-3 px-6 rounded-lg mt-6 transition transform hover:scale-105">
                            Sewa Sekarang
                        </button>
                    </div>
                </div> --}}

                <!-- PlayStation 5 Card - Coming Soon -->
                <div class="bg-white rounded-2xl shadow-xl overflow-hidden card-hover">
                    <!-- Header with Console Image -->
                    <div class="bg-blue-600 px-6 py-8 text-center">
                        <div
                            class="bg-white bg-opacity-20 w-24 h-16 mx-auto rounded-lg flex items-center justify-center mb-4">
                            <svg class="w-12 h-8 text-white" fill="currentColor" viewBox="0 0 24 24">
                                <path
                                    d="M21.58 16.09l-1.09-7.66A3.996 3.996 0 0 0 16.53 5H7.47C5.48 5 3.79 6.46 3.51 8.43l-1.09 7.66C2.25 17.17 3.04 18 4.04 18h.01c.7 0 1.34-.37 1.69-.97L6.5 16h11l.76 1.03c.35.6.99.97 1.69.97h.01c1-.01 1.79-.84 1.62-1.91zM9 10H7V8h2v2zm8 0h-2V8h2v2z" />
                            </svg>
                        </div>
                        <h3 class="text-2xl font-bold text-white">Playstation 5</h3>
                    </div>

                    <!-- Coming Soon -->
                    <div class="bg-blue-600 px-6 py-16 text-white text-center">
                        <div class="text-4xl font-bold mb-4">COMING SOON</div>
                        <p class="text-blue-200 mb-6">PlayStation 5 akan segera tersedia untuk disewa!</p>

                        <button disabled
                            class="w-full bg-gray-400 text-gray-600 font-bold py-3 px-6 rounded-lg cursor-not-allowed">
                            Segera Hadir
                        </button>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <!-- Additional Info Section -->
    <section class="py-16 bg-white">
        <div class="container mx-auto px-4">
            <div class="max-w-4xl mx-auto text-center">
                <h3 class="text-3xl font-bold text-gray-800 mb-8">Yang Anda Dapatkan</h3>

                <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-6">
                    <div class="p-6 bg-gradient-to-br from-blue-50 to-indigo-100 rounded-xl">
                        <div class="bg-blue-500 w-12 h-12 rounded-full flex items-center justify-center mx-auto mb-4">
                            <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 24 24">
                                <path
                                    d="M21.58 16.09l-1.09-7.66A3.996 3.996 0 0 0 16.53 5H7.47C5.48 5 3.79 6.46 3.51 8.43l-1.09 7.66C2.25 17.17 3.04 18 4.04 18h.01c.7 0 1.34-.37 1.69-.97L6.5 16h11l.76 1.03c.35.6.99.97 1.69.97h.01c1-.01 1.79-.84 1.62-1.91z" />
                            </svg>
                        </div>
                        <h4 class="font-bold text-gray-800 mb-2">Konsol Original</h4>
                        <p class="text-gray-600 text-sm">PlayStation asli dengan kondisi prima</p>
                    </div>

                    <div class="p-6 bg-gradient-to-br from-green-50 to-emerald-100 rounded-xl">
                        <div class="bg-green-500 w-12 h-12 rounded-full flex items-center justify-center mx-auto mb-4">
                            <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 24 24">
                                <path
                                    d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z" />
                            </svg>
                        </div>
                        <h4 class="font-bold text-gray-800 mb-2">Game Terlengkap</h4>
                        <p class="text-gray-600 text-sm">Ratusan pilihan game terbaru</p>
                    </div>

                    <div class="p-6 bg-gradient-to-br from-purple-50 to-violet-100 rounded-xl">
                        <div class="bg-purple-500 w-12 h-12 rounded-full flex items-center justify-center mx-auto mb-4">
                            <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <h4 class="font-bold text-gray-8Mq00 mb-2">Hygienis</h4>
                        <p class="text-gray-600 text-sm">Selalu dibersihkan setiap pemakaian</p>
                    </div>

                    <div class="p-6 bg-gradient-to-br from-yellow-50 to-amber-100 rounded-xl">
                        <div class="bg-yellow-500 w-12 h-12 rounded-full flex items-center justify-center mx-auto mb-4">
                            <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <h4 class="font-bold text-gray-800 mb-2">24/7 Support</h4>
                        <p class="text-gray-600 text-sm">Layanan customer service 24 jam</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-gray-800 text-white py-8">
        <div class="container mx-auto px-4">
            <div class="flex flex-col md:flex-row justify-between items-center">
                <div class="flex items-center space-x-2 mb-4 md:mb-0">
                    <div class="bg-blue-600 p-2 rounded-lg">
                        <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 24 24">
                            <path
                                d="M21.58 16.09l-1.09-7.66A3.996 3.996 0 0 0 16.53 5H7.47C5.48 5 3.79 6.46 3.51 8.43l-1.09 7.66C2.25 17.17 3.04 18 4.04 18h.01c.7 0 1.34-.37 1.69-.97L6.5 16h11l.76 1.03c.35.6.99.97 1.69.97h.01c1-.01 1.79-.84 1.62-1.91z" />
                        </svg>
                    </div>
                    <div>
                        <h4 class="font-bold">PSOne Rental</h4>
                        <p class="text-gray-400 text-sm">Play Game Anytime, Anywhere</p>
                    </div>
                </div>
                <p class="text-gray-400">&copy; 2024 PSOne Rental. All rights reserved.</p>
            </div>
        </div>
    </footer>

    <script>
        function toggleMobileMenu() {
            const mobileMenu = document.getElementById('mobile-menu');
            mobileMenu.classList.toggle('hidden');
        }

        // Smooth scrolling for anchor links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function(e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({
                        behavior: 'smooth'
                    });
                }
            });
        });
    </script>
</body>

</html>
