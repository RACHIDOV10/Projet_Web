<?php 
session_start();
error_reporting(0);
// الاتصال بقاعدة البيانات
include('includes/config.php');
?>
<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <title> الفريق</title>
   
    <script>
        addEventListener("load", function () {
            setTimeout(hideURLbar, 0);
        }, false);

        function hideURLbar() {
            window.scrollTo(0, 1);
        }
    </script>
    <!-- ملفات النمط المخصصة -->
    <link href="css/bootstrap.css" type="text/css" rel="stylesheet" media="all">
    <link href="css/style.css" type="text/css" rel="stylesheet" media="all">
    <!-- أيقونات font-awesome -->
    <link href="css/fontawesome-all.min.css" rel="stylesheet">
    <!-- //ملفات النمط المخصصة -->
    <!-- خطوط الإنترنت -->

    <link href="//fonts.googleapis.com/css?family=Lato:100,100i,300,300i,400,400i,700,700i,900,900i" rel="stylesheet">

    <style>
        body {
            direction: rtl;
            text-align: right;
        }
        .breadcrumb a {
            text-decoration: none;
        }
        .btn-block {
            width: 100%;
        }
    </style>
</head>

<body>
    <!-- البانر -->
    <div class="inner-banner" id="home">
        <!-- شريط التنقل -->
        <?php include_once("includes/navbar.php");?>
        <!-- //شريط التنقل -->
    </div>

    <!-- مسار الصفحات -->
    <nav aria-label="breadcrumb" class="bg-light py-2">
        <ol class="breadcrumb container">
            <li class="breadcrumb-item">
                <a href="index.php">الرئيسية</a>
            </li>
            <li class="breadcrumb-item active" aria-current="page">الفريق</li>
        </ol>
    </nav>

    <!-- قسم الفريق -->
    <section class="team-agile py-lg-5">
        <div class="container py-sm-5 pt-5 pb-0">
            <div class="title-section text-center pb-lg-5">
                <h4>عالم الطب</h4>
                <h3 class="w3ls-title text-center text-capitalize">فريق العمل الطبي</h3>
            </div>

            <?php 
            // التحقق من رقم الصفحة في الرابط
            if (isset($_GET['page_no']) && $_GET['page_no']!="") {
                $page_no = $_GET['page_no'];
            } else {
                $page_no = 1;
            }
         
            $total_records_per_page = 6;
            $offset = ($page_no-1) * $total_records_per_page;
            $previous_page = $page_no - 1;
            $next_page = $page_no + 1;
            $adjacents = "2"; 
         
            // حساب إجمالي السجلات
            $result_count = mysqli_query($con,"SELECT COUNT(ID) As total_records FROM tblnurse ");
            $total_records = mysqli_fetch_array($result_count);
            $total_records = $total_records['total_records'];
            $total_no_of_pages = ceil($total_records / $total_records_per_page);
            $second_last = $total_no_of_pages - 1; // آخر صفحة ناقص 1

            // جلب بيانات الممرضين
            $query=mysqli_query($con,"SELECT * FROM tblnurse LIMIT $offset, $total_records_per_page");
            ?>

            <div class="row">
            <?php
            // عرض الممرضين في البطاقات
            while($result=mysqli_fetch_array($query)){
            ?>
                <div class="col-md-4 mb-4">
                    <div class="card h-100 border">
                        <img src="admin/images/<?php echo $result['ProfilePic']?>" class="card-img-top" alt="team-img" />
                        <div class="card-body">
                            <h4 class="card-title"><?php echo $result['Name']?></h4>
                            <p class="card-text"><?php echo $result['EducationDescription']?></p>
                            <ul class="list-group list-group-flush mb-3">
                                <li class="list-group-item">
                                    <i class="far fa-check-square ml-2"></i> <?php echo $result['Address']?>
                                </li>
                                <li class="list-group-item">
                                    <i class="far fa-check-square ml-2"></i> الخبرة: <?php echo $result['NursingExp']?> سنوات
                                </li>
                            
                                <li class="list-group-item">
                                    <i class="far fa-check-square ml-2"></i> المدينة: <?php echo $result['City']?>
                                </li>
                                <li class="list-group-item">
                                    <i class="far fa-check-square ml-2"></i> اللغات المعروفة: <?php echo $result['LanguagesKnown']?>
                                </li>
                                <li class="list-group-item">
                                    <i class="far fa-check-square ml-2"></i> الشهادة: <?php echo $result['NursingCertificate']?>
                                </li>
                            </ul>
                            <a href="book-nurse.php?bookid=<?php echo $result['ID']?>" class="btn btn-primary btn-block">احجز موعدًا</a>
                        </div>
                    </div>
                </div>
            <?php } ?>
            </div>

            <!-- ترقيم الصفحات -->
            <nav aria-label="Page navigation example" class="mt-4">
                <ul class="pagination justify-content-center">
                    <li class="page-item <?php if($page_no <= 1){ echo 'disabled'; } ?>">
                        <a class="page-link" href="<?php if($page_no > 1){ echo "?page_no=$previous_page"; } else { echo '#'; } ?>">السابق</a>
                    </li>
                    <?php 
                    // منطق عرض أرقام الصفحات
                    if ($total_no_of_pages <= 10){       
                        for ($counter = 1; $counter <= $total_no_of_pages; $counter++){
                            if ($counter == $page_no) {
                               echo "<li class='page-item active'><a class='page-link'>$counter</a></li>";  
                            } else {
                               echo "<li class='page-item'><a class='page-link' href='?page_no=$counter'>$counter</a></li>";
                            }
                        }
                    }
                    elseif($total_no_of_pages > 10){
                        
                        if($page_no <= 4) {         
                         for ($counter = 1; $counter < 8; $counter++){       
                                if ($counter == $page_no) {
                               echo "<li class='page-item active'><a class='page-link'>$counter</a></li>";  
                                } else {
                               echo "<li class='page-item'><a class='page-link' href='?page_no=$counter'>$counter</a></li>";
                                }
                            }
                            echo "<li class='page-item disabled'><a class='page-link'>...</a></li>";
                            echo "<li class='page-item'><a class='page-link' href='?page_no=$second_last'>$second_last</a></li>";
                            echo "<li class='page-item'><a class='page-link' href='?page_no=$total_no_of_pages'>$total_no_of_pages</a></li>";
                        }
                 
                         elseif($page_no > 4 && $page_no < $total_no_of_pages - 4) {         
                            echo "<li class='page-item'><a class='page-link' href='?page_no=1'>1</a></li>";
                            echo "<li class='page-item'><a class='page-link' href='?page_no=2'>2</a></li>";
                            echo "<li class='page-item disabled'><a class='page-link'>...</a></li>";
                            for ($counter = $page_no - $adjacents; $counter <= $page_no + $adjacents; $counter++) {         
                               if ($counter == $page_no) {
                               echo "<li class='page-item active'><a class='page-link'>$counter</a></li>";  
                                    } else {
                               echo "<li class='page-item'><a class='page-link' href='?page_no=$counter'>$counter</a></li>";
                                    }                  
                           }
                           echo "<li class='page-item disabled'><a class='page-link'>...</a></li>";
                           echo "<li class='page-item'><a class='page-link' href='?page_no=$second_last'>$second_last</a></li>";
                           echo "<li class='page-item'><a class='page-link' href='?page_no=$total_no_of_pages'>$total_no_of_pages</a></li>";      
                        }
                        
                        else {
                            echo "<li class='page-item'><a class='page-link' href='?page_no=1'>1</a></li>";
                            echo "<li class='page-item'><a class='page-link' href='?page_no=2'>2</a></li>";
                            echo "<li class='page-item disabled'><a class='page-link'>...</a></li>";
                     
                            for ($counter = $total_no_of_pages - 6; $counter <= $total_no_of_pages; $counter++) {
                              if ($counter == $page_no) {
                               echo "<li class='page-item active'><a class='page-link'>$counter</a></li>";  
                                    } else {
                               echo "<li class='page-item'><a class='page-link' href='?page_no=$counter'>$counter</a></li>";
                                    }                   
                            }
                        }
                    }
                    ?>
                    <li class="page-item <?php if($page_no >= $total_no_of_pages){ echo 'disabled'; } ?>">
                        <a class="page-link" href="<?php if($page_no < $total_no_of_pages) { echo "?page_no=$next_page"; } else { echo '#'; } ?>">التالي</a>
                    </li>
                    <?php if($page_no < $total_no_of_pages){
                        echo "<li class='page-item'><a class='page-link' href='?page_no=$total_no_of_pages'>الأخير &rsaquo;&rsaquo;</a></li>";
                    } ?>
                </ul>
            </nav>
        </div>
    </section>

    <!-- الفوتر -->
    <?php include_once("includes/footer.php");?>
    <!-- //الفوتر -->

    <!-- مكتبة js -->
    <script src="js/jquery-2.2.3.min.js"></script>
    <!-- //js -->
    <!-- زر التواصل السريع -->
    <script>
        $(function () {
            var hidden = true;
            $(".heading").click(function () {
                if (hidden) {
                    $(this).parent('.outer-col').animate({
                        bottom: "0"
                    }, 1200);
                } else {
                    $(this).parent('.outer-col').animate({
                        bottom: "-305px"
                    }, 1200);
                }
                hidden = !hidden;
            });
        });
    </script>
    <!-- //زر التواصل السريع -->
    <!-- بداية أداة اختيار التاريخ -->
    <link rel="stylesheet" href="css/jquery-ui.css" />
    <script src="js/jquery-ui.js"></script>
    <script>
        $(function () {
            $("#datepicker,#datepicker1").datepicker();
        });
    </script>
    <!-- نهاية أداة اختيار التاريخ -->
    <!-- بداية التمرير السلس -->
    <script src="js/easing.js"></script>
    <script>
        jQuery(document).ready(function ($) {
            $(".scroll").click(function (event) {
                event.preventDefault();

                $('html,body').animate({
                    scrollTop: $(this.hash).offset().top
                }, 1000);
            });
        });
    </script>
    <script src="js/SmoothScroll.min.js"></script>
    <!-- نهاية التمرير السلس -->
    <!-- مكتبة Bootstrap -->
    <script src="js/bootstrap.js"></script>
</body>

</html>
