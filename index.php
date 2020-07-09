
<?=include('includes/header.php')?>

<?php
if($_SESSION['type'] === "student"){
  header("Location: std_dashboard.php");
}
?>
<?=include('includes/sidebar.php')?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0 text-dark">Dashboard</h1>
          <?php
          // echo "<pre>";
          // print_r($_SESSION);
          // die();
          ?>

        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
  <!-- /.content-header -->

  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <!-- Main row -->
      <div class="row">
        <!-- Left col -->
        <section class="col-lg-12 connectedSortable">
          <!-- Application buttons -->

          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Pages</h3>
            </div>

            <div class="card-body">

              <a href="add_user.php" class="btn btn-app">
                <i class="fa fa-user-plus"></i> Add user
              </a>
              <a href="users.php" class="btn btn-app">
                <span class="badge bg-warning">3</span>
                <i class="fa fa-users"></i> All Users
              </a>
              <a href="add_department.php" class="btn btn-app">
                <i class="fa fa-address-book"></i> Add Department
              </a>
              <a href="submission/departments.php" class="btn btn-app">
                <span class="badge bg-purple">891</span>
                <i class="fa fa-address-card"></i> All Departments
              </a>

            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </section>
        <!-- /.Left col -->
      </div>
      <!-- /.row (main row) -->
    </div><!-- /.container-fluid -->
  </section>
  <!-- /.content -->
</div>
<?=include('includes/footer.php')?>
