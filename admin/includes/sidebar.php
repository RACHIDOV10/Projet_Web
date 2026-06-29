<aside class="main-sidebar sidebar-dark-primary elevation-4" dir="rtl" lang="ar">
  <!-- شعار الموقع -->
  <a href="dashboard.php" class="brand-link" style="text-align: right; display: block;">
  <span class="brand-text font-weight-light"> الإدارة</span>
</a>


  <div class="sidebar">
    <!-- لوحة المستخدم (اختياري) -->
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
      <div class="image">
        <img src="../dist/img/manager.png" class="img-circle elevation-2" alt="صورة المستخدم">
      </div>
      <div class="info">
        <a href="#" class="d-block"><?php echo htmlspecialchars($_SESSION['uname']); ?></a>
      </div>
    </div>

    <!-- قائمة التنقل الجانبية -->
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <!-- أضف أيقونات للروابط باستخدام فئة nav-icon مع font-awesome أو أي مكتبة أيقونات أخرى -->
        
        <li class="nav-item">
          <a href="dashboard.php" class="nav-link" style="text-align: right; display: block;">
            <i class="nav-icon fas fa-tachometer-alt"></i>
            <p>لوحة التحكم</p>
          </a>
        </li>

        <li class="nav-item has-treeview">
          <a href="#" class="nav-link"style="text-align: right; display: block;">
            <i class="nav-icon fas fa-users"></i>
            <p>
              الممرضون
              <i class="right fas fa-angle-left"></i>
            </p>
          </a>
          <ul class="nav nav-treeview" style="display: none;">
            <li class="nav-item">
              <a href="add-nurse.php" class="nav-link"style="text-align: right; display: block;">
                <i class="far fa-circle nav-icon"></i>
                <p>إضافة ممرض</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="manage-nurse.php" class="nav-link"style="text-align: right; display: block;">
                <i class="far fa-circle nav-icon"></i>
                <p>إدارة الممرضين</p>
              </a>
            </li>
          </ul>
        </li>

        <li class="nav-item has-treeview">
          <a href="#" class="nav-link"style="text-align: right; display: block;">
            <i class="nav-icon fas fa-file-medical"></i>
            <p>
              طلبات الممرضين
              <i class="right fas fa-angle-left"></i>
            </p>
          </a>
          <ul class="nav nav-treeview" style="display: none;">
            <li class="nav-item">
              <a href="all-request.php" class="nav-link"style="text-align: right; display: block;">
                <i class="far fa-circle nav-icon"></i>
                <p>جميع الطلبات</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="new-request.php" class="nav-link"style="text-align: right; display: block;">
                <i class="far fa-circle nav-icon"></i>
                <p>الطلبات الجديدة</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="accept-request.php" class="nav-link"style="text-align: right; display: block;">
                <i class="far fa-circle nav-icon"></i>
                <p>الطلبات المقبولة</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="reject-request.php" class="nav-link"style="text-align: right; display: block;">
                <i class="far fa-circle nav-icon"></i>
                <p>الطلبات المرفوضة</p>
              </a>
            </li>
          </ul>
        </li>

        <!-- التقارير -->
        <li class="nav-item has-treeview">
          <a href="#" class="nav-link"style="text-align: right; display: block;">
            <i class="nav-icon fas fa-chart-bar"></i>
            <p>
              التقارير
              <i class="right fas fa-angle-left"></i>
            </p>
          </a>
          <ul class="nav nav-treeview" style="display: none;">
            <li class="nav-item">
              <a href="bwdates-report-ds.php" class="nav-link"style="text-align: right; display: block;">
                <i class="far fa-calendar-alt nav-icon"></i>
                <p>بين تاريخين</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="search-report.php" class="nav-link"style="text-align: right; display: block;">
                <i class="fas fa-search nav-icon"></i>
                <p>بحث في التقارير</p>
              </a>
            </li>
          </ul>
        </li>

        <!-- إعدادات الحساب -->
        <li class="nav-item has-treeview">
          <a href="#" class="nav-link"style="text-align: right; display: block;">
            <i class="nav-icon fas fa-user-cog"></i>
            <p>
              إعدادات الحساب
              <i class="right fas fa-angle-left"></i>
            </p>
          </a>
          <ul class="nav nav-treeview" style="display: none;">
            <li class="nav-item">
              <a href="profile.php" class="nav-link"style="text-align: right; display: block;">
                <i class="far fa-user nav-icon"></i>
                <p>الملف الشخصي</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="change-password.php" class="nav-link"style="text-align: right; display: block;">
                <i class="fas fa-key nav-icon"></i>
                <p>تغيير كلمة المرور</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="logout.php" class="nav-link"style="text-align: right; display: block;">
                <i class="fas fa-sign-out-alt nav-icon"></i>
                <p>تسجيل الخروج</p>
              </a>
            </li>
          </ul>
        </li>

      </ul>
    </nav>
    <!-- /.sidebar-menu -->
  </div>
  <!-- /.sidebar -->
</aside>
