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
          <h1 class="m-0 text-dark">DEPARTMENTS</h1>
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
              <h3 class="card-title">All DEPARTMENTS </h3>
              <a href="add_department.php" class="btn  btn-outline-success btn-sm float-right"><i class="fa fa-plus"></i> Add DEPARTMENT</a>
            </div>
            <div class="card-body">
              <?php if(isset($_SESSION['response'])) { ?>
              <div class="callout callout-<?=($_SESSION['response']['type'] =='success')?'success':'danger'?>">
                  <h5><?=$_SESSION['response']['msg']?></h5>
                </div>
              <?php } ?>
              <?php
                  include("includes/connection.php");

                  $q = "SELECT * FROM `departments`";

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
                        <th>Phone</th>
                        <th>Address</th>
                        <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php while($record = $records->fetch_assoc()) { ?>
                        <tr>
                            <td><?=$record['id']?></td>
                            <td><?=$record['name']?></td>
                            <td><?=$record['phone']?></td>
                            <td><?=$record['address']?></td>

                            <td>
                                <a href="edit_department.php?id=<?=$record['id']?>" class="btn btn-warning"><i class="fa fa-edit"></i> Edit</a>
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
