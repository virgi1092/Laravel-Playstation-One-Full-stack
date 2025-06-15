<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Testimoni - PSOne Rental</title>
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
        .star-rating {
            color: #fbbf24;
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
                            <path d="M21.58 16.09l-1.09-7.66A3.996 3.996 0 0 0 16.53 5H7.47C5.48 5 3.79 6.46 3.51 8.43l-1.09 7.66C2.25 17.17 3.04 18 4.04 18h.01c.7 0 1.34-.37 1.69-.97L6.5 16h11l.76 1.03c.35.6.99.97 1.69.97h.01c1-.01 1.79-.84 1.62-1.91zM9 10H7V8h2v2zm8 0h-2V8h2v2z"/>
                        </svg>
                    </div>
                    <div>
                        <h1 class="text-white font-bold text-xl">PSOne</h1>
                        <p class="text-blue-200 text-sm">RENTAL</p>
                    </div>
                </div>

                <!-- Navigation -->
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
        </div>
    </header>

    <!-- Hero Section -->
    <section class="hero-gradient py-20">
        <div class="container mx-auto px-4 text-center">
            <h2 class="text-4xl lg:text-5xl font-bold text-white mb-4">
                Testimoni Pelanggan PSOne
            </h2>
            <p class="text-xl text-blue-100 max-w-2xl mx-auto">
                Bukti Nyata Kepuasan Gamers!
            </p>
        </div>
    </section>

    <!-- Testimoni Section -->
    <section class="py-16 bg-white">
        <div class="container mx-auto px-4">
            <div class="grid md:grid-cols-3 gap-8 max-w-6xl mx-auto">
                <!-- Testimoni 1 -->
                <div class="bg-white rounded-xl shadow-lg p-6 border-l-4 border-blue-500 hover:shadow-xl transition">
                    <div class="mb-4">
                        <div class="flex star-rating mb-3">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/>
                            </svg>
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/>
                            </svg>
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/>
                            </svg>
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/>
                            </svg>
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/>
                            </svg>
                        </div>
                        <p class="text-gray-700 leading-relaxed mb-4">
                            "Pesan lewat WhatsApp langsung diproses, barang cepat sampai dan bisa bayar COD! 
                            Konsolenya mulus, game-nya juga up-to-date. 
                            Mantap banget, puas!"
                        </p>
                    </div>
                    <div class="flex items-center">
                        <div class="bg-blue-500 w-10 h-10 rounded-full flex items-center justify-center text-white font-bold mr-3">
                            V
                        </div>
                        <div>
                            <h4 class="font-bold text-gray-800">Virgi</h4>
                            <p class="text-gray-500 text-sm">Pelanggan Setia</p>
                        </div>
                    </div>
                </div>

                <!-- Testimoni 2 -->
                <div class="bg-white rounded-xl shadow-lg p-6 border-l-4 border-green-500 hover:shadow-xl transition">
                    <div class="mb-4">
                        <div class="flex star-rating mb-3">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/>
                            </svg>
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/>
                            </svg>
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/>
                            </svg>
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/>
                            </svg>
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/>
                            </svg>
                        </div>
                        <p class="text-gray-700 leading-relaxed mb-4">
                            "Nggak nyangka dapat PS5 yang super bersih dan performanya happy! 
                            Harganya ramah di kantong, pengirimannya juga cepat. 
                            Fix bakal sewa lagi nanti!"
                        </p>
                    </div>
                    <div class="flex items-center">
                        <div class="bg-green-500 w-10 h-10 rounded-full flex items-center justify-center text-white font-bold mr-3">
                            R
                        </div>
                        <div>
                            <h4 class="font-bold text-gray-800">Riel</h4>
                            <p class="text-gray-500 text-sm">Gamer Antusias</p>
                        </div>
                    </div>
                </div>

                <!-- Testimoni 3 -->
                <div class="bg-white rounded-xl shadow-lg p-6 border-l-4 border-yellow-500 hover:shadow-xl transition">
                    <div class="mb-4">
                        <div class="flex star-rating mb-3">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/>
                            </svg>
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/>
                            </svg>
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/>
                            </svg>
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/>
                            </svg>
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/>
                            </svg>
                        </div>
                        <p class="text-gray-700 leading-relaxed mb-4">
                            "Sewa PS5 buat kumpul keluarga selama seminggu-semu, pada happy! 
                            Harganya ramah di kantong, pengirimannya juga cepat. 
                            Layanannya juara, recommended banget!"
                        </p>
                    </div>
                    <div class="flex items-center">
                        <div class="bg-yellow-500 w-10 h-10 rounded-full flex items-center justify-center text-white font-bold mr-3">
                            B
                        </div>
                        <div>
                            <h4 class="font-bold text-gray-800">Bagas</h4>
                            <p class="text-gray-500 text-sm">Family Gamer</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- CTA Section -->
            <div class="text-center mt-12">
                <h3 class="text-2xl font-bold text-gray-800 mb-4">Siap Bergabung dengan Ribuan Gamers Lainnya?</h3>
                <p class="text-gray-600 mb-6 max-w-2xl mx-auto">
                    Jangan sampai ketinggalan! Rasakan pengalaman gaming terbaik dengan PSOne Rental sekarang juga.
                </p>
                <a href="{{ route('paket.harga.login') }}" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-4 px-8 rounded-lg text-lg transition transform hover:scale-105 shadow-lg">
                    Mulai Sewa Sekarang
                </a>
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
                            <path d="M21.58 16.09l-1.09-7.66A3.996 3.996 0 0 0 16.53 5H7.47C5.48 5 3.79 6.46 3.51 8.43l-1.09 7.66C2.25 17.17 3.04 18 4.04 18h.01c.7 0 1.34-.37 1.69-.97L6.5 16h11l.76 1.03c.35.6.99.97 1.69.97h.01c1-.01 1.79-.84 1.62-1.91z"/>
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
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({
                        behavior: 'smooth'
                    });
                }
            });
        });

        // Add animation on scroll
        const observerOptions = {
            threshold: 0.1,
            rootMargin: '0px 0px -50px 0px'
        };

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.style.opacity = '1';
                    entry.target.style.transform = 'translateY(0)';
                }
            });
        }, observerOptions);

        // Observe testimoni cards
        document.querySelectorAll('.bg-white.rounded-xl').forEach(card => {
            card.style.opacity = '0';
            card.style.transform = 'translateY(20px)';
            card.style.transition = 'opacity 0.6s ease, transform 0.6s ease';
            observer.observe(card);
        });
    </script>
</body>
</html>