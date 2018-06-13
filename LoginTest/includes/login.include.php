<?php

session_start();

if (!isset($_POST['submit'])) {
    header("Location: ../index.php?login=error");
    exit();
}

include_once 'db.include.php';

$uid = mysqli_real_escape_string($connection, $_POST['uid']);
$pwd = mysqli_real_escape_string($connection, $_POST['pwd']);

// Error Handlers
if (empty($uid) || empty($pwd)) {
    header("Location: ../index.php?login=empty");
    exit();
} else {
    $sql = "SELECT * from users where user_uid='$uid' OR user_email='$uid';";
    $sql_result = mysqli_query($connection, $sql);
    $result_check = mysqli_num_rows($sql_result);

    if ($result_check < 1) {
        header("Location: ../index.php?login=error");
        exit();
    } else {
        if ($row = mysqli_fetch_assoc($sql_result)) {
            // Dehashing the password
            $hashedPasswordCheck = password_verify($pwd, $row[user_pwd]);
            if ($hashedPasswordCheck == false) {
                header("Location: ../index.php?login=error");
                exit();
            } else if ($hashedPasswordCheck == true) {
                // Log in the User
                $_SESSION['u_id'] = $row['user_id'];
                $_SESSION['u_first'] = $row['user_first'];
                $_SESSION['u_last'] = $row['user_last'];
                $_SESSION['u_email'] = $row['user_email'];
                $_SESSION['u_uid'] = $row['user_uid'];
                header("Location: ../index.php?login=success");
                exit();
            }
        }
    }
}
