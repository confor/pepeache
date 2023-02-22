<?php

session_start();

if (strlen($_POST['id_poly']) == 0 || strlen($_POST['nombre']) == 0 || strlen($_POST['descripcion']) == 0 || strlen($_POST['etiquetas']) == 0 ) {
    header('Location: ../lugares.php');
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

header('Location: ../lugares.php');
