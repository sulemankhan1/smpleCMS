<?php
session_start();
include('../includes/connection.php');
// ADD USER from admin side and check weather all fields is provided or not:
if(isset($_POST['add_user'])) {

   // check if all fields are provided
    $pp = $_FILES['profile_pic'];

    
   $fields = $_POST;
   $errors = [];
   if(!($pp['type'] === "image/jpeg" || $pp['type'] === "image/jpg" || $pp['type'] === "image/png")) {
    $errors['profile_pic'] = "<p class='err text-danger'>Invalid Profile picture</p>";
  }
   if($fields['name'] === "") {
     $errors['name'] = "<p class='err text-danger'>Please provide name</p>";
   }
   if($fields['type'] === "") {
    $errors['type'] = "<p class='err text-danger'>Please provide type</p>";
  }
   if($fields['email'] === "") {
     $errors['email'] = "<p class='err text-danger'>Please provide email</p>";
   }
   if($fields['phone'] === "") {
     $errors['phone'] = "<p class='err text-danger'>Please provide phone</p>";
   }
   if($fields['address'] === "") {
     $errors['address'] = "<p class='err text-danger'>Please provide address</p>";
   }
   if($fields['password'] === "") {
     $errors['password'] = "<p class='err text-danger'>Please provide password</p>";
   }
   if($fields['department_id'] === "") {
     $errors['department_id'] = "<p class='err text-danger'>Please Select a department</p>";
   }

   // check if email is valid
   if(!filter_var($fields['email'], FILTER_VALIDATE_EMAIL)) {
     $errors['email'] = "<p class='err text-danger'>Please Provide a valid Email</p>";
   }

   if(!empty($errors)) {
     $_SESSION['errors'] = $errors;
     $_SESSION['response'] = array(
       'type' => 'error',
       'msg' => "Please fix below issues first"
     );
     header("Location: ../add_user.php");
     exit;
   }
   
   // upload picture to the server
   move_uploaded_file($pp['tmp_name'], '../uploads/'.$pp['name']);

    $q = "INSERT INTO `users`
        (`profile_pic`,`type`,`name`, `email`, `password`, `phone`, `address`, `department_id`)
        VALUES
        ('".$pp['name']."', '".$_POST['type']."', '".$_POST['name']."', '".$_POST['email']."','".$_POST['password']."', ".$_POST['phone'].", '".$_POST['address']."', ".$_POST['department_id'].")";

    if(mysqli_query($conn, $q) === false) {
        die("Error Found!");
    }

    $_SESSION['response'] = array(
      'type' => 'success',
      'msg' => "User Added Successfully!"
    );

    header("Location: ../users.php");
}

// UPDATE USER

// DELETE USER from admin side:



   // //  to check the validation of LOGIN FORM
if(isset($_POST['login'])) {
  $fields = $_POST;
  // validate user
  $q = "SELECT * FROM `users` WHERE email =  '".$fields['email']."' ";
  $result = mysqli_query($conn, $q);
  $row = $result->fetch_assoc();
  if(empty($row)) {
    $response = "Invalid email or password";
    header('Location: ../login.php');
    exit;
  }

  // check password
  if($fields['password'] !== $row['password']) {
    $response = "Invalid email or password";
    header('Location: ../login.php');
    exit;
  }

  // create session array
  $_SESSION = array(
    'id' => $row['id'],
    'name' => $row['name'],
    'profile_pic' => $row['profile_pic'],
    'type' => $row['type'],
    'is_logged_in' => true
  );
  header('Location: ../index.php');
}

// REGISTER
if(isset($_POST['register'])) {
  // check if all fields are provided

  $fields = $_POST;
  $errors = [];
  if($fields['name'] === "") {
    $errors['name'] = "<p class='err text-danger'>Please provide name</p>";
  }
  if($fields['email'] === "") {
    $errors['email'] = "<p class='err text-danger'>Please provide email</p>";
  }
  if($fields['phone'] === "") {
    $errors['phone'] = "<p class='err text-danger'>Please provide phone</p>";
  }
  if($fields['address'] === "") {
    $errors['address'] = "<p class='err text-danger'>Please provide address</p>";
  }
  if($fields['password'] === "") {
    $errors['password'] = "<p class='err text-danger'>Please provide password</p>";
  }
  if($fields['cpassword'] === "") {
    $errors['cpassword'] = "<p class='err text-danger'>Please enter confirm password</p>";
  }

  // check if email is valid
  if(!filter_var($fields['email'], FILTER_VALIDATE_EMAIL)) {
    $errors['email'] = "<p class='err text-danger'>Please Provide a valid Email</p>";
  }

  // check if both passswords match
  if($fields['password'] !== $fields['cpassword']) {
    $errors['cpassword'] = "<p class='err text-danger'>Password doesn't match</p>";
  }

  // check if there is already an account with same email
  $q = "SELECT * FROM `users` WHERE email =  '".$fields['email']."' ";
  $result = mysqli_query($conn, $q);
  $row = $result->fetch_assoc();
  if(!empty($row)) {
    $errors['email'] = "<p class='err text-danger'>There is already an account with the same email</p>";
  }


  if(!empty($errors)) {
    $_SESSION['errors'] = $errors;
    header("Location: ../login.php");
    exit;
  }


   $q = "INSERT INTO `users`
       (`name`, `email`, `password`, `phone`, `address`)
       VALUES
       ('".$_POST['name']."', '".$_POST['email']."','".$_POST['password']."', ".$_POST['phone'].", '".$_POST['address']."')";


   if(mysqli_query($conn, $q) === false) {
       die("Error Found!");
   }

   $_SESSION['response'] = array(
     'type' => 'success',
     'msg' => "You have been Registered successfully!. You can login now."
   );

   //to check weather the students are login or admin:
   $_SESSION['type'] = array(
     'types' => 'admin'
   );

   header("Location: ../login.php");
}
?>
