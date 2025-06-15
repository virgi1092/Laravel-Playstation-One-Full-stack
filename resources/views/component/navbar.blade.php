<div class="hidden md:flex items-center space-x-8">
    <a href="{{ route('beranda') }}"
        class="{{ request()->route()->getName() == 'beranda' ? 'bg-blue-600 text-white' : 'text-white hover:text-blue-200' }} px-4 py-2 rounded-lg font-medium transition">
        Beranda
    </a>

    <a href="{{ route('tentang.kami') }}"
        class="{{ request()->route()->getName() == 'tentang.kami' ? 'bg-blue-600 text-white' : 'text-white hover:text-blue-200' }} px-4 py-2 rounded-lg font-medium transition">
        Tentang Kami
    </a>

    <a href="{{ route('paket.harga') }}"
        class="{{ request()->route()->getName() == 'paket.harga' ? 'bg-blue-600 text-white' : 'text-white hover:text-blue-200' }} px-4 py-2 rounded-lg font-medium transition">
        Paket & Harga
    </a>

    <a href="{{ route('testimoni') }}"
        class="{{ request()->route()->getName() == 'testimoni' ? 'bg-blue-600 text-white' : 'text-white hover:text-blue-200' }} px-4 py-2 rounded-lg font-medium transition">
        Testimoni
    </a>

    <a href="{{ route('kontak') }}"
        class="{{ request()->route()->getName() == 'kontak' ? 'bg-blue-600 text-white' : 'text-white hover:text-blue-200' }} px-4 py-2 rounded-lg font-medium transition">
        Kontak
    </a>

    <div class="flex items-center space-x-2 text-white">
        <a href="{{ route('daftar.index') }}"
            class="{{ request()->route()->getName() == 'daftar' ? 'text-blue-400' : 'hover:text-blue-200' }} transition">
            Daftar
        </a>
        <span>|</span>
        <a href="{{ route('login') }}"
            class="{{ request()->route()->getName() == 'login' ? 'text-blue-400' : 'hover:text-blue-200' }} transition">
            Login
        </a>
    </div>
</div>
