<?php 
session_start();
// اتصال بقاعدة البيانات
include('includes/config.php');

// التحقق من وجود الجلسة
if(strlen($_SESSION['aid'])==0)
{ 
    header('location:index.php');
}
else { 
?>
<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>لوحة التحكم</title>

  <!-- Google Font: Cairo for Arabic -->
  <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;600;700;900&display=swap" rel="stylesheet" />
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Tempusdominus Bootstrap 4 -->
  <link rel="stylesheet" href="../plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="../plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- JQVMap -->
  <link rel="stylesheet" href="../plugins/jqvmap/jqvmap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../dist/css/adminlte.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="../plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="../plugins/daterangepicker/daterangepicker.css">
  <!-- summernote -->
  <link rel="stylesheet" href="../plugins/summernote/summernote-bs4.min.css">

  <style>
    /* ===== BASE ===== */
    body, h1, h2, h3, h4, h5, h6, p, a {
      font-family: 'Cairo', sans-serif !important;
    }

    /* ===== SIDEBAR ===== */
    .main-sidebar {
      left: auto !important;
      right: 0 !important;
      background: linear-gradient(180deg, #0d47a1, #1565c0) !important;
    }

    .content-wrapper {
      margin-left: 0 !important;
      margin-right: 250px !important;
      direction: rtl;
    }

    .sidebar {
      direction: rtl;
    }

    .nav-sidebar > .nav-item > .nav-link p {
      text-align: right;
    }

    .nav-sidebar .nav-item .nav-link {
      color: rgba(255,255,255,0.8) !important;
      transition: all 0.3s ease;
      border-radius: 8px;
      margin: 2px 10px;
    }

    .nav-sidebar .nav-item .nav-link:hover {
      background: rgba(255,255,255,0.15) !important;
      color: #fff !important;
    }

    .nav-sidebar .nav-item .nav-link.active {
      background: rgba(255,255,255,0.2) !important;
      color: #fff !important;
      box-shadow: 0 4px 15px rgba(0,0,0,0.2);
    }

    .nav-sidebar .nav-item .nav-link i {
      color: rgba(255,255,255,0.7);
    }

    .nav-sidebar .nav-item .nav-link:hover i,
    .nav-sidebar .nav-item .nav-link.active i {
      color: #fff;
    }

    .brand-link {
      background: linear-gradient(135deg, #0a2a6a, #0d47a1) !important;
      border-bottom: 1px solid rgba(255,255,255,0.1);
    }

    .brand-link .brand-text {
      color: #fff !important;
      font-weight: 700;
    }

    .brand-link .brand-image {
      background: rgba(255,255,255,0.2);
      padding: 5px;
      border-radius: 50%;
    }

    /* ===== HEADER NAVBAR ===== */
    .main-header {
      background: #fff !important;
      box-shadow: 0 2px 15px rgba(0,0,0,0.08);
    }

    .main-header .navbar-nav .nav-link {
      color: #555 !important;
    }

    .main-header .navbar-nav .nav-link:hover {
      color: #0d47a1 !important;
    }

    /* ===== STAT CARDS ===== */
    .small-box {
      border-radius: 15px !important;
      box-shadow: 0 5px 20px rgba(0,0,0,0.08) !important;
      transition: all 0.3s ease !important;
      overflow: hidden;
      position: relative;
    }

    .small-box:hover {
      transform: translateY(-5px) !important;
      box-shadow: 0 12px 35px rgba(0,0,0,0.15) !important;
    }

    .small-box .inner {
      padding: 20px 25px !important;
    }

    .small-box .inner h3 {
      font-size: 2.5rem !important;
      font-weight: 700 !important;
      margin: 0 0 5px 0 !important;
    }

    .small-box .inner p {
      font-size: 1.1rem !important;
      font-weight: 600 !important;
      margin: 0 !important;
      opacity: 0.9;
    }

    .small-box .icon {
      font-size: 4rem !important;
      opacity: 0.3 !important;
      transition: all 0.3s ease !important;
    }

    .small-box:hover .icon {
      opacity: 0.5 !important;
      transform: scale(1.1) !important;
    }

    .small-box .small-box-footer {
      background: rgba(0,0,0,0.1) !important;
      padding: 8px 20px !important;
      color: #fff !important;
      font-weight: 600 !important;
      transition: all 0.3s ease !important;
      text-decoration: none !important;
      display: block;
    }

    .small-box .small-box-footer:hover {
      background: rgba(0,0,0,0.2) !important;
      padding-right: 30px !important;
    }

    .small-box .small-box-footer i {
      transition: all 0.3s ease !important;
    }

    .small-box .small-box-footer:hover i {
      transform: translateX(-5px) !important;
    }

    /* ===== CARD COLORS ===== */
    .small-box.bg-info {
      background: linear-gradient(135deg, #0d47a1, #1565c0) !important;
    }

    .small-box.bg-primary {
      background: linear-gradient(135deg, #00bcd4, #0097a7) !important;
    }

    .small-box.bg-success {
      background: linear-gradient(135deg, #43a047, #2e7d32) !important;
    }

    .small-box.bg-danger {
      background: linear-gradient(135deg, #e53935, #c62828) !important;
    }

    /* ===== PAGE HEADER ===== */
    .content-header h1 {
      font-weight: 700 !important;
      color: #0d47a1 !important;
      position: relative;
      padding-right: 15px;
    }

    .content-header h1::before {
      content: '';
      position: absolute;
      right: 0;
      top: 5px;
      width: 4px;
      height: 70%;
      background: linear-gradient(180deg, #0d47a1, #00bcd4);
      border-radius: 5px;
    }

    /* ===== BREADCRUMB ===== */
    .breadcrumb {
      float: left !important;
      background: transparent !important;
      padding: 0.75rem 0 !important;
    }

    .breadcrumb-item a {
      color: #0d47a1 !important;
      font-weight: 600;
      text-decoration: none;
    }

    .breadcrumb-item a:hover {
      color: #00bcd4 !important;
    }

    .breadcrumb-item.active {
      color: #888 !important;
    }

    /* ===== FOOTER ===== */
    .main-footer {
      background: #fff !important;
      border-top: 1px solid #f0f0f0 !important;
      padding: 15px 20px !important;
      color: #888 !important;
    }

    .main-footer a {
      color: #0d47a1 !important;
    }

    .main-footer a:hover {
      color: #00bcd4 !important;
    }

    /* ===== RESPONSIVE ===== */
    @media (max-width: 991px) {
      .content-wrapper {
        margin-right: 0 !important;
      }
    }

    @media (max-width: 768px) {
      .small-box .inner h3 {
        font-size: 2rem !important;
      }
      .small-box .icon {
        font-size: 3rem !important;
      }
    }

    @media (max-width: 480px) {
      .content-header h1 {
        font-size: 1.4rem !important;
      }
      .small-box .inner {
        padding: 15px !important;
      }
      .small-box .inner h3 {
        font-size: 1.8rem !important;
      }
      .small-box .inner p {
        font-size: 0.95rem !important;
      }
    }
  </style>

</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

  <!-- Navbar -->
  <?php include_once('includes/navbar.php'); ?>

  <!-- Sidebar -->
  <?php include_once('includes/sidebar.php'); ?>

  <!-- Content Wrapper -->
  <div class="content-wrapper" style="direction: rtl;">

    <!-- Content Header -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 font-weight-bold">لوحة التحكم</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-left">
              <li class="breadcrumb-item"><a href="#">الرئيسية</a></li>
              <li class="breadcrumb-item active">لوحة التحكم</li>
            </ol>
          </div>
        </div>
      </div>
    </div>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">

        <!-- Stats Row -->
        <div class="row">

          <!-- الطلبات المرفوضة -->
          <div class="col-lg-3 col-6">
            <div class="small-box bg-danger">
              <div class="inner">
                <?php 
                $query4 = mysqli_query($con, "SELECT ID FROM tblbooking WHERE Status='Rejected'");
                $rejreq = mysqli_num_rows($query4);
                ?>
                <h3><?php echo $rejreq; ?></h3>
                <p>الطلبات المرفوضة</p>
              </div>
              <div class="icon">
                <i class="ion ion-close"></i>
              </div>
              <a href="reject-request.php" class="small-box-footer">المزيد <i class="fas fa-arrow-circle-left"></i></a>
            </div>
          </div>

          <!-- الطلبات المقبولة -->
          <div class="col-lg-3 col-6">
            <div class="small-box bg-success">
              <div class="inner">
                <?php 
                $query3 = mysqli_query($con, "SELECT ID FROM tblbooking WHERE Status='Accepted'");
                $acceptedreq = mysqli_num_rows($query3);
                ?>
                <h3><?php echo $acceptedreq; ?></h3>
                <p>الطلبات المقبولة</p>
              </div>
              <div class="icon">
                <i class="ion ion-checkmark"></i>
              </div>
              <a href="accept-request.php" class="small-box-footer">المزيد <i class="fas fa-arrow-circle-left"></i></a>
            </div>
          </div>

          <!-- الطلبات الجديدة -->
          <div class="col-lg-3 col-6">
            <div class="small-box bg-primary">
              <div class="inner">
                <?php 
                $query2 = mysqli_query($con, "SELECT ID FROM tblbooking WHERE Status IS NULL");
                $newreq = mysqli_num_rows($query2);
                ?>
                <h3><?php echo $newreq; ?></h3>
                <p>الطلبات الجديدة</p>
              </div>
              <div class="icon">
                <i class="ion ion-person-add"></i>
              </div>
              <a href="new-request.php" class="small-box-footer">المزيد <i class="fas fa-arrow-circle-left"></i></a>
            </div>
          </div>

          <!-- إجمالي الممرضين -->
          <div class="col-lg-3 col-6">
            <div class="small-box bg-info">
              <div class="inner">
                <?php 
                $query1 = mysqli_query($con, "SELECT ID FROM tblnurse");
                $nursecnt = mysqli_num_rows($query1);
                ?>
                <h3><?php echo $nursecnt; ?></h3>
                <p>إجمالي عدد الممرضين</p>
              </div>
              <div class="icon">
                <i class="ion ion-person"></i>
              </div>
              <a href="manage-nurse.php" class="small-box-footer">المزيد <i class="fas fa-arrow-circle-left"></i></a>
            </div>
          </div>

        </div>
        <!-- /.row -->

        <!-- Graphique / Dernières activités (optionnel) -->
        <div class="row mt-4">
          <div class="col-md-8">
            <div class="card">
              <div class="card-header">
                <h5 class="card-title"><i class="fas fa-chart-line ml-2"></i>نشاط الحجوزات</h5>
              </div>
              <div class="card-body">
                <p class="text-muted text-center">سيتم إضافة الرسوم البيانية قريباً</p>
              </div>
            </div>
          </div>
          <div class="col-md-4">
            
        </div>

      </div>
    </section>
    <!-- /.content -->

  </div>
  <!-- /.content-wrapper -->

  <?php include_once('includes/footer.php'); ?>

</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="../plugins/jquery/jquery.min.js"></script>
<!-- jQuery UI -->
<script src="../plugins/jquery-ui/jquery-ui.min.js"></script>
<script>
  $.widget.bridge('uibutton', $.ui.button);
</script>
<!-- Bootstrap 4 -->
<script src="../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- ChartJS -->
<script src="../plugins/chart.js/Chart.min.js"></script>
<!-- Sparkline -->
<script src="../plugins/sparklines/sparkline.js"></script>
<!-- JQVMap -->
<script src="../plugins/jqvmap/jquery.vmap.min.js"></script>
<script src="../plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
<!-- jQuery Knob Chart -->
<script src="../plugins/jquery-knob/jquery.knob.min.js"></script>
<!-- daterangepicker -->
<script src="../plugins/moment/moment.min.js"></script>
<script src="../plugins/daterangepicker/daterangepicker.js"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="../plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<!-- Summernote -->
<script src="../plugins/summernote/summernote-bs4.min.js"></script>
<!-- overlayScrollbars -->
<script src="../plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="../dist/js/adminlte.js"></script>
<!-- AdminLTE demo -->
<script src="../dist/js/demo.js"></script>
<!-- Dashboard demo -->
<script src="../dist/js/pages/dashboard.js"></script>

</body>
</html>
<?php } ?>