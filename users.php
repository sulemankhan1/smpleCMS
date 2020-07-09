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
          <h1 class="m-0 text-dark">Users</h1>
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
              <h3 class="card-title">All Users </h3>
              <a href="add_user.php" class="btn  btn-outline-success btn-sm float-right"><i class="fa fa-plus"></i> Add User</a>
            </div>
            <div class="card-body">
              <?php if(isset($_SESSION['response'])) { ?>
              <div class="callout callout-<?=($_SESSION['response']['type'] =='success')?'success':'danger'?>">
                  <h5><?=$_SESSION['response']['msg']?></h5>
                </div>
              <?php } ?>
              <?php
                  include("includes/connection.php");

                  $q = "SELECT `users`.*, `departments`.`name` as `dept_name` FROM `users`
                  LEFT OUTER JOIN `departments` ON `users`.`department_id` = `departments`.`id`";

                  $records = mysqli_query($conn, $q);

                  if($records === FALSE) {
                      echo mysqli_error();
                      die("Something went wrong!");
                  }
              ?>
              <table class="table table-bordered datable">
                  <thead>
                    <tr>
                        <th>ID</th>
                        <th>Profile Pic</th>
                        <th>type</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Address</th>
                        <th>Department Name</th>
                        <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php while($record = $records->fetch_assoc()) { ?>
                        <tr>
                            <td><?=$record['id']?></td>
                            <td>
                              <?php if($record['profile_pic'] == "") { ?>
                                <img src="<?='uploads/default.png'?>" width="100">
                              <?php } else { ?>
                                <a href="<?='uploads/'.$record['profile_pic']?>" target="_blank">
                                  <img src="<?='uploads/'.$record['profile_pic']?>" width="100">
                                </a>
                              <?php } ?>
                            </td>
                            <td><?=$record['type']?></td>
                            <td><?=$record['name']?></td>
                            <td><?=$record['email']?></td>
                            <td><?=$record['phone']?></td>
                            <td><?=$record['address']?></td>
                            <td><?=($record['dept_name'])?$record['dept_name']:" - "?></td>
                            <td>
                                <a href="edit_user.php?id=<?=$record['id']?>" class="btn btn-warning"><i class="fa fa-edit"></i> Edit</a>
                                <a href="delete.php?id=<?=$record['id']?>" onclick="handleDelete(<?=$record['id']?>)" class="btn btn-danger"> Delete</a>
                            </td>
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
