<?php

if (!isset($_POST['submit'])) {
    header("Location: ../signup.php");
    exit();
}

include_once 'db.include.php';

$first = mysqli_real_escape_string($connection, $_POST['first']);
$last = mysqli_real_escape_string($connection, $_POST['last']);
$email = mysqli_real_escape_string($connection, $_POST['email']);
$uid = mysqli_real_escape_string($connection, $_POST['uid']);
$pwd = mysqli_real_escape_string($connection, $_POST['pwd']);
// Error Handlers
if (empty($first) || empty($last) || empty($email) || empty($uid) || empty($pwd)) {
    header("Location: ../signup.php?signup=empty");
    exit();
} else {
    if (!preg_match("/[a-zA-Z]+/", $first) || !preg_match("/[a-zA-Z]+/", $last)) {
        header("Location: ../signup.php?signup=invalid_char");
        exit();
    } else {
        // Check if the email is valid.
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            header("Location: ../signup.php?signup=invalid_email&first=$first&last=$last&uid=$uid");
            exit();
        } else {
            $sql = "SELECT * from users where user_uid='$uid';";
            $sql_result = mysqli_query($connection, $sql);
            $result_check = mysqli_num_rows($sql_result);

            if ($result_check > 0) {
                header("Location: ../signup.php?signup=usertaken");
                exit();
            } else {
                // Hashing the Password
                $hashed_password = password_hash($pwd, PASSWORD_DEFAULT);
                // Insert the user into database
                $sql = "INSERT INTO `users` (`user_first`,`user_last`,`user_email`,`user_uid`,`user_pwd`) VALUES (?,?,?,?,?);";
                $stmt = mysqli_stmt_init($connection);
                if (!mysqli_stmt_prepare($stmt, $sql)) {
                    echo 'SQL Error: Cannot Insert to Database';
                } else {
                    mysqli_stmt_bind_param($stmt, "sssss", $first, $last, $email, $uid, $hashed_password);
                    mysqli_stmt_execute($stmt);
                    header("Location: ../signup.php?signup=success");
                    exit();
                }
            }
        }
    }
}
