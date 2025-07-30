<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>تسجيل الدخول</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" />
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@300;400;600;700&display=swap" rel="stylesheet">
</head>

<body>
<div class="login-container">
    <div class="login-background">
        <div class="floating-shapes">
            <div class="shape shape-1"></div>
            <div class="shape shape-2"></div>
            <div class="shape shape-3"></div>
            <div class="shape shape-4"></div>
        </div>
    </div>

    <div class="login-card">
        <div class="login-header">
            <div class="logo-container">
                <i class="fas fa-user-circle"></i>
            </div>
            <h2>مرحباً بك</h2>
            <p>قم بتسجيل الدخول للمتابعة</p>
        </div>

        <form  method="POST" action="{{ route('login.submit') }}">
            @csrf
            <div class="form-group">
                <div class="input-container">
                    <i class="fas fa-phone input-icon"></i>
                    <input type="tel" class="form-control" id="phone" name="phone" placeholder=" " required>
                    <label for="phone" class="floating-label">رقم الهاتف</label>
                </div>
            </div>

            <div class="form-group">
                <div class="input-container">
                    <i class="fas fa-lock input-icon"></i>
                    <input type="password" class="form-control" id="password" name="password" placeholder=" " required>
                    <label for="password" class="floating-label">كلمة المرور</label>
                    <button type="button" class="password-toggle" onclick="togglePassword()">
                        <i class="fas fa-eye" id="toggleIcon"></i>
                    </button>
                </div>
            </div>

            <div class="form-options">
                <div class="remember-me">
                    <input type="checkbox" id="remember" name="remember">
                    <label for="remember">تذكرني</label>
                </div>
            </div>

            <button type="submit" class="btn-login">
                <span>تسجيل الدخول</span>
                <i class="fas fa-arrow-left"></i>
            </button>


        </form>
    </div>
</div>

