<?php

include('db_credentials.php');

$conn = mysqli_connect($server, $username, $password, $db_name);

if(!$conn) {
    die("Connection Error!");
}

