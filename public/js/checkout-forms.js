// Modern Checkout JavaScript
document.addEventListener('DOMContentLoaded', function() {
    // Initialize checkout functionality
    initializePaymentMethods();
    initializeFormValidation();
    initializeAnimations();
    initializeProgressIndicator();
});

// Payment Methods Handler
function initializePaymentMethods() {
    const paymentOptions = document.querySelectorAll('.payment-option');
    const metodeInput = document.getElementById('metode_bayar');
    
    paymentOptions.forEach(option => {
        option.addEventListener('click', function() {
            // Remove active class from all options
            paymentOptions.forEach(opt => {
                opt.classList.remove('active');
                const radio = opt.querySelector('.payment-radio i');
                radio.className = 'far fa-circle';
            });
            
            // Add active class to clicked option
            this.classList.add('active');
            const activeRadio = this.querySelector('.payment-radio i');
            activeRadio.className = 'fas fa-check-circle';
            
            // Update hidden input value
            const method = this.getAttribute('data-method');
            metodeInput.value = method;
            
            // Add selection animation
            this.style.transform = 'scale(1.02)';
            setTimeout(() => {
                this.style.transform = '';
            }, 200);
            
            // Show payment details if needed
            showPaymentDetails(method);
        });
    });
}

// Show payment details based on method
function showPaymentDetails(method) {
    // Remove existing payment details
    const existingDetails = document.querySelector('.payment-details');
    if (existingDetails) {
        existingDetails.remove();
    }
    
    const paymentCard = document.querySelector('.info-card:has(.payment-methods)');
    let detailsHTML = '';
    
    switch(method) {
        case 'E-Wallet':
            detailsHTML = `
                <div class="payment-details">
                    <div class="detail-header">
                        <i class="fas fa-mobile-alt"></i>
                        <span>Detail E-Wallet</span>
                    </div>
                    <div class="ewallet-options">
                        <div class="ewallet-item">
                            <img src="https://via.placeholder.com/40x40?text=OVO" alt="OVO">
                            <span>OVO: 0812-3456-7890</span>
                        </div>
                        <div class="ewallet-item">
                            <img src="https://via.placeholder.com/40x40?text=DANA" alt="DANA">
                            <span>DANA: 0812-3456-7890</span>
                        </div>
                        <div class="ewallet-item">
                            <img src="https://via.placeholder.com/40x40?text=GP" alt="GoPay">
                            <span>GoPay: 0812-3456-7890</span>
                        </div>
                    </div>
                </div>`;
            break;
        case 'Transfer':
            detailsHTML = `
                <div class="payment-details">
                    <div class="detail-header">
                        <i class="fas fa-university"></i>
                        <span>Detail Transfer Bank</span>
                    </div>
                    <div class="bank-options">
                        <div class="bank-item">
                            <div class="bank-logo">BCA</div>
                            <div class="bank-info">
                                <div class="bank-name">Bank Central Asia</div>
                                <div class="account-number">1234567890</div>
                                <div class="account-name">PS One Rental</div>
                            </div>
                        </div>
                        <div class="bank-item">
                            <div class="bank-logo">BRI</div>
                            <div class="bank-info">
                                <div class="bank-name">Bank Rakyat Indonesia</div>
                                <div class="account-number">0987654321</div>
                                <div class="account-name">PS One Rental</div>
                            </div>
                        </div>
                    </div>
                </div>`;
            break;
        case 'Tunai':
            detailsHTML = `
                <div class="payment-details">
                    <div class="detail-header">
                        <i class="fas fa-money-bills"></i>
                        <span>Pembayaran Tunai</span>
                    </div>
                    <div class="cash-info">
                        <div class="info-item">
                            <i class="fas fa-truck"></i>
                            <span>Pembayaran saat pengiriman PlayStation</span>
                        </div>
                        <div class="info-item">
                            <i class="fas fa-calculator"></i>
                            <span>Siapkan uang pas untuk mempermudah proses</span>
                        </div>
                    </div>
                </div>`;
            break;
    }
    
    if (detailsHTML) {
        paymentCard.insertAdjacentHTML('beforeend', detailsHTML);
        
        // Animate the new details
        const details = document.querySelector('.payment-details');
        details.style.opacity = '0';
        details.style.transform = 'translateY(20px)';
        
        setTimeout(() => {
            details.style.transition = 'all 0.3s ease';
            details.style.opacity = '1';
            details.style.transform = 'translateY(0)';
        }, 50);
    }
}

