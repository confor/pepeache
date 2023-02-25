<?php

define('ROOT', '/var/www/html');

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

foreach (['id_poly', 'nombre', 'descripcion', 'etiquetas'] as $required) {
    if (array_key_exists($required, $_POST) !== true || strlen($_POST[$required]) === 0) {
        header('Location: ../lugares.php');
        exit();
    }
}

require ROOT . '/utils/database.php';

$con = connect();

$sql = 'SELECT * FROM lugar WHERE id_poly=?';
$params = [$_POST['id_poly']];

$ids = select($con, $sql, $params);

if (count($ids) > 0) {
    $_SESSION['lugarMessage'] = 'Ya existe un lugar con esa ID OSM';
    $_SESSION['lugarStatus'] = 'danger';

    header('Location: ../lugares.php');
    exit();
}

$path = '';
$path_sql = '';
if (strlen($_FILES['url_foto']['name']) > 0) {
    $file = $_FILES['url_foto']['name'];
    $temp_name = $_FILES['url_foto']['tmp_name'];

    # FIXME hay que usar magic bytes, esto no sirve para validar
    $ext = pathinfo($file, PATHINFO_EXTENSION);

    $allow_ext = array('jpg', 'jpeg', 'png');

    if (in_array($ext, $allow_ext)) {
        $path = '/var/www/html/img/'.$_POST['id_poly'].'.'.$ext;
        $path_sql = 'img/'.$_POST['id_poly'].'.'.$ext;

        # FIXME hay q permitir configurar la ruta raíz del sistema
        # quizá hacer un define('ROOT', '/var/www/html') ?
        move_uploaded_file($temp_name, $path);
    } else {
        $_SESSION['lugarMessage'] = 'Extensión de imagen no desponible (usar solo jpg, jpeg o png)';
        $_SESSION['lugarStatus'] = 'danger';

        header('Location: ../lugares.php');
        exit();
    }
}

if (strlen($_POST['id_duenho']) == 0) {
    $sql = 'INSERT INTO lugar (id_poly,nombre,descripcion,url_foto,horario,etiquetas) VALUES (?,?,?,?,?,?)';
    $params = array($_POST['id_poly'], $_POST['nombre'], $_POST['descripcion'], $path_sql, $_POST['horario'], $_POST['etiquetas']);
    $types = 'isssss';
} else {
    $sql = 'INSERT INTO lugar (id_poly,nombre,descripcion,url_foto,horario,etiquetas,id_duenho) VALUES (?,?,?,?,?,?,?)';
    $params = array($_POST['id_poly'], $_POST['nombre'], $_POST['descripcion'], $path_sql, $_POST['horario'], $_POST['etiquetas'], $_POST['id_duenho']);
    $types = 'isssssi';
}

insert($con, $sql, $types, $params); # TODO validar

$_SESSION['lugarMessage'] = 'Lugar insertado correctamente';
$_SESSION['lugarStatus'] = 'success';

header('Location: ../lugares.php');
