<?php
session_start();
$email = $_SESSION['user']['email'];
$username = $_SESSION['user']['username'];

if (!$_SESSION['user']) {
    header('Location: auth.php');
}

if (isset($_POST['logout'])) {
    unset($_SESSION['user']);
    header('Location: index.php');
}
?>



<!doctype html>
<html lang="en">
<?php
$page_title = 'Profile';
include 'templates/head.php'
?>

<body>
<header class="header center ndigo darken-2">
    <?php include 'templates/header.php'; ?>
</header>
<h4 class="center">My Profile</h4>

<div class="center">
    <h5><?php echo 'Email: ' . $email ?></h5>
    <h5><?php echo 'Username: ' . $username ?></h5>
    <button><a href="edit_profile.php">Edit</a></button>
</div>

<form action="" method="post">
    <button type="submit" id="logout" name="logout">Log out</button>
</form>


<footer>
<?php include 'templates/footer.php'; ?>
</footer>

</body>
</html>