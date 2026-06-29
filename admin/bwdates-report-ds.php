<?php 
session_start();
include('includes/config.php');
if(strlen($_SESSION['aid'])==0) { 
    header('location:index.php');
} else {
?>
<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title> تقرير بين تاريخين</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../plugins/fontawesome-free/css/all.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../dist/css/adminlte.min.css">

  <style>
    body {
      direction: rtl;
      text-align: right;
    }
    .main-sidebar {
      right: 0;
      left: auto;
    }
    .content-wrapper {
      margin-left: 0 !important;
      margin-right: 250px; /* largeur sidebar */
    }
    .main-header {
      margin-left: 0 !important;
      margin-right: 250px;
    }
  </style>
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">

  <!-- Navbar -->
  <?php include_once("includes/navbar.php");?>
  <!-- /.navbar -->

  <!-- Sidebar -->
  <?php include_once("includes/sidebar.php");?>
  <!-- /.sidebar -->

  <!-- Content Wrapper -->
  <div class="content-wrapper">
    <!-- Content Header -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>تقرير بين تاريخين</h1>
          </div>
         
        </div>
      </div>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <!-- form -->
          <div class="col-md-8">
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">اختيار الفترة</h3>
              </div>
              <form method="post" name="bwdatesreportds" action="bwdates-report-details.php">  
                <div class="card-body">

                  <div class="form-group">
                    <label>من تاريخ</label>
                    <input class="form-control" id="fromdate" name="fromdate" type="date" required>
                  </div>

                  <div class="form-group">
                    <label>إلى تاريخ</label>
                    <input class="form-control" id="todate" name="todate" type="date" required>
                  </div>

                </div>
                <div class="card-footer">
                  <button type="submit" class="btn btn-primary" name="submit" id="submit">عرض التقرير</button>
                </div>
              </form>
            </div>
          </div>
          <!-- /.col -->
        </div>
      </div>
    </section>
  </div>

  <?php include_once('includes/footer.php');?>

</div>

<!-- Scripts -->
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
