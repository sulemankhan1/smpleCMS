<?php

$id = $_GET['id'];
   include('includes/connection.php');
	
 $qurey = "DELETE FROM student_classes WHERE id={$id}";
 $result = mysqli_query($conn,$qurey);
//	$_SESSION['message'] = "Address deleted!"; 
	header('location: all_classes.php');
