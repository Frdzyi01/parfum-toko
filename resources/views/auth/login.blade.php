<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Rando Parfum</title>
    
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@600;700&family=Inter:wght@400;500;600;700&family=Montserrat:wght@400;500;700;800&display=swap" rel="stylesheet">
    
    <!-- FontAwesome for Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <style>
        /* CSS resets & Variables */
        :root {
            --primary-color: #632c9b;
            --primary-hover: #522283;
            --primary-light: rgba(99, 44, 155, 0.1);
            --text-main: #1e293b;
            --text-muted: #64748b;
            --text-light: #94a3b8;
            --bg-page: #f1f5f9; /* light subtle gray/blue */
            --bg-card: #ffffff;
            --border-color: #e2e8f0;
            --border-focus: #632c9b;
            --error-bg: #fef2f2;
            --error-border: #fee2e2;
            --error-text: #ef4444;
            --transition-speed: 0.2s;
        }
        
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }
        
        body {
            font-family: 'Inter', sans-serif;
            background-color: var(--bg-page);
            color: var(--text-main);
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 20px;
        }
        
        /* Layout Container */
        .login-container {
            width: 100%;
            max-width: 1024px;
            min-height: 600px;
            background-color: var(--bg-card);
            border-radius: 24px;
            overflow: hidden;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.04), 0 8px 20px rgba(0, 0, 0, 0.02);
            display: flex;
            animation: fadeIn 0.6s cubic-bezier(0.16, 1, 0.3, 1);
        }
        
        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        /* Left Column (Branding & Image) */
        .brand-section {
            flex: 1;
            background-image: linear-gradient(135deg, rgba(255, 255, 255, 0.1) 0%, rgba(255, 255, 255, 0.02) 100%), 
                              url('https://images.unsplash.com/photo-1594035910387-fea47794261f?q=80&w=1200&auto=format&fit=crop');
            background-size: cover;
            background-position: center;
            position: relative;
            padding: 55px 45px;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            color: #1e1b29; /* Dark typography over pink background */
        }
        
        /* Overlay to soften image if necessary and match pink tones */
        .brand-section::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(255, 255, 255, 0.08); /* subtle light tint */
            z-index: 1;
        }
        
        .brand-content {
            position: relative;
            z-index: 2;
            height: 100%;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }
        
        /* Top Logo Branding */
        .brand-logo-container {
            text-align: left;
        }
        
        .logo-rando {
            font-family: 'Cinzel', serif;
            font-size: 2.4rem;
            font-weight: 700;
            letter-spacing: 5px;
            color: #1e1b29;
            line-height: 1;
        }
        
        .logo-parfum {
            font-family: 'Montserrat', sans-serif;
            font-size: 0.95rem;
            font-weight: 500;
            letter-spacing: 12px;
            color: #4b4857;
            margin-top: 6px;
            text-transform: uppercase;
        }
        
        /* Slogan and details at bottom-left */
        .brand-bottom {
            margin-top: auto;
        }
        
        .brand-slogan {
            font-family: 'Montserrat', sans-serif;
            font-size: 1.75rem;
            font-weight: 700;
            line-height: 1.4;
            color: #1e1b29;
            margin-bottom: 12px;
            max-width: 90%;
        }
        
        .brand-divider {
            width: 40px;
            height: 3px;
            background-color: #1e1b29;
            margin-bottom: 22px;
            border-radius: 2px;
        }
        
        .brand-info {
            font-family: 'Inter', sans-serif;
            font-size: 0.9rem;
            font-weight: 500;
            color: #4b4857;
            line-height: 1.6;
        }
        
        /* Right Column (Form) */
        .form-section {
            flex: 1;
            padding: 55px 50px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            background-color: var(--bg-card);
            position: relative;
        }
        
        .form-header {
            margin-bottom: 35px;
        }
        
        .form-title {
            font-size: 2.1rem;
            font-weight: 700;
            color: #0f172a;
            margin-bottom: 6px;
            letter-spacing: -0.5px;
        }
        
        .form-subtitle {
            font-size: 0.95rem;
            color: var(--text-muted);
        }
        
        /* Alert Box */
        .error-alert {
            background-color: var(--error-bg);
            border: 1px solid var(--error-border);
            color: var(--error-text);
            border-radius: 12px;
            padding: 14px 18px;
            font-size: 0.9rem;
            margin-bottom: 25px;
            display: flex;
            align-items: center;
            gap: 10px;
            animation: shake 0.4s ease;
        }
        
        @keyframes shake {
            0%, 100% { transform: translateX(0); }
            25% { transform: translateX(-4px); }
            75% { transform: translateX(4px); }
        }
        
        .error-alert i {
            font-size: 1.1rem;
            flex-shrink: 0;
        }
        
        /* Input styling */
        .form-group {
            margin-bottom: 24px;
            position: relative;
        }
        
        .label-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 8px;
        }
        
        .form-label {
            font-size: 0.88rem;
            font-weight: 600;
            color: #334155;
        }
        
        .forgot-link {
            font-size: 0.85rem;
            font-weight: 500;
            color: var(--primary-color);
            text-decoration: none;
            transition: color var(--transition-speed);
        }
        
        .forgot-link:hover {
            color: var(--primary-hover);
            text-decoration: underline;
        }
        
        .input-wrapper {
            position: relative;
            display: flex;
            align-items: center;
        }
        
        .form-input {
            width: 100%;
            padding: 14px 18px;
            font-size: 0.95rem;
            font-family: inherit;
            color: #0f172a;
            background-color: #ffffff;
            border: 1.5px solid var(--border-color);
            border-radius: 12px;
            outline: none;
            transition: all var(--transition-speed) ease;
        }
        
        /* Spacing for input with eye icon */
        .form-input-password {
            padding-right: 48px;
        }
        
        .form-input:focus {
            border-color: var(--border-focus);
            box-shadow: 0 0 0 4px rgba(99, 44, 155, 0.1);
        }
        
        /* Eye Toggle Button */
        .password-toggle {
            position: absolute;
            right: 18px;
            cursor: pointer;
            color: var(--text-light);
            transition: color var(--transition-speed);
            user-select: none;
            padding: 5px;
        }
        
        .password-toggle:hover {
            color: var(--primary-color);
        }
        
        /* Custom Checkbox */
        .remember-row {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 28px;
        }
        
        .checkbox-container {
            display: flex;
            align-items: center;
            position: relative;
            cursor: pointer;
            font-size: 0.88rem;
            user-select: none;
            color: #475569;
        }
        
        .checkbox-container input {
            position: absolute;
            opacity: 0;
            cursor: pointer;
            height: 0;
            width: 0;
        }
        
        .checkmark {
            height: 18px;
            width: 18px;
            background-color: #ffffff;
            border: 1.5px solid var(--border-color);
            border-radius: 5px;
            margin-right: 10px;
            display: inline-block;
            position: relative;
            transition: all var(--transition-speed);
        }
        
        .checkbox-container:hover input ~ .checkmark {
            border-color: var(--primary-color);
        }
        
        .checkbox-container input:checked ~ .checkmark {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
        }
        
        .checkmark:after {
            content: "";
            position: absolute;
            display: none;
            left: 5px;
            top: 2px;
            width: 4px;
            height: 8px;
            border: solid white;
            border-width: 0 2px 2px 0;
            transform: rotate(45deg);
        }
        
        .checkbox-container input:checked ~ .checkmark:after {
            display: block;
        }
        
        /* Button */
        .btn-submit {
            width: 100%;
            padding: 14px 24px;
            background-color: var(--primary-color);
            color: #ffffff;
            border: none;
            border-radius: 12px;
            font-size: 1rem;
            font-weight: 600;
            font-family: inherit;
            cursor: pointer;
            transition: all var(--transition-speed) ease;
            box-shadow: 0 4px 12px rgba(99, 44, 155, 0.15);
        }
        
        .btn-submit:hover {
            background-color: var(--primary-hover);
            box-shadow: 0 6px 16px rgba(99, 44, 155, 0.25);
            transform: translateY(-1px);
        }
        
        .btn-submit:active {
            transform: translateY(1px);
            box-shadow: 0 3px 8px rgba(99, 44, 155, 0.15);
        }
        
        /* Register Footer */
        .register-footer {
            text-align: center;
            margin-top: 30px;
            font-size: 0.9rem;
            color: var(--text-muted);
        }
        
        .register-link {
            color: var(--primary-color);
            font-weight: 600;
            text-decoration: none;
            transition: color var(--transition-speed);
        }
        
        .register-link:hover {
            color: var(--primary-hover);
            text-decoration: underline;
        }
        
        .back-home-link {
            font-size: 0.85rem;
            color: var(--text-muted);
            font-weight: 500;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 6px;
            transition: color var(--transition-speed);
        }
        
        .back-home-link:hover {
            color: var(--primary-color);
            text-decoration: none;
        }

        .back-to-home-top {
            position: absolute;
            top: 24px;
            right: 32px;
            font-size: 0.88rem;
            font-weight: 500;
            color: var(--text-muted);
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 6px;
            transition: color var(--transition-speed);
            z-index: 10;
        }

        .back-to-home-top:hover {
            color: var(--primary-color);
        }
        
        /* Responsive design */
        @media (max-width: 991px) {
            .login-container {
                max-width: 480px;
                min-height: auto;
            }
            .brand-section {
                display: none;
            }
            .form-section {
                padding: 45px 35px;
            }
        }
        
        @media (max-width: 480px) {
            body {
                padding: 12px;
            }
            .login-container {
                border-radius: 16px;
            }
            .form-section {
                padding: 35px 20px;
            }
            .form-title {
                font-size: 1.8rem;
            }
        }
    </style>
