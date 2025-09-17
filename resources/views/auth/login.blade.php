<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>SPBE Login Portal</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap');

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            position: relative;
            overflow-x: hidden;
        }

        /* Animated background particles */
        .bg-particles {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            overflow: hidden;
            z-index: 1;
        }

        .particle {
            position: absolute;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 50%;
            animation: float 6s ease-in-out infinite;
        }

        .particle:nth-child(1) { left: 20%; width: 80px; height: 80px; animation-delay: 0s; }
        .particle:nth-child(2) { left: 60%; width: 60px; height: 60px; animation-delay: 2s; }
        .particle:nth-child(3) { left: 80%; width: 100px; height: 100px; animation-delay: 4s; }
        .particle:nth-child(4) { left: 40%; width: 120px; height: 120px; animation-delay: 1s; }
        .particle:nth-child(5) { left: 10%; width: 90px; height: 90px; animation-delay: 3s; }

        @keyframes float {
            0%, 100% { transform: translateY(0px) rotate(0deg); }
            33% { transform: translateY(-30px) rotate(120deg); }
            66% { transform: translateY(-60px) rotate(240deg); }
        }

        .login-container {
            position: relative;
            z-index: 2;
            width: 100%;
            max-width: 450px;
            margin: 20px;
        }

        .login-card {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(20px);
            border-radius: 24px;
            box-shadow: 0 25px 50px rgba(0, 0, 0, 0.15);
            border: 1px solid rgba(255, 255, 255, 0.2);
            overflow: hidden;
            position: relative;
        }

        .card-header {
            background: linear-gradient(135deg, #1a1a2e 0%, #16213e 50%, #0f3460 100%);
            padding: 40px 30px 35px;
            text-align: center;
            position: relative;
            overflow: hidden;
        }

        .card-header::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23ffffff' fill-opacity='0.05'%3E%3Ccircle cx='30' cy='30' r='4'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
            opacity: 0.3;
        }

        .logo-container {
            display: flex;
            justify-content: center;
            align-items: center;
            margin-bottom: 25px;
            gap: 20px;
            position: relative;
            z-index: 1;
        }

        .logo-placeholder {
            width: 80px;
            height: 80px;
            background: linear-gradient(135deg, #4f46e5, #7c3aed);
            border-radius: 16px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: 700;
            font-size: 14px;
            box-shadow: 0 8px 25px rgba(79, 70, 229, 0.3);
        }

        .logo-placeholder img {
            width: 60px;
        }
        .card-header h3 {
            color: white;
            font-size: 18px;
            font-weight: 600;
            line-height: 1.5;
            letter-spacing: 0.3px;
            position: relative;
            z-index: 1;
        }

        .card-body {
            padding: 40px 35px;
            background: white;
        }

        .welcome-text {
            text-align: center;
            margin-bottom: 35px;
        }

        .welcome-text h4 {
            color: #1f2937;
            font-size: 24px;
            font-weight: 700;
            margin-bottom: 8px;
        }

        .welcome-text p {
            color: #6b7280;
            font-size: 15px;
            font-weight: 400;
        }

        .form-group {
            margin-bottom: 25px;
            position: relative;
        }

        .form-group label {
            display: block;
            margin-bottom: 8px;
            color: #374151;
            font-weight: 500;
            font-size: 14px;
        }

        .form-group input {
            width: 100%;
            padding: 16px 20px;
            border: 2px solid #e5e7eb;
            background-color: #f9fafb;
            border-radius: 12px;
            font-size: 15px;
            font-weight: 400;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            color: #1f2937;
        }

        .form-group input:focus {
            outline: none;
            border-color: #4f46e5;
            background-color: white;
            box-shadow: 0 0 0 3px rgba(79, 70, 229, 0.1);
            transform: translateY(-1px);
        }

        .form-group input::placeholder {
            color: #9ca3af;
            font-weight: 400;
        }

        .btn-login {
            background: linear-gradient(135deg, #4f46e5 0%, #7c3aed 100%);
            color: white;
            border: none;
            border-radius: 12px;
            padding: 16px 24px;
            width: 100%;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
            overflow: hidden;
        }

        .btn-login::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
            transition: left 0.5s;
        }

        .btn-login:hover::before {
            left: 100%;
        }

        .btn-login:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(79, 70, 229, 0.4);
        }

        .btn-login:active {
            transform: translateY(0);
        }

        .alert {
            background: linear-gradient(135deg, #ef4444, #dc2626);
            color: white;
            padding: 16px 20px;
            border-radius: 12px;
            margin-bottom: 25px;
            font-size: 14px;
            font-weight: 500;
            display: flex;
            align-items: center;
            justify-content: space-between;
            box-shadow: 0 4px 15px rgba(239, 68, 68, 0.3);
        }

        .alert-icon {
            margin-right: 12px;
            font-size: 18px;
        }

        .closebtn {
            font-size: 24px;
            font-weight: bold;
            cursor: pointer;
            transition: all 0.2s;
            opacity: 0.8;
        }

        .closebtn:hover {
            opacity: 1;
            transform: scale(1.1);
        }

        .footer-text {
            text-align: center;
            margin-top: 30px;
            color: #6b7280;
            font-size: 13px;
        }

        .footer-text a {
            color: #4f46e5;
            text-decoration: none;
            font-weight: 500;
        }

        /* Responsive Design */
        @media (max-width: 480px) {
            .login-container {
                margin: 15px;
            }

            .card-header {
                padding: 30px 20px 25px;
            }

            .card-body {
                padding: 30px 25px;
            }

            .logo-placeholder {
                width: 70px;
                height: 70px;
                font-size: 12px;
            }

            .card-header h3 {
                font-size: 16px;
            }

            .welcome-text h4 {
                font-size: 22px;
            }
        }

        /* Loading animation */
        .btn-login.loading {
            pointer-events: none;
            position: relative;
        }

        .btn-login.loading::after {
            content: '';
            position: absolute;
            width: 16px;
            height: 16px;
            margin: auto;
            border: 2px solid transparent;
            border-top-color: #ffffff;
            border-radius: 50%;
            animation: spin 1s linear infinite;
            top: 0;
            left: 0;
            bottom: 0;
            right: 0;
        }

        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }
    </style>
