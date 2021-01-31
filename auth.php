<?php

include 'db_connect.php';

$error = ['login' => '', 'pass' => '', 'incorrect_login' => '', 'incorrect_pass' => ''];

$login = $_POST['email'];
$password = $_POST['pass'];

if (isset($_POST['submit'])) {

    if (empty($login)) {
        $error['login'] =  'Email cannot be empty';
    }

    if (!filter_var($login, FILTER_VALIDATE_EMAIL)) {
        $error['login'] = 'Must be a valid email';
    }

    if (empty($password)) {
        $error['pass'] = 'Password cannot be empty';
    }

//login confirmation
    $sql = $connect->prepare("SELECT * FROM users WHERE user_email = '$login'");
    $sql->execute();

    $user_info = $sql -> fetch();

    if ($login === $user_info['user_email'] && password_verify($password, $user_info['user_password'])) {
        header("Location: index.php");
    } else {
        $error['incorrect_login'] = 'Incorrect login or password';
    }
}

?>


















<!doctype html>
<html lang="en">
<?php
    $page_title = 'Authorization';
    include 'templates/head.php'
?>

<body>
    <header class="header center ndigo darken-2">
       <?php include 'templates/header.php'; ?>
    </header>

    <div class="row center">
        <form class="col s12" action="" method="post">
            <div class="input-field">
            <input type="text" id="email" name="email" placeholder="Email"> <br>
                <div class="red-text"><?= $error['login'] ?></div>
                <div class="red-text"><?= $error['incorrect_login'] ?></div>
            </div>

            <div class="input-field">
            <input type="password" id="pass" name="pass" placeholder="Password">
                <div class="red-text"><?= $error['pass'] ?></div>
                <div class="red-text"><?= $error['incorrect_pass'] ?></div>
            </div>

            <button type="submit" id="submit" name="submit">Enter</button>
            <p>Don't have an account? <a href="register.php">Register</a></p>
        </form>
    </div>
    <footer>
        <?php include "templates/footer.php" ?>
    </footer>
</body>
</html>