<style>
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    body {
        font-family: 'Cairo', sans-serif;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        min-height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
        overflow-x: hidden;
    }

    .login-container {
        position: relative;
        width: 100%;
        min-height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 20px;
    }

    .login-background {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        z-index: -1;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    }

    .floating-shapes {
        position: absolute;
        width: 100%;
        height: 100%;
        overflow: hidden;
    }

    .shape {
        position: absolute;
        border-radius: 50%;
        background: rgba(255, 255, 255, 0.1);
        animation: float 6s ease-in-out infinite;
    }

    .shape-1 {
        width: 80px;
        height: 80px;
        top: 10%;
        left: 10%;
        animation-delay: 0s;
    }

    .shape-2 {
        width: 120px;
        height: 120px;
        top: 70%;
        right: 10%;
        animation-delay: 2s;
    }

    .shape-3 {
        width: 100px;
        height: 100px;
        top: 50%;
        left: 5%;
        animation-delay: 4s;
    }

    .shape-4 {
        width: 60px;
        height: 60px;
        top: 20%;
        right: 20%;
        animation-delay: 1s;
    }

    @keyframes float {
        0%, 100% { transform: translateY(0px) rotate(0deg); }
        50% { transform: translateY(-20px) rotate(10deg); }
    }

    .login-card {
        background: rgba(255, 255, 255, 0.95);
        backdrop-filter: blur(20px);
        border: 1px solid rgba(255, 255, 255, 0.2);
        border-radius: 20px;
        padding: 40px;
        width: 100%;
        max-width: 450px;
        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
        animation: slideUp 0.8s ease-out;
    }

    @keyframes slideUp {
        from {
            opacity: 0;
            transform: translateY(50px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .login-header {
        text-align: center;
        margin-bottom: 30px;
    }

    .logo-container {
        margin-bottom: 20px;
    }

    .logo-container i {
        font-size: 60px;
        color: #667eea;
        background: linear-gradient(135deg, #667eea, #764ba2);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
    }

    .login-header h2 {
        color: #333;
        font-weight: 700;
        margin-bottom: 8px;
        font-size: 28px;
    }

    .login-header p {
        color: #666;
        font-size: 16px;
    }

    .form-group {
        margin-bottom: 25px;
    }

    .input-container {
        position: relative;
    }

    .input-icon {
        position: absolute;
        right: 15px;
        top: 50%;
        transform: translateY(-50%);
        color: #999;
        z-index: 2;
    }

    .form-control {
        width: 100%;
        padding: 15px 45px 15px 15px;
        border: 2px solid #e1e5e9;
        border-radius: 12px;
        font-size: 16px;
        background: rgba(255, 255, 255, 0.9);
        transition: all 0.3s ease;
        font-family: 'Cairo', sans-serif;
    }

    .form-control:focus {
        outline: none;
        border-color: #667eea;
        box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
        background: white;
    }

    .floating-label {
        position: absolute;
        right: 45px;
        top: 50%;
        transform: translateY(-50%);
        color: #999;
        pointer-events: none;
        transition: all 0.3s ease;
        font-size: 16px;
        background: white;
        padding: 0 5px;
    }

    .form-control:focus + .floating-label,
    .form-control:not(:placeholder-shown) + .floating-label {
        top: 0;
        font-size: 12px;
        color: #667eea;
        font-weight: 600;
    }

    .password-toggle {
        position: absolute;
        left: 15px;
        top: 50%;
        transform: translateY(-50%);
        background: none;
        border: none;
        color: #999;
        cursor: pointer;
        font-size: 16px;
        transition: color 0.3s ease;
    }

    .password-toggle:hover {
        color: #667eea;
    }

    .form-options {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 30px;
        font-size: 14px;
    }

    .remember-me {
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .remember-me input[type="checkbox"] {
        width: 18px;
        height: 18px;
        accent-color: #667eea;
    }

    .forgot-password {
        color: #667eea;
        text-decoration: none;
        transition: color 0.3s ease;
    }

    .forgot-password:hover {
        color: #764ba2;
        text-decoration: underline;
    }

    .btn-login {
        width: 100%;
        padding: 15px;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        border: none;
        border-radius: 12px;
        color: white;
        font-size: 16px;
        font-weight: 600;
        font-family: 'Cairo', sans-serif;
        cursor: pointer;
        transition: all 0.3s ease;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 10px;
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
        box-shadow: 0 10px 25px rgba(102, 126, 234, 0.3);
    }

    .divider {
        text-align: center;
        margin: 30px 0;
        position: relative;
    }

    .divider::before {
        content: '';
        position: absolute;
        top: 50%;
        left: 0;
        right: 0;
        height: 1px;
        background: #e1e5e9;
    }

    .divider span {
        background: white;
        padding: 0 20px;
        color: #999;
        font-size: 14px;
    }

    .social-login {
        display: flex;
        flex-direction: column;
        gap: 12px;
        margin-bottom: 25px;
    }

    .social-btn {
        width: 100%;
        padding: 12px;
        border: 2px solid #e1e5e9;
        border-radius: 12px;
        background: white;
        color: #333;
        font-size: 14px;
        font-family: 'Cairo', sans-serif;
        cursor: pointer;
        transition: all 0.3s ease;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 10px;
    }

    .google-btn:hover {
        border-color: #db4437;
        background: #db4437;
        color: white;
    }

    .facebook-btn:hover {
        border-color: #3b5998;
        background: #3b5998;
        color: white;
    }

    .signup-link {
        text-align: center;
        font-size: 14px;
        color: #666;
    }

    .signup-link a {
        color: #667eea;
        text-decoration: none;
        font-weight: 600;
    }

    .signup-link a:hover {
        text-decoration: underline;
    }

    @media (max-width: 480px) {
        .login-card {
            padding: 30px 20px;
            margin: 10px;
        }

        .login-header h2 {
            font-size: 24px;
        }

        .form-control {
            padding: 12px 40px 12px 12px;
        }

        .social-login {
            flex-direction: column;
        }
    }
</style>

<script>
    function togglePassword() {
        const passwordInput = document.getElementById('password');
        const toggleIcon = document.getElementById('toggleIcon');

        if (passwordInput.type === 'password') {
            passwordInput.type = 'text';
            toggleIcon.classList.remove('fa-eye');
            toggleIcon.classList.add('fa-eye-slash');
        } else {
            passwordInput.type = 'password';
            toggleIcon.classList.remove('fa-eye-slash');
            toggleIcon.classList.add('fa-eye');
        }
    }

    // Add floating label animation
    document.querySelectorAll('.form-control').forEach(input => {
        input.addEventListener('focus', function() {
            this.parentElement.classList.add('focused');
        });

        input.addEventListener('blur', function() {
            if (this.value === '') {
                this.parentElement.classList.remove('focused');
            }
        });
    });

    // Add form validation
    document.querySelector('.login-form').addEventListener('submit', function(e) {
        e.preventDefault();

        const phone = document.getElementById('phone').value;
        const password = document.getElementById('password').value;

        if (!phone || !password) {
            alert('يرجى ملء جميع الحقول المطلوبة');
            return;
        }

        // Add loading state
        const submitBtn = document.querySelector('.btn-login');
        const originalText = submitBtn.innerHTML;
        submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> جاري تسجيل الدخول...';
        submitBtn.disabled = true;

        // Simulate API call
        setTimeout(() => {
            submitBtn.innerHTML = originalText;
            submitBtn.disabled = false;
            alert('تم تسجيل الدخول بنجاح!');
        }, 2000);
    });
</script>
</body>

</html>
