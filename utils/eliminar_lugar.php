<?php

define('ROOT', '/var/www/html2/pepeache-patch-2');
require ROOT . '/utils/return_login.php';

foreach (['id_lugar', 'id_poly', 'nombre', 'descripcion', 'etiquetas'] as $required) {
    if (array_key_exists($required, $_POST) !== true || strlen($_POST[$required]) === 0) {
        header('Location: ../lugares.php');
        exit();
    }
}

require ROOT . '/utils/database.php';

$con = connect();

$sql = 'DELETE FROM lugar WHERE id_lugar=?';
$id = $_POST['id_lugar'];

$ids = delete($con, $sql, 'i', $id);

$_SESSION['lugarMessage'] = 'Lugar eliminado correctamente';
$_SESSION['lugarStatus'] = 'success';

unset($_SESSION['eliminando']);

header('Location: ../lugares.php');
