<?php
session_start();
// اتصال بقاعدة البيانات
include('includes/config.php');

// تفعيل UTF-8 لعرض العربية
mysqli_set_charset($con, "utf8mb4");

// التحقق من الجلسة
if(strlen($_SESSION['aid'])==0) { 
    header('location:index.php');
} else {

    // تحديث صورة الممرضة
    if(isset($_POST['submit'])){

        $editid = intval($_GET['lid']);
        $currentpic = $_POST['currentprofilepic'];
        $oldprofilepic = "images/".$currentpic;
        $profilepic = $_FILES["profilepic"]["name"];

        // الامتداد
        $extension = substr($profilepic, strlen($profilepic)-4, strlen($profilepic));
        $allowed_extensions = array(".jpg","jpeg",".png",".gif");

        if(!in_array($extension, $allowed_extensions)) {
            echo "<script>alert('صيغة الصورة غير صحيحة. مسموح فقط jpg / jpeg / png / gif');</script>";
        } else {
            // إعادة تسمية الملف
            $newprofilepic = md5($profilepic).time().$extension;
            move_uploaded_file($_FILES["profilepic"]["tmp_name"], "images/".$newprofilepic);

            $query = mysqli_query($con, "UPDATE tblnurse SET ProfilePic='$newprofilepic' WHERE ID='$editid'");
            if($query){
                unlink($oldprofilepic);  
                echo "<script>alert('تم تحديث صورة الملف الشخصي بنجاح');</script>";
                echo "<script>document.location = 'manage-nurse.php';</script>";
            } else {
                echo "<script>alert('حدث خطأ، حاول مرة أخرى');</script>";
            }
        }
    }
?>
<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>تحديث صورة الممرضة</title>

  <link rel="stylesheet" href="../plugins/fontawesome-free/css/all.min.css">
  <link rel="stylesheet" href="../dist/css/adminlte.min.css">

  <style>
    /* نقل الشريط الجانبي لليمين */
    .main-sidebar {
      left: auto !important;
      right: 0 !important;
    }
    /* جعل المحتوى يأخذ كل المساحة */
    .content-wrapper {
      margin-left: 0 !important;
      margin-right: 250px !important; /* عرض الشريط الجانبي */
      direction: rtl;
    }
    /* النصوص داخل الشريط الجانبي من اليمين */
    .sidebar {
      direction: rtl;
    }
    .nav-sidebar > .nav-item > .nav-link p {
      text-align: right;
    }
  </style>
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">

  <!-- شريط التنقل -->
  <?php include_once("includes/navbar.php");?>

  <!-- الشريط الجانبي -->
  <?php include_once("includes/sidebar.php");?>

  <!-- المحتوى الرئيسي -->
  <div class="content-wrapper">
    <!-- رأس الصفحة -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>تحديث صورة الممرضة</h1>
          </div>
         
        </div>
      </div>
    </section>

    <!-- المحتوى -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">

          <!-- العمود الأيسر -->
          <div class="col-md-8">
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">صورة الملف الشخصي</h3>
              </div>

              <form method="post" enctype="multipart/form-data">
                <div class="card-body">
                  <?php 
                  $editid = intval($_GET['lid']);
                  $query = mysqli_query($con, "SELECT ProfilePic,ID FROM tblnurse WHERE ID='$editid'");
                  while($result = mysqli_fetch_array($query)) { ?>
                    <div class="form-group">
                      <label>الصورة الحالية</label><br>
                      <img src="images/<?php echo $result['ProfilePic']?>" width="200">
                    </div>
                  <?php } ?>

                  <div class="form-group">
                    <label>صورة جديدة <span style="font-size:12px;color:red;">(jpg / jpeg / png / gif فقط)</span></label>
                    <div class="input-group">
                      <div class="custom-file">
                        <input type="hidden" name="currentprofilepic" value="<?php echo $result['ProfilePic'];?>">
                        <input type="file" class="custom-file-input" name="profilepic" required>
                        <label class="custom-file-label">اختر ملف</label>
                      </div>
                      <div class="input-group-append">
                        <span class="input-group-text">رفع</span>
                      </div>
                    </div>
                  </div>

                  <div class="card-footer text-center">
                    <button type="submit" class="btn btn-primary" name="submit">تحديث</button>
                  </div>
                </div>
              </form>

            </div>
          </div>

        </div>
      </div>
    </section>
  </div>

  <?php include_once('includes/footer.php');?>

</div>

<script src="../plugins/jquery/jquery.min.js"></script>
<script src="../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="../plugins/bs-custom-file-input/bs-custom-file-input.min.js"></script>
<script src="../dist/js/adminlte.min.js"></script>
<script>
$(function () {
  bsCustomFileInput.init();
});
</script>
</body>
</html>
<?php } ?>
