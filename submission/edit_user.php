<?php session_start();
include('../includes/connection.php');
if(isset($_POST['submit'])) {
   // check if all fields are provided
   $id = $_POST['id'];
   $fields = $_POST;
   $errors = [];
   if($fields['type'] === "") {
    $errors['type'] = "<p class='err'>Please provide type</p>";
  }
   if($fields['name'] === "") {
     $errors['name'] = "<p class='err'>Please provide name</p>";
   }
   if($fields['email'] === "") {
     $errors['email'] = "<p class='err'>Please provide email</p>";
   }
   if($fields['phone'] === "") {
     $errors['phone'] = "<p class='err'>Please provide phone</p>";
   }
   if($fields['address'] === "") {
     $errors['address'] = "<p class='err'>Please provide address</p>";
   }
    if($fields['department_id'] === "") {
     $errors['department_id'] = "<p class='err'>Please Select a department</p>";
   }

   // check if email is valid
   if(!filter_var($fields['email'], FILTER_VALIDATE_EMAIL)) {
     $errors['email'] = "<p class='err'>Please Provide a valid Email</p>";
   }

   if(!empty($errors)) {
     $_SESSION['errors'] = $errors;
     header("Location: ../edit_user.php?id=$id");
     exit;
   }

    $q = "UPDATE `users` SET";
    $q .= " `type` = '". $_POST['type']."'"; 
    $q .= ", `name` = '". $_POST['name']."'";
    $q .= ", email = '". $_POST['email'] ."'";
    $q .= ", phone = '". $_POST['phone'] ."'";
    $q .= ", address = '". $_POST['address'] ."'";
    $q .= ", department_id = ". $_POST['department_id'];
    $q .= " WHERE `users`.`id` = ". $id;

    if(mysqli_query($conn, $q) === false) {
        die("Error Found!");
    }

    if (mysqli_query($conn,$q) === true){
      
      $response = array(
        "type" => "success",
        "msg" => "user edited successfully"
      );
      $_SESSION['response'] = $response;
     header("location: ../users.php");
    }
      else{
      $response = array(
        "type" => "error",
        "msg" => "error occured!"
      );
      $_SESSION['response'] = $response;
      header("Location: ../edit_user.php?id=$id");
    }


    // add message for success user updated
    header("location: ../users.php");
}

if(isset($_SESSION['errors'])) {
    unset($_SESSION['errors']);
}
?>