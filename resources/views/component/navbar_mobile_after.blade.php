{{-- MOBILE NAVBAR COMPONENT AFTER LOGIN --}}
{{-- Mobile menu overlay --}}
<div id="simple-mobile-menu" style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0,0,0,0.5); z-index: 9999;">
    {{-- Sidebar --}}
    <div style="position: fixed; top: 0; left: 0; width: 250px; height: 100%; background: #1e40af; color: white; transform: translateX(-100%); transition: transform 0.3s ease;" id="simple-sidebar">
        {{-- Header --}}
        <div style="padding: 1rem; border-bottom: 1px solid #3b82f6; display: flex; justify-content: space-between; align-items: center;">
            <h3 style="margin: 0; font-size: 1.2rem;">Menu</h3>
            <button onclick="closeSimpleMobileMenu()" style="background: none; border: none; color: white; font-size: 1.5rem; cursor: pointer; padding: 0.5rem;">×</button>
        </div>
        
        {{-- User Info Section (for authenticated users) --}}
        @auth('penyewa')
        <div style="padding: 1rem; border-bottom: 1px solid #3b82f6; background: rgba(59, 130, 246, 0.2);">
            <div style="display: flex; align-items: center; margin-bottom: 0.5rem;">
                <svg style="width: 2rem; height: 2rem; margin-right: 0.75rem; background: rgba(255,255,255,0.2); padding: 0.25rem; border-radius: 50%;" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"></path>
                </svg>
                <div>
                    <div style="font-weight: bold; font-size: 0.9rem;">{{ Auth::guard('penyewa')->user()->name }}</div>
                    <div style="font-size: 0.8rem; opacity: 0.8;">Penyewa</div>
                </div>
            </div>
        </div>
        @endauth
        
        {{-- Menu Items --}}
        <div style="padding: 1rem;">
            <a href="{{ route('beranda.login') }}" style="display: block; padding: 0.75rem; color: white; text-decoration: none; border-radius: 0.5rem; margin-bottom: 0.5rem; {{ request()->route()->getName() == 'beranda.login' ? 'background: #3b82f6;' : '' }}" onmouseover="this.style.background='#3b82f6'" onmouseout="this.style.background='{{ request()->route()->getName() == 'beranda.login' ? '#3b82f6' : 'transparent' }}'">🏠 Beranda</a>
            
            <a href="{{ route('tentangkami.login') }}" style="display: block; padding: 0.75rem; color: white; text-decoration: none; border-radius: 0.5rem; margin-bottom: 0.5rem; {{ request()->route()->getName() == 'tentangkami.login' ? 'background: #3b82f6;' : '' }}" onmouseover="this.style.background='#3b82f6'" onmouseout="this.style.background='{{ request()->route()->getName() == 'tentangkami.login' ? '#3b82f6' : 'transparent' }}'">ℹ️ Tentang Kami</a>
            
            <a href="{{ route('paket.harga.login') }}" style="display: block; padding: 0.75rem; color: white; text-decoration: none; border-radius: 0.5rem; margin-bottom: 0.5rem; {{ request()->route()->getName() == 'paket.harga.login' ? 'background: #3b82f6;' : '' }}" onmouseover="this.style.background='#3b82f6'" onmouseout="this.style.background='{{ request()->route()->getName() == 'paket.harga.login' ? '#3b82f6' : 'transparent' }}'">💰 Paket & Harga</a>
            
            <a href="{{ route('testimoni.login') }}" style="display: block; padding: 0.75rem; color: white; text-decoration: none; border-radius: 0.5rem; margin-bottom: 0.5rem; {{ request()->route()->getName() == 'testimoni.login' ? 'background: #3b82f6;' : '' }}" onmouseover="this.style.background='#3b82f6'" onmouseout="this.style.background='{{ request()->route()->getName() == 'testimoni.login' ? '#3b82f6' : 'transparent' }}'">💬 Testimoni</a>
            
            <a href="{{ route('kontak.login') }}" style="display: block; padding: 0.75rem; color: white; text-decoration: none; border-radius: 0.5rem; margin-bottom: 0.5rem; {{ request()->route()->getName() == 'kontak.login' ? 'background: #3b82f6;' : '' }}" onmouseover="this.style.background='#3b82f6'" onmouseout="this.style.background='{{ request()->route()->getName() == 'kontak.login' ? '#3b82f6' : 'transparent' }}'">📧 Kontak</a>
            
            <a href="{{ route('cekpesanan.login') }}" style="display: block; padding: 0.75rem; color: white; text-decoration: none; border-radius: 0.5rem; margin-bottom: 0.5rem; {{ request()->route()->getName() == 'cekpesanan.login' ? 'background: #3b82f6;' : '' }}" onmouseover="this.style.background='#3b82f6'" onmouseout="this.style.background='{{ request()->route()->getName() == 'cekpesanan.login' ? '#3b82f6' : 'transparent' }}'">📦 Cek Pesanan</a>
        </div>
        
        {{-- User Actions Section --}}
        <div style="position: absolute; bottom: 0; left: 0; right: 0; padding: 1rem; border-top: 1px solid #3b82f6;">
            @auth('penyewa')
                {{-- Profile & Settings --}}
                <a href="#" style="display: block; padding: 0.75rem; color: white; text-decoration: none; border-radius: 0.5rem; margin-bottom: 0.5rem; border: 1px solid #3b82f6; background: transparent;" onmouseover="this.style.background='#3b82f6'" onmouseout="this.style.background='transparent'">
                    <svg style="width: 1rem; height: 1rem; display: inline-block; margin-right: 0.5rem;" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-6-3a2 2 0 11-4 0 2 2 0 014 0zm-2 4a5 5 0 00-4.546 2.916A5.986 5.986 0 0010 16a5.986 5.986 0 004.546-2.084A5 5 0 0010 11z" clip-rule="evenodd"></path>
                    </svg>
                    Profile
                </a>
                
                <a href="#" style="display: block; padding: 0.75rem; color: white; text-decoration: none; border-radius: 0.5rem; margin-bottom: 0.5rem; border: 1px solid #3b82f6; background: transparent;" onmouseover="this.style.background='#3b82f6'" onmouseout="this.style.background='transparent'">
                    <svg style="width: 1rem; height: 1rem; display: inline-block; margin-right: 0.5rem;" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M11.49 3.17c-.38-1.56-2.6-1.56-2.98 0a1.532 1.532 0 01-2.286.948c-1.372-.836-2.942.734-2.106 2.106.54.886.061 2.042-.947 2.287-1.561.379-1.561 2.6 0 2.978a1.532 1.532 0 01.947 2.287c-.836 1.372.734 2.942 2.106 2.106a1.532 1.532 0 012.287.947c.379 1.561 2.6 1.561 2.978 0a1.533 1.533 0 012.287-.947c1.372.836 2.942-.734 2.106-2.106a1.533 1.533 0 01.947-2.287c1.561-.379 1.561-2.6 0-2.978a1.532 1.532 0 01-.947-2.287c.836-1.372-.734-2.942-2.106-2.106a1.532 1.532 0 01-2.287-.947zM10 13a3 3 0 100-6 3 3 0 000 6z" clip-rule="evenodd"></path>
                    </svg>
                    Pengaturan
                </a>
                
                {{-- Logout Button --}}
                <form action="{{ route('logout') }}" method="POST" style="margin: 0;">
                    @csrf
                    <button type="submit" style="display: block; width: 100%; padding: 0.75rem; color: white; text-decoration: none; border-radius: 0.5rem; text-align: left; background: #dc2626; border: none; cursor: pointer;" onmouseover="this.style.background='#b91c1c'" onmouseout="this.style.background='#dc2626'">
                        <svg style="width: 1rem; height: 1rem; display: inline-block; margin-right: 0.5rem;" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M3 3a1 1 0 00-1 1v12a1 1 0 102 0V4a1 1 0 00-1-1zm10.293 9.293a1 1 0 001.414 1.414l3-3a1 1 0 000-1.414l-3-3a1 1 0 10-1.414 1.414L14.586 9H7a1 1 0 100 2h7.586l-1.293 1.293z" clip-rule="evenodd"></path>
                        </svg>
                        Logout
                    </button>
                </form>
            @else
                {{-- Login Button for guests --}}
                <a href="{{ route('login') }}" style="display: block; padding: 0.75rem; color: white; text-decoration: none; border-radius: 0.5rem; text-align: center; background: #10b981;">
                    <svg style="width: 1rem; height: 1rem; display: inline-block; margin-right: 0.5rem;" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M3 3a1 1 0 011 1v12a1 1 0 11-2 0V4a1 1 0 011-1zm7.707 3.293a1 1 0 010 1.414L9.414 9H17a1 1 0 110 2H9.414l1.293 1.293a1 1 0 01-1.414 1.414l-3-3a1 1 0 010-1.414l3-3a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                    </svg>
                    Login
                </a>
            @endauth
        </div>
    </div>
