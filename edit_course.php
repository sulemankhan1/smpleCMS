<?=include('includes/header.php')?>
<?php if($_SESSION['type'] === "student") {
  header("Location: index.php");
  exit;
}
$_SESSION['pg_name'] = 'courses';
?>
<?=include('includes/sidebar.php')?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0 text-dark">Edit course</h1>
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

        // Getting Users (Teaches)
        $q = "SELECT * FROM `users` WHERE type = 'teacher'";
        $teachers = mysqli_query($conn, $q);
        if($teachers === FALSE) {
            echo mysqli_error();
            die("Something went wrong!");
        }

        // getting user record
        $q = "SELECT * FROM `courses` WHERE id =".$_GET['id'];
        $course = mysqli_query($conn, $q);
        if($course === FALSE) {
            echo mysqli_error();
            die("Something went wrong!");
        }

        if($course->num_rows === 0) {
          // No user found with that id
          header("Location: courses.php");
        }
        $course = $course->fetch_assoc();

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
              <h3 class="card-title">Update Course </h3>
            </div>
            <div class="card-body">
              <?php if(isset($_SESSION['response'])) { ?>
              <div class="callout callout-<?=($_SESSION['response']['type'] =='success')?'success':'danger'?>">
                  <h5><?=$_SESSION['response']['msg']?></h5>
                </div>
              <?php } ?>
              <form action="submission/courses.php" method="post">
                <input type="hidden" name="id" value="<?=$course['id']?>">
                  <div class="form-group">
                      <label>Course Name</label>
                      <input type="text" name="name" class="form-control <?=(isset($errors['name']))?"is-invalid":""?>" value="<?=$course['name']?>">
                      <?=(isset($errors['name']))?$errors['name']:""?>
                  </div>
                  <div class="form-group">
                      <label>Select Teacher</label>
                      <select class="form-control" name="teacher_id">
                        <option value=""> -- select Teacher -- </option>
                        <?php while($user = $teachers->fetch_assoc()) { ?>
                          <option value="<?=$user['id']?>" <?=($user['id'] == $course['teacher_id'])?'selected':''?>><?=$user['name']?></option>
                        <?php } ?>
                      </select>
                      <?=(isset($errors['address']))?$errors['address']:""?>
                  </div>
                  <div class="form-group">
                      <input type="submit" class="btn btn-success" name="update_course" value="Save department">
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


if(isset($_POST['submit'])) {

   // check if all fields are provided
   $id = $_POST['id'];
   $fields = $_POST;
   $errors = [];
   if($fields['name'] === "") {
     $errors['name'] = "<p class='err'>Please provide name</p>";
   }
   if($fields['phone'] === "") {
     $errors['phone'] = "<p class='err'>Please provide phone</p>";
   }
   if($fields['address'] === "") {
     $errors['address'] = "<p class='err'>Please provide address</p>";
   }


   if(!empty($errors)) {
     $_SESSION['errors'] = $errors;
     header("Location: edit_department.php?id=$id");
     exit;
   }

    $q = "UPDATE `departments` SET";
    $q .= " `name` = '". $_POST['name']."'";
    $q .= ", phone = '". $_POST['phone'] ."'";
    $q .= ", address = '". $_POST['address'] ."'";
    $q .= " WHERE `departments`.`id` = ". $id;

    if(mysqli_query($conn, $q) === false) {
        die("Error Found!");
    }

    if (mysqli_query($conn,$q) === true){

      $response = array(
        "type" => "success",
        "msg" => " department updated  successfully"
      );
      $_SESSION['response'] = $response;
     header("location: departments.php");
    }
      else{
      $response = array(
        "type" => "error",
        "msg" => "error occured!"
      );
      $_SESSION['response'] = $response;
      header("location : edit_department.php");
    }


    // add message for success user updated
    header("location: departments.php");
}

if(isset($_SESSION['errors'])) {
    unset($_SESSION['errors']);
}
 ?>

<?=include('includes/footer.php')?>
