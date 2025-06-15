{{-- SIMPLE MOBILE NAVBAR COMPONENT --}}
{{-- Mobile menu overlay --}}
<div id="simple-mobile-menu"
    style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0,0,0,0.5); z-index: 9999;">
    {{-- Sidebar --}}
    <div style="position: fixed; top: 0; left: 0; width: 250px; height: 100%; background: #1e40af; color: white; transform: translateX(-100%); transition: transform 0.3s ease;"
        id="simple-sidebar">
        {{-- Header --}}
        <div
            style="padding: 1rem; border-bottom: 1px solid #3b82f6; display: flex; justify-content: space-between; align-items: center;">
            <h3 style="margin: 0; font-size: 1.2rem;">Menu</h3>
            <button onclick="closeSimpleMobileMenu()"
                style="background: none; border: none; color: white; font-size: 1.5rem; cursor: pointer; padding: 0.5rem;">×</button>
        </div>

        {{-- Menu Items --}}
        <div style="padding: 1rem;">
            <a href="{{ route('beranda') }}"
                style="display: block; padding: 0.75rem; color: white; text-decoration: none; border-radius: 0.5rem; margin-bottom: 0.5rem; {{ request()->route()->getName() == 'beranda' ? 'background: #3b82f6;' : '' }}"
                onmouseover="this.style.background='#3b82f6'"
                onmouseout="this.style.background='{{ request()->route()->getName() == 'beranda' ? '#3b82f6' : 'transparent' }}'">🏠
                Beranda</a>

            <a href="{{ route('tentang.kami') }}"
                style="display: block; padding: 0.75rem; color: white; text-decoration: none; border-radius: 0.5rem; margin-bottom: 0.5rem; {{ request()->route()->getName() == 'tentang.kami' ? 'background: #3b82f6;' : '' }}"
                onmouseover="this.style.background='#3b82f6'"
                onmouseout="this.style.background='{{ request()->route()->getName() == 'tentang.kami' ? '#3b82f6' : 'transparent' }}'">ℹ️
                Tentang Kami</a>

            <a href="{{ route('paket.harga') }}"
                style="display: block; padding: 0.75rem; color: white; text-decoration: none; border-radius: 0.5rem; margin-bottom: 0.5rem; {{ request()->route()->getName() == 'paket.harga' ? 'background: #3b82f6;' : '' }}"
                onmouseover="this.style.background='#3b82f6'"
                onmouseout="this.style.background='{{ request()->route()->getName() == 'paket.harga' ? '#3b82f6' : 'transparent' }}'">💰
                Paket & Harga</a>

            <a href="{{ route('testimoni') }}"
                style="display: block; padding: 0.75rem; color: white; text-decoration: none; border-radius: 0.5rem; margin-bottom: 0.5rem; {{ request()->route()->getName() == 'testimoni' ? 'background: #3b82f6;' : '' }}"
                onmouseover="this.style.background='#3b82f6'"
                onmouseout="this.style.background='{{ request()->route()->getName() == 'testimoni' ? '#3b82f6' : 'transparent' }}'">💬
                Testimoni</a>

            <a href="{{ route('kontak') }}"
                style="display: block; padding: 0.75rem; color: white; text-decoration: none; border-radius: 0.5rem; margin-bottom: 0.5rem; {{ request()->route()->getName() == 'kontak' ? 'background: #3b82f6;' : '' }}"
                onmouseover="this.style.background='#3b82f6'"
                onmouseout="this.style.background='{{ request()->route()->getName() == 'kontak' ? '#3b82f6' : 'transparent' }}'">📧
                Kontak</a>
        </div>

        {{-- Auth Links --}}
        <div style="position: absolute; bottom: 0; left: 0; right: 0; padding: 1rem; border-top: 1px solid #3b82f6;">
            <a href="{{ route('daftar.index') }}"
                style="display: block; padding: 0.75rem; color: white; text-decoration: none; border-radius: 0.5rem; margin-bottom: 0.5rem; text-align: center; border: 1px solid #3b82f6; background: {{ request()->route()->getName() == 'daftar.index' ? '#3b82f6' : 'transparent' }};">Daftar</a>

            <a href="{{ route('login') }}"
                style="display: block; padding: 0.75rem; color: white; text-decoration: none; border-radius: 0.5rem; text-align: center; background: {{ request()->route()->getName() == 'login' ? '#3b82f6' : '#10b981' }};">Login</a>
        </div>
    </div>
</div>

<script>
    console.log('Simple mobile menu loaded');

    function openSimpleMobileMenu() {
        console.log('Opening simple mobile menu');
        const menu = document.getElementById('simple-mobile-menu');
        const sidebar = document.getElementById('simple-sidebar');

        if (menu && sidebar) {
            menu.style.display = 'block';
            setTimeout(() => {
                sidebar.style.transform = 'translateX(0)';
            }, 10);
            document.body.style.overflow = 'hidden';
            console.log('Simple menu opened');
        } else {
            console.error('Simple menu elements not found');
        }
    }

    function closeSimpleMobileMenu() {
        console.log('Closing simple mobile menu');
        const menu = document.getElementById('simple-mobile-menu');
        const sidebar = document.getElementById('simple-sidebar');

        if (menu && sidebar) {
            sidebar.style.transform = 'translateX(-100%)';
            setTimeout(() => {
                menu.style.display = 'none';
            }, 300);
            document.body.style.overflow = 'auto';
            console.log('Simple menu closed');
        }
    }

    // Event listeners
    document.addEventListener('DOMContentLoaded', function() {
        const menu = document.getElementById('simple-mobile-menu');

        console.log('Simple menu elements:', {
            menu: !!menu,
            screenWidth: window.innerWidth
        });

        // Close on backdrop click
        if (menu) {
            menu.addEventListener('click', function(e) {
                if (e.target === menu) {
                    closeSimpleMobileMenu();
                }
            });
        }

        // Close on navigation link click
        const navLinks = document.querySelectorAll('#simple-mobile-menu a');
        navLinks.forEach(link => {
            link.addEventListener('click', function() {
                setTimeout(closeSimpleMobileMenu, 100);
            });
        });

        // Close on escape key
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                closeSimpleMobileMenu();
            }
        });

        // Close on resize to desktop
        window.addEventListener('resize', function() {
            if (window.innerWidth >= 768) {
                closeSimpleMobileMenu();
            }
        });
    });

    // Backward compatibility
    function toggleMobileMenu() {
        openSimpleMobileMenu();
    }
</script>
