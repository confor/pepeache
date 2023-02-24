<?php

session_start();

if (strlen($_POST['email']) == 0 || strlen($_POST['pass']) == 0) {
    header('Location: ../index.php');
    exit();
}

require 'database.php';

$con = connect();

$email = $_POST['email'];
$pass = $_POST['pass'];
$pass_hash = password_hash($pass, PASSWORD_DEFAULT);

$sql = 'SELECT * FROM usuario WHERE correo = ?'; # no
$params = [$email];

$query = select($con, $sql, $params);

if (count($query) > 0) {
    $pass_valid = password_verify($query[0][3], $pass_hash);
    if ($pass_valid) {
        $_SESSION['session'] = true;
        $_SESSION['id'] = $query[0][0];
        $_SESSION['name'] = $query[0][1];
        $_SESSION['email'] = $query[0][2];
        $_SESSION['pass'] = $pass_hash;
        $_SESSION['rut'] = $query[0][4];
        $_SESSION['admin'] = $query[0][5];
        $_SESSION['ts'] = $query[0][6];

        $_SESSION['validate'] = 0;
        header('Location: ../index.php');
        exit();
    } else {
        $_SESSION['validate'] = 1;
        header('Location: ../login.php');
        exit();
    }
} else {
    $_SESSION['validate'] = 1;
    header('Location: ../login.php');
    exit();
}
