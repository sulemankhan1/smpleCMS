<?php
session_start();
unset($_SESSION['id']);
unset($_SESSION['name']);
unset($_SESSION['is_logged_in']);
header('Location: ../login.php');
 ?>
