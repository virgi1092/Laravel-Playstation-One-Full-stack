<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tentang Kami - PSOne Rental</title>
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

        .game-zone-bg {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%, #f093fb 100%);
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

    <!-- Tentang Kami Section -->
    <section class="py-16 bg-gray-100">
        <div class="container mx-auto px-4">
            <div class="bg-white rounded-2xl shadow-xl overflow-hidden">
                <div class="flex flex-col lg:flex-row">
                    <!-- Left Image Section -->
                    <div class="lg:w-1/2">
                        <div
                            class="game-zone-bg h-96 lg:h-full flex items-center justify-center relative overflow-hidden">
                            <!-- Game Zone Diamond -->
                            <div class="relative">
                                <div
                                    class="bg-pink-500 transform rotate-45 w-32 h-32 flex items-center justify-center rounded-2xl shadow-2xl border-4 border-white">
                                    <div class="transform -rotate-45 text-white text-center">
                                        <div class="text-xl font-bold tracking-wider">GAME</div>
                                        <div class="text-xl font-bold tracking-wider">ZONE</div>
                                    </div>
                                </div>

                                <!-- Floating Controllers -->
                                <div class="absolute -top-8 -left-8 bg-green-400 w-6 h-6 rounded-full animate-bounce">
                                </div>
                                <div class="absolute -top-4 -right-8 bg-yellow-400 w-4 h-4 rounded-full animate-bounce"
                                    style="animation-delay: 0.5s;"></div>
                                <div class="absolute -bottom-6 -left-6 bg-blue-400 w-5 h-5 rounded-full animate-bounce"
                                    style="animation-delay: 1s;"></div>
                                <div class="absolute -bottom-8 -right-6 bg-red-400 w-6 h-6 rounded-full animate-bounce"
                                    style="animation-delay: 1.5s;"></div>
                            </div>

                            <!-- Background Gaming Elements -->
                            <div class="absolute top-8 left-8 text-white opacity-30">
                                <svg class="w-12 h-12" fill="currentColor" viewBox="0 0 24 24">
                                    <path
                                        d="M21.58 16.09l-1.09-7.66A3.996 3.996 0 0 0 16.53 5H7.47C5.48 5 3.79 6.46 3.51 8.43l-1.09 7.66C2.25 17.17 3.04 18 4.04 18h.01c.7 0 1.34-.37 1.69-.97L6.5 16h11l.76 1.03c.35.6.99.97 1.69.97h.01c1-.01 1.79-.84 1.62-1.91z" />
                                </svg>
                            </div>
                            <div class="absolute bottom-8 right-8 text-white opacity-30">
                                <svg class="w-16 h-16" fill="currentColor" viewBox="0 0 24 24">
                                    <path
                                        d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z" />
                                </svg>
                            </div>
                        </div>
                    </div>

                    <!-- Right Content Section -->
                    <div class="lg:w-1/2 p-8 lg:p-12">
                        <h2 class="text-4xl lg:text-5xl font-bold text-blue-600 mb-6">
                            Tentang Kami
                        </h2>

                        <div class="space-y-6 text-gray-700 text-lg leading-relaxed">
                            <p>
                                <span class="font-bold text-blue-600">PSOne</span> adalah layanan sewa Playstation 3 & 4
                                profesional yang didirikan untuk memenuhi
                                kebutuhan gamers Indonesia.
                            </p>

                            <p>
                                Dengan tagline <em class="text-blue-600 font-semibold">"Play Game Anytime,
                                    Anywhere"</em>,
                                kami memungkinkan siapa saja menikmati gaming
                                berkualitas tanpa harus beli konsol mahal.
                            </p>
                        </div>

                        <!-- Features List -->
                        <div class="mt-10 space-y-4">
                            <div class="flex items-center">
                                <div class="bg-blue-500 w-3 h-3 rounded-full mr-4"></div>
                                <span class="font-semibold text-gray-800 text-lg">Support 24 Jam</span>
                            </div>
                            <div class="flex items-center">
                                <div class="bg-green-500 w-3 h-3 rounded-full mr-4"></div>
                                <span class="font-semibold text-gray-800 text-lg">Layanan Fleksibel</span>
                            </div>
                            <div class="flex items-center">
                                <div class="bg-yellow-500 w-3 h-3 rounded-full mr-4"></div>
                                <span class="font-semibold text-gray-800 text-lg">Hygienis & Terawat</span>
                            </div>
                            <div class="flex items-center">
                                <div class="bg-purple-500 w-3 h-3 rounded-full mr-4"></div>
                                <span class="font-semibold text-gray-800 text-lg">Konsol & Game Terupdate</span>
                            </div>
                        </div>

                        <!-- CTA Button -->
                        <div class="mt-10">
                            <a href="{{ route('login') }}"
                                class="bg-yellow-400 hover:bg-yellow-500 text-blue-900 font-bold py-4 px-8 rounded-lg text-lg transition transform hover:scale-105 shadow-lg inline-block text-center">
                                Sewa Sekarang
                            </a>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Why Choose Us Section -->
    <section class="py-16 bg-white">
        <div class="container mx-auto px-4">
            <div class="text-center mb-12">
                <h3 class="text-3xl font-bold text-gray-800 mb-4">Mengapa Memilih PSOne?</h3>
                <p class="text-gray-600 max-w-2xl mx-auto">Kami berkomitmen memberikan pengalaman gaming terbaik dengan
                    layanan profesional dan berkualitas tinggi</p>
            </div>

            <div class="grid md:grid-cols-3 gap-8">
                <div
                    class="text-center p-6 rounded-xl bg-gradient-to-br from-blue-50 to-indigo-100 hover:shadow-lg transition">
                    <div class="bg-blue-500 w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg class="w-8 h-8 text-white" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <h4 class="text-xl font-bold text-gray-800 mb-3">Kualitas Premium</h4>
                    <p class="text-gray-600">Konsol PS3/PS4 original dengan kondisi prima dan performa optimal untuk
                        gaming experience terbaik</p>
                </div>

                <div
                    class="text-center p-6 rounded-xl bg-gradient-to-br from-green-50 to-emerald-100 hover:shadow-lg transition">
                    <div class="bg-green-500 w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg class="w-8 h-8 text-white" fill="currentColor" viewBox="0 0 24 24">
                            <path
                                d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z" />
                        </svg>
                    </div>
                    <h4 class="text-xl font-bold text-gray-800 mb-3">Game Terlengkap</h4>
                    <p class="text-gray-600">Koleksi ratusan game dari berbagai genre, selalu update dengan title-title
                        terbaru setiap bulannya</p>
                </div>

                <div
                    class="text-center p-6 rounded-xl bg-gradient-to-br from-yellow-50 to-amber-100 hover:shadow-lg transition">
                    <div class="bg-yellow-500 w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg class="w-8 h-8 text-white" fill="currentColor" viewBox="0 0 24 24">
                            <path
                                d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <h4 class="text-xl font-bold text-gray-800 mb-3">Harga Terjangkau</h4>
                    <p class="text-gray-600">Paket rental fleksibel mulai dari harian hingga bulanan dengan harga yang
                        sangat bersahabat</p>
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
