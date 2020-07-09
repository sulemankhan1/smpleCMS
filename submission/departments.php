<?php
session_start();
include('../includes/connection.php');
// ADD departments
if(isset($_POST['add_department'])) {

   // check if all fields are provided

   $fields = $_POST;
   $errors = [];
   if($fields['name'] === "") {
     $errors['name'] = "<p class='err text-danger'>Please provide name</p>";
   }
   if($fields['phone'] === "") {
     $errors['phone'] = "<p class='err text-danger'>Please provide phone</p>";
   }
   if($fields['address'] === "") {
     $errors['address'] = "<p class='err text-danger'>Please provide address</p>";
   }

   if(!empty($errors)) {
     $_SESSION['errors'] = $errors;
     $_SESSION['response'] = array(
       'type' => 'error',
       'msg' => "Please fix below issues first"
     );
     header("Location: ../add_department.php");
     exit;
   }


    $q = "INSERT INTO `departments`
        (`name`,  `phone`, `address`)
        VALUES
        ('".$_POST['name']."', ".$_POST['phone'].", '".$_POST['address']."')";


    if(mysqli_query($conn, $q) === false) {
        die("Error Found!");
    }

    $_SESSION['response'] = array(
      'type' => 'success',
      'msg' => "Department Added Successfully!"
    );

    header("Location: ../departments.php");
}

// UPDATE department
// DELETE department
