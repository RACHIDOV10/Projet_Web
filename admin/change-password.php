<?php 
session_start();
// الاتصال بقاعدة البيانات
include('includes/config.php');

// التحقق من الجلسة (تسجيل الدخول)
if(strlen($_SESSION['aid'])==0) { 
    header('location:index.php'); // إعادة التوجيه لصفحة الدخول إن لم يكن مسجل
} else {
    // تغيير كلمة المرور
    if(isset($_POST['change'])){
        $admid = $_SESSION['aid'];
        $cpassword = md5($_POST['currentpassword']);
        $newpassword = md5($_POST['newpassword']);
        $query = mysqli_query($con, "SELECT ID FROM tbladmin WHERE ID='$admid' AND Password='$cpassword'");
        $row = mysqli_fetch_array($query);
        if($row > 0){
            $ret = mysqli_query($con, "UPDATE tbladmin SET Password='$newpassword' WHERE ID='$admid'");
            echo "<script>alert('تم تغيير كلمة المرور بنجاح.');</script>";
        } else {
            echo "<script>alert('كلمة المرور الحالية خاطئة.');</script>";
        }
    }
?>

<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title> تغيير كلمة المرور</title>

  <!-- خطوط Google -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback" />
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../plugins/fontawesome-free/css/all.min.css" />
  <!-- قالب AdminLTE -->
  <link rel="stylesheet" href="../dist/css/adminlte.min.css" />

  <style>
    .content-wrapper { text-align: right; }
    .main-sidebar { right: 0; left: auto; }
    .content-wrapper, .main-footer, .main-header {
      margin-left: 0 !important; /* إزالة الهامش الأيسر */
      margin-right: 250px; /* مساحة الـ sidebar على اليمين */
    }
    @media (max-width: 768px) {
      .content-wrapper, .main-footer, .main-header {
          margin-right: 0;
      }
    }
  </style>

  <script>
    function checkpass() {
      if (document.changepassword.newpassword.value !== document.changepassword.confirmpassword.value) {
        alert('كلمة المرور الجديدة وتأكيد كلمة المرور غير متطابقتين');
        document.changepassword.confirmpassword.focus();
        return false;
      }
      return true;
    }
  </script>
</head>

<body class="hold-transition sidebar-mini">
<div class="wrapper">

  <!-- شريط التنقل -->
  <?php include_once("includes/navbar.php"); ?>

  <!-- الشريط الجانبي -->
  <?php include_once("includes/sidebar.php"); ?>

  <!-- محتوى الصفحة -->
  <div class="content-wrapper">
    <!-- رأس الصفحة -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>تغيير كلمة المرور</h1>
          </div>
        </div>
      </div>
    </section>

    <!-- المحتوى الرئيسي -->
    <section class="content">
      <div class="container-fluid">
        <div class="row justify-content-right">
          <div class="col-md-8">
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">غير كلمة المرور الخاصة بك</h3>
              </div>

              <form name="changepassword" method="post" onsubmit="return checkpass();">
                <div class="card-body">
                  <div class="form-group">
                    <label for="currentpassword">كلمة المرور الحالية</label>
                    <input type="password" class="form-control" id="currentpassword" name="currentpassword" required />
                  </div>

                  <div class="form-group">
                    <label for="newpassword">كلمة المرور الجديدة</label>
                    <input type="password" class="form-control" id="newpassword" name="newpassword" required />
                  </div>

                  <div class="form-group">
                    <label for="confirmpassword">تأكيد كلمة المرور</label>
                    <input type="password" class="form-control" id="confirmpassword" name="confirmpassword" required />
                  </div>
                </div>

                <div class="card-footer text-right">
                  <button type="submit" name="change" id="change" class="btn btn-primary">تغيير</button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </section>

  </div>
  <!-- /.content-wrapper -->

  <?php include_once('includes/footer.php'); ?>

</div>
<!-- ./wrapper -->

<!-- السكريبتات -->
<script src="../plugins/jquery/jquery.min.js"></script>
<script src="../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="../plugins/bs-custom-file-input/bs-custom-file-input.min.js"></script>
<script src="../dist/js/adminlte.min.js"></script>
<script src="../dist/js/demo.js"></script>

<script>
  $(function () {
    bsCustomFileInput.init();
  });
</script>

</body>
</html>
<?php } ?>

