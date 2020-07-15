<?=include('includes/header.php')?>
<?php $_SESSION['pg_name'] = 'classes'; ?>
<?php
//if id exist or id is equal to
if(!isset($_GET['id']) || $_GET['id'] === 0) {

  // No user found with that id
  header("Location: all_classes.php");
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
          <h1 class="m-0 text-dark">Edit class</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
            <a href="all_classes.php" class="btn btn-default float-right"><i class="fa fa-arrow-left"></i> Back</a>
        </div>
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
  <!-- /.content-header -->
  <?php
      include("includes/connection.php");

      // getting all departments
      $q = "SELECT * FROM `classes`";
      $records = mysqli_query($conn, $q);
      if($records === FALSE) {
          echo mysqli_error();
          die("Something went wrong!");
      }

      // getting user record
      $q = "SELECT * FROM `classes` WHERE id =".$_GET['id'];
      $class = mysqli_query($conn, $q);
      if($class === FALSE) {
          echo mysqli_error();
          die("Something went wrong!");
      }

      if($class->num_rows === 0) {
        // No user found with that id
        header("Location: all_classes.php");
      }
      $class = $class->fetch_assoc();

      if(isset($_SESSION['errors']) && !empty($_SESSION['errors'])) {
        $errors = $_SESSION['errors'];
      }
  ?>
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
              <h3 class="card-title">Update class</h3>
            </div>
            <?php
              include("includes/connection.php");

              // Getting Users (Teaches)
              $q = "SELECT * FROM `courses` WHERE department_id = ".$_SESSION['department_id'];
              $courses = mysqli_query($conn, $q);
              if($courses === FALSE) {
                  echo mysqli_error();
                  die("Something went wrong!");
              }
              ?>
            <div class="card-body">
              <?php if(isset($_SESSION['response'])) { ?>
              <div class="callout callout-<?=($_SESSION['response']['type'] =='success')?'success':'danger'?>">
                  <h5><?=$_SESSION['response']['msg']?></h5>
                </div>
              <?php } ?>
              <form action="edit_class.php?id=<?=$_GET['id']?>" method="POST">
                <input type="hidden" name="id" value="<?=$class['id']?>">
                <div class="form-group">
                    <label>Select Course</label>
                    <select class="form-control" name="course_id">
                      <option value=""> -- Select Course -- </option>
                      <?php while($course = $courses->fetch_assoc()) { ?>
                        <option value="<?=$course['id']?>" <?=($course['id'] == $class['course_id'])?'selected':''?>><?=$course['name']?></option>
                      <?php } ?>
                    </select>
                    <?=(isset($errors['address']))?$errors['address']:""?>
                </div>
                  <div class="form-group">
                      <label>class Title</label>
                      <input type="text" name="Title" class="form-control" value="<?=$class['class_Title']?>">
                      <?=(isset($errors['Title']))?$errors['Title']:""?>
                  </div>
                  <div class="form-group">
                      <label>subject</label>
                      <input type="text" name="subject" class="form-control" value="<?=$class['subject']?>">
                      <?=(isset($errors['subject']))?$errors['subject']:""?>
                  </div>
                  <div class="form-group">
                      <label>description</label>
                      <textarea name="description" class="form-control" id="" cols="30" rows="10"><?=$class['description']?></textarea>
                      <?=(isset($errors['description']))?$errors['description']:""?>
                  </div>

                  <div class="form-group">
                      <input type="submit" class="btn btn-success" name="submit" value="Save class">
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



<!-- this is validation section -->

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
   if($fields['course_id'] === "") {
     $errors['course_id'] = "<p class='err'>Please Select Course</p>";
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
    $q .= ", course_id = '". $_POST['course_id'] ."'";
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
<?= include('includes/footer.php')?>
