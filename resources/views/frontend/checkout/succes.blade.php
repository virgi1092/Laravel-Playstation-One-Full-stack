<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pemesanan Sukses - PSOne Rental</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }
        
        .success-container {
            max-width: 1000px;
            width: 100%;
            background: white;
            border-radius: 20px;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.15);
            overflow: hidden;
            animation: slideUp 0.6s ease-out;
        }
        
        @keyframes slideUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        .header {
            background: linear-gradient(135deg, #4ecdc4, #44a08d);
            color: white;
            padding: 25px 30px;
            text-align: left;
            position: relative;
            overflow: hidden;
        }
        
        .header::before {
            content: '';
            position: absolute;
            top: -50%;
            right: -50%;
            width: 200%;
            height: 200%;
            background: radial-gradient(circle, rgba(255,255,255,0.1) 0%, transparent 70%);
            animation: float 6s ease-in-out infinite;
        }
        
        @keyframes float {
            0%, 100% { transform: translateY(0px) rotate(0deg); }
            50% { transform: translateY(-20px) rotate(180deg); }
        }
        
        .brand-title {
            font-size: 28px;
            font-weight: 800;
            letter-spacing: 2px;
            text-transform: uppercase;
            position: relative;
            z-index: 2;
        }
        
        .brand-subtitle {
            font-size: 14px;
            opacity: 0.9;
            margin-top: 5px;
            font-weight: 400;
            position: relative;
            z-index: 2;
        }
        
        .content {
            padding: 50px 30px;
            text-align: center;
        }
        
        .success-animation {
            width: 120px;
            height: 120px;
            margin: 0 auto 40px;
            position: relative;
        }
        
        .success-circle {
            width: 100%;
            height: 100%;
            background: linear-gradient(135deg, #1e88e5, #1565c0);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 8px 25px rgba(30, 136, 229, 0.3);
            animation: pulse 2s infinite;
            position: relative;
        }
        
        @keyframes pulse {
            0% { transform: scale(1); box-shadow: 0 8px 25px rgba(30, 136, 229, 0.3); }
            50% { transform: scale(1.05); box-shadow: 0 12px 35px rgba(30, 136, 229, 0.4); }
            100% { transform: scale(1); box-shadow: 0 8px 25px rgba(30, 136, 229, 0.3); }
        }
        
        .checkmark {
            font-size: 48px;
            color: white;
            animation: checkmarkPop 0.6s ease-out 0.3s both;
        }
        
        @keyframes checkmarkPop {
            0% { transform: scale(0) rotate(-45deg); opacity: 0; }
            50% { transform: scale(1.2) rotate(-45deg); opacity: 1; }
            100% { transform: scale(1) rotate(0deg); opacity: 1; }
        }
        
        .success-title {
            font-size: 32px;
            font-weight: 700;
            color: #2c3e50;
            margin-bottom: 20px;
            animation: fadeInUp 0.6s ease-out 0.4s both;
        }
        
        .success-message {
            color: #7f8c8d;
            font-size: 18px;
            line-height: 1.6;
            margin-bottom: 40px;
            animation: fadeInUp 0.6s ease-out 0.5s both;
        }
        
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        .order-card {
            background: linear-gradient(135deg, #fff3cd, #ffeaa7);
            border: 2px solid #fdcb6e;
            border-radius: 15px;
            padding: 25px;
            margin-bottom: 35px;
            position: relative;
            animation: fadeInUp 0.6s ease-out 0.6s both;
            transition: transform 0.3s ease;
        }
        
        .order-card:hover {
            transform: translateY(-2px);
        }
        
        .star-badge {
            position: absolute;
            left: 20px;
            top: 50%;
            transform: translateY(-50%);
            width: 40px;
            height: 40px;
            background: #f39c12;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 4px 12px rgba(243, 156, 18, 0.3);
        }
        
        .star-icon {
            color: white;
            font-size: 18px;
        }
        
        .order-details {
            padding-left: 60px;
            text-align: left;
        }
        
        .order-label {
            font-size: 14px;
            color: #8b4513;
            font-weight: 600;
            margin-bottom: 8px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        
        .order-id {
            font-size: 24px;
            font-weight: 800;
            color: #2c3e50;
            margin-bottom: 8px;
            font-family: 'Courier New', monospace;
        }
        
        .order-note {
            font-size: 13px;
            color: #8b4513;
            font-style: italic;
        }
        
        .action-buttons {
            display: flex;
            gap: 15px;
            justify-content: center;
            flex-wrap: wrap;
            animation: fadeInUp 0.6s ease-out 0.7s both;
        }
        
        .btn {
            padding: 15px 30px;
            border: none;
            border-radius: 50px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 10px;
            transition: all 0.3s ease;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        
        .btn-primary {
            background: linear-gradient(135deg, #4ecdc4, #44a08d);
            color: white;
            box-shadow: 0 6px 20px rgba(78, 205, 196, 0.3);
        }
        
        .btn-primary:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 30px rgba(78, 205, 196, 0.4);
        }
        
        .btn-secondary {
            background: white;
            color: #4ecdc4;
            border: 2px solid #4ecdc4;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        }
        
        .btn-secondary:hover {
            background: #4ecdc4;
            color: white;
            transform: translateY(-3px);
            box-shadow: 0 8px 25px rgba(78, 205, 196, 0.3);
        }
        
        .floating-shapes {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            pointer-events: none;
            z-index: -1;
        }
        
        .shape {
            position: absolute;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 50%;
            animation: floatShapes 20s infinite linear;
        }
        
        .shape:nth-child(1) {
            width: 80px;
            height: 80px;
            left: 10%;
            animation-delay: -2s;
        }
        
        .shape:nth-child(2) {
            width: 120px;
            height: 120px;
            left: 80%;
            animation-delay: -8s;
        }
        
        .shape:nth-child(3) {
            width: 60px;
            height: 60px;
            left: 50%;
            animation-delay: -15s;
        }
        
        @keyframes floatShapes {
            0% {
                transform: translateY(100vh) scale(0);
                opacity: 0;
            }
            10% {
                opacity: 1;
            }
            90% {
                opacity: 1;
            }
            100% {
                transform: translateY(-100px) scale(1);
                opacity: 0;
            }
        }
        
        @media (max-width: 600px) {
            .success-container {
                margin: 10px;
                border-radius: 15px;
            }
            
            .header {
                padding: 20px;
            }
            
            .brand-title {
                font-size: 24px;
            }
            
            .content {
                padding: 40px 20px;
            }
            
            .success-title {
                font-size: 26px;
            }
            
            .success-message {
                font-size: 16px;
            }
            
            .order-card {
                padding: 20px;
            }
            
            .action-buttons {
                flex-direction: column;
                align-items: stretch;
            }
            
            .btn {
                justify-content: center;
            }
        }
    </style>
</head>
<body>
    <div class="floating-shapes">
        <div class="shape"></div>
        <div class="shape"></div>
        <div class="shape"></div>
    </div>
    
    <div class="success-container">
        <div class="header">
            <div class="brand-title">PSOne</div>
            <div class="brand-subtitle">PlayStation Rental Service</div>
        </div>
        
        <div class="content">
            <div class="success-animation">
                <div class="success-circle">
                    <i class="fas fa-check checkmark"></i>
                </div>
            </div>
            
            <h1 class="success-title">Pemesanan Sukses!</h1>
            
            <p class="success-message">
                Terima kasih! Kami akan segera memproses penyewaan PlayStation Anda dan menghubungi Anda dalam waktu 24 jam.
            </p>
            
            <div class="order-card">
                <div class="star-badge">
                    <i class="fas fa-star star-icon"></i>
                </div>
                <div class="order-details">
                    <div class="order-label">ID Pemesanan Anda</div>
                    <div class="order-id">{{ $pby_id ?? 'PBY0001' }}</div>
                    <div class="order-note">Simpan ID pemesanan ini untuk referensi Anda</div>
                </div>
            </div>
            
            <div class="action-buttons">
                <a href="{{ route('beranda.login') }}" class="btn btn-primary">
                    <i class="fas fa-home"></i>
                    Kembali ke Beranda
                </a>
                <a href="{{ route('checkout.detail', $pby_id) }}" class="btn btn-secondary">
                    <i class="fas fa-receipt"></i>
                    Lihat Detail
                </a>
            </div>
        </div>
    </div>

    <script>
        // Add some interactive effects
        document.addEventListener('DOMContentLoaded', function() {
            // Add click effect to buttons
            const buttons = document.querySelectorAll('.btn');
            buttons.forEach(button => {
                button.addEventListener('click', function(e) {
                    // Create ripple effect
                    const ripple = document.createElement('span');
                    const rect = this.getBoundingClientRect();
                    const size = Math.max(rect.width, rect.height);
                    const x = e.clientX - rect.left - size / 2;
                    const y = e.clientY - rect.top - size / 2;
                    
                    ripple.style.cssText = `
                        position: absolute;
                        width: ${size}px;
                        height: ${size}px;
                        left: ${x}px;
                        top: ${y}px;
                        background: rgba(255, 255, 255, 0.3);
                        border-radius: 50%;
                        transform: scale(0);
                        animation: ripple 0.6s ease-out;
                        pointer-events: none;
                    `;
                    
                    this.style.position = 'relative';
                    this.style.overflow = 'hidden';
                    this.appendChild(ripple);
                    
                    setTimeout(() => {
                        ripple.remove();
                    }, 600);
                });
            });
            
            // Copy order ID functionality
            const orderId = document.querySelector('.order-id');
            orderId.addEventListener('click', function() {
                navigator.clipboard.writeText(this.textContent).then(() => {
                    const originalText = this.textContent;
                    this.textContent = 'Disalin!';
                    this.style.color = '#27ae60';
                    
                    setTimeout(() => {
                        this.textContent = originalText;
                        this.style.color = '#2c3e50';
                    }, 1500);
                });
            });
        });
        
        // Add ripple animation to CSS
        const style = document.createElement('style');
        style.textContent = `
            @keyframes ripple {
                to {
                    transform: scale(2);
                    opacity: 0;
                }
            }
        `;
        document.head.appendChild(style);
    </script>
</body>
</html>