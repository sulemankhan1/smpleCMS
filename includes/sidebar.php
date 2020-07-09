<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
  <!-- Brand Logo -->
  <a href="index.php" class="brand-link">
    <img src="dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
         style="opacity: .8">
    <span class="brand-text font-weight-light">AdminLTE 3</span>
  </a>

  <!-- Sidebar -->
  <div class="sidebar">


    <!-- Sidebar Menu -->
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <!-- Add icons to the links using the .nav-icon class
             with font-awesome or any other icon font library -->
        <li class="nav-header">Pages</li>
        <li class="nav-item <?=($_SESSION['pg_name'] == 'dashboard')?'menu-open':''?>">
          <a href="index.php" class="nav-link <?=($_SESSION['pg_name'] == 'dashboard')?'active':''?>" onclick="triger_page_change(dashboard)">
            <i class="nav-icon far fa-calendar-alt"></i>
            <p>
              Dashboard

            </p>
          </a>
        </li>
        <li class="nav-item has-treeview <?=($_SESSION['pg_name'] == 'courses')?'menu-open':''?>">
          <a href="#" class="nav-link <?=($_SESSION['pg_name'] == 'courses')?'active':''?>">
            <i class="nav-icon far fa-envelope"></i>
            <p>
              Courses
              <i class="fas fa-angle-left right"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="add_course.php" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Add Course</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="courses.php" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>All Courses</p>
              </a>
            </li>
          </ul>
        </li>
        <?php if($_SESSION['type'] === "teacher") { ?>
          <li class="nav-item has-treeview <?=($_SESSION['pg_name'] == 'departments')?'menu-open':''?>">
            <a href="#" class="nav-link <?=($_SESSION['pg_name'] == 'departments')?'active':''?>">
              <i class="nav-icon far fa-envelope"></i>
              <p>
                Departments
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="add_department.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Add Department</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="departments.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>All Departments</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item has-treeview <?=($_SESSION['pg_name'] == 'users')?'menu-open':''?>">
            <a href="#" class="nav-link <?=($_SESSION['pg_name'] == 'users')?'active':''?>">
              <i class="nav-icon far fa-envelope"></i>
              <p>
                Users
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="add_user.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Add User</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="users.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>All Users</p>

                </a>
              </li>
            </ul>
          </li>
        <?php } ?>

        <li class="nav-item has-treeview <?=($_SESSION['pg_name'] == 'classes')?'menu-open':''?>">
          <a href="#" class="nav-link <?=($_SESSION['pg_name'] == 'classes')?'active':''?>">
            <i class="nav-icon far fa-envelope"></i>
            <p>
              Classes
              <i class="fas fa-angle-left right"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <?php if($_SESSION['type'] === "teacher") { ?>
              <li class="nav-item">
                <a href="add_class.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Add Class</p>
                </a>
              </li>
            <?php } ?>
            <li class="nav-item">
              <a href="all_classes.php" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>All Classes</p>
              </a>
            </li>
          </ul>
        </li>
      </ul>

    </nav>
    <!-- /.sidebar-menu -->
    <? } ?>
  </div>
  <!-- /.sidebar -->

</aside>
