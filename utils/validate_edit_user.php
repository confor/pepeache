<?php

include 'return_login.php';

include 'validate_rut.php';

session_start();

if (strlen($_POST['name']) == 0 || strlen($_POST['rut']) == 0 || strlen($_POST['email']) == 0 || strlen($_POST['new_password']) == 0 || strlen($_POST['rep_new_password']) == 0 || strlen($_POST['password']) == 0) {
    header('Location: ../editar_usuario.php');
}

if ($_POST['password'] != $_SESSION['pass']) {
    $_SESSION['editMessage'] = 'Contraseña actual incorrecta';
    header('Location: ../editar_usuario.php');
} elseif ($_POST['new_password'] != $_POST['rep_new_password']) {
    $_SESSION['editMessage'] = 'La nueva contraseña no coincide con la repetición';
    header('Location: ../editar_usuario.php');
} elseif (rut($_POST['rut']) == false) {
    $_SESSION['editMessage'] = 'RUT no valido';
    header('Location: ../editar_usuario.php');
} else {
    include 'database.php';
    
    $con = connect();
    
    $sql = 'UPDATE usuario SET nombre=?, correo=?, password=?, rut=? WHERE id_usuario=?';
    $params = array($_POST['name'], $_POST['email'], $_POST['new_password'], $_POST['rut'], $_SESSION['id']);
    $types = 'ssssi';

    edit($con, $sql, $types, $params);

    $_SESSION['name'] = $_POST['name'];
    $_SESSION['email'] = $_POST['email'];
    $_SESSION['pass'] = $_POST['new_password'];
    $_SESSION['rut'] = $_POST['rut'];
    
    $_SESSION['userMessage'] = 'Usuario editado correctamente';
    header('Location: ../index.php');
}
