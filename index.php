<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <title> الصفحة الرئيسية</title>
    
    <script>
        // تشغيل دالة إخفاء شريط العنوان عند تحميل الصفحة
        addEventListener("load", function () {
            setTimeout(hideURLbar, 0);
        }, false);

        function hideURLbar() {
            window.scrollTo(0, 1);
        }
    </script>
    <!-- ملفات التصميم المخصصة -->
    <link href="css/bootstrap.css" type="text/css" rel="stylesheet" media="all">
    <link href="css/style.css" type="text/css" rel="stylesheet" media="all">
    <!-- أيقونات font-awesome -->
    <link href="css/fontawesome-all.min.css" rel="stylesheet">
    <!-- //ملفات التصميم المخصصة -->
    <!-- خطوط أونلاين -->
    <link href="//fonts.googleapis.com/css?family=Lato:100,100i,300,300i,400,400i,700,700i,900,900i" rel="stylesheet">
    <style>
        /* إضافة إعدادات للاتجاه من اليمين لليسار في حال لم يدعمه ملف CSS */
        body {
            direction: rtl;
            text-align: right;
        }
        .banner-text span, .banner-text h3 {
            text-align: right;
        }
        /* تعديل الهوامش أو المسافات إذا لزم الأمر */
    </style>
</head>

<body>
    <!-- بانر -->
    <div class="banner" id="home">
        <!-- رأس الصفحة -->
        <?php include_once("includes/navbar.php");?>
        <!-- //رأس الصفحة -->
        <div class="container">
            <!-- نص البانر -->
            <div class="banner-text">
                <div class="callbacks_container">
                    <ul class="rslides" id="slider3">
                        <li>
                           <div class="slider-info">
    <div class="badge-title">✦ نظام رعاية صحية متكامل</div>
    <h3>نوفر حلولاً كاملة</h3>
    <div class="divider"></div>
    <h2>لرعاية صحية متميزة</h2>
    <p class="sub-text">خدمات طبية على أعلى مستوى من الجودة والاحترافية</p>
    <a href="team.php" class="btn-banner">اكتشف فريقنا <i class="fas fa-arrow-left"></i></a>
</div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <!-- //نهاية الحاوية -->
    </div>
    <!-- //بانر -->
    
    <!-- قسم التعريف -->
    <div class="agileits-about py-md-5 py-5" id="services">
        <div class="container py-lg-5">
            <div class="title-section text-center pb-md-5">
                <h4>نظام توظيف الممرضين عبر الإنترنت</h4>
                <h3 class="w3ls-title text-center text-capitalize">مستشفى يمكنك الوثوق به</h3>
            </div>
            <div class="agileits-about-row row text-center pt-md-0 pt-5">
                <div class="col-lg-4 col-sm-6 agileits-about-grids">
                    <div class="p-md-5 p-sm-3">
                        <i class="fas fa-user-md"></i>
                        <h4 class="mt-2 mb-3">معالج</h4>
                        <p>نقدم أفضل الرعاية من خلال فريق متخصص ومحترف</p>
                    </div>
                </div>
                <div class="col-lg-4 col-sm-6 agileits-about-grids border-left border-right my-sm-0 my-5">
                   <div class="p-md-5 p-sm-3">
                        <i class="fas fa-thermometer"></i>
                        <h4 class="mt-2 mb-3">المختبر</h4>
                        <p>نتيح خدمات فحص دقيقة وموثوقة للمرضى</p>
                    </div>
                </div>
                <div class="col-lg-4 agileits-about-grids">
                   <div class="p-md-5 p-sm-3">
                        <i class="far fa-hospital"></i>
                        <h4 class="mt-2 mb-3">الجراحة</h4>
                        <p>نقدم عمليات جراحية بأعلى مستويات السلامة والدقة</p>
                    </div>
                </div>
            </div>
            <div class="agileits-about-row border-top row text-center pb-lg-5 pt-md-0 pt-5 mt-md-0 mt-5">
                <div class="col-lg-4 col-sm-6 agileits-about-grids">
                    <div class="p-md-5 p-sm-3 col-label">
                        <i class="fas fa-hospital-symbol"></i>
                        <h4 class="mt-2 mb-3">الزراعة</h4>
                        <p>نوفر أحدث تقنيات الزراعة الطبية للمرضى</p>
                    </div>
                </div>
                <div class="col-lg-4 col-sm-6 agileits-about-grids mt-lg-0 mt-md-3 border-left border-right pt-sm-0 pt-5">
                    <div class="p-md-5 p-sm-3 col-label">
                        <i class="fas fa-ambulance"></i>
                        <h4 class="mt-2 mb-3">رعاية الطوارئ</h4>
                        <p>خدمات الطوارئ متوفرة على مدار الساعة بأفضل كفاءة</p>
                    </div>
                </div>
                <div class="col-lg-4 agileits-about-grids pt-md-0 pt-5">
                    <div class="p-md-5 p-sm-3 col-label">
                        <i class="fa fa-user-md"></i>
                        <h4 class="mt-2 mb-3">الأورام</h4>
                        <p>فريق متخصص في علاج الأورام بدقة واهتمام</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- //قسم التعريف -->

    <!-- تذييل الصفحة -->
    <?php include_once("includes/footer.php");?>
    <!-- //تذييل الصفحة -->

    <!-- ملفات الجافاسكربت هنا... (بدون تغيير) -->

</body>

</html>
