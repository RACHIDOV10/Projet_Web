<?php 
session_start();
error_reporting(0);
// الاتصال بقاعدة البيانات
include('includes/config.php');

// التحقق من الجلسة (تسجيل الدخول)
if(strlen($_SESSION['aid'])==0) { 
    header('location:index.php');
} else {
    // تحديث بيانات الممرضة
    if(isset($_POST['update'])){
        // جلب القيم من POST
        $fname = $_POST['fullname'];
        $gender = $_POST['gender'];
        $email = $_POST['emailid'];
        $mobileno = $_POST['mobilenumber'];
        $address = $_POST['address'];
        $city = $_POST['city'];
        $languagesknown = $_POST['languagesknown'];
        $experience = $_POST['experience'];
        $certificate = $_POST['certificate'];
        $description = $_POST['description'];
        $editid = intval($_GET['editid']);

        $query = mysqli_query($con, "UPDATE tblnurse SET Name='$fname', Gender='$gender', Email='$email', MobileNo='$mobileno', Address='$address', City='$city', LanguagesKnown='$languagesknown', NursingExp='$experience', NursingCertificate='$certificate', EducationDescription='$description' WHERE ID='$editid'");

        if($query){
            echo "<script>alert('تم تحديث بيانات الممرضة بنجاح.');</script>";
            echo "<script type='text/javascript'> document.location = 'manage-nurse.php'; </script>";
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
  <title> (ة)تحديث بيانات الممرض</title>

  <!-- الخطوط -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- أيقونات Font Awesome -->
  <link rel="stylesheet" href="../plugins/fontawesome-free/css/all.min.css">
  <!-- Tempusdominus Bootstrap 4 -->
  <link rel="stylesheet" href="../plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
  <!-- Select2 -->
  <link rel="stylesheet" href="../plugins/select2/css/select2.min.css">
  <link rel="stylesheet" href="../plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
  <!-- Bootstrap4 Duallistbox -->
  <link rel="stylesheet" href="../plugins/bootstrap4-duallistbox/bootstrap-duallistbox.min.css">
  <!-- BS Stepper -->
  <link rel="stylesheet" href="../plugins/bs-stepper/css/bs-stepper.min.css">
  <!-- dropzonejs -->
  <link rel="stylesheet" href="../plugins/dropzone/min/dropzone.min.css">
  <!-- تصميم القالب -->
  <link rel="stylesheet" href="../dist/css/adminlte.min.css">

  <style>
    /* sidebar على اليمين */
    .main-sidebar {
      left: auto !important;
      right: 0 !important;
    }

    /* محتوى الصفحة ياخذ المساحة المتبقية */
    .content-wrapper {
      margin-left: 0 !important;
      margin-right: 250px !important; /* عرض الـ sidebar */
      direction: rtl;
      text-align: right;
    }

    /* تعديل مكان breadcrumb */
    .breadcrumb {
      float: left !important;
    }

    /* اتجاه النص داخل sidebar */
    .sidebar {
      direction: rtl;
      text-align: right;
    }

    /* محاذاة النص في القوائم */
    .nav-sidebar > .nav-item > .nav-link p {
      text-align: right;
    }

    /* إزالة الفراغ الأبيض على اليسار */
    body.sidebar-mini.sidebar-collapse .content-wrapper {
      margin-right: 250px !important;
      margin-left: 0 !important;
    }

    /* على الشاشات الصغيرة */
    @media (max-width: 768px) {
      .content-wrapper {
        margin-right: 0 !important;
        margin-left: 0 !important;
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
            <h1>تحديث بيانات الممرضة</h1>
          </div>
          
        </div>
      </div><!-- /.container-fluid -->
    </section>

<?php 
$editid = intval($_GET['editid']);
$query = mysqli_query($con, "SELECT * FROM tblnurse WHERE ID='$editid'");
while($result = mysqli_fetch_array($query)) {
?>

    <!-- المحتوى الرئيسي -->
    <section class="content">   
      <div class="container-fluid">
        <h5 style="color:red">ملف: <?php echo htmlspecialchars($result['Name'], ENT_QUOTES, 'UTF-8'); ?></h5>       
        <div class="row">
          <!-- العمود الأيسر -->
          <div class="col-md-6">
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">المعلومات الشخصية</h3>
              </div>
              <form method="post" enctype="multipart/form-data">
                <div class="card-body">
                  <!-- الاسم الكامل -->
                  <div class="form-group">
                    <label for="fullname">الاسم الكامل</label>
                    <input type="text" class="form-control" id="fullname" name="fullname" value="<?php echo htmlspecialchars($result['Name'], ENT_QUOTES, 'UTF-8'); ?>" required>
                  </div>
                  <!-- الجنس -->
                  <div class="form-group">
                    <label for="gender">الجنس</label>
                    <select class="form-control" name="gender" id="gender" required>
                      <option value="<?php echo htmlspecialchars($result['Gender'], ENT_QUOTES, 'UTF-8'); ?>"><?php echo htmlspecialchars($result['Gender'], ENT_QUOTES, 'UTF-8'); ?></option>
                      <option value="Male">ذكر</option>
                      <option value="Female">أنثى</option>
                    </select>
                  </div>
                  <!-- البريد الإلكتروني -->
                  <div class="form-group">
                    <label for="emailid">البريد الإلكتروني</label>
                    <input type="email" class="form-control" id="emailid" name="emailid" value="<?php echo htmlspecialchars($result['Email'], ENT_QUOTES, 'UTF-8'); ?>" required>
                  </div>
                  <!-- رقم الجوال -->
                  <div class="form-group">
                    <label for="mobilenumber">رقم الجوال</label>
                    <input type="text" class="form-control" id="mobilenumber" name="mobilenumber" pattern="[0-9]{10}" maxlength="10" title="10 أرقام فقط" value="<?php echo htmlspecialchars($result['MobileNo'], ENT_QUOTES, 'UTF-8'); ?>" required>
                  </div>
                  <!-- العنوان -->
                  <div class="form-group">
                    <label for="address">العنوان</label>
                    <textarea class="form-control" id="address" name="address" required><?php echo htmlspecialchars($result['Address'], ENT_QUOTES, 'UTF-8'); ?></textarea>
                  </div>
                  <!-- المدينة -->
                  <div class="form-group">
                    <label for="city">المدينة</label>
                    <input type="text" class="form-control" id="city" name="city" value="<?php echo htmlspecialchars($result['City'], ENT_QUOTES, 'UTF-8'); ?>" required>
                  </div>
                  
                  <!-- اللغات المعروفة -->
                  <div class="form-group">
                    <label for="languagesknown">اللغات المعروفة <span style="font-size:12px;">(يجب فصل اللغات بفاصلة، مثال: العربية, الإنجليزية)</span></label>
                    <input type="text" class="form-control" id="languagesknown" name="languagesknown" value="<?php echo htmlspecialchars($result['LanguagesKnown'], ENT_QUOTES, 'UTF-8'); ?>" required>
                  </div>
                  <!-- صورة الملف الشخصي -->
                  <div class="form-group">
                    <label>الصورة الشخصية</label><br>
                    <img src="images/<?php echo htmlspecialchars($result['ProfilePic'], ENT_QUOTES, 'UTF-8'); ?>" width="120" alt="صورة الملف الشخصي">
                    <br><a href="update-nurse-pic.php?lid=<?php echo $result['ID']; ?>">تحديث الصورة الشخصية</a>
                  </div>
                </div>
            </div>
          </div>

          <!-- العمود الأيمن -->
          <div class="col-md-6">
            <div class="card card-success">
              <div class="card-header">
                <h3 class="card-title">المعلومات المهنية</h3>
              </div>
              <div class="card-body">
                <!-- سنوات الخبرة -->
                <div class="form-group">
                  <label for="experience">خبرة التمريض (بالسنوات)</label>
                  <input type="text" class="form-control" id="experience" name="experience" pattern="[0-9]{1,2}" maxlength="2" title="رقمين كحد أقصى" value="<?php echo htmlspecialchars($result['NursingExp'], ENT_QUOTES, 'UTF-8'); ?>" required>
                </div>
                <!-- الشهادات -->
                <div class="form-group">
                                  <label for="certificate">شهادات التمريض (إن وجدت) <span style="font-size:12px;">(يفصل بين الشهادات بفاصلة)</span></label>

                  <input type="text" class="form-control" id="certificate" name="certificate" value="<?php echo htmlspecialchars($result['NursingCertificate'], ENT_QUOTES, 'UTF-8'); ?>">
                </div>
                <!-- وصف التعليم -->
                <div class="form-group">
                  <label for="description">الوصف التعليمي</label>
                  <textarea class="form-control" id="description" name="description" rows="5"><?php echo htmlspecialchars($result['EducationDescription'], ENT_QUOTES, 'UTF-8'); ?></textarea>
                </div>
                <!-- تاريخ التسجيل -->
                <div class="form-group">
                  <label for="regdate">تاريخ تسجيل الملف الشخصي</label>
                  <input type="text" class="form-control" id="regdate" name="regdate" value="<?php echo htmlspecialchars($result['CreationDate'], ENT_QUOTES, 'UTF-8'); ?>" readonly>
                </div>
              </div>
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
<script src="../plugins/select2/js/select2.full.min.js"></script>
<script>
  $(function () {
    bsCustomFileInput.init();

    // تهيئة Select2
    $('.select2').select2();
    $('.select2bs4').select2({
      theme: 'bootstrap4'
    });
  });
</script>
</body>
</html>

<?php } ?>
