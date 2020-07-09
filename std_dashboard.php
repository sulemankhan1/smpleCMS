<?=include('includes/header.php')?>
<?php
if($_SESSION['type'] !== "student"){
  header("Location: index.php");
}
$_SESSION['pg_name'] = 'dashboard';
?>
<?=include('includes/sidebar.php')?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0 text-dark">Student Dashboard</h1>
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
            <div class="card-body">

          <a href="add_class.php" class="btn btn-app">
          <i class="fas fa-house-user"></i> Add class
          </a>
          <a href="all_classes.php" class="btn btn-app">
          <span class="badge bg-warning">3</span>
          <i class="fas fa-house-user"></i> All classes
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
