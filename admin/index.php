<?php
session_start();
include('includes/config.php');

if(isset($_POST['login'])) {
    $uname = $_POST['username'];
    $Password = md5($_POST['inputpwd']);
    $query = mysqli_query($con, "SELECT ID, AdminuserName FROM tbladmin WHERE AdminuserName='$uname' && Password='$Password' ");
    $ret = mysqli_fetch_array($query);
    if($ret > 0) {
        $_SESSION['aid'] = $ret['ID'];
        $_SESSION['uname'] = $ret['AdminuserName'];
        header('location: dashboard.php');
        exit();
    } else {
        $error = "بيانات غير صحيحة. يرجى المحاولة مرة أخرى.";
    }
}
?>
<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>تسجيل الدخول - نظام إدارة المشفى</title>
    
    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;600;700;900&display=swap" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Bootstrap -->
    <link href="css/bootstrap.css" type="text/css" rel="stylesheet">
    
    <style>
        /* ===== VARIABLES UNIFIÉES ===== */
        :root {
            --primary: #0d47a1;
            --primary-light: #1565c0;
            --primary-dark: #0a2a6a;
            --secondary: #00bcd4;
            --accent: #4caf50;
            --gradient: linear-gradient(135deg, #0d47a1, #00bcd4);
            --gradient-hover: linear-gradient(135deg, #0a2a6a, #0097a7);
            --white: #ffffff;
            --shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            --shadow-hover: 0 20px 40px rgba(0, 0, 0, 0.15);
            --radius: 15px;
        }

        * {
            box-sizing: border-box;
        }

        body {
            font-family: 'Cairo', sans-serif;
            min-height: 100vh;
            background: var(--gradient);
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
            margin: 0;
            direction: rtl;
            text-align: right;
        }

        /* ===== CONTAINER ===== */
        .login-wrapper {
            width: 100%;
            max-width: 450px;
        }

        .login-box {
            background: rgba(255, 255, 255, 0.95);
            border-radius: var(--radius);
            padding: 40px 35px;
            box-shadow: var(--shadow-hover);
            backdrop-filter: blur(10px);
            animation: fadeInUp 0.8s ease;
        }

        @keyframes fadeInUp {
            0% {
                opacity: 0;
                transform: translateY(30px);
            }
            100% {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* ===== LOGO ===== */
        .login-logo {
            text-align: center;
            margin-bottom: 25px;
        }

        .login-logo .icon {
            font-size: 3.5rem;
            background: var(--gradient);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .login-logo h2 {
            color: var(--primary);
            font-weight: 700;
            font-size: 1.8rem;
            margin-top: 10px;
        }

        .login-logo p {
            color: #777;
            font-size: 0.95rem;
            margin-top: 5px;
        }

        /* ===== FORM ===== */
        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            font-weight: 600;
            color: var(--text-dark, #1a1a2e);
            display: block;
            margin-bottom: 8px;
            font-size: 0.95rem;
        }

        .input-group {
            position: relative;
            display: flex;
            align-items: center;
        }

        .input-group .form-control {
            flex: 1;
            padding: 12px 18px;
            border: 2px solid #e0e0e0;
            border-radius: 8px 0 0 8px;
            font-size: 1rem;
            transition: all 0.3s ease;
            background: #f8f9fa;
            color: #1a1a2e;
            width: 100%;
            outline: none;
        }

        .input-group .form-control:focus {
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(13, 71, 161, 0.15);
            background: #fff;
        }

        .input-group .form-control::placeholder {
            color: #aaa;
        }

        .input-group-append {
            display: flex;
            align-items: center;
        }

        .input-group-text {
            padding: 12px 16px;
            background: #f8f9fa;
            border: 2px solid #e0e0e0;
            border-right: none;
            border-radius: 0 8px 8px 0;
            color: #888;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .input-group-text:hover {
            background: #e8e8e8;
        }

        .input-group-text .fas {
            font-size: 1.1rem;
        }

        /* ===== BUTTON ===== */
        .btn-login {
            width: 100%;
            padding: 14px;
            background: var(--gradient);
            color: var(--white);
            border: none;
            border-radius: 8px;
            font-size: 1.1rem;
            font-weight: 700;
            cursor: pointer;
            transition: all 0.3s ease;
            font-family: 'Cairo', sans-serif;
        }

        .btn-login:hover {
            background: var(--gradient-hover);
            transform: scale(1.02);
            box-shadow: 0 8px 25px rgba(13, 71, 161, 0.4);
        }

        .btn-login:active {
            transform: scale(0.98);
        }

        /* ===== LINKS ===== */
        .login-links {
            text-align: center;
            margin-top: 20px;
            padding-top: 20px;
            border-top: 1px solid #eee;
        }

        .login-links a {
            color: var(--primary);
            text-decoration: none;
            font-weight: 600;
            transition: all 0.3s ease;
            display: inline-block;
            margin: 5px 10px;
            font-size: 0.95rem;
        }

        .login-links a:hover {
            color: var(--secondary);
            transform: translateY(-2px);
        }

        .login-links .separator {
            color: #ccc;
            margin: 0 5px;
        }

        /* ===== ALERT ===== */
        .alert {
            border-radius: 8px;
            padding: 12px 18px;
            margin-bottom: 20px;
            font-weight: 600;
        }

        .alert-danger {
            background: #fde8e8;
            border: 1px solid #f5c6c6;
            color: #c0392b;
        }

        .alert-success {
            background: #e8f5e9;
            border: 1px solid #c8e6c9;
            color: #2e7d32;
        }

        /* ===== RESPONSIVE ===== */
        @media (max-width: 480px) {
            .login-box {
                padding: 30px 20px;
            }

            .login-logo h2 {
                font-size: 1.5rem;
            }

            .login-logo .icon {
                font-size: 2.8rem;
            }

            .btn-login {
                font-size: 1rem;
                padding: 12px;
            }

            .input-group .form-control {
                padding: 10px 14px;
                font-size: 0.95rem;
            }
        }
    </style>
</head>
<body>

<div class="login-wrapper">
    <div class="login-box">
        
        <!-- Logo -->
        <div class="login-logo">
            <div class="icon">🏥</div>
            <h2>مرحبًا بك</h2>
            <p>تسجيل الدخول للوحة التحكم</p>
        </div>

        <!-- Error Message -->
        <?php if(isset($error)): ?>
            <div class="alert alert-danger text-center">
                <i class="fas fa-exclamation-circle ml-2"></i>
                <?php echo $error; ?>
            </div>
        <?php endif; ?>

        <!-- Login Form -->
        <form method="post" autocomplete="off">
            
            <div class="form-group">
                <label><i class="fas fa-user ml-2"></i>اسم المستخدم</label>
                <div class="input-group">
                    <input type="text" class="form-control" placeholder="أدخل اسم المستخدم" name="username" required>
                    <div class="input-group-append">
                        <span class="input-group-text">
                            <i class="fas fa-user"></i>
                        </span>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label><i class="fas fa-lock ml-2"></i>كلمة المرور</label>
                <div class="input-group">
                    <input id="password" type="password" class="form-control" placeholder="أدخل كلمة المرور" name="inputpwd" required>
                    <div class="input-group-append">
                        <span class="input-group-text" onclick="togglePassword()">
                            <i id="toggleIcon" class="fas fa-eye"></i>
                        </span>
                    </div>
                </div>
            </div>

            <button type="submit" class="btn-login" name="login">
                <i class="fas fa-sign-in-alt ml-2"></i>دخول
            </button>

        </form>

        <!-- Links -->
        <div class="login-links">
            <a href="password-recovery.php">
                <i class="fas fa-key ml-1"></i>نسيت كلمة المرور؟
            </a>
            <span class="separator">|</span>
            <a href="register.php">
                <i class="fas fa-user-plus ml-1"></i>إنشاء حساب جديد
            </a>
            <br>
            <a href="../index.php">
                <i class="fas fa-home ml-1"></i>العودة للرئيسية
            </a>
        </div>

    </div>
</div>

<!-- Scripts -->
<script>
    function togglePassword() {
        const pwdInput = document.getElementById('password');
        const icon = document.getElementById('toggleIcon');
        if (pwdInput.type === 'password') {
            pwdInput.type = 'text';
            icon.classList.remove('fa-eye');
            icon.classList.add('fa-eye-slash');
        } else {
            pwdInput.type = 'password';
            icon.classList.remove('fa-eye-slash');
            icon.classList.add('fa-eye');
        }
    }
</script>

</body>
</html>