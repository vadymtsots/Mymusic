<?php
session_start();
$username = $_SESSION['user']['username'];
$login_status = '';

    if (!$_SESSION['user']) {
        $login_status = 'Not logged in';

    } else {
        $login_status = 'Logged in as: ' . $username;
    }

?>


<nav>
    <div class="nav-wrapper #1976d2 blue darken-2 center">
        <a href="index.php" class="brand-logo">MyMusic</a>

        <ul id="nav-mobile" class="right hide-on-med-and-down">
            <li><a href="add.php">Add an album</a></li>
        </ul>

        <ul id="nav-mobile" class="left hide-on-med-and-down">
            <li><a href="auth.php">Log in</a></li>
        </ul>

        <ul id="nav-mobile" class="left hide-on-med-and-down">
            <li><a href="register.php">Sign up</a></li>
        </ul>
        <ul id="nav-mobile" class="left hide-on-med-and-down">
            <li>
                <a href="profile.php"><?php echo $login_status; ?></a>
            </li>
            
        </ul>
    </div>
</nav>