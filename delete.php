<?php


echo $id = $_GET['id'];
    include('includes/connection.php');
	
 $qurey = "DELETE FROM users WHERE id={$id}";
 $result = mysqli_query($conn,$qurey) or die("unsuccessfull");
//	$_SESSION['message'] = "Address deleted!"; 
 	header('location: users.php');



