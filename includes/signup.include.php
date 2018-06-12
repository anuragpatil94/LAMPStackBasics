<?php

include_once 'db.include.php';

$first = $_POST['first'];
$last = $_POST['last'];
$email = $_POST['email'];
$uid = $_POST['uid'];
$pwd = $_POST['pwd'];

// Insert data from users table
$sql = "INSERT INTO `users`
(
`user_first`,
`user_last`,
`user_email`,
`user_uid`,
`user_pwd`)
VALUES
('$first','$last','$email','$uid','$pwd');";
mysqli_query($connection, $sql);

// Get data from users table
/*$sql = "SELECT * FROM users;";
$result = mysqli_query($connection, $sql);

$resultCheck = mysqli_num_rows($result);
if ($resultCheck > 0) {
while($row = mysqli_fetch_assoc($result)){
echo $row['user_uid'] . "<br>";
}
}*/

// Once this file is called by action method, to get back to the main page header is used
header("Location: ../index.php?signup=success");
