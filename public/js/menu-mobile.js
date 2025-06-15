function toggleMobileMenu() {
    const mobileMenu = document.getElementById('mobile-menu');
    const sidebar = document.getElementById('sidebar');
    
    if (mobileMenu.classList.contains('hidden')) {
        // Show menu
        mobileMenu.classList.remove('hidden');
        // Small delay to ensure DOM is ready
        setTimeout(() => {
            sidebar.classList.remove('-translate-x-full');
        }, 10);
        // Prevent body scroll when menu is open
        document.body.style.overflow = 'hidden';
    } else {
        // Hide menu
        sidebar.classList.add('-translate-x-full');
        // Wait for animation to complete before hiding
        setTimeout(() => {
            mobileMenu.classList.add('hidden');
        }, 300);
        // Restore body scroll
        document.body.style.overflow = 'auto';
    }
}

// Close menu when clicking on a navigation link
document.addEventListener('DOMContentLoaded', function() {
    const navLinks = document.querySelectorAll('#mobile-menu nav a');
    navLinks.forEach(link => {
        link.addEventListener('click', function() {
            toggleMobileMenu();
        });
    });
    
    // Close menu on window resize if screen becomes larger
    window.addEventListener('resize', function() {
        if (window.innerWidth >= 768) { // md breakpoint
            const mobileMenu = document.getElementById('mobile-menu');
            const sidebar = document.getElementById('sidebar');
            if (!mobileMenu.classList.contains('hidden')) {
                sidebar.classList.add('-translate-x-full');
                setTimeout(() => {
                    mobileMenu.classList.add('hidden');
                }, 300);
                document.body.style.overflow = 'auto';
            }
        }
    });
});