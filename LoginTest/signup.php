<?php
include_once 'header.php';
?>
<section class="main-container">
    <div class="container">
        <h2>Sign Up</h2>
        <form action="includes/signup.include.php" class="signup-form" method="POST">
            <input type="text" name="first" id="" placeholder="Firstname"><br>
            <input type="text" name="last" id="" placeholder="Lastname"><br>
            <input type="text" name="email" id="" placeholder="Email"><br>
            <input type="text" name="uid" id="" placeholder="Username"><br>
            <input type="password"  name="pwd" placeholder="Password"><br>
            <button type="submit"  name="submit">Sign Up</button>
        </form>
    </div>
</section>
<?php
include_once 'footer.php';
?>