// Form Validation
function initializeFormValidation() {
    const form = document.getElementById('checkoutForm');
    const confirmBtn = document.getElementById('confirmBtn');
    
    form.addEventListener('submit', function(e) {
        e.preventDefault();
        
        // Show loading state
        confirmBtn.classList.add('loading');
        
        // Validate form
        if (validateForm()) {
            // Simulate processing time
            setTimeout(() => {
                // Show success modal
                const successModal = new bootstrap.Modal(document.getElementById('successModal'));
                successModal.show();
                
                // Reset loading state
                confirmBtn.classList.remove('loading');
                
                // Redirect after modal is closed
                document.getElementById('successModal').addEventListener('hidden.bs.modal', function() {
                    // You can redirect to a success page or dashboard
                    // window.location.href = '/dashboard';
                });
            }, 2000);
        } else {
            confirmBtn.classList.remove('loading');
        }
    });
}

// Form validation function
function validateForm() {
    const metodeInput = document.getElementById('metode_bayar');
    
    if (!metodeInput.value) {
        showNotification('Pilih metode pembayaran terlebih dahulu', 'error');
        return false;
    }
    
    return true;
}

// Animations
function initializeAnimations() {
    // Fade in animation for cards
    const cards = document.querySelectorAll('.info-card');
    cards.forEach((card, index) => {
        card.style.opacity = '0';
        card.style.transform = 'translateY(30px)';
        
        setTimeout(() => {
            card.style.transition = 'all 0.6s ease';
            card.style.opacity = '1';
            card.style.transform = 'translateY(0)';
        }, index * 100);
    });
    
    // Hover effects for interactive elements
    addHoverEffects();
    
    // Parallax effect for header
    addParallaxEffect();
}

// Add hover effects
function addHoverEffects() {
    const interactiveElements = document.querySelectorAll('.table-row, .info-row, .social-link');
    
    interactiveElements.forEach(element => {
        element.addEventListener('mouseenter', function() {
            this.style.transform = 'translateX(5px)';
        });
        
        element.addEventListener('mouseleave', function() {
            this.style.transform = 'translateX(0)';
        });
    });
}

// Parallax effect
function addParallaxEffect() {
    window.addEventListener('scroll', function() {
        const scrolled = window.pageYOffset;
        const header = document.querySelector('.header');
        
        if (header) {
            header.style.transform = `translateY(${scrolled * 0.5}px)`;
        }
    });
}

// Progress indicator
function initializeProgressIndicator() {
    // Create progress bar
    const progressBar = document.createElement('div');
    progressBar.className = 'checkout-progress';
    progressBar.innerHTML = `
        <div class="progress-bar">
            <div class="progress-fill"></div>
        </div>
        <div class="progress-steps">
            <div class="progress-step active">
                <div class="step-number">1</div>
                <div class="step-label">Detail Pesanan</div>
            </div>
            <div class="progress-step active">
                <div class="step-number">2</div>
                <div class="step-label">Pembayaran</div>
            </div>
            <div class="progress-step">
                <div class="step-number">3</div>
                <div class="step-label">Konfirmasi</div>
            </div>
        </div>
    `;
    
    const mainContainer = document.querySelector('.main-container');
    mainContainer.insertBefore(progressBar, mainContainer.firstChild);
}

