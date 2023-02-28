<?php

define('ROOT', '/var/www/html');

require ROOT . '/utils/return_login.php';
require ROOT . '/utils/database.php';

$con = connect();

$sql = 'SELECT * FROM usuario';

$USUARIOS = select_all($con, $sql);
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <title>UtalcaGO </title>
        <link href="css/styles.css" rel="stylesheet" />
        <link href="css/tabla.css" rel="stylesheet" />
    </head>
    <body class="sb-nav-fixed">
        <?php
        require ROOT . '/static/navbar.php';
        ?>
        <div id="layoutSidenav">
            <?php
            require ROOT . '/static/sidebar.php';
            ?>
            <div id="layoutSidenav_content">
            <main>
                    <div class="container-fluid px-4">
                        <h1 class="mt-4">Mantenedor de Usuarios</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item active">Agregar un usuario</li>
                        </ol>
                        <?php

                        if (isset($_SESSION['usuarioMessage'])) {
                            if (strlen($_SESSION['usuarioMessage']) > 0) {
                                echo '<div class="row">
                                        <div class="col-xl-3">
                                            <div class="card text-white mb-4 bg-opacity-50 bg-'.$_SESSION['usuarioStatus'].'">
                                                <div class="card-body">'.$_SESSION['usuarioMessage'].'</div>
                                            </div>
                                        </div>
                                    </div>';
                                $_SESSION['usuarioMessage'] = '';                                
                                $_SESSION['usuarioStatus'] = '';
                            }
                        }
                        ?>
                        <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-table me-1"></i>
                                <?php if (isset($_SESSION['editando'])) {
                                    echo 'Edición de un Usuario';
                                } else {
                                    echo 'Ingresar un Usuario';
                                }
                                ?>
                            </div>
                            <div class="card-body">
                                        <?php
                                        if (isset($_SESSION['editando'])) {
                                            echo '<a> hola </a>'; 
                                        } else {
                                            echo '
                                        <form class="row g-3" action="utils/validate_insert_users.php" method="post" enctype="multipart/form-data">

                                            <div class="col-md-6">
                                                <label for="nombre" class="form-label">Nombre</label>
                                                <input type="text" class="form-control" id="nombre" name="nombre" value="" required>
                                            </div>

                                            <div class="col-md-6">
                                                <label for="rut" class="form-label">Rut</label>
                                                <input type="text" class="form-control" id="rut" name="rut" value="" required>
                                            </div>

                                            <div class="col-md-6">
                                                <label for="pwd" class="form-label">Contraseña</label>
                                                <input type="text" class="form-control" id="pwd" name="pwd" value="" required>
                                                <input class="form-check-input" type="checkbox" value="" id="view_pass">
                                                <label class="form-check-label" for="view_pass">
                                                    Ver contraseña
                                                </label>
                                            </div>

                                            <div class="col-md-6">
                                                <label for="email" class="form-label">Correo</label>
                                                <input type="email" class="form-control" id="email" name="email" value="" required>
                                            </div>

                                            <div class="col-md-6">
                                                <label for="admin" class="form-label">Administrador</label>
                                                <select name="Admin" id="admin">
                                                    <option value="0">No</option>    
                                                    <option value="1">Si</option>
                                                </select>
                                            </div>

                                            <div class="col-12 text-end">
                                                <input class="btn btn-secondary" type="submit" value="Ingresar">';
                                        
                                        }
                                        
                                        ?>
                                    </div>
                                </form>
                            </div>
                        </div>

                        <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-table me-1"></i>
                                Tabla de usuarios
                            </div>
                            <div class="card-body">
                                <table id="datatablesSimple">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>NOMBRE</th>
                                            <th>CORREO</th>
                                            <th>PASSWORD</th>
                                            <th>RUT</th>
                                            <th>ADMIN</th>
                                            <th>TS_CREACION</th>
                                            <th>ACCIONES</th>
                                        </tr>                                    
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>ID</th>
                                            <th>NOMBRE</th>
                                            <th>CORREO</th>
                                            <th>PASSWORD</th>
                                            <th>RUT</th>
                                            <th>ADMIN</th>
                                            <th>TS_CREACION</th>
                                            <th>ACCIONES</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                    <?php
                                    foreach ($USUARIOS as $usuario) {
                                        echo '<tr><form action="utils/select_usuario.php" method="post">';
                                        foreach ($usuario as $key => $columna) {
                                            if ($key != 'id_lugar') {
                                                echo '<td><input name="'.$key.'" value="'.$columna.'" hidden>'.$columna.'</td>';
                                            } else {
                                                if ($columna == NULL) {
                                                    echo '<td><input name="'.$key.'" value="" hidden>No tiene</td>';
                                                    echo '<td><input name="nombre_lugar" value="" hidden>No tiene</td>';
                                                } else {
                                                    echo '<td><input name="'.$key.'" value="'.$columna.'" hidden>'.$columna.'</td>';
                                                }
                                            }
                                        }

                                        echo '                                        <td><div class="btn-group" role="group">
                                        <input class="btn btn-warning" type="submit" name="editar" value="Editar">
                                        <input class="btn btn-danger" type="submit" name="eliminar" value="Eliminar">
                                    </div></form></td></tr>';
                                    }
                                    ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                <?php
                include ROOT . '/static/footer.html';
                ?>
            </div>
        </div>
        <script src="js/jquery.js"></script>
        <script src="js/jquery_min.js"></script>
        <script src="js/data_table.js"></script>
        <script src="js/scripts.js"></script>
    </body>