</head>
<body>

    <div class="login-container">
        <!-- Left Section: Brand & Slogan -->
        <div class="brand-section">
            <div class="brand-content">
                <a href="{{ route('beranda') }}" style="text-decoration: none;">
                    <div class="brand-logo-container">
                        <div class="logo-rando">RANDO</div>
                        <div class="logo-parfum">PARFUM</div>
                    </div>
                </a>
                
                <div class="brand-bottom">
                    <div class="brand-slogan">Temukan Aroma Terbaik Untuk Setiap Momen</div>
                    <div class="brand-divider"></div>
                    <div class="brand-info">
                        Toko Parfum Original<br>
                        Jakarta Selatan
                    </div>
                </div>
            </div>
        </div>

        <!-- Right Section: Login Form -->
        <div class="form-section">
            <!-- Back to Home Link (Top Right) -->
            <a href="{{ route('beranda') }}" class="back-to-home-top">
                <i class="fa-solid fa-house"></i> Halaman Utama
            </a>

            <div class="form-header">
                <h1 class="form-title" id="form-heading">Login</h1>
                <p class="form-subtitle">Masuk untuk melanjutkan</p>
            </div>

            <!-- Error Notification -->
            @if($errors->any())
                <div class="error-alert" role="alert" id="login-error-alert">
                    <i class="fa-solid fa-circle-exclamation"></i>
                    <span>{{ $errors->first() }}</span>
                </div>
            @endif

            <form method="POST" action="{{ route('masuk') }}" id="login-form">
                @csrf
                
                <!-- Email Field -->
                <div class="form-group">
                    <div class="label-row">
                        <label for="email" class="form-label">Email</label>
                    </div>
                    <div class="input-wrapper">
                        <input type="email" name="email" id="email" class="form-input" 
                               value="{{ old('email') }}" placeholder="Masukkan email" 
                               required autofocus>
                    </div>
                </div>

                <!-- Password Field -->
                <div class="form-group">
                    <div class="label-row">
                        <label for="password" class="form-label">Password</label>
                        <!-- @if(Route::has('password.request'))
                            <a href="{{ route('password.request') }}" class="forgot-link">Lupa password?</a>
                        @endif -->
                    </div>
                    <div class="input-wrapper">
                        <input type="password" name="password" id="password" class="form-input form-input-password" 
                               placeholder="Masukkan password" required>
                        <span class="password-toggle" id="toggle-password-btn" title="Tampilkan Password">
                            <i class="fa-regular fa-eye" id="toggle-password-icon"></i>
                        </span>
                    </div>
                </div>

                <!-- Remember Me & Extra Options -->
                <div class="remember-row">
                    <label class="checkbox-container">
                        Ingat saya
                        <input type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                        <span class="checkmark"></span>
                    </label>
                </div>

                <!-- Submit Button -->
                <button type="submit" class="btn-submit" id="btn-login-submit">Login</button>
            </form>

            <!-- Footer Links -->
            <div class="register-footer">
                Belum punya akun? <a href="{{ route('daftar') }}" class="register-link">Daftar di sini</a>
                <div style="margin-top: 15px;">
                    <a href="{{ route('beranda') }}" class="back-home-link">
                        <i class="fa-solid fa-arrow-left"></i> Kembali ke Halaman Utama
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Toggle Password Visibility JS -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const togglePasswordBtn = document.getElementById('toggle-password-btn');
            const passwordInput = document.getElementById('password');
            const togglePasswordIcon = document.getElementById('toggle-password-icon');

            if (togglePasswordBtn && passwordInput && togglePasswordIcon) {
                togglePasswordBtn.addEventListener('click', function () {
                    // Toggle the input type
                    const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
                    passwordInput.setAttribute('type', type);

                    // Toggle icon and title
                    if (type === 'text') {
                        togglePasswordIcon.classList.remove('fa-regular', 'fa-eye');
                        togglePasswordIcon.classList.add('fa-solid', 'fa-eye-slash');
                        togglePasswordBtn.setAttribute('title', 'Sembunyikan Password');
                    } else {
                        togglePasswordIcon.classList.remove('fa-solid', 'fa-eye-slash');
                        togglePasswordIcon.classList.add('fa-regular', 'fa-eye');
                        togglePasswordBtn.setAttribute('title', 'Tampilkan Password');
                    }
                });
            }
        });
    </script>
</body>
</html>
