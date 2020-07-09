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
          <h1 class="m-0 text-dark">Add User</h1>
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

      $q = "SELECT * FROM `departments`";

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
              <h3 class="card-title">Create a New User </h3>
            </div>
            <div class="card-body">
              <?php if(isset($_SESSION['response'])) { ?>
              <div class="callout callout-<?=($_SESSION['response']['type'] =='success')?'success':'danger'?>">
                  <h5><?=$_SESSION['response']['msg']?></h5>
                </div>
              <?php } ?>
              <form action="submission/users.php" method="post" enctype="multipart/form-data">
              <div class="form-group">
                      <label>Profile pic</label>
                      <input type="file" name="profile_pic" class="form-control <?=(isset($errors['profile_pic']))?"is-invalid":""?>" >
                      <?=(isset($errors['profile_pic']))?$errors['profile_pic']:""?>
                  </div>
                  <div class="form-group">
                        <label>User Type</label>
                        <select name="type" class="form-control">
                        <option value="admin">Admin</option>
                         <option value="student">Student</option>
                         <option value="teacher">Teacher</option>

                        </select>
                    </div>
              <div class="form-group">
                      <label>Username</label>
                      <input type="text" name="name" class="form-control <?=(isset($errors['name']))?"is-invalid":""?>" >
                      <?=(isset($errors['name']))?$errors['name']:""?>
                  </div>
                  <div class="form-group">
                      <label>Email</label>
                      <input type="text" name="email" class="form-control <?=(isset($errors['email']))?"is-invalid":""?>">
                      <?=(isset($errors['email']))?$errors['email']:""?>
                  </div>
                  <div class="form-group">
                      <label>Password</label>
                      <input type="password" name="password" class="form-control <?=(isset($errors['password']))?"is-invalid":""?>">
                      <?=(isset($errors['password']))?$errors['password']:""?>
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
                      <label>Departments</label>
                      <select name="department_id" class="form-control <?=(isset($errors['department_id']))?"is-invalid":""?>">
                          <option value=""> -- select -- </option>
                          <?php while($record = $records->fetch_assoc()) { ?>
                              <option value="<?=$record['id']?>"><?=$record['name']?></option>
                          <?php } ?>
                      </select>
                      <?=(isset($errors['department_id']))?$errors['department_id']:""?>
                  </div>
                  <div class="form-group">
                      <input type="submit" class="btn btn-success" name="add_user" value="Save User">
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
