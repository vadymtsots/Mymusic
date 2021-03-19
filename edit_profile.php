<?php
session_start();
include 'db_connect.php';

$req = $_REQUEST;
$id = $_SESSION['user']['id'];
$email = $_SESSION['user']['email'];
$username = $_SESSION['user']['username'];

if (isset($req['submit'])) {
    $sql = "UPDATE users SET user_email = ?, user_name = ? WHERE users.id = ?";
    $stmt = $connect -> prepare($sql);
    $stmt -> execute([
       $req['email'],
       $req['username'],
       $id,
    ]);
    $_SESSION['user']['email'] = $req['email'];
    $_SESSION['user']['username'] = $req['username'];
header('Location: profile.php');
}
?>





<html lang="en">
<?php
$page_title = 'Edit profile';
include 'templates/head.php'
?>
<body>
<header>
    <?php include 'templates/header.php' ?>
</header>

<div class="container">
    <section class="form">
        <form method="post">

            <label for="artist">Email</label>
            <input type="text" id="email" name="email" value="<?php  echo $email  ?>"> <br>
            <div class="red-text"> <?php echo $error['artist']  ?> </div>

            <label for="album">Username</label>
            <input type="text" id="username" name="username" value="<?php  echo $username  ?>"> <br>
            <div class="red-text"> <?php echo $error['album']  ?> </div>

            <input type="hidden" name="id" id="id" value="<?php echo $id ?>">

            <input type="submit" class="submit" id="submit" name="submit">

        </form>
    </section>
</div>


<footer>

    <?php include 'templates/footer.php' ?>
</footer>



</body>
</html>
