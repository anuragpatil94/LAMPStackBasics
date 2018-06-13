<?php

include "keys.secret.php";

$host = "localhost";
$user = "root";
$password = $secretPassword;
$dbName = "loginTest";

$connection = mysqli_connect($host, $user, $password, $dbName);
