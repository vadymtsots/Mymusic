<?php

error_reporting(0);

//function render($path, $data)
//{
//    ob_start();
//    require $path;
//    return ob_get_flush();
//}

$host = 'localhost';
$user = 'root';
$password = 'root';
$db_name = 'mymusic';
$dsn = 'mysql:host='. $host . ';dbname=' . $db_name;

// $connect = mysqli_connect('localhost', 'root', 'root', 'mymusic');
$connect = new PDO($dsn, $user, $password);

if (!$connect)
{
    echo 'fail!';
} 

?>
