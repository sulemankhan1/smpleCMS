<?=include('includes/header.php')?>
<?php if($_SESSION['type'] === "student") {
  header("Location: index.php");
  exit;
} ?>
<?=include('includes/sidebar.php')?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0 text-dark">ADD DEPARTMENT</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
            <a href="users.php" class="btn btn-default float-right"><i class="fa fa-arrow-left"></i> Back</a>
        </div>
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
  <!-- /.content-header -->

  <!-- Main content -->
  <section class="content">
    <?php
      include("includes/connection.php");

      $q = "SELECT * FROM `users`";

      $records = mysqli_query($conn, $q);

      if($records === FALSE) {
          echo mysqli_error();
          die("Something went wrong!");
      }

      $errors = array();
      if(isset($_SESSION['errors']) && !empty($_SESSION['errors'])) {
        $errors = $_SESSION['errors'];
      }

    ?>

    <div class="container-fluid">
      <!-- Main row -->
      <div class="row">
        <!-- Left col -->
        <section class="col-lg-12 connectedSortable">
          <!-- Application buttons -->
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Create a New department </h3>
            </div>
            <div class="card-body">
              <?php if(isset($_SESSION['response'])) { ?>
              <div class="callout callout-<?=($_SESSION['response']['type'] =='success')?'success':'danger'?>">
                  <h5><?=$_SESSION['response']['msg']?></h5>
                </div>
              <?php } ?>
              <form action="submission/departments.php" method="post">
                  <div class="form-group">
                      <label>department name</label>
                      <input type="text" name="name" class="form-control <?=(isset($errors['name']))?"is-invalid":""?>" >
                      <?=(isset($errors['name']))?$errors['name']:""?>
                  </div>
                 <div class="form-group">
                      <label>Phone</label>
                      <input type="text" name="phone" class="form-control <?=(isset($errors['phone']))?"is-invalid":""?>">
                      <?=(isset($errors['phone']))?$errors['phone']:""?>
                  </div>
                  <div class="form-group">
                      <label>Address</label>
                      <textarea name="address" class="form-control <?=(isset($errors['address']))?"is-invalid":""?>" cols="30" rows="10"></textarea>
                      <?=(isset($errors['address']))?$errors['address']:""?>
                  </div>
                  <div class="form-group">
                      <input type="submit" class="btn btn-success" name="add_department" value="Save department">
                  </div>
              </form>
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

<?php
if(isset($_SESSION['errors'])) {
    unset($_SESSION['errors']);
}
 ?>

<?=include('includes/footer.php')?>