</head>
<body>
    <!-- Background Particles -->
    <div class="bg-particles">
        <div class="particle"></div>
        <div class="particle"></div>
        <div class="particle"></div>
        <div class="particle"></div>
        <div class="particle"></div>
    </div>

    <div class="login-container">
        <div class="login-card">
            <div class="card-header">
                <div class="logo-container">
                    <div class="logo-placeholder">
                         {{-- KENDARI --}}

                    </div>
                    <div class="logo-placeholder">
                        <img src="../assets/images/logos/logo-spbe.png" alt="SPBE Logo" class="brand-logo">
                        {{-- SPBE --}}
                    </div>
                </div>
                <h3>SISTEM EVALUASI TINGKAT KEMATANGAN SPBE<br>Dinas Komunikasi Dan Informatika Kota Kendari</h3>
            </div>

            <div class="card-body">
                <div class="welcome-text">
                    <h4>Selamat Datang</h4>
                    <p>Silakan masuk untuk mengakses sistem</p>
                </div>

                <div id="error-alert" class="alert" style="display: none;">
                    <div>
                        <span class="alert-icon">⚠️</span>
                        <strong>Error!</strong> <span id="error-message">Username atau password salah</span>
                    </div>
                    <span class="closebtn" onclick="document.getElementById('error-alert').style.display='none'">&times;</span>
                </div>

                <form id="login-form" action="/login" method="post">
                    @csrf
                    <div class="form-group">
                        <label for="username">Username</label>
                        <input type="text" name="username" id="username" placeholder="Masukkan username Anda" required>
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" name="password" id="password" placeholder="Masukkan password Anda" required>
                    </div>
                    <button type="submit" class="btn-login" id="login-btn">MASUK</button>
                </form>

                <div class="footer-text">
                    Butuh bantuan? <a href="#" onclick="showHelp()">Hubungi Admin</a>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Form submission with loading state
        document.getElementById('login-form').addEventListener('submit', function(e) {
            const btn = document.getElementById('login-btn');
            btn.classList.add('loading');
            btn.innerHTML = '';

            // Remove loading state after 3 seconds (simulate)
            setTimeout(() => {
                btn.classList.remove('loading');
                btn.innerHTML = 'MASUK';
            }, 3000);
        });

        // Demo error function
        function showError(message) {
            const errorAlert = document.getElementById('error-alert');
            const errorMessage = document.getElementById('error-message');
            errorMessage.textContent = message;
            errorAlert.style.display = 'flex';
        }

        // Demo help function
        function showHelp() {
            alert('Untuk bantuan teknis, silakan hubungi admin sistem di:\nEmail: admin@diskominfo.kendarikota.go.id\nTelepon: (0401) 123456');
        }

        // Auto-hide alert after 5 seconds
        setTimeout(() => {
            const alert = document.getElementById('error-alert');
            if (alert.style.display === 'flex') {
                alert.style.display = 'none';
            }
        }, 5000);

        // Add some interactivity
        document.querySelectorAll('input').forEach(input => {
            input.addEventListener('focus', function() {
                this.parentElement.style.transform = 'scale(1.02)';
            });

            input.addEventListener('blur', function() {
                this.parentElement.style.transform = 'scale(1)';
            });
        });
    </script>
</body>
</html>
