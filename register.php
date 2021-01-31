<?php
include 'db_connect.php';

$username = $_POST['username'];
$email = $_POST['email'];
$password =  $_POST['pass'];
$hashed_pass = password_hash($password, PASSWORD_DEFAULT);

$error = ['username' => '', 'email' => '', 'password' => ''];





if(isset($_POST['submit'])) {

    if (empty($username)) {
        $error['username'] =  'Username cannot be empty <br>';
    }

    if (empty($email)) {
        $error['email'] =  'Email cannot be empty <br>';
    } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        //$error['email'] = 'Must be a valid email';
    }

    if (empty($password)) {
        $error['password'] = 'Password cannot be empty';
    }



// insert data into database
    $sql = $connect -> prepare("INSERT INTO users (user_email, user_name, user_password) VALUES 
('$email', '$username', '$hashed_pass')");
    $sql -> execute();




header("Location: index.php");

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
    <title>Registration</title>
</head>
<body>
    <header class="header center ndigo darken-2">
        <?php include 'templates/header.php'; ?>
    </header>

    <div class="row center">
        <form class="col s12"  method="post">
            <div class="input-field">
                <input type="email" id="email" name="email" placeholder="Email">
                <div class="red-text"><?php echo $error['email'] ?> </div>
            </div>

            <div class="input-field">
                <input type="text" id="username" name="username" placeholder="Username">
                <div class="red-text"><?php echo $error['username'] ?> </div>
            </div>

            <div class="input-field">
                <input type="password" id="pass" name="pass" placeholder="Password">
                <div class="red-text"><?php echo $error['password'] ?> </div>
            </div>

            <button type="submit" id="submit" name="submit">Register</button>
        </form>

        <p>Already have an account? <a href="auth.php">Enter</a></p>
    </div>

    <footer>
        <?php include "templates/footer.php" ?>
    </footer>
</body>
</html>