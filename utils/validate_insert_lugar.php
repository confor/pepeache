<?php

require 'return_login.php';

if (strlen($_POST['id_poly']) == 0 || strlen($_POST['nombre']) == 0 || strlen($_POST['descripcion']) == 0 || strlen($_POST['etiquetas']) == 0 ) {
    header('Location: ../lugares.php');
    exit();
}

if (strlen($_FILES['url_foto']['name']) > 0) {
    $file = $_FILES['url_foto']['name'];
    $temp_name = $_FILES['url_foto']['tmp_name'];

    # FIXME hay que usar magic bytes, esto no sirve para validar
    $ext = pathinfo($file, PATHINFO_EXTENSION);

    $allow_ext = array('jpg', 'jpeg', 'png');

    if (in_array($ext, $allow_ext)) {
        // $folder = 'img/';
        // $path = $_POST['nombre'];

        # FIXME hay q permitir configurar la ruta raíz del sistema
        # quizá hacer un define('ROOT', '/var/www/html') ?
        move_uploaded_file($temp_name, '/var/www/html/img/a.png');
    } else {
        # la extensión no dice que tipo de archivo es, eso es algo de windows
        echo 'extension INCORRECTA';
        $_SESSION['lugarMessage'] = 'Extensión de imagen no desponible (usar solo jpg, jpeg o png)';
        $_SESSION['lugarStatus'] = 'danger';

        header('Location: ../lugares.php');
        exit();
    }
}

require 'database.php';

$con = connect();

if (strlen($_POST['id_duenho']) == 0) {
    $sql = 'INSERT INTO lugar (id_poly,nombre,descripcion,horario,etiquetas) VALUES (?,?,?,?,?)';
    $params = array($_POST['id_poly'], $_POST['nombre'], $_POST['descripcion'], $_POST['horario'], $_POST['etiquetas']);
    $types = 'issss';
} else {
    $sql = 'INSERT INTO lugar (id_poly,nombre,descripcion,horario,etiquetas,id_duenho) VALUES (?,?,?,?,?,?)';
    $params = array($_POST['id_poly'], $_POST['nombre'], $_POST['descripcion'], $_POST['horario'], $_POST['etiquetas'], $_POST['id_duenho']);
    $types = 'issssi';
}

insert($con, $sql, $types, $params); # TODO validar

$_SESSION['lugarMessage'] = 'Usuario insertado correctamente';
$_SESSION['lugarStatus'] = 'success';

header('Location: ../lugares.php');
