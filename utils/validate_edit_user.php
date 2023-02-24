<?php

require 'return_login.php';

require 'validate_rut.php';

if (strlen($_POST['name']) == 0 || strlen($_POST['rut']) == 0 || strlen($_POST['email']) == 0 || strlen($_POST['new_password']) == 0 || strlen($_POST['rep_new_password']) == 0 || strlen($_POST['password']) == 0) {
    header('Location: ../editar_usuario.php');
    exit();
}

if ($_POST['password'] != $_SESSION['pass']) { # ??? no!!!!!
    $_SESSION['editMessage'] = 'Contraseña actual incorrecta';
    header('Location: ../editar_usuario.php');
    exit();
} elseif ($_POST['new_password'] != $_POST['rep_new_password']) {
    $_SESSION['editMessage'] = 'La nueva contraseña no coincide con la repetición';
    header('Location: ../editar_usuario.php');
    exit();
} elseif (rut($_POST['rut']) == false) {
    $_SESSION['editMessage'] = 'RUT no valido';
    header('Location: ../editar_usuario.php');
    exit();
} else {
    require 'database.php';

    $con = connect();

    # FIXME hay que hacer un hash con algún salt
    $sql = 'UPDATE usuario SET nombre=?, correo=?, password=?, rut=? WHERE id_usuario=?';
    $params = array($_POST['name'], $_POST['email'], $_POST['new_password'], $_POST['rut'], $_SESSION['id']);
    $types = 'ssssi';

    edit($con, $sql, $types, $params); # TODO validar

    $_SESSION['name'] = $_POST['name'];
    $_SESSION['email'] = $_POST['email'];
    $_SESSION['pass'] = $_POST['new_password']; # no!!!!!!!!!!
    $_SESSION['rut'] = $_POST['rut'];

    $_SESSION['userMessage'] = 'Usuario editado correctamente';
    header('Location: ../index.php');
    exit();
}
