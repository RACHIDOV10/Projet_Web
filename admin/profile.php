<?php 
session_start();
// الاتصال بقاعدة البيانات
include('includes/config.php');

// التحقق من الجلسة (تسجيل الدخول)
if(strlen($_SESSION['aid'])==0) { 
    header('location:index.php'); // إذا لم يكن المستخدم مسجل دخول يعاد توجيهه لصفحة الدخول
} else {
    // تحديث بيانات المسؤول الفرعي
    if(isset($_POST['update'])){
        $fname = $_POST['fullname'];
        $email = $_POST['emailid'];
        $mobileno = $_POST['mobilenumber'];
        $adminid = intval($_SESSION['aid']);
        
        // تنفيذ تحديث البيانات في الجدول tbladmin
        $query = mysqli_query($con, "UPDATE tbladmin SET AdminName='$fname', MobileNumber='$mobileno', Email='$email' WHERE ID='$adminid'");
        
        if($query){
            echo "<script>alert('تم تحديث بيانات الملف الشخصي بنجاح.');</script>";
            echo "<script type='text/javascript'> document.location = 'profile.php'; </script>";
        } else {
            echo "<script>alert('حدث خطأ ما. يرجى المحاولة مرة أخرى.');</script>";
        }
    }
?>

<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title> ملفي الشخصي</title>

  <!-- خطوط Google -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- أيقونات Font Awesome -->
  <link rel="stylesheet" href="../plugins/fontawesome-free/css/all.min.css">
  <!-- تصميم القالب -->
  <link rel="stylesheet" href="../dist/css/adminlte.min.css">
  <style>
    .content-wrapper { text-align: right; }
    .main-sidebar { right: 0; left: auto; }
    .content-wrapper, .main-footer, .main-header {
    margin-left: 0 !important; /* إلغاء المساحة على اليسار */
    margin-right: 250px; /* مساحة الشريط على اليمين */
    }

    @media (max-width: 768px) {
    .content-wrapper, .main-footer, .main-header {
        margin-right: 0; /* على الشاشات الصغيرة لا نترك أي مسافة */
    }
    }
  </style>

</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">

  <!-- شريط التنقل -->
  <?php include_once("includes/navbar.php");?>

  <!-- الشريط الجانبي -->
  <?php include_once("includes/sidebar.php");?>

  <!-- محتوى الصفحة -->
  <div class="content-wrapper">
    <!-- رأس الصفحة -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>ملفي الشخصي</h1>
          </div>
          
        </div>
      </div>
    </section>

    <?php 
    $adminid = intval($_SESSION['aid']);
    $query = mysqli_query($con, "SELECT * FROM tbladmin WHERE ID='$adminid'");
    while($result = mysqli_fetch_array($query)){
    ?>

    <!-- المحتوى الرئيسي -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <!-- العمود الأيسر -->
          <div class="col-md-8">
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">تحديث المعلومات</h3>
              </div>
              <!-- نموذج التحديث -->
              <form name="subadmin" method="post">
                <div class="card-body">
                  <!-- اسم المستخدم (للدخول فقط، لا يمكن تغييره) -->
                  <div class="form-group">
                    <label for="sadminusername">اسم المستخدم (للدخول)</label>
                    <input type="text" name="sadminusername" id="sadminusername" class="form-control" value="<?php echo htmlspecialchars($result['AdminuserName'], ENT_QUOTES, 'UTF-8'); ?>" readonly>
                  </div>
                  
                  <!-- الاسم الكامل -->
                  <div class="form-group">
                    <label for="fullname">الاسم الكامل</label>
                    <input type="text" class="form-control" id="fullname" name="fullname" value="<?php echo htmlspecialchars($result['AdminName'], ENT_QUOTES, 'UTF-8'); ?>" placeholder="أدخل الاسم الكامل" required>
                  </div>
                  
                  <!-- البريد الإلكتروني -->
                  <div class="form-group">
                    <label for="emailid">البريد الإلكتروني</label>
                    <input type="email" class="form-control" id="emailid" name="emailid" placeholder="أدخل البريد الإلكتروني" required value="<?php echo htmlspecialchars($result['Email'], ENT_QUOTES, 'UTF-8'); ?>">
                  </div>
                  
                  <!-- رقم الجوال -->
                  <div class="form-group">
                    <label for="mobilenumber">رقم الجوال</label>
                    <input type="text" class="form-control" id="mobilenumber" name="mobilenumber" placeholder="أدخل رقم الجوال" pattern="[0-9]{10}" title="10 أرقام فقط" maxlength="10" required value="<?php echo htmlspecialchars($result['MobileNumber'], ENT_QUOTES, 'UTF-8'); ?>">
                  </div>
                  
                  <!-- تاريخ التسجيل (غير قابل للتعديل) -->
                  <div class="form-group">
                    <label for="regdate">تاريخ التسجيل</label>
                    <input type="text" class="form-control" id="regdate" name="regdate" value="<?php echo htmlspecialchars($result['AdminRegdate'], ENT_QUOTES, 'UTF-8'); ?>" readonly>
                  </div>
                </div>
                <!-- زر التحديث -->
                <div class="card-footer">
                  <button type="submit" class="btn btn-primary" name="update" id="update">تحديث</button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </section>
    <?php } ?>

  </div>
  <!-- /.content-wrapper -->

  <?php include_once('includes/footer.php');?>

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
