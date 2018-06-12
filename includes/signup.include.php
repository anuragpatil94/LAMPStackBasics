<?php

include_once 'db.include.php';

// USING MYSQLI for SQL Injection
$first = mysqli_real_escape_string($connection, $_POST['first']);
$last = mysqli_real_escape_string($connection, $_POST['last']);
$email = mysqli_real_escape_string($connection, $_POST['email']);
$uid = mysqli_real_escape_string($connection, $_POST['uid']);
$pwd = mysqli_real_escape_string($connection, $_POST['pwd']);

// Insert data from users table
// $sql = "INSERT INTO `users`
// (`user_first`,`user_last`,`user_email`,`user_uid`,`user_pwd`)
// VALUES
// ('$first','$last','$email','$uid','$pwd');";
// mysqli_query($connection, $sql);

// Get data from users table
/*$sql = "SELECT * FROM users;";
$result = mysqli_query($connection, $sql);

$resultCheck = mysqli_num_rows($result);
if ($resultCheck > 0) {
while($row = mysqli_fetch_assoc($result)){
echo $row['user_uid'] . "<br>";
}
}*/

// PREPARED STATEMENT
// $data = "admin";
// GET DATA
// $sql = "SELECT * FROM users WHERE user_uid=?;";

// $stmt = mysqli_stmt_init($connection);
// if (!mysqli_stmt_prepare($stmt, $sql)) {
//     echo 'SQL Statement failed';
// } else {
//     // Bind parameters to the placeholders
//     mysqli_stmt_bind_param($stmt, "s", $data);
//     // Run parameters inside database
//     mysqli_stmt_execute($stmt);
//     $result = mysqli_stmt_get_result($stmt);

//     while ($row = mysqli_fetch_assoc($result)) {
//         echo $row['user_uid'] . "<br>";
//     }

// }

// INSERT DATA
$sql = "INSERT INTO `users` (`user_first`,`user_last`,`user_email`,`user_uid`,`user_pwd`) VALUES (?,?,?,?,?);";
$stmt = mysqli_stmt_init($connection);
if (!mysqli_stmt_prepare($stmt, $sql)) {
    echo 'SQL Error';
} else {
    mysqli_stmt_bind_param($stmt, "sssss", $first, $last, $email, $uid, $pwd);
    mysqli_stmt_execute($stmt);
}

// Once this file is called by action method, to get back to the main page header is used
header("Location: ../index.php?signup=success");
