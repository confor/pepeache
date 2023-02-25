<?php

define('ROOT', '/var/www/html');

require ROOT . '/utils/return_login.php';
require ROOT . '/utils/validate_rut.php';

foreach (['name', 'rut', 'email', 'new_password', 'rep_new_password', 'password'] as $required) {
    if (array_key_exists($required, $_POST) !== true || strlen($_POST[$required]) === 0) {
        header('Location: ../lugares.php');
        exit();
    }
}

if (!password_verify($_POST['password'], $_SESSION['pass'])) {
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
    require ROOT . '/utils/database.php';

    $con = connect();

    $sql = 'SELECT * FROM usuario WHERE correo = ?';
    $params = [$_POST['email']];
    $types = 's';

    $query = select($con, $sql, $types, $params);

    if ($query === false) {
        $_SESSION['editMessage'] = 'Error en la base de datos';
        header('Location: ../editar_usuario.php');
        exit();
    } else {
        if (count($query[0]) == 1 && $_SESSION['id'] != $query[0]['id_usuario']) {
            $_SESSION['editMessage'] = 'Correo no disponible';
            header('Location: ../editar_usuario.php');
            exit();
        } else {
            $hash_pass = password_hash($_POST['new_password'], PASSWORD_DEFAULT);

            $sql = 'UPDATE usuario SET nombre=?, correo=?, password=?, rut=? WHERE id_usuario=?';
            $params = array($_POST['name'], $_POST['email'], $hash_pass, $_POST['rut'], $_SESSION['id']);
            $types = 'ssssi';

            $query = edit($con, $sql, $types, $params);

            if ($query === false) {
                $_SESSION['editMessage'] = 'Error en la base de datos';
                header('Location: ../editar_usuario.php');
                exit();
            } else {
                $_SESSION['name'] = $_POST['name'];
                $_SESSION['email'] = $_POST['email'];
                $_SESSION['pass'] = $hash_pass;
                $_SESSION['rut'] = $_POST['rut'];

                $_SESSION['userMessage'] = 'Usuario editado correctamente';
                header('Location: ../index.php');
                exit();
            }
       }
    }
}
