<?php
session_start();
include('../includes/connection.php');
// ADD departments
if(isset($_POST['add_course'])) {

   // check if all fields are provided

   $fields = $_POST;
   $errors = [];
   if($fields['name'] === "") {
     $errors['name'] = "<p class='err text-danger'>Please provide name</p>";
   }
   if($fields['teacher_id'] === "") {
     $errors['teacher_id'] = "<p class='err text-danger'>Please Select Teacher</p>";
   }
   if($fields['department_id'] === "") {
     $errors['department_id'] = "<p class='err text-danger'>Please Select Department</p>";
   }

   if(!empty($errors)) {
     $_SESSION['errors'] = $errors;
     $_SESSION['response'] = array(
       'type' => 'error',
       'msg' => "Please fix below issues first"
     );
     header("Location: ../add_course.php");
     exit;
   }


    $q = "INSERT INTO `courses`
        (`name`,  `teacher_id`, `department_id`)
        VALUES
        ('".$_POST['name']."', ".$_POST['teacher_id'].", '".$_POST['department_id']."')";

    if(mysqli_query($conn, $q) === false) {
        die("Error Found!");
    }

    $_SESSION['response'] = array(
      'type' => 'success',
      'msg' => "Course Added Successfully!"
    );

    header("Location: ../courses.php");
}


if(isset($_POST['update_course'])) {

   // check if all fields are provided
   $id = $_POST['id'];
   $fields = $_POST;
   $errors = [];
   if($fields['name'] === "") {
     $errors['name'] = "<p class='err text-danger'>Please provide name</p>";
   }
   if($fields['teacher_id'] === "") {
     $errors['teacher_id'] = "<p class='err text-danger'>Please Select Teacher</p>";
   }

   if($fields['department_id'] === "") {
     $errors['department_id'] = "<p class='err text-danger'>Please Select Department</p>";
   }

   if(!empty($errors)) {
     $_SESSION['errors'] = $errors;
     $_SESSION['response'] = array(
       'type' => 'error',
       'msg' => "Please fix below issues first"
     );
     header("Location: ../add_course.php");
     exit;
   }

    $q = "UPDATE `courses` SET";
    $q .= " `name` = '". $_POST['name']."'";
    $q .= ", teacher_id = '". $_POST['teacher_id'] ."'";
    $q .= ", department_id = '". $_POST['department_id'] ."'";
    $q .= " WHERE `courses`.`id` = ". $id;

    if(mysqli_query($conn, $q) === false) {
        die("Error Found!");
    }

    if (mysqli_query($conn,$q) === true){

      $response = array(
        "type" => "success",
        "msg" => " Course Updated  successfully"
      );
      $_SESSION['response'] = $response;
     header("location: ../courses.php");
     exit;
    }
      else{
      $response = array(
        "type" => "error",
        "msg" => "error occured!"
      );
      $_SESSION['response'] = $response;
      header("location : ../edit_course.php");
      exit;
    }

}
