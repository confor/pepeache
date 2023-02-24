<?php

require 'return_login.php';

foreach ($required in ['id_poly', 'nombre', 'descripcion', 'etiquetas']) {
    if (array_key_exists($required, $_POST) !== true || strlen($_POST[$required]) === 0) {
        header('Location: ../lugares.php');
        exit();
    }
}

require 'database.php';

$con = connect();

$sql = 'UPDATE lugar SET';

$params = array();
$types = '';
foreach ($_POST as $key => $valor) {
    if ($key != 'id_lugar') {
        if ($key != 'id_duenho') {
            $sql = $sql.' '.$key.'=?,'; # ??
        } else {
            $sql = $sql.' '.$key.'=?'; # ??
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

# probablemente vulnerable
edit($con, $sql, $types, $params); # TODO validar

$_SESSION['lugarMessage'] = 'Lugar editado correctamente';
$_SESSION['lugarStatus'] = 'success';

unset($_SESSION['editando']);

header('Location: ../lugares.php');
