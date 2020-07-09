<?=include('includes/header.php')?>
<?php if($_SESSION['type'] === "student") {
  header("Location: index.php");
  exit;
}
$_SESSION['pg_name'] = 'users';
?>
<?=include('includes/sidebar.php')?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0 text-dark">Edit User</h1>
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

        // getting all departments
        $q = "SELECT * FROM `departments`";
        $records = mysqli_query($conn, $q);
        if($records === FALSE) {
            echo mysqli_error();
            die("Something went wrong!");
        }

        // getting user record
        $q = "SELECT * FROM `users` WHERE id =".$_GET['id'];
        $user = mysqli_query($conn, $q);
        if($user === FALSE) {
            echo mysqli_error();
            die("Something went wrong!");
        }

        if($user->num_rows === 0) {
          // No user found with that id
          header("Location: users.php");
        }
        $user = $user->fetch_assoc();

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
              <h3 class="card-title">Update User </h3>
            </div>
            <div class="card-body">
              <?php if(isset($_SESSION['response'])) { ?>
              <div class="callout callout-<?=($_SESSION['response']['type'] =='success')?'success':'danger'?>">
                  <h5><?=$_SESSION['response']['msg']?></h5>
                </div>
              <?php } ?>
              <form action="submission/edit_user.php?id=<?=$_GET['id']?>" method="POST" enctype="multipart/form-data">
                  <input type="hidden" name="id" value="<?=$user['id']?>">
                  <?php if($user['profile_pic'] !== "") { ?>
                    <a href="<?='uploads/'.$user['profile_pic']?>" target="_blank">
                        <img src="<?='uploads/'.$user['profile_pic']?>" class="img img-thumbnail" width="100">
                    </a>
                  <?php } ?>
                    <input type="hidden" name="old_profile_pic" value="<?=$user['profile_pic']?>">
                    <div class="form-group">
                        <label>Change Profile Pic</label>
                        <input type="file" name="profile_pic" class="form-control" value="<?=$user['profile_pic']?>">
                        <?=(isset($errors['profile_pic']))?$errors['profile_pic']:""?>
                    </div>
                    <div class="form-group">
                        <label>type</label>
                        <select name="type" class="form-control">
                            <option value=""> -- select -- </option>
                            <option value="student" <?=($user['type'] === "student")?"selected":""?>>Student</option>
                            <option value="teacher" <?=($user['type'] === "teacher")?"selected":""?>>Teacher</option>
                            <option value="admin" <?=($user['type'] === "admin")?"selected":""?>>Admin</option>
                        </select>
                        <?=(isset($errors['type']))?$errors['type']:""?>
                    </div>
                    <div class="form-group">
                        <label>Username</label>
                        <input type="text" name="name" class="form-control" value="<?=$user['name']?>">
                        <?=(isset($errors['name']))?$errors['name']:""?>
                    </div>
                    <div class="form-group">
                        <label>Email</label>
                        <input type="text" name="email" class="form-control" value="<?=$user['email']?>">
                        <?=(isset($errors['email']))?$errors['email']:""?>
                    </div>
                    <div class="form-group">
                        <label>Phone</label>
                        <input type="text" name="phone" class="form-control" value="<?=$user['phone']?>">
                        <?=(isset($errors['phone']))?$errors['phone']:""?>
                    </div>
                    <div class="form-group">
                        <label>Address</label>
                        <textarea name="address" class="form-control" id="" cols="30" rows="10"><?=$user['address']?></textarea>
                        <?=(isset($errors['address']))?$errors['address']:""?>
                    </div>
                    <div class="form-group">
                        <label>Departments</label>
                        <select name="department_id" class="form-control">
                            <option value=""> -- select -- </option>
                            <?php while($record = $records->fetch_assoc()) { ?>
                                <option value="<?=$record['id']?>" <?=($record['id'] === $user['department_id'])?"selected":""?> ><?=$record['name']?></option>
                            <?php } ?>
                        </select>
                        <?=(isset($errors['department_id']))?$errors['department_id']:""?>
                    </div>
                    <div class="form-group">
                        <input type="submit" class="btn btn-success" name="submit" value="Save user">
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
