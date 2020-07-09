
<?=include('includes/header.php')?>
<?=include('includes/sidebar.php')?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0 text-dark">classes</h1>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
  <!-- /.content-header -->

  <!-- Main content -->
  <section class="content">

  <?php
      include("includes/connection.php");

      $q = "SELECT * FROM `student_classes`";


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
              <h3 class="card-title">All classes </h3>
              <a href="add_class.php" class="btn  btn-outline-success btn-sm float-right"><i class="fa fa-plus"></i> Add class</a>
            </div>
            <div class="card-body">
              <?php if(isset($_SESSION['response'])) { ?>
              <div class="callout callout-<?=($_SESSION['response']['type'] =='success')?'success':'danger'?>">
                  <h5><?=$_SESSION['response']['msg']?></h5>
                </div>
              <?php } ?>
              <table class="table table-bordered datable">
                  <thead>
                    <tr>
                        <th>ID</th>
                        <th>class Title</th>
                        <th>subject</th>
                        <th>description</th>
                        <th>date_created</th>
                        <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>

                  <?php while($record = $records->fetch_assoc()) { ?>
                        <tr>
                             <td><?=$record['id']?></td>
                            <td><?=$record['class_Title']?></td>
                            <td><?=$record['subject']?></td>
                            <td><?=$record['description']?></td>
                            <td><?=$record['date_created']?></td>
                            <td>
                                <a href="edit_class.php?id=<?=$record['id']?>" class="btn btn-warning"><i class="fa fa-edit"></i> Edit</a>
                                <a href="delete_classes.php?id=<?=$record['id']?>" onclick="handleDelete(<?=$record['id']?>)" class="btn btn-danger"> Delete</a>
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
      window.open("edit_class.php?id="+id, "_self");
    }
  }
</script>

<?=include('includes/footer.php')?>
