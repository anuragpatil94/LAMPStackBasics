<?php
include_once 'header.php';
?>
<section class="main-container">
    <div class="container">
        <h2>Home</h2>
        <?php
if (isset($_SESSION['u_id'])) {
    echo 'You are Logged In';
}
?>
    </div>
</section>
<?php
include_once 'footer.php';
?>
