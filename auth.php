<?php

include 'db_connect.php';

$error = ['login' => '', 'pass' => '', 'pass_confirm' => '', 'incorrect_login' => '', 'incorrect_pass' => ''];

$login = $_POST['email'];
$password = $_POST['pass'];
$pass_confirm = $_POST['pass_confirm'];




if (isset($_POST['submit'])) {

    if (empty($login))
    {
        $error['login'] =  'Email cannot be empty';
    }

    if (!filter_var($login, FILTER_VALIDATE_EMAIL))
    {
        $error['login'] = 'Must be a valid email';
    }

    if (empty($password))
    {
        $error['pass'] = 'Password cannot be empty';
    }

    if (empty($pass_confirm))
    {
        $error['pass_confirm'] = 'Password must be confirmed';
    }

//login confirmation
    $sql = $connect->prepare("SELECT * FROM users 
WHERE user_email = '$login'");
    $sql->execute();

    $user_info = $sql -> fetch();


    if ($password === $pass_confirm) {

        if ($login === $user_info['user_email'] and password_verify($password, $user_info['user_password'])) {
            header("Location: index.php");
        } else {
            $error['incorrect_login'] = 'Incorrect login or password';

        }
    } else
    {
        $error['pass_confirm'] = 'Passwords doesn\'t match';
    }







}


?>


















<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <title>Authorisation</title>
</head>
<body>

<header class="header center ndigo darken-2">
   <?php include 'templates/header.php'; ?>
</header>


<div class="row center" >
<form class="col s12" action="" method="post">

    <div class="input-field">
    <input type="text" id="email" name="email" placeholder="Email"> <br>
        <div class="red-text"><?php echo $error['login'] ?></div>
        <div class="red-text"><?php echo $error['incorrect_login'] ?></div>
    </div>

    <div class="input-field">
    <input type="password" id="pass" name="pass" placeholder="Password">
        <div class="red-text"><?php echo $error['pass'] ?></div>
        <div class="red-text"><?php echo $error['incorrect_pass'] ?></div>


    </div>

    <div class="input-field">
        <input type="password" id="pass_confirm" name="pass_confirm" placeholder="Confirm the password">
        <div class="red-text"><?php echo $error['pass_confirm'] ?></div>
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
