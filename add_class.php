<?=include('includes/header.php')?>
<?php if($_SESSION['type'] === "student") {
  header("Location: index.php");
  exit;
}
$_SESSION['pg_name'] = 'classes';
?>
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
              <form action="submission/classes.php" method="post" >
                <div class="form-group">
                    <label>Select Course</label>
                    <select class="form-control" name="course_id">
                      <option value=""> -- Select Course -- </option>
                      <?php while($course = $courses->fetch_assoc()) { ?>
                        <option value="<?=$course['id']?>"><?=$course['name']?></option>
                      <?php } ?>
                    </select>
                    <?=(isset($errors['address']))?$errors['address']:""?>
                </div>
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
if(isset($_SESSION['errors'])) {
    unset($_SESSION['errors']);
}
 ?>
<?= include('includes/footer.php')?>
