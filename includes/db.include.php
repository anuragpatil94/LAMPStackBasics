<?php

include "keys.secret.php";

$host = "localhost";
$user = "root";
$password = $secretPassword;
$dbName = "loginSystemTest";

$connection = mysqli_connect($host, $user, $password, $dbName);
