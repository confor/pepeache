<?php

session_start();

if (strlen($_POST['email']) == 0 || strlen($_POST['pass']) == 0) {
    header('Location: ../index.php');
}

include 'database.php';

$con = connect();

$email = $_POST['email'];
$pass = $_POST['pass'];

$sql = 'SELECT * FROM usuario WHERE correo=\'' . $email . '\' AND password=\'' . $pass . '\'';

$query = select($con, $sql);

if (count($query) > 0) {
    $_SESSION['session'] = true;
    $_SESSION['id'] = $query[0][0];
    $_SESSION['name'] = $query[0][1];
    $_SESSION['email'] = $query[0][2];
    $_SESSION['pass'] = $query[0][3];
    $_SESSION['rut'] = $query[0][4];
    $_SESSION['admin'] = $query[0][5];
    $_SESSION['ts'] = $query[0][6];

    $_SESSION['validate'] = 0;
    echo $_SESSION['validate'];
    header('Location: ../index.php');
} else {
    $_SESSION['validate'] = 1;
    echo $_SESSION['validate'];
    header('Location: ../login.php');
}
