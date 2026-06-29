<?php 
session_start();
error_reporting(0);
// اتصال بقاعدة البيانات
include('includes/config.php');
// التحقق من وجود الجلسة
if(strlen($_SESSION['aid'])==0)
{ 
    header('location:index.php');
}
else{
// حذف بيانات الممرض
if($_GET['action']=='delete'){
    $bsid=intval($_GET['bsid']);
    $profilepic=$_GET['profilepic'];
    $ppicpath="lawyerpic"."/".$profilepic;
    $query=mysqli_query($con,"delete from tblnurse where id='$bsid'");
    if($query){
        unlink($ppicpath);
        echo "<script>alert('تم حذف بيانات الممرض بنجاح.');</script>";
        echo "<script type='text/javascript'> document.location = 'manage-nurse.php'; </script>";
    } else {
        echo "<script>alert('حدث خطأ ما. حاول مرة أخرى.');</script>";
    }
}

?>
<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title> إدارة الممرضين</title>

  <!-- Google Font: Cairo -->
  <link href="https://fonts.googleapis.com/css2?family=Cairo&display=swap" rel="stylesheet" />
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../plugins/fontawesome-free/css/all.min.css">
  <!-- DataTables -->
  <link rel="stylesheet" href="../plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="../plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="../plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../dist/css/adminlte.min.css">

  <style>
    body, h1, h2, h3, h4, h5, h6, p, a {
      font-family: 'Cairo', sans-serif !important;
    }

    /* Sidebar à droite */
    .main-sidebar {
      left: auto !important;
      right: 0 !important;
    }
    /* Décalage du contenu principal vers la gauche */
    .content-wrapper {
      margin-left: 0 !important;
      margin-right: 250px !important;
      direction: rtl;
    }
    .sidebar {
      direction: rtl;
    }
    /* Texte des liens dans la sidebar aligné à droite */
    .nav-sidebar > .nav-item > .nav-link p {
      text-align: right;
    }
    /* Breadcrumb en float à gauche car RTL */
    .breadcrumb {
      float: left !important;
    }
    #example1 th, #example1 td {
      text-align: center;
      vertical-align: middle;
    }
    
  </style>
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">

  <!-- Navbar -->
  <?php include_once("includes/navbar.php");?>

  <!-- Sidebar -->
  <?php include_once("includes/sidebar.php");?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper" style="direction: rtl;">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>إدارة الممرضين</h1>
          </div>
          
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">

            
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>#</th>
                    <th>صورة الملف الشخصي</th>
                    <th>الاسم الكامل</th>
                    <th>البريد الإلكتروني</th>
                    <th>رقم الجوال</th>
                    <th>تاريخ التسجيل</th>
                    <th>الإجراءات</th>
                  </tr>
                  </thead>
                  <tbody>

<?php 
$query=mysqli_query($con,"select * from tblnurse");
$cnt=1;
while($result=mysqli_fetch_array($query)){
?>

                  <tr>
                    <td><?php echo $cnt;?></td>
                    <td><img src="images/<?php echo $result['ProfilePic']?>" width="80"></td>
                    <td><?php echo $result['Name']?></td>
                    <td><?php echo $result['Email']?></td>
                    <td><?php echo $result['MobileNo']?></td>
                    <td><?php echo $result['CreationDate']?></td>
                    <td>
                      <a href="edit-nurse.php?editid=<?php echo $result['ID'];?>" title="تعديل بيانات الممرض">
                        <i class="fa fa-edit" aria-hidden="true"></i>
                      </a> | 
                      <a href="manage-nurse.php?action=delete&&bsid=<?php echo $result['ID']; ?>&&profilepic=<?php echo $result['ProfilePic'];?>" style="color:red;" title="حذف هذا السجل" onclick="return confirm('هل أنت متأكد من حذف هذا السجل؟');">
                        <i class="fa fa-trash" aria-hidden="true"></i>
                      </a>
                    </td>
                  </tr>
<?php $cnt++; } ?>

                  </tbody>
                  <tfoot>
                  <tr>
                    <th>#</th>
                    <th>صورة الملف الشخصي</th>
                    <th>الاسم الكامل</th>
                    <th>البريد الإلكتروني</th>
                    <th>رقم الجوال</th>
                    <th>تاريخ التسجيل</th>
                    <th>الإجراءات</th>
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
    <!-- محتوى لوحة التحكم الجانبية -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="../plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- DataTables  & Plugins -->
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
<!-- AdminLTE App -->
<script src="../dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="../dist/js/demo.js"></script>
<!-- Page specific script -->
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

</script>
</body>
</html>
<?php } ?>