</div>

<script>
console.log('Mobile menu after login loaded');

// Pastikan function tersedia secara global
window.openSimpleMobileMenu = function() {
    console.log('Opening mobile menu');
    const menu = document.getElementById('simple-mobile-menu');
    const sidebar = document.getElementById('simple-sidebar');
    
    if (menu && sidebar) {
        menu.style.display = 'block';
        setTimeout(() => {
            sidebar.style.transform = 'translateX(0)';
        }, 10);
        document.body.style.overflow = 'hidden';
        console.log('Mobile menu opened');
    } else {
        console.error('Mobile menu elements not found');
    }
}

window.closeSimpleMobileMenu = function() {
    console.log('Closing mobile menu');
    const menu = document.getElementById('simple-mobile-menu');
    const sidebar = document.getElementById('simple-sidebar');
    
    if (menu && sidebar) {
        sidebar.style.transform = 'translateX(-100%)';
        setTimeout(() => {
            menu.style.display = 'none';
        }, 300);
        document.body.style.overflow = 'auto';
        console.log('Mobile menu closed');
    }
}

// Event listeners
document.addEventListener('DOMContentLoaded', function() {
    const menu = document.getElementById('simple-mobile-menu');
    
    console.log('Mobile menu elements:', {
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
    const navLinks = document.querySelectorAll('#simple-mobile-menu a:not([onclick])');
    navLinks.forEach(link => {
        link.addEventListener('click', function(e) {
            // Don't close immediately for forms
            if (!link.closest('form')) {
                setTimeout(closeSimpleMobileMenu, 100);
            }
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
window.toggleMobileMenu = function() {
    openSimpleMobileMenu();
}

// Ensure functions are available immediately
if (typeof window.openSimpleMobileMenu === 'function') {
    console.log('Mobile menu functions loaded successfully');
} else {
    console.error('Failed to load mobile menu functions');
}
</script>