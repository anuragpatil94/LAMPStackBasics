<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Login System Test</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="./public/css/main.css" />
    <script src="main.js"></script>
</head>
<body>

<div class="form">
<form action="includes/signup.include.php" method="post">
<?php
if (isset($_GET['first'])) {
    echo '<input type="text" class="form-element" name="first" placeholder="Firstname" value="$_GET[\'first\']"><br>';
} else {
    echo '<input type="text" class="form-element" name="first" placeholder="Firstname"><br>';
}
if (isset($_GET['last'])) {
    echo '<input type="text" class="form-element" name="last" placeholder="Lastname" value="$_GET[\'last\']"><br>';
} else {
    echo '<input type="text" class="form-element" name="last" placeholder="Lastname"><br>';
}
?>

        <input type="text" class="form-element" name="email" placeholder="Email"><br>
<?php
if (isset($_GET['uid'])) {
    echo '<input type="text" class="form-element" name="uid" placeholder="Username" value="$_GET[\'uid\']"><br>';
} else {
    echo '<input type="text" class="form-element" name="uid" placeholder="Username"><br>';
}
?>
        <input type="password" class="form-element" name="pwd" placeholder="Password"><br>
        <button type="submit" class="btn" name="submit">Sign Up</button>
    </form>

<?php
/*
$fullURL = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

if (strpos($fullURL, "signup=empty") == true) {
echo "<p class='error'>You did not fill in all fields!</p>";
exit();
} else if (strpos($fullURL, "signup=char") == true) {
echo "<p class='error'>Invalid Characters in Firstname or Lastname !</p>";
exit();
} else if (strpos($fullURL, "signup=invalid_email") == true) {
echo "<p class='error'>Invalid Email!</p>";
exit();
} else if (strpos($fullURL, "signup=success") == true) {
echo "<p class='success'>Successfully Signed up!</p>";
exit();
}*/

if (!isset($_GET['signup'])) {
    exit();
} else {
    $signupCheck = $_GET['signup'];

    if ($signupCheck == "empty") {
        echo "<p class='error'>You did not fill in all fields!</p>";
        exit();
    } else if ($signupCheck == "char") {
        echo "<p class='error'>Invalid Characters in Firstname or Lastname !</p>";
        exit();
    } else if ($signupCheck == "invalid_email") {
        echo "<p class='error'>Invalid Email!</p>";
        exit();
    } else if ($signupCheck == "success") {
        echo "<p class='success'>Successfully Signed up!</p>";
        exit();
    }
}

?>
</div>

</body>
</html>
