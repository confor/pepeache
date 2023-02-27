<?php

define('ROOT', '/var/www/html');

require ROOT . '/utils/return_login.php';
require ROOT . '/utils/validate_rut.php';


if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

foreach (['nombre', 'rut', 'email', 'pwd', 'Admin'] as $required) {
    if (array_key_exists($required, $_POST) !== true || strlen($_POST[$required]) === 0) {
        # header('Location: ../usuarios.php');
    }
}

# validaciones 

# rut
if (rut($_POST['rut']) == false) {
    $_SESSION['usuarioMessage'] = 'RUT no valido';
    header('Location: ../usuarios.php');
    $flag = false;
    exit();
}

require ROOT . '/utils/database.php';

$con = connect();

$sql = 'INSERT INTO usuario (nombre, correo, password, rut, admin, ts_creacion) VALUES (?,?,?,?,?, "2030-02-03")';
$params = array($_POST['nombre'], $_POST['email'], $_POST['pwd'], $_POST['rut'], $_POST['Admin']);
$types = 'ssssi';

insert($con, $sql, $types, $params);

$_SESSION['usuarioMessage'] = 'Usuario insertado correctamente';
$_SESSION['usuarioStatus'] = 'success';

header('Location: ../usuarios.php');
