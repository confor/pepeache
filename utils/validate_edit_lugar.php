<?php

session_start();

include 'return_login.php';

if (strlen($_POST['id_poly']) == 0 || strlen($_POST['nombre']) == 0 || strlen($_POST['descripcion']) == 0 || strlen($_POST['etiquetas']) == 0 ) {
    header('Location: ../lugares.php');
}

include 'database.php';

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
        array_push($params, $valor);
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