// Notification system
function showNotification(message, type = 'info') {
    // Remove existing notifications
    const existingNotification = document.querySelector('.notification');
    if (existingNotification) {
        existingNotification.remove();
    }
    
    const notification = document.createElement('div');
    notification.className = `notification ${type}`;
    notification.innerHTML = `
        <div class="notification-content">
            <i class="fas ${type === 'error' ? 'fa-exclamation-circle' : 'fa-info-circle'}"></i>
            <span>${message}</span>
            <button class="notification-close">
                <i class="fas fa-times"></i>
            </button>
        </div>
    `;
    
    document.body.appendChild(notification);
    
    // Show notification
    setTimeout(() => {
        notification.classList.add('show');
    }, 100);
    
    // Auto hide after 5 seconds
    setTimeout(() => {
        hideNotification(notification);
    }, 5000);
    
    // Close button functionality
    notification.querySelector('.notification-close').addEventListener('click', () => {
        hideNotification(notification);
    });
}

function hideNotification(notification) {
    notification.classList.remove('show');
    setTimeout(() => {
        notification.remove();
    }, 300);
}

// Copy to clipboard functionality
function copyToClipboard(text, element) {
    navigator.clipboard.writeText(text).then(() => {
        const originalContent = element.innerHTML;
        element.innerHTML = '<i class="fas fa-check"></i> Disalin!';
        element.style.background = 'var(--success-color)';
        
        setTimeout(() => {
            element.innerHTML = originalContent;
            element.style.background = '';
        }, 2000);
    });
}

// Add copy functionality to payment ID
document.addEventListener('DOMContentLoaded', function() {
    const paymentId = document.getElementById('pby_id');
    if (paymentId) {
        paymentId.style.cursor = 'pointer';
        paymentId.title = 'Klik untuk menyalin';
        
        paymentId.addEventListener('click', function() {
            copyToClipboard(this.textContent, this.parentElement);
        });
    }
});

// Real-time form updates
function updateFormData() {
    // Update total calculation if needed
    // This function can be extended for dynamic price calculations
}

// Keyboard shortcuts
document.addEventListener('keydown', function(e) {
    // Ctrl + Enter to submit form
    if (e.ctrlKey && e.key === 'Enter') {
        const form = document.getElementById('checkoutForm');
        form.dispatchEvent(new Event('submit'));
    }
    
    // Escape to go back
    if (e.key === 'Escape') {
        history.back();
    }
});

// Mobile optimizations
function initializeMobileOptimizations() {
    if (window.innerWidth <= 768) {
        // Add swipe gestures for payment methods
        let startX = 0;
        let startY = 0;
        
        document.addEventListener('touchstart', function(e) {
            startX = e.touches[0].clientX;
            startY = e.touches[0].clientY;
        });
        
        document.addEventListener('touchend', function(e) {
            const endX = e.changedTouches[0].clientX;
            const endY = e.changedTouches[0].clientY;
            
            const diffX = startX - endX;
            const diffY = startY - endY;
            
            // Swipe left to go back
            if (Math.abs(diffX) > Math.abs(diffY) && diffX > 50) {
                history.back();
            }
        });
    }
}

// Initialize mobile optimizations
document.addEventListener('DOMContentLoaded', initializeMobileOptimizations);

// Error handling
window.addEventListener('error', function(e) {
    console.error('Checkout error:', e.error);
    showNotification('Terjadi kesalahan. Silakan refresh halaman.', 'error');
});

// Performance optimization
function optimizePerformance() {
    // Lazy load images
    const images = document.querySelectorAll('img[data-src]');
    const imageObserver = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                const img = entry.target;
                img.src = img.dataset.src;
                img.removeAttribute('data-src');
                imageObserver.unobserve(img);
            }
        });
    });
    
    images.forEach(img => imageObserver.observe(img));
}

// Initialize performance optimizations
document.addEventListener('DOMContentLoaded', optimizePerformance);