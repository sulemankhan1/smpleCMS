<?php
session_start();
include('../includes/connection.php');
if(isset($_POST['add_class'])) {
  // check if all fields are provided

  $fields = $_POST;
  $errors = [];
  if($fields['class_Title'] === "") {
    $errors['class_Title'] = "<p class='err text-danger'>Please provide Class title</p>";
  }
  if($fields['subject'] === "") {
    $errors['subject'] = "<p class='err text-danger'>Please provide subject</p>";
  }
  if($fields['description'] === "") {
    $errors['description'] = "<p class='err text-danger'>Please provide description</p>";
  }
  if($fields['course_id'] === "") {
    $errors['course_id'] = "<p class='err text-danger'>Please Select a Course</p>";
  }

  if(!empty($errors)) {
    $_SESSION['errors'] = $errors;
    $_SESSION['response'] = array(
      'type' => 'error',
      'msg' => "Please fix below issues first"
    );
    header("Location: ../add_class.php");
    exit;
  }


   $q = "INSERT INTO `classes`
       (`class_Title`,  `subject`, `description`, `course_id`)
       VALUES
       ('".$_POST['class_Title']."', '".$_POST['subject']."', '".$_POST['description']."', '".$_POST['course_id']."')";


   if(mysqli_query($conn, $q) === false) {
       die("Error Found!");
   }

   $_SESSION['response'] = array(
     'type' => 'success',
     'msg' => "Class Added Successfully!"
   );

   header("Location: ../all_classes.php");
} ?>
