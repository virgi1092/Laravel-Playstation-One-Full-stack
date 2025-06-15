<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kontak - PSOne Rental</title>
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

        .contact-bg {
            background: linear-gradient(135deg, #e5e7eb 0%, #f3f4f6 100%);
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

    <!-- Main Content -->
    <section class="contact-bg py-20 min-h-screen">
        <div class="container mx-auto px-4">
            <div class="max-w-6xl mx-auto">
                <div class="grid lg:grid-cols-2 gap-12 items-start">
                    <!-- Left Side - Company Info -->
                    <div class="space-y-8">
                        <!-- Logo and Company Name -->
                        <div class="flex items-center space-x-3 mb-8">
                            <div class="bg-blue-600 p-3 rounded-xl shadow-lg">
                                <svg class="w-10 h-10 text-white" fill="currentColor" viewBox="0 0 24 24">
                                    <path
                                        d="M21.58 16.09l-1.09-7.66A3.996 3.996 0 0 0 16.53 5H7.47C5.48 5 3.79 6.46 3.51 8.43l-1.09 7.66C2.25 17.17 3.04 18 4.04 18h.01c.7 0 1.34-.37 1.69-.97L6.5 16h11l.76 1.03c.35.6.99.97 1.69.97h.01c1-.01 1.79-.84 1.62-1.91zM9 10H7V8h2v2zm8 0h-2V8h2v2z" />
                                </svg>
                            </div>
                            <div>
                                <h1 class="text-3xl font-bold text-blue-600">PSOne</h1>
                                <p class="text-xl text-blue-500 font-medium">RENTAL</p>
                            </div>
                        </div>

                        <!-- Company Description -->
                        <div class="bg-white rounded-xl p-6 shadow-lg">
                            <p class="text-gray-700 text-lg leading-relaxed">
                                PSOne adalah layanan sewa PS3 & PS4 profesional yang didirikan untuk memenuhi kebutuhan
                                gamers Indonesia.
                            </p>
                            <p class="text-gray-700 text-lg leading-relaxed mt-4">
                                Dengan tagline "Play Game Anytime, Anywhere", kami memungkinkan siapa saja menikmati
                                gaming berkualitas tanpa harus beli konsol mahal.
                            </p>
                        </div>
                    </div>

                    <!-- Right Side - Contact Info -->
                    <div class="space-y-8">
                        <!-- Contact Section -->
                        <div class="bg-white rounded-xl p-8 shadow-lg">
                            <h2 class="text-2xl font-bold text-blue-600 mb-6">Kontak Kami</h2>
                            <p class="text-gray-600 mb-6">Untuk info lebih lanjut hubungi kami di:</p>

                            <div class="space-y-4">
                                <!-- Phone -->
                                <div
                                    class="flex items-center space-x-4 p-4 bg-blue-50 rounded-lg hover:bg-blue-100 transition">
                                    <div class="bg-blue-500 p-3 rounded-full">
                                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                                        </svg>
                                    </div>
                                    <div>
                                        <p class="text-gray-600 text-sm">Telepon</p>
                                        <a href="tel:+6281311274228"
                                            class="text-blue-600 font-semibold text-lg hover:text-blue-700">+62
                                            813-1127-4228</a>
                                    </div>
                                </div>

                                <!-- Email -->
                                <div
                                    class="flex items-center space-x-4 p-4 bg-green-50 rounded-lg hover:bg-green-100 transition">
                                    <div class="bg-green-500 p-3 rounded-full">
                                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                        </svg>
                                    </div>
                                    <div>
                                        <p class="text-gray-600 text-sm">Email</p>
                                        <a href="mailto:PSOne.Bogor@gmail.com"
                                            class="text-green-600 font-semibold text-lg hover:text-green-700">PSOne.Bogor@gmail.com</a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Social Media Section -->
                        <div class="bg-white rounded-xl p-8 shadow-lg">
                            <h3 class="text-2xl font-bold text-blue-600 mb-6">Sosmed Kami</h3>

                            <div class="flex space-x-4">
                                <!-- Instagram -->
                                <a href="#"
                                    class="bg-gradient-to-br from-purple-600 to-pink-500 p-4 rounded-xl shadow-lg hover:shadow-xl transform hover:scale-105 transition group">
                                    <svg class="w-8 h-8 text-white" fill="currentColor" viewBox="0 0 24 24">
                                        <path
                                            d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z" />
                                    </svg>
                                    <div
                                        class="text-white text-sm font-medium mt-2 opacity-0 group-hover:opacity-100 transition">
                                        Instagram</div>
                                </a>

                                <!-- TikTok -->
                                <a href="#"
                                    class="bg-gradient-to-br from-gray-800 to-gray-900 p-4 rounded-xl shadow-lg hover:shadow-xl transform hover:scale-105 transition group">
                                    <svg class="w-8 h-8 text-white" fill="currentColor" viewBox="0 0 24 24">
                                        <path
                                            d="M19.321 5.562a5.124 5.124 0 01-.443-.258 6.228 6.228 0 01-1.137-.966c-.849-.849-1.334-1.996-1.334-3.146V.846h-3.213v13.512c0 .726-.296 1.422-.823 1.949a2.748 2.748 0 01-1.948.822c-.736 0-1.433-.296-1.959-.822a2.748 2.748 0 01-.822-1.949c0-.736.296-1.433.822-1.959.526-.526 1.223-.822 1.959-.822.304 0 .608.05.898.148v-3.213a6.016 6.016 0 00-.898-.069c-1.59 0-3.115.632-4.243 1.759A5.991 5.991 0 004.424 14.4c0 1.59.632 3.115 1.759 4.243a5.991 5.991 0 004.243 1.759c1.59 0 3.115-.632 4.243-1.759a5.991 5.991 0 001.759-4.243V8.775a9.345 9.345 0 005.371 1.666v-3.213a6.097 6.097 0 01-2.478-.666z" />
                                    </svg>
                                    <div
                                        class="text-white text-sm font-medium mt-2 opacity-0 group-hover:opacity-100 transition">
                                        TikTok</div>
                                </a>
                            </div>
                        </div>

                        <!-- Quick Action -->
                        <div class="text-center">
                            <a href="https://wa.me/6281311274228" target="_blank"
                                class="inline-flex items-center space-x-3 bg-green-500 hover:bg-green-600 text-white font-bold py-4 px-8 rounded-xl text-lg transition transform hover:scale-105 shadow-lg">
                                <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                                    <path
                                        d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893A11.821 11.821 0 0020.051 3.488" />
                                </svg>
                                <span>Chat WhatsApp</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-blue-600 text-white py-6">
        <div class="container mx-auto px-4">
            <div class="text-center">
                <p class="text-blue-100">&copy; 2025 PSone.com</p>
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

        // Animation on scroll
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

        // Observe contact cards
        document.querySelectorAll('.bg-white.rounded-xl').forEach(card => {
            card.style.opacity = '0';
            card.style.transform = 'translateY(20px)';
            card.style.transition = 'opacity 0.6s ease, transform 0.6s ease';
            observer.observe(card);
        });

        // Add hover effect to contact links
        document.querySelectorAll('a[href^="tel:"], a[href^="mailto:"]').forEach(link => {
            link.addEventListener('mouseenter', function() {
                this.style.transform = 'scale(1.02)';
            });
            link.addEventListener('mouseleave', function() {
                this.style.transform = 'scale(1)';
            });
        });
    </script>
</body>

</html>
