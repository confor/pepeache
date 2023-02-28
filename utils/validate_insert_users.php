<?php

define('ROOT', '/var/www/html');

require ROOT . '/utils/return_login.php';
require ROOT . '/utils/validate_rut.php';
require ROOT . '/utils/database.php';

$con = connect();
$flag = true;

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

foreach (['nombre', 'rut', 'email', 'pwd', 'Admin'] as $required) {
    if (array_key_exists($required, $_POST) !== true || strlen($_POST[$required]) === 0) {
        header('Location: ../usuarios.php');
        exit();
    }
}

# validaciones

# rut
if (rut($_POST['rut']) == false) {
    $_SESSION['usuarioMessage'] = 'RUT no valido';
    $_SESSION['usuarioStatus'] = 'danger';
    header('Location: ../usuarios.php');
    $flag = false;
    exit();
} 
else {
    # repeat rut
    $sql = 'SELECT rut FROM usuario WHERE rut = ?';
    $params = [$_POST['rut']];
    $types = 's';

    $query = select($con, $sql, $types, $params);

    if ($query === false) {
        $_SESSION['usuarioMessage'] = 'Error';
        header('Location: ../usuarios.php');
        exit();
    } else {
        if ($query[0] != NULL){
            $flag = false;
            $_SESSION['usuarioMessage'] = 'El rut ingresado ya está vinculado a una cuenta.';
            $_SESSION['usuarioStatus'] = 'danger';
            header('Location: ../usuarios.php');
            exit();
        }
    }
}

# validar correo real (ask this uwu.)

# # # #

# repeat email
$sql = 'SELECT correo FROM usuario WHERE correo = ?';
$params = [$_POST['email']];
$types = 's';

$query = select($con, $sql, $types, $params);

if ($query === false) {
    $_SESSION['usuarioMessage'] = 'Error';
    header('Location: ../usuarios.php');
    exit();
} else {
    # $query[0]['correo'];
    if ($query[0] != NULL){
        $flag = false;
        $_SESSION['usuarioMessage'] = 'El correo ingresado ya tiene una cuenta.';
        $_SESSION['usuarioStatus'] = 'danger';
        header('Location: ../usuarios.php');
        exit();
    }
}

if ($flag == true) {

    # hash
    $pwd_ = password_hash($_POST['pwd'], PASSWORD_DEFAULT);

    $sql = 'INSERT INTO usuario (nombre, correo, password, rut, admin, ts_creacion) VALUES (?,?,?,?,?, "2030-02-03")';
    $params = array($_POST['nombre'], $_POST['email'], $pwd_, $_POST['rut'], $_POST['Admin']);
    $types = 'ssssi';
    
    insert($con, $sql, $types, $params);
    
    $_SESSION['usuarioMessage'] = 'Usuario insertado correctamente';
    $_SESSION['usuarioStatus'] = 'success';
    
    header('Location: ../usuarios.php');
    exit();   
}
