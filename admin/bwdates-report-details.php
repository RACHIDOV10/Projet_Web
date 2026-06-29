<?php 
session_start();
error_reporting(0);
// الاتصال بقاعدة البيانات
include('includes/config.php');

// التحقق من الجلسة (تسجيل الدخول)
if(strlen($_SESSION['aid'])==0) { 
    header('location:index.php');
} else {
?>

<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title> تفاصيل تقرير بين التاريخين</title>

  <!-- خطوط Google -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- أيقونات Font Awesome -->
  <link rel="stylesheet" href="../plugins/fontawesome-free/css/all.min.css">
  <!-- DataTables -->
  <link rel="stylesheet" href="../plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="../plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="../plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
  <!-- تصميم القالب -->
  <link rel="stylesheet" href="../dist/css/adminlte.min.css">

  <style>
    /* وضع الشريط الجانبي على اليمين */
    .main-sidebar {
      left: auto !important;
      right: 0 !important;
    }

    /* توسيع محتوى الصفحة مع ترك مساحة للشريط الجانبي */
    .content-wrapper {
      margin-left: 0 !important;
      margin-right: 250px !important; /* عرض sidebar */
      direction: rtl;
      text-align: right;
    }

    /* تعديل اتجاه breadcrumb */
    .breadcrumb {
      float: left !important;
    }

    /* اتجاه النص داخل sidebar */
    .sidebar {
      direction: rtl;
      text-align: right;
    }

    /* محاذاة نص القوائم في sidebar */
    .nav-sidebar > .nav-item > .nav-link p {
      text-align: right;
    }

    /* إزالة الفراغ الأبيض على اليسار */
    body.sidebar-mini.sidebar-collapse .content-wrapper {
      margin-right: 250px !important;
      margin-left: 0 !important;
    }

    /* تحسين عرض الجدول وتوسيع المحتوى */
    .container-fluid, .row, .col-12 {
      max-width: 100% !important;
      padding-left: 15px;
      padding-right: 15px;
    }

    /* تجاوب الشاشة الصغيرة */
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
          <div class="col-sm-8">
<?php 
$fromdate = $_POST['fromdate'];
$todate = $_POST['todate'];
$fdate = date("d-m-Y", strtotime($fromdate));
$tdate = date("d-m-Y", strtotime($todate));
?>
            <h1>تفاصيل التقرير بين <?php echo $fdate;?> و <?php echo $tdate;?></h1>
          </div>
         
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- المحتوى الرئيسي -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                    <tr>
                      <th>رقم</th>
                      <th>رقم الحجز</th>
                      <th>اسم جهة الاتصال</th>
                      <th>البريد الإلكتروني</th>
                      <th>رقم الاتصال</th>
                      <th>الحالة</th>
                      <th>تاريخ الحجز</th>
                      <th>الإجراء</th>
                    </tr>
                  </thead>
                  <tbody>
<?php
$ret = mysqli_query($con, "SELECT * FROM tblbooking WHERE BookingDate BETWEEN '$fromdate' AND '$todate'");
$cnt = 1;
while ($row = mysqli_fetch_array($ret)) {
?>
                    <tr class="gradeX">
                      <td><?php echo $cnt;?></td>
                      <td><?php echo htmlspecialchars($row['BookingID'], ENT_QUOTES, 'UTF-8');?></td>
                      <td><?php echo htmlspecialchars($row['ContactName'], ENT_QUOTES, 'UTF-8');?></td>
                      <td><?php echo htmlspecialchars($row['ContactEmail'], ENT_QUOTES, 'UTF-8');?></td>
                      <td><?php echo htmlspecialchars($row['ContactNumber'], ENT_QUOTES, 'UTF-8');?></td>
                      <td>
    <?php 
      if ($row['Status'] == "Accepted") {
          echo "مقبول";
      } elseif ($row['Status'] == "Rejected") {
          echo "مرفوض";
      } elseif ($row['Status'] == "" || $row['Status'] == NULL) {
          echo "لم يتم التحديث بعد";
      } else {
          echo $row['Status'];
      }
    ?>
  </td>
                       <td><span class="badge badge-primary">
<?php
$timestamp = strtotime($row['BookingDate']);
$timestamp += 2 * 3600; 
echo date('Y-m-d H:i:s', $timestamp);
?>
</span></td>

                      <td><a href="view-request.php?viewid=<?php echo $row['ID'];?>"><i class="fa fa-eye" aria-hidden="true"></i></a></td>
                    </tr>
<?php 
$cnt++;
} 
?>
                  </tbody>
                  <tfoot>
                    <tr>
                      <th>رقم</th>
                      <th>رقم الحجز</th>
                      <th>اسم جهة الاتصال</th>
                      <th>البريد الإلكتروني</th>
                      <th>رقم الاتصال</th>
                      <th>الحالة</th>
                      <th>تاريخ الحجز</th>
                      <th>الإجراء</th>
                    </tr>
                  </tfoot>
                </table>
              </div>
              <!-- /.card-body -->

            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <?php include_once('includes/footer.php');?>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- محتوى الشريط الجانبي الإضافي إذا وجد -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- جافا سكريبت -->
<script src="../plugins/jquery/jquery.min.js"></script>
<script src="../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="../plugins/datatables/jquery.dataTables.min.js"></script>
<script src="../plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="../plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="../plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="../plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="../plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="../plugins/jszip/jszip.min.js"></script>
<script src="../plugins/pdfmake/pdfmake.min.js"></script>
<script src="../plugins/pdfmake/vfs_fonts.js"></script>
<script src="../plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="../plugins/datatables-buttons/js/buttons.print.min.js"></script>
<script src="../plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
<script src="../dist/js/adminlte.min.js"></script>
<script src="../dist/js/demo.js"></script>

<script>
  $(function () {
    $("#example1").DataTable({
      "responsive": true,
      "lengthChange": false,
      "autoWidth": false,
      "language": {
        "decimal": "",
        "emptyTable": "لا توجد بيانات في الجدول",
        "info": "عرض _START_ إلى _END_ من أصل _TOTAL_ مُدخل",
        "infoEmpty": "عرض 0 إلى 0 من أصل 0 مُدخل",
        "infoFiltered": "(منتقاة من مجموع _MAX_ مُدخل)",
        "lengthMenu": "عرض _MENU_ مُدخلات",
        "loadingRecords": "جارٍ التحميل...",
        "processing": "جارٍ المعالجة...",
        "search": "بحث:",
        "zeroRecords": "لم يتم العثور على سجلات مطابقة",
        "paginate": {
          "first": "الأول",
          "last": "الأخير",
          "next": "التالي",
          "previous": "السابق"
        },
        "aria": {
          "sortAscending": ": تفعيل لفرز العمود تصاعدياً",
          "sortDescending": ": تفعيل لفرز العمود تنازلياً"
        }
      }
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
  });
</script>
</body>
</html>
<?php } ?>
