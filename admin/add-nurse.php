<?php 
session_start();
// Database Connection
include('includes/config.php');
// Validating Session
if(strlen($_SESSION['aid'])==0)
{ 
    header('location:index.php');
}
else{
    // Code for Add New Nurse
    if(isset($_POST['submit'])){
        // Getting Post Values  
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
        $profilepic = $_FILES["profilepic"]["name"];
        // get the image extension
        $extension = substr($profilepic,strlen($profilepic)-4,strlen($profilepic));
        // allowed extensions
        $allowed_extensions = array(".jpg","jpeg",".png",".gif");
        // Validation for allowed extensions .in_array() function searches an array for a specific value.
        if(!in_array($extension,$allowed_extensions))
        {
            echo "<script>alert('تنسيق غير صالح. يُسمح فقط بصيغ jpg / jpeg / png / gif');</script>";
        }
        else
        {
            // rename the image file
            $newprofilepic = md5($profilepic).time().$extension;
            // move image into directory
            move_uploaded_file($_FILES["profilepic"]["tmp_name"],"images/".$newprofilepic);

            $query = mysqli_query($con,"INSERT INTO tblnurse(Name,Gender,Email,MobileNo,Address,City,LanguagesKnown,NursingExp,NursingCertificate,EducationDescription,ProfilePic) VALUES('$fname','$gender','$email','$mobileno','$address','$city','$languagesknown','$experience','$certificate','$description','$newprofilepic')");
            if($query){
                echo "<script>alert('تمت إضافة بيانات الممرض بنجاح.');</script>";
                echo "<script type='text/javascript'> document.location = 'add-nurse.php'; </script>";
            } else {
                echo "<script>alert('حدث خطأ ما. يرجى المحاولة مرة أخرى.');</script>";
            }
        }
    }
?>

<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title> إضافة ممرض</title>

  <link rel="stylesheet" href="../plugins/fontawesome-free/css/all.min.css" />
  <link rel="stylesheet" href="../plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css" />
  <link rel="stylesheet" href="../plugins/select2/css/select2.min.css" />
  <link rel="stylesheet" href="../plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css" />
  <link rel="stylesheet" href="../plugins/bootstrap4-duallistbox/bootstrap-duallistbox.min.css" />
  <link rel="stylesheet" href="../plugins/bs-stepper/css/bs-stepper.min.css" />
  <link rel="stylesheet" href="../plugins/dropzone/min/dropzone.min.css" />
  <link rel="stylesheet" href="../dist/css/adminlte.min.css" />

  <style>
    /* sidebar على اليمين */
    .main-sidebar {
      left: auto ;
      right: 0 ;
    }
    /* محتوى الصفحة ياخذ المساحة المتبقية */
    .content-wrapper {
      margin-left: 0 !important;
      margin-right: 250px !important; /* عرض الـ sidebar */
      direction: rtl;
    }
    /* تعديل مكان breadcrumb */
    .breadcrumb {
      float: left !important;
    }
    /* اتجاه النص داخل sidebar */
    .sidebar {
      direction: rtl;
    }
    /* محاذاة النص في القوائم */
    .nav-sidebar > .nav-item > .nav-link p {
      text-align: right;
    }
    
    
  </style>
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper" dir="rtl">

  <!-- Navbar -->
  <?php include_once("includes/navbar.php");?>

  <!-- Main Sidebar Container -->
  <?php include_once("includes/sidebar.php");?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>إضافة ممرض</h1>
          </div>
          
        </div>
      </div>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">

          <!-- العمود الأيسر -->
          <div class="col-md-6">
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">المعلومات الشخصية</h3>
              </div>
              <form name="addlawyer" method="post" enctype="multipart/form-data">
                <div class="card-body">

                  <div class="form-group" style="text-align: right;">
                    <label for="fullname">الاسم الكامل</label>
                    <input type="text" class="form-control" id="fullname" name="fullname" placeholder="أدخل اسم الممرض الكامل" required>
                  </div>

                  <div class="form-group"style="text-align: right;">
                    <label for="gender">الجنس</label>
                    <select class="form-control" name="gender" id="gender" required>
                      <option value="">اختر الجنس</option>
                      <option value="Male">ذكر</option>
                      <option value="Female">أنثى</option>
                    </select>
                  </div>

                  <div class="form-group"style="text-align: right;">
                    <label for="emailid">البريد الإلكتروني</label>
                    <input type="email" class="form-control" id="emailid" name="emailid" placeholder="أدخل البريد الإلكتروني" required>
                  </div>

                  <div class="form-group"style="text-align: right;">
                    <label for="mobilenumber">رقم الجوال</label>
                    <input type="text" class="form-control" id="mobilenumber" name="mobilenumber" placeholder="أدخل رقم الجوال" pattern="[0-9]{10}" maxlength="10" title="10 أرقام فقط" required>
                  </div>

                  <div class="form-group"style="text-align: right;">
                    <label for="address">العنوان</label>
                    <input type="text" class="form-control" id="address" name="address" placeholder="أدخل العنوان" required>
                  </div>

                  <div class="form-group"style="text-align: right;">
                    <label for="city">المدينة</label>
                    <input type="text" class="form-control" id="city" name="city" placeholder="أدخل اسم المدينة" required>
                  </div>

                  <div class="form-group"style="text-align: right;">
                    <label for="languagesknown">اللغات المعروفة <span style="font-size:12px;">(يفصل بين اللغات بفاصلة، مثال: العربية, الإنجليزية)</span></label>
                    <input type="text" class="form-control" id="languagesknown" name="languagesknown" placeholder="اللغات المعروفة" required>
                  </div>

                  <div class="form-group"style="text-align: right;">
                    <label for="profilepic">صورة الملف الشخصي <span style="font-size:12px; color:red;">(مسموح فقط jpg / jpeg / png / gif)</span></label>
                    <div class="input-group">
                      <div class="custom-file">
                        <input type="file" class="custom-file-input" id="profilepic" name="profilepic" required>
                        <label class="custom-file-label" for="profilepic">اختر ملف</label>
                      </div>
                      <div class="input-group-append">
                        <span class="input-group-text">رفع</span>
                      </div>
                    </div>
                  </div>

                </div>
                <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
        <!--/.col (left) -->

        <!-- العمود الأيمن -->
        <div class="col-md-6">
          <div class="card card-success">
            <div class="card-header">
              <h3 class="card-title">المعلومات المهنية</h3>
            </div>
            <div class="card-body">

              <div class="form-group"style="text-align: right;">
                <label for="experience">خبرة التمريض (بالسنوات)</label>
                <input type="text" class="form-control" id="experience" name="experience" placeholder="أدخل سنوات الخبرة" pattern="[0-9]{1,2}" maxlength="2" title="سنتين كحد أقصى" required>
              </div>

              <div class="form-group"style="text-align: right;">
                <label for="certificate">شهادات التمريض (إن وجدت) <span style="font-size:12px;">(يفصل بين الشهادات بفاصلة)</span></label>
                <input type="text" class="form-control" id="certificate" name="certificate" placeholder="الشهادات">
              </div>

              <div class="form-group"style="text-align: right;">
                <label for="description">الوصف التعليمي</label>
                <textarea class="form-control" id="description" name="description" placeholder="الوصف" rows="5"></textarea>
              </div>

              <div class="card-footer"style="text-align: right;">
                <button type="submit" class="btn btn-primary" name="submit" id="submit">إرسال</button>
              </div>
            </div>
          </div>
          <!-- /.card -->
        </div>

        </form>
      </div>
      <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <?php include_once('includes/footer.php');?>

</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="../plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- bs-custom-file-input -->
<script src="../plugins/bs-custom-file-input/bs-custom-file-input.min.js"></script>
<!-- AdminLTE App -->
<script src="../dist/js/adminlte.min.js"></script>
<!-- AdminLTE demo -->
<script src="../dist/js/demo.js"></script>
<!-- Select2 -->
<script src="../plugins/select2/js/select2.full.min.js"></script>

<script>
  $(function () {
    bsCustomFileInput.init();
    $('.select2').select2();
    $('.select2bs4').select2({
      theme: 'bootstrap4'
    });
  });
</script>

</body>
</html>

<?php } ?>
