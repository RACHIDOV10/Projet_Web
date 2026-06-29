<?php
include('includes/config.php');

if(isset($_POST['register']))
{
    $name = $_POST['fullname'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $mobile = $_POST['mobileno'];
    $password = md5($_POST['password']);
    $confirm = md5($_POST['confirmpassword']);

    if($password != $confirm) {
        echo "<script>alert('كلمة المرور وتأكيد كلمة المرور غير متطابقين!');</script>";
    } else {
        // Vérifier si l'utilisateur existe déjà
        $check = mysqli_query($con, "SELECT ID FROM tbladmin WHERE AdminuserName='$username' OR Email='$email' OR MobileNumber='$mobile'");
        $rowcount = mysqli_num_rows($check);
        
        if($rowcount > 0) {
            echo "<script>alert('اسم المستخدم أو البريد الإلكتروني أو رقم الهاتف موجود بالفعل!');</script>";
        } else {
            $query = mysqli_query($con, "INSERT INTO tbladmin(AdminName, AdminuserName, Email, MobileNumber, Password) 
                                         VALUES('$name','$username','$email','$mobile','$password')");
            if($query) {
                echo "<script>alert('تم إنشاء الحساب بنجاح! يمكنك الآن تسجيل الدخول.');</script>";
                echo "<script type='text/javascript'> document.location = 'index.php'; </script>";
            } else {
                echo "<script>alert('حدث خطأ أثناء إنشاء الحساب. حاول مرة أخرى.');</script>";
            }
        }
    }
}
?>
<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>إنشاء حساب جديد</title>

  <!-- Google Font: Cairo -->
  <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;600;700;900&display=swap" rel="stylesheet" />
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../plugins/fontawesome-free/css/all.min.css" />
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="../plugins/icheck-bootstrap/icheck-bootstrap.min.css" />
  <!-- Theme style -->
  <link rel="stylesheet" href="../dist/css/adminlte.min.css" />

  <style>
    /* ===== STYLE UNIFIÉ AVEC LOGIN ===== */
    body.login-page {
      background: linear-gradient(135deg, #0d47a1, #00bcd4);
      color: #fff;
      font-family: 'Cairo', sans-serif;
      min-height: 100vh;
      display: flex;
      align-items: center;
      justify-content: center;
      padding: 20px;
      margin: 0;
    }

    .login-box {
      max-width: 450px;
      margin: 0 auto;
      animation: fadeInUp 0.8s ease;
      direction: rtl;
      text-align: right;
      width: 100%;
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

    .card {
      background: rgba(255, 255, 255, 0.95);
      border-radius: 15px;
      backdrop-filter: blur(10px);
      color: #333;
      border: none;
      box-shadow: 0 20px 60px rgba(0,0,0,0.2);
    }

    .card-header {
      background: transparent;
      border-bottom: none;
      padding: 30px 30px 0 30px;
      text-align: center;
    }

    .card-header .icon {
      font-size: 3.5rem;
      display: block;
      margin-bottom: 10px;
    }

    .card-header .brand-text {
      color: #0d47a1;
      font-weight: 700;
      font-size: 1.8rem;
      text-decoration: none;
      display: block;
    }

    .card-header .sub-text {
      color: #777;
      font-size: 0.95rem;
      margin-top: 5px;
      display: block;
    }

    .card-body {
      padding: 25px 30px 30px 30px;
    }

    .register-box-msg {
      font-size: 1.1rem;
      margin-bottom: 20px;
      font-weight: 600;
      color: #333;
      text-align: center;
    }

    .form-control {
      background: #f8f9fa;
      border: 2px solid #e0e0e0;
      border-radius: 8px 0 0 8px;
      color: #333;
      text-align: right;
      padding: 12px 18px;
      font-size: 1rem;
      transition: all 0.3s ease;
      height: auto;
    }

    .form-control:focus {
      border-color: #0d47a1;
      box-shadow: 0 0 0 3px rgba(13, 71, 161, 0.15);
      background: #fff;
    }

    .form-control::placeholder {
      color: #aaa;
    }

    .input-group-text {
      background: #f8f9fa;
      border: 2px solid #e0e0e0;
      border-right: none;
      border-radius: 0 8px 8px 0;
      color: #888;
      padding: 12px 16px;
    }

    .btn-primary {
      background: linear-gradient(135deg, #0d47a1, #00bcd4) !important;
      border: none !important;
      font-weight: 700;
      font-size: 1.05rem;
      padding: 12px 20px;
      border-radius: 8px;
      transition: all 0.3s ease;
      color: #fff;
      width: 100%;
      font-family: 'Cairo', sans-serif;
    }

    .btn-primary:hover {
      transform: scale(1.02);
      box-shadow: 0 8px 25px rgba(13, 71, 161, 0.4);
    }

    .btn-primary:active {
      transform: scale(0.98);
    }

    a {
      color: #0d47a1;
      text-decoration: none;
      font-weight: 600;
      transition: all 0.3s ease;
    }

    a:hover {
      color: #00bcd4;
      text-decoration: none;
    }

    .mb-1 {
      margin-bottom: 10px;
    }

    .text-center {
      text-align: center;
    }

    .row {
      display: flex;
      flex-wrap: wrap;
    }

    .col-12 {
      flex: 0 0 100%;
      max-width: 100%;
    }

    .mt-2 {
      margin-top: 15px;
    }

    /* Responsive */
    @media (max-width: 480px) {
      .card-body {
        padding: 20px;
      }
      .card-header {
        padding: 20px 20px 0 20px;
      }
      .card-header .brand-text {
        font-size: 1.5rem;
      }
      .card-header .icon {
        font-size: 2.8rem;
      }
      .btn-primary {
        font-size: 0.95rem;
        padding: 10px 15px;
      }
      .form-control {
        padding: 10px 14px;
        font-size: 0.95rem;
      }
      .input-group-text {
        padding: 10px 12px;
      }
    }
  </style>
</head>
<body class="login-page">
  <div class="login-box">
    <div class="card">
      <div class="card-header text-center">
        <span class="icon">👤</span>
        <span class="brand-text">إنشاء حساب جديد</span>
        <span class="sub-text">أدخل بياناتك لإنشاء حساب جديد</span>
      </div>
      <div class="card-body">
        <p class="register-box-msg">إنشاء حساب</p>

        <form method="post">
          <div class="input-group mb-3">
            <input
              type="text"
              class="form-control"
              placeholder="الاسم الكامل"
              name="fullname"
              required
              autocomplete="name"
            />
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-user"></span>
              </div>
            </div>
          </div>

          <div class="input-group mb-3">
            <input
              type="text"
              class="form-control"
              placeholder="اسم المستخدم"
              name="username"
              required
              autocomplete="username"
            />
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-user-tag"></span>
              </div>
            </div>
          </div>

          <div class="input-group mb-3">
            <input
              type="email"
              class="form-control"
              placeholder="البريد الإلكتروني"
              name="email"
              required
              autocomplete="email"
            />
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-envelope"></span>
              </div>
            </div>
          </div>

          <div class="input-group mb-3">
            <input
              type="text"
              class="form-control"
              placeholder="رقم الهاتف المحمول"
              name="mobileno"
              required
              autocomplete="tel"
            />
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-phone"></span>
              </div>
            </div>
          </div>

          <div class="input-group mb-3">
            <input
              type="password"
              class="form-control"
              placeholder="كلمة المرور"
              name="password"
              id="password"
              required
              autocomplete="new-password"
            />
            <div class="input-group-append">
              <div class="input-group-text" onclick="togglePassword('password', 'toggleIconPwd')" style="cursor:pointer;">
                <span id="toggleIconPwd" class="fas fa-eye"></span>
              </div>
            </div>
          </div>

          <div class="input-group mb-3">
            <input
              type="password"
              class="form-control"
              placeholder="تأكيد كلمة المرور"
              name="confirmpassword"
              id="confirmpassword"
              required
              autocomplete="new-password"
            />
            <div class="input-group-append">
              <div class="input-group-text" onclick="togglePassword('confirmpassword', 'toggleIconConfirm')" style="cursor:pointer;">
                <span id="toggleIconConfirm" class="fas fa-eye"></span>
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-12">
              <button type="submit" class="btn btn-primary btn-block" name="register">
                <i class="fas fa-user-plus ml-2"></i> إنشاء حساب
              </button>
            </div>
          </div>
        </form>

        <p class="mb-1 text-center mt-2">
          <a href="index.php"><i class="fas fa-sign-in-alt ml-1"></i> لديك حساب؟ تسجيل الدخول</a>
        </p>
        <p class="mb-1 text-center">
          <a href="../index.php"><i class="fas fa-home ml-1"></i> العودة للرئيسية</a>
        </p>
      </div>
    </div>
  </div>

  <!-- jQuery -->
  <script src="../plugins/jquery/jquery.min.js"></script>
  <!-- Bootstrap 4 -->
  <script src="../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- AdminLTE App -->
  <script src="../dist/js/adminlte.min.js"></script>

  <script>
    function togglePassword(inputId, iconId) {
        const pwdInput = document.getElementById(inputId);
        const icon = document.getElementById(iconId);
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