<?php

define('ROOT', '/var/www/html');

require ROOT . '/utils/return_login.php';
require ROOT . '/utils/database.php';


$delete_ = $_POST['eliminar'];
$edit_ = $_POST['editar'];

foreach (['id','nombre', 'rut', 'email', 'pwd', 'Admin'] as $required) {
    if (array_key_exists($required, $_POST) !== true || strlen($_POST[$required]) === 0) {
        #header('Location: ../usuarios.php');
        #exit();
    }
}

function delete_user($id){
    $CON = connect();
    $sql = 'DELETE FROM usuario WHERE id_usuario=?';

    delete($CON, $sql, 'i', $id);

    $_SESSION['usuarioMessage'] = 'usuario eliminado correctamente';
    $_SESSION['usuarioStatus'] = 'success';

    header('Location: ../usuarios.php');
}

# get the id
function id_user(){
    $con = connect();
    
    $sql = 'select id_usuario FROM usuario WHERE rut=?';
    $params = [$_POST['rut']];
    $types = 's';

    $query = select($con, $sql, $types, $params);

    if ($query === false) {
        $_SESSION['usuarioMessage'] = 'Error';
        header('Location: ../usuarios.php');
        exit();
    } else {
        if ($query[0] != NULL){
            $asd = $query[0]['id_usuario'];
            # validar que no se elimine xdddddddddd
            if ($asd == $_SESSION['id']){
                $_SESSION['usuarioMessage'] = 'NO te puedes eliminar >:c';
                $_SESSION['usuarioStatus'] = 'danger';

                header('Location: ../usuarios.php');
                exit();
            }elseif ($asd == 1){
                $_SESSION['usuarioMessage'] = 'No puedes eliminar a un ADMINISTRADOR >:c';
                $_SESSION['usuarioStatus'] = 'danger';

                header('Location: ../usuarios.php');
                exit();
            }
            else {
                delete_user($asd);
            }
        }
    }
}

if (empty($delete_) == 0){
    id_user();

}elseif (empty($delete_ == 1)){
    echo "no tengo datos";
}
