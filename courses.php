<?=include('includes/header.php')?>
<?php
//  if($_SESSION['type'] === "student") {
//   header("Location: index.php");
//   exit;
// }
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
          <h1 class="m-0 text-dark">Courses</h1>
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
              <h3 class="card-title">All Courses </h3>
              <a href="add_department.php" class="btn  btn-outline-success btn-sm float-right"><i class="fa fa-plus"></i> Add Course</a>
            </div>
            <div class="card-body">
              <?php if(isset($_SESSION['response'])) { ?>
              <div class="callout callout-<?=($_SESSION['response']['type'] =='success')?'success':'danger'?>">
                  <h5><?=$_SESSION['response']['msg']?></h5>
                </div>
              <?php } ?>
              <?php
                  include("includes/connection.php");

                  $q = "SELECT `courses`.*, `users`.`name` as `teacher_name`, `departments`.`name` as `department_name` FROM `courses`
                  JOIN `users` ON `courses`.`teacher_id` = `users`.`id`
                  JOIN `departments` ON `courses`.`department_id` = `departments`.`id`
                  ";

                  $records = mysqli_query($conn, $q);

                  if($records === FALSE) {
                      echo mysqli_error();
                      die("Something went wrong!");
                  }
              ?>
              <table class="table table-bordered datable">
                  <thead>
                    <tr>
                        <th>ID </th>
                        <th>Name</th>
                        <th>Teacher</th>
                        <th>Department</th>
                        <?php if($_SESSION['type'] != 'student') { ?>
                          <th>Action</th>
                        <?php } ?>
                    </tr>
                  </thead>
                  <tbody>
                    <?php while($record = $records->fetch_assoc()) { ?>
                        <tr>
                            <td><?=$record['id']?></td>
                            <td><?=$record['name']?></td>
                            <td><?=$record['teacher_name']?></td>
                            <td><?=$record['department_name']?></td>
                            <?php if($_SESSION['type'] != 'student') { ?>
                              <td>
                                  <a href="edit_course.php?id=<?=$record['id']?>" class="btn btn-warning"><i class="fa fa-edit"></i> Edit</a>
                                  <a href="delete_course.php?id=<?=$record['id']?>" onclick="handleDelete(<?=$record['id']?>)" class="btn btn-danger"> Delete</a>
                              </td>
                            <?php } ?>
                        </tr>
                    <?php } ?>
                  </tbody>
              </table>

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

<script>
  function handleDelete(id) {
    let c = confirm('Are you sure')
    if(c) {
      window.open("edit_user.php?id="+id, "_self");
    }
  }
</script>

<?=include('includes/footer.php')?>
