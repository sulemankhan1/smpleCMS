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
          <h1 class="m-0 text-dark">Add class</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
            <a href="all_classes.php" class="btn btn-default float-right"><i class="fa fa-arrow-left"></i> Back</a>
        </div>
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
              <h3 class="card-title">Create a New class</h3>
            </div>
            <div class="card-body">
              <?php if(isset($_SESSION['response'])) { ?>
              <div class="callout callout-<?=($_SESSION['response']['type'] =='success')?'success':'danger'?>">
                  <h5><?=$_SESSION['response']['msg']?></h5>
                </div>
              <?php } ?>
              <form action="submission/classes.php" method="post" >
              <div class="form-group">
                      <label>class Title</label>
                      <input type="text" name="class_Title" class="form-control <?=(isset($errors['class_Title']))?"is-invalid":""?>" >
                      <?=(isset($errors['class_Title']))?$errors['class_Title']:""?>
                  </div>
                  <div class="form-group">
                      <label>subject</label>
                      <input type="text" name="subject" class="form-control <?=(isset($errors['subject']))?"is-invalid":""?>">
                      <?=(isset($errors['subject']))?$errors['subject']:""?>
                  </div>
                  <div class="form-group">
                      <label>description</label>
                      <textarea name="description" class="form-control <?=(isset($errors['description']))?"is-invalid":""?>" rows="8" cols="80"></textarea>
                      <?=(isset($errors['description']))?$errors['description']:""?>
                  </div>

                  <div class="form-group">
                      <input type="submit" class="btn btn-success" name="add_class" value="Save class">
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
// ADD USER from admin side and check weather all fields is provided or not:

// if(isset($_POST['add_class'])) {
//   // check if all fields are provided
//
//   $fields = $_POST;
//   $errors = [];
//   if($fields['class_Title'] === "") {
//     $errors['class_Title'] = "<p class='err text-danger'>Please provide class Title</p>";
//   }
//   if($fields['subject'] === "") {
//     $errors['subject'] = "<p class='err text-danger'>Please provide subject</p>";
//   }
//   if($fields['description'] === "") {
//     $errors['description'] = "<p class='err text-danger'>Please provide description</p>";
//   }
//   if($fields['date_created'] === "") {
//     $errors['date_created'] = "<p class='err text-danger'>Please provide date of creation of class</p>";
//   }
//
//
//   if(!empty($errors)) {
//     $_SESSION['errors'] = $errors;
//     header("Location: add_class.php");
//     exit;
//   }
//
//
//    $q = "INSERT INTO `student_classes`
//        (`class_Title`, `subject`, `description`, `date_created`)
//        VALUES
//        ('".$_POST['class_Title']."', '".$_POST['subject']."','".$_POST['description']."', '".$_POST['date_created']."')";
//
//
//    if(mysqli_query($conn, $q) === false) {
//        die("Error Found!");
//    }
//
//    $_SESSION['response'] = array(
//      'type' => 'success',
//      'msg' => "class have been added successfully successfully!. "
//    );

?>

<?php
if(isset($_SESSION['errors'])) {
    unset($_SESSION['errors']);
}
 ?>
<?= include('includes/footer.php')?>
