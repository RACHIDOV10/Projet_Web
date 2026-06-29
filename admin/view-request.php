<?php 
session_start();
error_reporting(0);
include('includes/config.php');
if(strlen($_SESSION['aid'])==0) { 
    header('location:index.php');
} else {
    if(isset($_POST['submit'])) {
        $viewid = $_GET['viewid'];
        $ressta = $_POST['status'];
        $remark = $_POST['remark'];
        $query = mysqli_query($con, "UPDATE tblbooking SET Remark='$remark', Status='$ressta' WHERE ID='$viewid'");
        if ($query) {
            echo '<script>alert("تم تحديث حالة الطلب بنجاح.")</script>';
            echo "<script type='text/javascript'> document.location ='all-request.php'; </script>";
        } else {
            echo '<script>alert("حدث خطأ ما. يرجى المحاولة مرة أخرى.")</script>';
        }
    }
?>
<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title> عرض الطلب</title>

  <!-- خطوط Google -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../plugins/fontawesome-free/css/all.min.css">
  <!-- DataTables -->
  <link rel="stylesheet" href="../plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="../plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="../plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
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
      margin-right: 250px; /* عرض الشريط الجانبي */
    }
    .main-header {
      margin-left: 0 !important;
      margin-right: 250px;
    }
    .breadcrumb {
      justify-content: flex-start !important; /* عكس اتجاه breadcrumb */
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
    <!-- رأس المحتوى -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>عرض الطلب</h1>
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

              <div class="card-header">
                <h3 class="card-title">تفاصيل الطلب</h3>
              </div>

              <div class="card-body">
                <?php
                $viewid = intval($_GET['viewid']);
                $ret = mysqli_query($con, "SELECT tblnurse.*, tblbooking.* FROM tblbooking JOIN tblnurse ON tblnurse.ID=tblbooking.NurseID WHERE tblbooking.ID='$viewid'");
                $cnt=1;
                while ($row = mysqli_fetch_array($ret)) {
                    $status = $row['Status'];
                ?>
                <table class="table table-bordered data-table">
                  <tr align="center">
                    <td colspan="4" style="font-size:20px; color:blue;">
                      تفاصيل الطلب رقم (<?php echo htmlspecialchars($row['BookingID'], ENT_QUOTES, 'UTF-8'); ?>)
                    </td>
                  </tr>
                  <tr>
                    <th>اسم المتصل</th>
                    <td><?php echo htmlspecialchars($row['ContactName'], ENT_QUOTES, 'UTF-8'); ?></td>
                    <th>رقم المتصل</th>
                    <td><?php echo htmlspecialchars($row['ContactNumber'], ENT_QUOTES, 'UTF-8'); ?></td>
                  </tr>
                  <tr>
                    <th>البريد الإلكتروني</th>
                    <td><?php echo htmlspecialchars($row['ContactEmail'], ENT_QUOTES, 'UTF-8'); ?></td>
                    <th>من تاريخ</th>
                    <td><?php echo htmlspecialchars($row['FromDate'], ENT_QUOTES, 'UTF-8'); ?></td>
                  </tr>
                  <tr>
                    <th>إلى تاريخ</th>
                    <td><?php echo htmlspecialchars($row['ToDate'], ENT_QUOTES, 'UTF-8'); ?></td>
                    <th>مدة الوقت</th>
                    <td><?php echo htmlspecialchars($row['TimeDuration'], ENT_QUOTES, 'UTF-8'); ?></td>
                  </tr>
                  <tr>
                    <th>وصف الحالة</th>
                    <td><?php echo htmlspecialchars($row['PatientDescrition'], ENT_QUOTES, 'UTF-8'); ?></td>
                    <th>تاريخ الحجز</th>
                    <td><?php echo htmlspecialchars($row['BookingDate'], ENT_QUOTES, 'UTF-8'); ?></td>
                  </tr>

                  <tr align="center">
                    <td colspan="4" style="font-size:20px; color:blue;">
                      تفاصيل الممرضة
                    </td>
                  </tr>

                  <tr>
                    <th>اسم الممرضة</th>
                    <td><?php echo htmlspecialchars($row['Name'], ENT_QUOTES, 'UTF-8'); ?></td>
                    <th>الجنس</th>
                    <td><?php echo htmlspecialchars($row['Gender'], ENT_QUOTES, 'UTF-8'); ?></td>
                  </tr>
                  <tr>
                    <th>البريد الإلكتروني</th>
                    <td><?php echo htmlspecialchars($row['Email'], ENT_QUOTES, 'UTF-8'); ?></td>
                    <th>رقم الجوال</th>
                    <td><?php echo htmlspecialchars($row['MobileNo'], ENT_QUOTES, 'UTF-8'); ?></td>
                  </tr>
                  <tr>
                    <th>العنوان</th>
                    <td><?php echo htmlspecialchars($row['Address'], ENT_QUOTES, 'UTF-8'); ?></td>
                    <th>المدينة</th>
                    <td><?php echo htmlspecialchars($row['City'], ENT_QUOTES, 'UTF-8'); ?></td>
                  </tr>
                  <tr>
                    <th>الولاية</th>
                    <td><?php echo htmlspecialchars($row['State'], ENT_QUOTES, 'UTF-8'); ?></td>
                    <th>اللغات المعروفة</th>
                    <td><?php echo htmlspecialchars($row['LanguagesKnown'], ENT_QUOTES, 'UTF-8'); ?></td>
                  </tr>
                  <tr>
                    <th>خبرة التمريض</th>
                    <td><?php echo htmlspecialchars($row['NursingExp'], ENT_QUOTES, 'UTF-8'); ?></td>
                    <th>شهادة التمريض</th>
                    <td><?php echo htmlspecialchars($row['NursingCertificate'], ENT_QUOTES, 'UTF-8'); ?></td>
                  </tr>
                  <tr>
                    <th>الوصف التعليمي</th>
                    <td><?php echo htmlspecialchars($row['EducationDescription'], ENT_QUOTES, 'UTF-8'); ?></td>
                    <th>صورة الملف الشخصي</th>
                    <td><img src="images/<?php echo htmlspecialchars($row['ProfilePic'], ENT_QUOTES, 'UTF-8'); ?>" width="120" alt="صورة الملف الشخصي"></td>
                  </tr>
                  <tr>
                    <th>حالة الطلب</th>
                    <td>
                      <?php  
                      if ($status == "Accepted") {
                        echo "تم قبول طلب الحجز";
                      } elseif ($status == "Rejected") {
                        echo "تم رفض طلب الحجز";
                      } else {
                        echo "في انتظار الموافقة";
                      }
                      ?>
                    </td>
                    <th>ملاحظات</th>
                    <td>
                      <?php  
                      if ($status == "") {
                        echo "في انتظار الموافقة";
                      } else {
                        echo htmlspecialchars($row['Remark'], ENT_QUOTES, 'UTF-8');
                      }
                      ?>
                    </td>
                  </tr>
                </table>
                <?php } ?>

                <?php if($status==""){ ?>
                <p align="center" style="padding-top: 20px;">                            
                  <button class="btn btn-primary waves-effect waves-light w-lg" data-toggle="modal" data-target="#myModal">اتخاذ إجراء</button>
                </p>  
                <?php } ?>

                <!-- مودال التحديث -->
                <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                  <div class="modal-dialog" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">اتخاذ إجراء</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="إغلاق">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body">
                        <form method="post" name="submit">
                          <table class="table table-bordered table-hover data-tables">
                            <tr>
                              <th>ملاحظات :</th>
                              <td><textarea name="remark" placeholder="أدخل ملاحظات" rows="6" cols="14" class="form-control wd-450" required="true"></textarea></td>
                            </tr>  
                            <tr>
                              <th>الحالة :</th>
                              <td>
                                <select name="status" class="form-control wd-450" required="true" >
                                  <option value="Accepted" selected="true">مقبول</option>
                                  <option value="Rejected">مرفوض</option>
                                </select>
                              </td>
                            </tr>
                          </table>
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">إغلاق</button>
                        <button type="submit" name="submit" class="btn btn-primary">تحديث</button>
                        </form>
                      </div>
                    </div>
                  </div>
                </div>

              </div> <!-- /.card-body -->
            </div> <!-- /.card -->
          </div> <!-- /.col -->
        </div> <!-- /.row -->
      </div> <!-- /.container-fluid -->
    </section> <!-- /.content -->
  </div> <!-- /.content-wrapper -->

  <?php include_once('includes/footer.php'); ?>

</div> <!-- ./wrapper -->

<!-- السكريبتات -->
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
