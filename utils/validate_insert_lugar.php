<?php

session_start();

include 'return_login.php';

if (strlen($_POST['id_poly']) == 0 || strlen($_POST['nombre']) == 0 || strlen($_POST['descripcion']) == 0 || strlen($_POST['etiquetas']) == 0 ) {
    header('Location: ../lugares.php');
    exit();
}

if (strlen($_FILES['url_foto']['name']) > 0) {
    $name = $_FILES['url_foto']['name'];
    $temp_name = $_FILES['url_foto']['tmp_name'];

    $ext = pathinfo($name, PATHINFO_EXTENSION);

    $allow_ext = array('jpg', 'jpeg', 'png');

    if (in_array($ext, $allow_ext)) {
        $folder = 'img/';
        $path = $_POST['nombre'];

        move_uploaded_file($temp_ubi, 'a.png');
    } else {
        echo 'extension INCORRECTA';
        $_SESSION['lugarMessage'] = 'Extensión de imagen no desponible (usar solo jpg, jpeg o png)';
        $_SESSION['lugarStatus'] = 'danger';

        // header('Location: ../lugares.php');
        // exit();
    }
}

include 'database.php';

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

insert($con, $sql, $types, $params);

$_SESSION['lugarMessage'] = 'Usuario insertado correctamente';
$_SESSION['lugarStatus'] = 'success';

// header('Location: ../lugares.php');
