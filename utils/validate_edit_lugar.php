<?php

define('ROOT', '/var/www/html');
require ROOT . '/utils/return_login.php';

foreach (['id_lugar', 'id_poly', 'nombre', 'descripcion', 'etiquetas'] as $required) {
    if (array_key_exists($required, $_POST) !== true || strlen($_POST[$required]) === 0) {
        header('Location: ../lugares.php');
        exit();
    }
}

$path = '';
$path_sql = '';
if (strlen($_FILES['url_foto']['name']) > 0) {
    $file = $_FILES['url_foto']['name'];
    $temp_name = $_FILES['url_foto']['tmp_name'];

    $ext = pathinfo($file, PATHINFO_EXTENSION);

    $allow_ext = array('jpg', 'jpeg', 'png');

    if (in_array($ext, $allow_ext)) {
        $path = '/var/www/html/img/'.$_POST['id_poly'].'.'.$ext;
        $path_sql = 'img/'.$_POST['id_poly'].'.'.$ext;

        if (file_exists($path)) {
            unlink($path);
        }
        move_uploaded_file($temp_name, $path);
    } else {
        $_SESSION['lugarMessage'] = 'Extensión de imagen no desponible (usar solo jpg, jpeg o png)';
        $_SESSION['lugarStatus'] = 'danger';

        header('Location: ../'.$_SERVER['HTTP_REFERER']);
        exit();
    }
}

require ROOT . '/utils/database.php';

$con = connect();

$sql = 'UPDATE lugar SET';

$params = array();
$types = '';
foreach ($_POST as $key => $valor) {
    if ($key != 'id_lugar') {
        if ($key != 'id_duenho') {
            $sql = $sql.' '.$key.'=?,';
        } else {
            $sql = $sql.' '.$key.'=?';
        }
        if ($key == 'descripcion') {
            array_push($params, $valor);
            array_push($params, $path_sql);
            $sql = $sql.' url_foto=?,';
            $types = $types.'s';
        } else {
            array_push($params, $valor);
        }
        if ($key == 'id_lugar' || $key == 'id_duenho' || $key == 'id_poly') {
            $types = $types.'i';
        } else {
            $types = $types.'s';
        }
    }
}

$sql = $sql.' WHERE id_lugar=?';
array_push($params, $_POST['id_lugar']);
$types = $types.'i';

edit($con, $sql, $types, $params);

$_SESSION['lugarMessage'] = 'Lugar editado correctamente';
$_SESSION['lugarStatus'] = 'success';

unset($_SESSION['editando']);

header('Location: ../lugares.php');
