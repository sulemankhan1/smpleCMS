<?=include('includes/header.php')?>
<?=include('includes/sidebar.php')?>
<?php 
//if id exist or id is equal to
if(!isset($_GET['id']) || $_GET['id'] === 0) {

  // No user found with that id
  header("Location: all_classes.php");
}
?>
<html>
<head>
    <!-- <link rel="stylesheet" href="assets/bootstrap.min.css" /> -->
    <style>
      .err {
        color: "purple";
        
      }
    </style>
</head>
<body>

    <?php
        include("includes/connection.php");
        
        // getting all departments
        $q = "SELECT * FROM `student_classes`";
        $records = mysqli_query($conn, $q);
        if($records === FALSE) {
            echo mysqli_error();
            die("Something went wrong!");
        }

        // getting user record
        $q = "SELECT * FROM `student_classes` WHERE id =".$_GET['id'];
        $user = mysqli_query($conn, $q);
        if($user === FALSE) {
            echo mysqli_error();
            die("Something went wrong!");
        }

        if($user->num_rows === 0) {
          // No user found with that id
          header("Location: all_classes.php");
        }
        $user = $user->fetch_assoc();

        if(isset($_SESSION['errors']) && !empty($_SESSION['errors'])) {
          $errors = $_SESSION['errors'];
        }
    ?>

    <div class="container">
        <h1>Edit class</h1>
        <div class="panel panel-default">
            <div class="panel-heading"  >
                Update classes
            </div>
            <div class='panel-body'>
            <?php if(isset($_SESSION['response']) && $_SESSION['response']['type'] == "error" ) { ?>
                <div class="alert alert-danger">
                  <?=$_SESSION['response']['msg']?>
                </div>
                <?php } ?>
             
                <div class="col-md-6">
                <form action="edit_class.php?id=<?=$_GET['id']?>" method="POST">
                  <input type="hidden" name="id" value="<?=$user['id']?>">
                    <div class="form-group">
                        <label>class Title</label>
                        <input type="text" name="Title" class="form-control" value="<?=$user['Title']?>">
                        <?=(isset($errors['Title']))?$errors['Title']:""?>
                    </div>
                    <div class="form-group">
                        <label>subject</label>
                        <input type="text" name="subject" class="form-control" value="<?=$user['subject']?>">
                        <?=(isset($errors['subject']))?$errors['subject']:""?>
                    </div>
                    <div class="form-group">
                        <label>description</label>
                        <textarea name="description" class="form-control" id="" cols="30" rows="10"><?=$user['description']?></textarea>
                        <?=(isset($errors['description']))?$errors['description']:""?>
                    </div>
                    <div class="form-group">
                        <label>date</label>
                        <textarea name="date_created" class="form-control" id="" cols="30" rows="10"><?=$user['date_created']?></textarea>
                        <?=(isset($errors['date_created']))?$errors['date_created']:""?>
                    </div>
                    

                    <div class="form-group">
                        <input type="submit" class="btn btn-success" name="submit" value="Save class">
                    </div>
                </form>
                </div>
            </div>
        </div>
        <a href="all_classes.php">Back</a>
    </div>

</body>
</html>

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
        "type" => "sucess",
        "msg" => " department updated  sucessfully"
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