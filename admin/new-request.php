<?php 
session_start();
error_reporting(0);
// اتصال بقاعدة البيانات
include('includes/config.php');
// التحقق من الجلسة
if(strlen($_SESSION['aid'])==0) { 
    header('location:index.php');
} else {
?>
<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title> الطلبات الجديدة</title>

  <!-- خطوط جوجل -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Cairo:300,400,700&display=swap">
  <!-- أيقونات Font Awesome -->
  <link rel="stylesheet" href="../plugins/fontawesome-free/css/all.min.css">
  <!-- DataTables -->
  <link rel="stylesheet" href="../plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="../plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="../plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
  <!-- تصميم AdminLTE -->
  <link rel="stylesheet" href="../dist/css/adminlte.min.css">

  <style>
    body { font-family: 'Cairo', sans-serif; }
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
            <h1>الطلبات الجديدة</h1>
          </div>
         
        </div>
      </div>
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
                      <th>م</th>
                      <th>رقم الحجز</th>
                      <th>اسم المتصل</th>
                      <th>البريد الإلكتروني</th>
                      <th>رقم الهاتف</th>
                      <th>الحالة</th>
                      <th>تاريخ الحجز</th>
                      <th>إجراء</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    $ret=mysqli_query($con,"SELECT * FROM tblbooking WHERE Status IS NULL");
                    $cnt=1;
                    while ($row=mysqli_fetch_array($ret)) {
                    ?>
                    <tr>
                      <td><?php echo $cnt;?></td>
                      <td><?php echo $row['BookingID'];?></td>
                      <td><?php echo $row['ContactName'];?></td>
                      <td><?php echo $row['ContactEmail'];?></td>
                      <td><?php echo $row['ContactNumber'];?></td>
                      <td>
                        <?php if($row['Status']==""){ 
                          echo "لم يتم التحديث بعد"; 
                        } else { 
                          echo $row['Status']; 
                        } ?>
                      </td>
                      <td><span class="badge badge-primary">
<?php
$timestamp = strtotime($row['BookingDate']);
$timestamp += 2 * 3600; // ajouter 2 heures
echo date('Y-m-d H:i:s', $timestamp);
?>
</span></td>

                      <td><a href="view-request.php?viewid=<?php echo $row['ID'];?>"><i class="fa fa-eye"></i></a></td>
                    </tr>
                    <?php $cnt++; } ?>
                  </tbody>
                  <tfoot>
                    <tr>
                      <th>م</th>
                      <th>رقم الحجز</th>
                      <th>اسم المتصل</th>
                      <th>البريد الإلكتروني</th>
                      <th>رقم الهاتف</th>
                      <th>الحالة</th>
                      <th>تاريخ الحجز</th>
                      <th>إجراء</th>
                    </tr>
                  </tfoot>
                </table>
              </div>

            </div>
          </div>
        </div>
      </div>
    </section> 
  </div>

  <!-- الفوتر -->
  <?php include_once('includes/footer.php');?>

</div>

<!-- سكربتات الجافاسكربت -->
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
<script>
 $(function () {
  $("#example1").DataTable({
    responsive: true,
    lengthChange: false,
    autoWidth: false,
    
    language: {
      decimal: "",
      emptyTable: "لا توجد بيانات في الجدول",
      info: "عرض _START_ إلى _END_ من أصل _TOTAL_ مُدخل",
      infoEmpty: "عرض 0 إلى 0 من أصل 0 مُدخل",
      infoFiltered: "(منتقاة من مجموع _MAX_ مُدخل)",
      thousands: ",",
      lengthMenu: "عرض _MENU_ مُدخلات",
      loadingRecords: "جارٍ التحميل...",
      processing: "جارٍ المعالجة...",
      search: "بحث:",
      zeroRecords: "لم يتم العثور على سجلات مطابقة",
      paginate: {
        first: "الأول",
        last: "الأخير",
        next: "التالي",
        previous: "السابق"
      },
      aria: {
        sortAscending: ": تفعيل لفرز العمود تصاعدياً",
        sortDescending: ": تفعيل لفرز العمود تنازلياً"
      }
    }
  }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
});


</script>
</body>
</html>
<?php } ?>
