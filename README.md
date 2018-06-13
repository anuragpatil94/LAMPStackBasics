# LAMPStackBasics

Understanding the Software Developement process with LAMP Stack.

## Contents

<!-- TOC -->

- [LAMPStackBasics](#lampstackbasics)
    - [Contents](#contents)
    - [System Configuration](#system-configuration)
    - [LAMP Server Setup](#lamp-server-setup)
        - [Steps to install the required libraries and software for LAMP](#steps-to-install-the-required-libraries-and-software-for-lamp)
        - [Starting server on boot](#starting-server-on-boot)
        - [Run PHP server in another workspace](#run-php-server-in-another-workspace)
    - [Database Connection](#database-connection)
    - [Login System Test](#login-system-test)
        - [Dummy Database Table](#dummy-database-table)
        - [Sign Up Form](#sign-up-form)
        - [Avoiding SQL Injection](#avoiding-sql-injection)
            - [Using MYSQLi](#using-mysqli)
            - [Prepared Statement](#prepared-statement)

<!-- /TOC -->

## System Configuration

- Ubuntu 18.04
- RAM 16GB

## LAMP Server Setup

### Steps to install the required libraries and software for LAMP

- Install Apache - `sudo apt-get install apache2`
- Verify Apache Server using `localhost` on browser
- Install MySQL - `sudo apt-get install mysql-server`
- Install PHP - `sudo apt-get install php`
- Install PHP Extensions - `sudo apt-get install -y php-{bcmath,bz2,intl,gd,mbstring,mysql,zip} && sudo apt-get install libapache2-mod-php`

### Starting server on boot

- `sudo systemctl enable apache2.service`
- `sudo systemctl enable mysql.service`

### Run PHP server in another workspace

- In the required folder - `php -S localhost:<port>`

## Database Connection

- USING MYSQL WORKBENCH

```PHP
// db.include.php
<?php

include "keys.secret.php"; //entry this to .gitignore

//Add all the following values to keys file and reference it here. (More Secure)

$host = "localhost";
$user = "root";
$password = $secretPassword;
$dbName = "loginSystemTest";

$connection = mysqli_connect($host, $user, $password, $dbName);
```

## Login System Test

### Dummy Database Table

```SQL
CREATE TABLE `loginSystemTest`.`users` (
user_id int(11) auto_increment primary key not null,
user_first varchar(256) not null,
user_last varchar(256) not null,
user_email varchar(256) not null,
user_uid varchar(256) not null,
user_pwd varchar(256) not null
);

INSERT INTO `loginSystemTest`.`users`
(
`user_first`,
`user_last`,
`user_email`,
`user_uid`,
`user_pwd`)
VALUES
('Jack','Ryan','jackryan@gmail.com','admin','test123');

INSERT INTO `loginSystemTest`.`users`
(
`user_first`,
`user_last`,
`user_email`,
`user_uid`,
`user_pwd`)
VALUES
('Jason','Bourne','jasbourn@gmail.com','jbourne','test123');
```

### Sign Up Form

```HTML
<!-- index.php -->
<form action="includes/signup.include.php" method="post">
    <input type="text" name="first" placeholder="Firstname"><br>
    <input type="text" name="last" placeholder="Lastname"><br>
    <input type="text" name="email" placeholder="EMail"><br>
    <input type="text" name="uid" placeholder="Username"><br>
    <input type="text" name="pwd" placeholder="Password"><br>
    <button type="submit" name="submit">Sign Up</button>
</form>
```

```PHP
//signup.include.php
<?php
include_once 'db.include.php';

$first = $_POST['first'];
$last = $_POST['last'];
$email = $_POST['email'];
$uid = $_POST['uid'];
$pwd = $_POST['pwd'];

// Insert data from users table
$sql = "INSERT INTO `users`
(`user_first`,`user_last`,`user_email`,`user_uid`,`user_pwd`) VALUES
('$first','$last','$email','$uid','$pwd');";
mysqli_query($connection, $sql);

// Get data from users table
$sql = "SELECT * FROM users;";
$result = mysqli_query($connection, $sql);

$resultCheck = mysqli_num_rows($result);
if ($resultCheck > 0) {
    while($row = mysqli_fetch_assoc($result)){
        echo $row['user_uid'] . "<br>";
    }
}


// Once this file is called by action method, to get back to the main page header is used
header("Location: ../index.php?signup=success");
```

### Avoiding SQL Injection

#### Using MYSQLi

```PHP
$first = mysqli_real_escape_string($connection, $_POST['first']);
```

#### Prepared Statement

```PHP
<!-- signup.include.php -->
// PREPARED STATEMENT
$data = "admin";
// GET DATA
$sql = "SELECT * FROM users WHERE user_uid=?;";

$stmt = mysqli_stmt_init($connection);
if (!mysqli_stmt_prepare($stmt, $sql)) {
    echo 'SQL Statement failed';
} else {
    // Bind parameters to the placeholders
    mysqli_stmt_bind_param($stmt, "s", $data);
    // Run parameters inside database
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    while ($row = mysqli_fetch_assoc($result)) {
        echo $row['user_uid'] . "<br>";
    }

}

// INSERT DATA
$sql = "INSERT INTO `users` (`user_first`,`user_last`,`user_email`,`user_uid`,`user_pwd`) VALUES (?,?,?,?,?);";
$stmt = mysqli_stmt_init($connection);
if (!mysqli_stmt_prepare($stmt, $sql)) {
    echo 'SQL Error';
} else {
    mysqli_stmt_bind_param($stmt, "sssss", $first, $last, $email, $uid, $pwd);
    mysqli_stmt_execute($stmt);
}
```
