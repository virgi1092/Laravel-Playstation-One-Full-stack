<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PSOne Rental - Sewa PS3/PS4</title>
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

                <!-- Navigation -->
                <!-- Desktop Navigation -->
                @include('component.navbar_after')
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
            @include('component.navbar_mobile_after')
    </header>

    <!-- Hero Section -->
    <section class="hero-gradient py-20">
        <div class="container mx-auto px-4">
            <div class="flex flex-col lg:flex-row items-center justify-between">
                <!-- Left Content -->
                <div class="lg:w-1/2 text-white mb-10 lg:mb-0">
                    <h2 class="text-4xl lg:text-5xl font-bold leading-tight mb-6">
                        Sewa PS3/PS4 Lengkap dengan Game Terbaik<br>
                        <span class="text-yellow-300">Mainkan Kapan Saja!</span>
                    </h2>

                    <p class="text-lg text-blue-100 mb-8 leading-relaxed">
                        PSOne siap bikin weekendmu seru dengan grafis 4K ultra HD dan koleksi game terupdate!
                        Dari GTA V hingga Spider-Man 2, semua ada. Ga perlu beli konsol mahal, cukup sewa,
                        mainkan, puaskan hasrat gamingmu.
                    </p>
                    <a href="{{ route('paket.harga.login') }}"
                        class="bg-yellow-400 hover:bg-yellow-500 text-blue-900 font-bold py-4 px-8 rounded-lg text-lg transition transform hover:scale-105 shadow-lg inline-block text-center">
                        Sewa Sekarang
                    </a>

                </div>

                <!-- Right Image -->
                <div class="lg:w-1/2 lg:pl-12">
                    <div class="relative">
                        <div class="bg-gradient-to-br from-blue-400 to-purple-600 rounded-2xl p-1 shadow-2xl">
                            <div class="bg-white rounded-xl p-4">
                                <img src="https://images.unsplash.com/photo-1606144042614-b2417e99c4e3?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1000&q=80"
                                    alt="Gaming Setup" class="w-full h-80 object-cover rounded-lg">
                            </div>
                        </div>
                        <!-- Floating elements -->
                        <div
                            class="absolute -top-4 -right-4 bg-yellow-400 text-blue-900 p-3 rounded-full font-bold shadow-lg">
                            4K HD
                        </div>
                        <div
                            class="absolute -bottom-4 -left-4 bg-green-400 text-white p-3 rounded-full font-bold shadow-lg">
                            100+ Games
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section class="py-16 bg-white">
        <div class="container mx-auto px-4">
            <div class="text-center mb-12">
                <h3 class="text-3xl font-bold text-gray-800 mb-4">Kenapa Pilih PSOne Rental?</h3>
                <p class="text-gray-600 max-w-2xl mx-auto">Kami menyediakan pengalaman gaming terbaik dengan layanan
                    profesional dan koleksi game terlengkap</p>
            </div>

            <div class="grid md:grid-cols-3 gap-8">
                <div
                    class="text-center p-6 rounded-xl bg-gradient-to-br from-blue-50 to-indigo-100 hover:shadow-lg transition">
                    <div class="bg-blue-500 w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg class="w-8 h-8 text-white" fill="currentColor" viewBox="0 0 24 24">
                            <path
                                d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z" />
                        </svg>
                    </div>
                    <h4 class="text-xl font-bold text-gray-800 mb-2">Kualitas Terjamin</h4>
                    <p class="text-gray-600">Konsol terawat dengan grafis 4K Ultra HD untuk pengalaman gaming maksimal
                    </p>
                </div>

                <div
                    class="text-center p-6 rounded-xl bg-gradient-to-br from-green-50 to-emerald-100 hover:shadow-lg transition">
                    <div class="bg-green-500 w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg class="w-8 h-8 text-white" fill="currentColor" viewBox="0 0 24 24">
                            <path
                                d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z" />
                        </svg>
                    </div>
                    <h4 class="text-xl font-bold text-gray-800 mb-2">Game Terlengkap</h4>
                    <p class="text-gray-600">Koleksi 100+ game terbaru dan terpopuler, selalu update setiap bulan</p>
                </div>

                <div
                    class="text-center p-6 rounded-xl bg-gradient-to-br from-yellow-50 to-amber-100 hover:shadow-lg transition">
                    <div class="bg-yellow-500 w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg class="w-8 h-8 text-white" fill="currentColor" viewBox="0 0 24 24">
                            <path
                                d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z" />
                        </svg>
                    </div>
                    <h4 class="text-xl font-bold text-gray-800 mb-2">Harga Terjangkau</h4>
                    <p class="text-gray-600">Paket rental fleksibel mulai dari harian hingga bulanan dengan harga
                        bersahabat</p>
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
                        <p class="text-gray-400 text-sm">Gaming Experience</p>
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
