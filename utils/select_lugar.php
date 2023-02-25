<?php

define('ROOT', '/var/www/html');

require ROOT . '/utils/return_login.php';

foreach (['id_lugar', 'id_poly', 'nombre', 'descripcion', 'etiquetas'] as $required) {
    if (array_key_exists($required, $_POST) !== true || strlen($_POST[$required]) === 0) {
        header('Location: ../lugares.php');
        exit();
    }
}

if (isset($_SESSION['formulario'])) {
    if (isset($_SESSION['eliminando'])) {
        unset($_SESSION['eliminando']);
    }

    if (isset($_SESSION['editando'])) {
        unset($_SESSION['editando']);
    }
}

if (isset($_POST['editar'])) {
    $_SESSION['editando'] = true;
    $_SESSION['formulario'] = array();

    foreach ($_POST as $key => $value) {
        array_push($_SESSION['formulario'], $value);
    }

    header('Location: ../lugares.php');

} elseif (isset($_POST['eliminar'])) {
    $_SESSION['eliminando'] = true;
    $_SESSION['formulario'] = array();

    foreach ($_POST as $key => $value) {
        array_push($_SESSION['formulario'], $value);
    }

    header('Location: ../lugares.php');
}
