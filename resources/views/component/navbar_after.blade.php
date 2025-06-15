<div class="hidden md:flex items-center space-x-8">
    <!-- Navigation Links -->
    <a href="{{ route('beranda.login') }}"
        class="{{ request()->route()->getName() == 'beranda.login' ? 'bg-blue-600 text-white' : 'text-white hover:text-blue-200' }} px-4 py-2 rounded-lg font-medium transition duration-300">
        Beranda
    </a>

    <a href="{{ route('tentangkami.login') }}"
        class="{{ request()->route()->getName() == 'tentangkami.login' ? 'bg-blue-600 text-white' : 'text-white hover:text-blue-200' }} px-4 py-2 rounded-lg font-medium transition duration-300">
        Tentang Kami
    </a>

    <a href="{{ route('paket.harga.login') }}"
        class="{{ request()->route()->getName() == 'paket.harga.login' ? 'bg-blue-600 text-white' : 'text-white hover:text-blue-200' }} px-4 py-2 rounded-lg font-medium transition duration-300">
        Paket & Harga
    </a>

    <a href="{{ route('testimoni.login') }}"
        class="{{ request()->route()->getName() == 'testimoni.login' ? 'bg-blue-600 text-white' : 'text-white hover:text-blue-200' }} px-4 py-2 rounded-lg font-medium transition duration-300">
        Testimoni
    </a>

    <a href="{{ route('kontak.login') }}"
        class="{{ request()->route()->getName() == 'kontak.login' ? 'bg-blue-600 text-white' : 'text-white hover:text-blue-200' }} px-4 py-2 rounded-lg font-medium transition duration-300">
        Kontak
    </a>
    <a href="{{ route('cekpesanan.login') }}"
        class="{{ request()->route()->getName() == 'cekpesanan.login' ? 'bg-blue-600 text-white' : 'text-white hover:text-blue-200' }} px-4 py-2 rounded-lg font-medium transition duration-300">
        Cek Pesanan
    </a>

    <!-- User Authentication Section -->
    @auth('penyewa')
        <div class="relative">
            <!-- User Dropdown Button -->
            <button onclick="toggleDropdown()"
                class="flex items-center space-x-2 text-white hover:text-blue-200 px-4 py-2 rounded-lg font-medium transition duration-300"
                id="userMenuButton">
                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd">
                    </path>
                </svg>
                <span>{{ Auth::guard('penyewa')->user()->name }}</span>
                <svg class="w-4 h-4 transition-transform duration-200" id="dropdownArrow" fill="currentColor"
                    viewBox="0 0 20 20">
                    <path fill-rule="evenodd"
                        d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                        clip-rule="evenodd"></path>
                </svg>
            </button>

            <!-- Dropdown Menu -->
            <div id="userDropdown"
                class="hidden absolute right-0 mt-2 w-56 bg-white rounded-lg shadow-lg ring-1 ring-black ring-opacity-5 z-50">

                <div class="py-2">
                    <!-- Profile Link -->
                    <a href="#"
                        class="flex items-center px-4 py-3 text-sm text-gray-700 hover:bg-blue-50 hover:text-blue-600 transition duration-200">
                        <svg class="w-4 h-4 mr-3" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-6-3a2 2 0 11-4 0 2 2 0 014 0zm-2 4a5 5 0 00-4.546 2.916A5.986 5.986 0 0010 16a5.986 5.986 0 004.546-2.084A5 5 0 0010 11z"
                                clip-rule="evenodd"></path>
                        </svg>
                        Profile
                    </a>

                    <!-- Settings Link -->
                    <a href="#"
                        class="flex items-center px-4 py-3 text-sm text-gray-700 hover:bg-blue-50 hover:text-blue-600 transition duration-200">
                        <svg class="w-4 h-4 mr-3" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M11.49 3.17c-.38-1.56-2.6-1.56-2.98 0a1.532 1.532 0 01-2.286.948c-1.372-.836-2.942.734-2.106 2.106.54.886.061 2.042-.947 2.287-1.561.379-1.561 2.6 0 2.978a1.532 1.532 0 01.947 2.287c-.836 1.372.734 2.942 2.106 2.106a1.532 1.532 0 012.287.947c.379 1.561 2.6 1.561 2.978 0a1.533 1.533 0 012.287-.947c1.372.836 2.942-.734 2.106-2.106a1.533 1.533 0 01.947-2.287c1.561-.379 1.561-2.6 0-2.978a1.532 1.532 0 01-.947-2.287c.836-1.372-.734-2.942-2.106-2.106a1.532 1.532 0 01-2.287-.947zM10 13a3 3 0 100-6 3 3 0 000 6z"
                                clip-rule="evenodd"></path>
                        </svg>
                        Pengaturan
                    </a>

                    <!-- Divider -->
                    <div class="border-t border-gray-100 my-1"></div>

                    <!-- Logout Button -->
                    <form action="{{ route('logout') }}" method="POST" class="block">
                        @csrf
                        <button type="submit"
                            class="flex items-center w-full text-left px-4 py-3 text-sm text-red-600 hover:bg-red-50 hover:text-red-700 transition duration-200">
                            <svg class="w-4 h-4 mr-3" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M3 3a1 1 0 00-1 1v12a1 1 0 102 0V4a1 1 0 00-1-1zm10.293 9.293a1 1 0 001.414 1.414l3-3a1 1 0 000-1.414l-3-3a1 1 0 10-1.414 1.414L14.586 9H7a1 1 0 100 2h7.586l-1.293 1.293z"
                                    clip-rule="evenodd"></path>
                            </svg>
                            Logout
                        </button>
                    </form>
                </div>
            </div>
        </div>
    @else
        <!-- Login Link -->
        <a href="{{ route('login') }}"
            class="flex items-center space-x-2 bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-lg font-medium transition duration-300">
            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd"
                    d="M3 3a1 1 0 011 1v12a1 1 0 11-2 0V4a1 1 0 011-1zm7.707 3.293a1 1 0 010 1.414L9.414 9H17a1 1 0 110 2H9.414l1.293 1.293a1 1 0 01-1.414 1.414l-3-3a1 1 0 010-1.414l3-3a1 1 0 011.414 0z"
                    clip-rule="evenodd"></path>
            </svg>
            <span>Login</span>
        </a>
    @endauth
</div>

<script>
    function toggleDropdown() {
        const dropdown = document.getElementById('userDropdown');
        const arrow = document.getElementById('dropdownArrow');

        dropdown.classList.toggle('hidden');
        arrow.classList.toggle('rotate-180');
    }

    // Close dropdown when clicking outside
    document.addEventListener('click', function(event) {
        const dropdown = document.getElementById('userDropdown');
        const button = document.getElementById('userMenuButton');

        if (!button.contains(event.target) && !dropdown.contains(event.target)) {
            dropdown.classList.add('hidden');
            document.getElementById('dropdownArrow').classList.remove('rotate-180');
        }
    });
</script>
