<?php 
session_start(); // بدء الجلسة
error_reporting(0); // إخفاء الأخطاء
include('includes/config.php'); // تضمين ملف الإعدادات وقاعدة البيانات

// التحقق إذا تم إرسال النموذج
if(isset($_POST['submit']))
{
    // استلام معرف الممرضة من الرابط
    $nbid=$_GET['bookid'];

    // استلام بيانات الحجز من النموذج
    $contactname=$_POST['contactname'];
    $contphonenum=$_POST['contphonenum'];
    $contemail=$_POST['contemail'];
    $fromdate=$_POST['fromdate'];
    $todate=$_POST['todate'];
    $timeduration=$_POST['timeduration'];
    $patientdesc=$_POST['patientdesc'];

    // إنشاء رقم حجز عشوائي
    $bookingid=mt_rand(100000000, 999999999);

    // التحقق من توفر الممرضة في التواريخ المطلوبة
    $ret=mysqli_query($con,"SELECT * FROM tblbooking 
        WHERE ('$fromdate' BETWEEN date(FromDate) AND date(ToDate) 
        OR '$todate' BETWEEN date(FromDate) AND date(ToDate) 
        OR date(FromDate) BETWEEN '$fromdate' AND '$todate') 
        AND NurseID='$nbid' AND Status='Accepted'");

    $count=mysqli_num_rows($ret);

    // إذا كانت الممرضة متاحة
    if($count==0){
        // إدخال بيانات الحجز في قاعدة البيانات
        $query=mysqli_query($con,"INSERT INTO tblbooking(BookingID,NurseID,ContactName,ContactNumber,ContactEmail,FromDate,ToDate,TimeDuration,PatientDescrition) 
            VALUES('$bookingid','$nbid','$contactname','$contphonenum','$contemail','$fromdate','$todate','$timeduration','$patientdesc')");
        
        if($query){
            // نجاح العملية
            echo '<script>alert("تم إرسال طلب الحجز بنجاح، سنتواصل معك قريباً.")</script>';
            echo "<script type='text/javascript'> document.location = 'team.php'; </script>";
        } else {
            // فشل الإدخال
            echo "<script>alert('حدث خطأ أثناء الإرسال. حاول مرة أخرى.');</script>";
        }
    } else {
        // الممرضة غير متاحة
        echo "<script>alert('الممرضة غير متاحة في هذه التواريخ.');</script>";
    }
}
?>
<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <title>نظام حجز الممرضات | تفاصيل الحجز</title>
    <!-- ملفات التصميم -->
    <link href="css/bootstrap.css" type="text/css" rel="stylesheet">
    <link href="css/style.css" type="text/css" rel="stylesheet">
    <link href="css/fontawesome-all.min.css" rel="stylesheet">
    <link href="//fonts.googleapis.com/css?family=Cairo:400,700&display=swap" rel="stylesheet">
    <style>
        /* ضبط الخط والاتجاه للنصوص */
        body { font-family: 'Cairo', sans-serif; text-align: right; }
        label { float: right; }
        input, textarea, select { direction: rtl; text-align: right; }
        .breadcrumb { justify-content: flex-end; }
    </style>
</head>
<body>
    <!-- البانر العلوي -->
    <div class="inner-banner" id="home">
        <?php include_once("includes/navbar.php");?>
    </div>

    <!-- مسار التنقل -->
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
        </ol>
    </nav>

    <!-- قسم الحجز -->
    <section class="team-agile py-lg-5">
        <div class="container py-sm-5 pt-5 pb-0">
            <div class="title-section text-center pb-lg-5">
                <h4>عالم الطب</h4>
                <h3 class="w3ls-title text-center">حجز ممرض(ة)</h3>
            </div>

            <div class="row mt-5 pb-lg-5">
                <div class="col-md-8 team-text mt-md-0 mt-5">
                    <!-- نموذج حجز الممرضة -->
                    <form action="#" method="post">
                        <div class="form-group">
                            <label for="contactname">الاسم الكامل</label>
                            <input type="text" class="form-control" placeholder="أدخل اسمك الكامل" name="contactname" id="contactname" required>
                        </div>

                        <div class="form-group">
                            <label for="contphonenum">رقم الجوال</label>
                            <input type="text" class="form-control" placeholder="أدخل رقم الجوال" name="contphonenum" id="contphonenum" required>
                        </div>

                        <div class="form-group">
                            <label for="contemail">البريد الإلكتروني</label>
                            <input type="email" class="form-control" placeholder="أدخل بريدك الإلكتروني" name="contemail" id="contemail" required>
                        </div>

                        <div class="form-group">
                            <label for="fromdate">تاريخ البداية</label>
                            <input type="date" class="form-control" id="fromdate" name="fromdate" required>
                        </div>

                        <div class="form-group">
                            <label for="todate">تاريخ النهاية</label>
                            <input type="date" class="form-control" id="todate" name="todate" required>
                        </div>

                        <div class="form-group">
                            <label for="timeduration">مدة العمل</label>
                            <input type="text" class="form-control" id="timeduration" name="timeduration" placeholder="مثال: 8 ساعات يومياً" required>
                        </div>

                        <div class="form-group">
                            <label for="patientdesc">وصف حالة المريض</label>
                            <textarea class="form-control" name="patientdesc" id="patientdesc" placeholder="أدخل تفاصيل حالة المريض" required></textarea>
                        </div>

                        <button type="submit" class="btn btn-primary" name="submit">إرسال طلب الحجز</button>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <!-- تذييل الصفحة -->
    <?php include_once("includes/footer.php");?>

    <!-- ملفات الجافاسكربت -->
    <script src="js/jquery-2.2.3.min.js"></script>
    <script src="js/bootstrap.js"></script>
</body>
</html>
