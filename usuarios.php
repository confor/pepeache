<?php

define('ROOT', '/var/www/html');

require ROOT . '/utils/return_login.php';
require ROOT . '/utils/database.php';

$con = connect();

$sql = 'SELECT * FROM usuario';

$LUGARES = select_all($con, $sql);
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
                                                <div class="card-body">'.$_SESSION['usuarioStatus'].'</div>
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
                                            </div>

                                            <div class="col-md-6">
                                                <label for="email" class="form-label">Correo</label>
                                                <input type="text" class="form-control" id="email" name="email" value="" required>
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