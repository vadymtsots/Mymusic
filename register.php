<?php
include 'db_connect.php';

$error = [
    'username' => '',
    'email' => '',
    'password' => '',
    'confirm_password' => '',
];

$req = $_REQUEST;
$password = $req['pass'];

function isValidated($error)
{
    foreach ($error as $name => $value) {
        if (!empty($value)) {
            return false;
        }
    }

    return true;
}

function pass_hashing ($password)
{
    return password_hash($password, PASSWORD_DEFAULT);
}

if(isset($req['submit'])) {

    $error['username'] = empty($req['username']) ? 'Username cannot be empty <br>' : '';
    $error['password'] = empty($req['pass']) ? 'Username cannot be empty <br>' : '';

    $error['email'] = empty($req['email']) ? 'Email cannot be empty <br>' :
        (!filter_var($req['email'], FILTER_VALIDATE_EMAIL) ? 'Must be valid email <br>' : '');


// insert data into database
    if (isValidated($error)) {
        $sql = "INSERT INTO users(user_email, user_name, user_password) VALUES (?, ?, ?)";
        $stmt = $connect -> prepare($sql);
        $stmt-> execute([
                $req['email'],
                $req['username'],
                pass_hashing($password),
    ]);
}

header("Location: index.php");

}

?>




<html lang="en">
<?php
$page_title = 'Register';
include 'templates/head.php'
?>
<body>
    <header class="header center ndigo darken-2">
        <?php include 'templates/header.php'; ?>
    </header>

    <div class="row center">
        <form class="col s12" method="post">
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

            <div class="input-field">
                <input type="password" id="confirm_password" name="confirm_password" placeholder="Confirm Password">
                <div class="red-text"><?php echo $error['confirm_password'] ?> </div>
            </div>

            <input type="submit" id="submit" name="submit">
        </form>

        <p>Already have an account? <a href="auth.php">Enter</a></p>
    </div>

    <footer>
        <?php include "templates/footer.php" ?>
    </footer>

    <?php if (isset($req['submit']) && isValidated($error)): ?>
        <script>
            alert('Success');
        </script>
    <?php endif ?>
</body>
</html>