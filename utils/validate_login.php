<?php

session_start();

if (strlen($_POST['email']) == 0 || strlen($_POST['pass']) == 0) {
    header('Location: ../index.php');
    exit();
}

require ROOT . '/utils/database.php';

$con = connect();

$email = $_POST['email'];
$pass = $_POST['pass'];

$sql = 'SELECT * FROM usuario WHERE correo = ?';
$params = [$email];
$types = 's';

$query = select($con, $sql, $types, $params);

if ($query === false) {
    $_SESSION['validate'] = 2;
    header('Location: ../login.php');
    exit();
} elseif (count($query) > 0) {
    $pass_valid = password_verify($pass, $query[0]['password']);
    echo var_dump($query[0]);
    
    if ($pass_valid) {
        $_SESSION['session'] = true;
        $_SESSION['id'] = $query[0]['id_usuario'];
        $_SESSION['name'] = $query[ 0]['nombre'];
        $_SESSION['email'] = $query[0]['correo'];
        $_SESSION['pass'] = $query[0]['password'];
        $_SESSION['rut'] = $query[0]['rut'];
        $_SESSION['admin'] = $query[0]['admin'];
        $_SESSION['ts'] = $query[0]['ts_creacion'];

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
