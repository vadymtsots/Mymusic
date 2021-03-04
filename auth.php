<?php
session_start();
include 'db_connect.php';

$error = [
    'email' => '',
    'pass' => '',
    'incorrect_login' => '',
];

/* $login = $_POST['email'];
$password = $_POST['pass'];
*/

$req = $_REQUEST;

if (isset($req['submit'])) {
    $error['email'] = empty($req['email']) ? 'Email cannot be empty <br>' : '';
    $error['pass'] = empty($req['pass']) ? 'Password cannot be empty <br>' : '';

//login confirmation
    $sql = "SELECT * FROM users WHERE user_email = ?";
    $stmt = $connect -> prepare($sql);
    $stmt->execute([$req['email']]);

    $user_info = $stmt -> fetch();

    if ($req['email'] === $user_info['user_email'] && password_verify($req['pass'], $user_info['user_password'])) {
        header("Location: index.php");
    } else {
        $error['incorrect_login'] = 'Incorrect login or password';
    }
    $_SESSION['user'] = [
            "id" => $user_info['id'],
            "email" => $user_info['user_email'],
            "username" => $user_info['user_name']
    ];



    header('Location: index.php');
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
                <div class="red-text"><?= $error['email'] ?></div>
                <div class="red-text"><?= $error['incorrect_login'] ?></div>
            </div>

            <div class="input-field">
            <input type="password" id="pass" name="pass" placeholder="Password">
                <div class="red-text"><?= $error['pass'] ?></div>
                <div class="red-text"><?= $error['incorrect_login'] ?></div>
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
