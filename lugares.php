<?php

# yo al ver este archivo
# https://thumbs.dreamstime.com/z/depressed-emoticon-sad-hands-face-56094937.jpg
define('ROOT', '/var/www/html');
require ROOT . '/utils/return_login.php';
require ROOT . '/utils/database.php';

$con = connect();

$sql = 'SELECT * FROM lugar';

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
                        <h1 class="mt-4">Mantenedor de lugares</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item active">Lugares</li>
                        </ol>
                        <?php

                        if (isset($_SESSION['lugarMessage']) && strlen($_SESSION['lugarMessage']) > 0) {
                            echo '<div class="row">
                                    <div class="col-xl-3">
                                        <div class="card text-white mb-4 bg-opacity-50 bg-'.$_SESSION['lugarStatus'].'">
                                            <div class="card-body">'.$_SESSION['lugarMessage'].'</div>
                                        </div>
                                    </div>
                                </div>';
                            $_SESSION['lugarMessage'] = '';
                            $_SESSION['lugarStatus'] = '';
                        }
                        ?>
                        <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-table me-1"></i>
                                <?php if (isset($_SESSION['editando'])) {
                                    echo 'Edición de lugar';
                                } else {
                                    echo 'Ingresar un lugar';
                                }
                                ?>
                            </div>
                            <div class="card-body">
                                        <?php
                                        if (isset($_SESSION['editando'])) {
                                            echo '
                                        <form class="row g-3" action="utils/validate_edit_lugar.php" method="post" enctype="multipart/form-data">
                                            <input type="number" class="form-control" id="id_lugar" name="id_lugar" value="'.$_SESSION['formulario'][0].'" required hidden>
                                            <div class="col-md-6">
                                                <label for="id_poly" class="form-label">ID OSM (Open Street Map)</label>
                                                <input type="number" class="form-control" id="id_poly" name="id_poly" value="'.$_SESSION['formulario'][1].'" required>
                                            </div>
                                            <div class="col-md-6">
                                                <label for="nombre" class="form-label">Nombre</label>
                                                <input type="text" class="form-control" id="nombre" name="nombre" value="'.$_SESSION['formulario'][2].'" required>
                                            </div>
                                            <div class="col-md-6">
                                                <label for="descripcion" class="form-label">Descripción</label>
                                                <input type="text" class="form-control" id="descripcion" name="descripcion" value="'.$_SESSION['formulario'][3].'" required>
                                            </div>
                                            <div class="col-md-6">
                                                <label for="url_foto" class="form-label">Nueva foto (Opcional)</label>
                                                <input type="file" class="form-control" id="url_foto" name="url_foto" value="">
                                            </div>
                                            <div class="col-md-6">
                                                <label for="horario" class="form-label">Horario (Opcional)</label>
                                                <textarea rows="4" cols="20" class="form-control" id="horario" name="horario">'.$_SESSION['formulario'][5].'</textarea>
                                            </div>
                                            <div class="col-md-6">
                                                <label for="etiquetas" class="form-label">Etiquetas</label>
                                                <input type="text" class="form-control" id="etiquetas" name="etiquetas" value="'.$_SESSION['formulario'][7].'" required>
                                            </div>
                                            <div class="col-md-6">
                                                <label for="id_duenho" class="form-label">ID Dueño (opcional)</label>
                                                <input type="number" class="form-control" id="id_duenho" name="id_duenho" value="'.$_SESSION['formulario'][9].'">
                                            </div>
                                            <div class="col-12 text-end">
                                                <a href="utils/cancel_lugar.php" class="btn btn-light">Cancelar</a>
                                                <input class="btn btn-secondary" type="submit" value="Editar información">';
                                            } elseif (isset($_SESSION['eliminando'])) {
                                                echo '
                                            <form class="row g-3" action="utils/eliminar_lugar.php" method="post" enctype="multipart/form-data">
                                                <div class="col-md-6">
                                                    <label for="id_lugar" class="form-label">ID Lugar</label>
                                                    <input type="number" class="form-control" id="id_lugar" name="id_lugar" value="'.$_SESSION['formulario'][0].'" readonly>
                                                </div>
                                                <div class="col-md-6">
                                                    <label for="id_poly" class="form-label">ID OSM (Open Street Map)</label>
                                                    <input type="number" class="form-control" id="id_poly" name="id_poly" value="'.$_SESSION['formulario'][1].'" readonly>
                                                </div>
                                                <div class="col-md-6">
                                                    <label for="nombre" class="form-label">Nombre</label>
                                                    <input type="text" class="form-control" id="nombre" name="nombre" value="'.$_SESSION['formulario'][2].'" readonly>
                                                </div>
                                                <div class="col-md-6">
                                                    <label for="descripcion" class="form-label">Descripción</label>
                                                    <input type="text" class="form-control" id="descripcion" name="descripcion" value="'.$_SESSION['formulario'][3].'" readonly>
                                                </div>
                                                <div class="col-md-6">
                                                    <label for="horario" class="form-label">Horario</label>
                                                    <textarea rows="4" cols="20" class="form-control" id="horario" name="horario" readonly>'.$_SESSION['formulario'][5].'</textarea>
                                                </div>
                                                <div class="col-md-6">
                                                    <label for="etiquetas" class="form-label">Etiquetas</label>
                                                    <input type="text" class="form-control" id="etiquetas" name="etiquetas" value="'.$_SESSION['formulario'][7].'" readonly>
                                                </div>
                                                <div class="col-md-6">
                                                    <label for="id_duenho" class="form-label">ID Dueño</label>
                                                    <input type="number" class="form-control" id="id_duenho" name="id_duenho" value="'.$_SESSION['formulario'][9].'" readonly>
                                                </div>
                                                <div class="col-12 text-end">
                                                    <a href="utils/cancel_lugar.php" class="btn btn-light">Cancelar</a>
                                                    <input class="btn btn-secondary" type="submit" value="Eliminar lugar">';
                                        } else {
                                            echo '
                                        <form class="row g-3" action="utils/validate_insert_lugar.php" method="post" enctype="multipart/form-data">
                                            <div class="col-md-6">
                                                <label for="id_poly" class="form-label">ID OSM (Open Street Map)</label>
                                                <input type="number" class="form-control" id="id_poly" name="id_poly" value="" required>
                                            </div>
                                            <div class="col-md-6">
                                                <label for="nombre" class="form-label">Nombre</label>
                                                <input type="text" class="form-control" id="nombre" name="nombre" value="" required>
                                            </div>
                                            <div class="col-md-6">
                                                <label for="descripcion" class="form-label">Descripción</label>
                                                <input type="text" class="form-control" id="descripcion" name="descripcion" value="" required>
                                            </div>
                                            <div class="col-md-6">
                                                <label for="url_foto" class="form-label">Foto (Opcional)</label>
                                                <input type="file" class="form-control" id="url_foto" name="url_foto" value="">
                                            </div>
                                            <div class="col-md-6">
                                                <label for="horario" class="form-label">Horario (Opcional)</label>
                                                <textarea rows="4" cols="20" class="form-control" id="horario" name="horario">
Lunes:Martes:Miércoles:Jueves:Viernes:Sábado:Domingo:</textarea>
                                            </div>
                                            <div class="col-md-6">
                                                <label for="etiquetas" class="form-label">Etiquetas</label>
                                                <input type="text" class="form-control" id="etiquetas" name="etiquetas" required>
                                            </div>
                                            <div class="col-md-6">
                                                <label for="id_duenho" class="form-label">ID Dueño (opcional)</label>
                                                <input type="number" class="form-control" id="id_duenho" name="id_duenho">
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
                                Tabla de lugares
                            </div>
                            <div class="card-body">
                                <table id="datatablesSimple">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>ID OSM</th>
                                            <th>Nombre</th>
                                            <th>Descripción</th>
                                            <th>Foto</th>
                                            <th>Horario</th>
                                            <th>Visitas</th>
                                            <th>Etiquetas</th>
                                            <th>Fecha creación</th>
                                            <th>ID dueño</th>
                                            <th>Acciones</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>ID</th>
                                            <th>ID OSM</th>
                                            <th>Nombre</th>
                                            <th>Descripción</th>
                                            <th>Foto</th>
                                            <th>Horario</th>
                                            <th>Visitas</th>
                                            <th>Etiquetas</th>
                                            <th>Fecha creación</th>
                                            <th>ID dueño</th>
                                            <th>Acciones</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                    <?php
                                    $lugar_dict = [
                                        0 => 'id_lugar',
                                        1 => 'id_poly',
                                        2 => 'nombre',
                                        3 => 'descripcion',
                                        4 => 'url_foto',
                                        5 => 'horario',
                                        6 => 'visitas',
                                        7 => 'etiquetas',
                                        8 => 'ts_creacion',
                                        9 => 'id_duenho'
                                    ];
                                    foreach ($LUGARES as $lugar) {
                                        echo '<tr><form action="utils/select_lugar.php" method="post">';
                                        foreach ($lugar as $key => $columna) {
                                            if ($key != 4 && $key != 9) {
                                                echo '<td><input name="'.$lugar_dict[$key].'" value="'.$columna.'" hidden>'.$columna.'</td>';
                                            } elseif ($key == 9) {
                                                if ($columna == NULL) {
                                                    echo '<td><input name="'.$lugar_dict[$key].'" value="" hidden>No tiene</td>';
                                                } else {
                                                    echo '<td><input name="'.$lugar_dict[$key].'" value="'.$columna.'" hidden>'.$columna.'</td>';
                                                }
                                            } elseif ($key == 4) {
                                                if ($columna != NULL) {
                                                    echo '<td><input name="'.$lugar_dict[$key].'" value="'.$columna.'" hidden><img src="'.$columna.'" width="50" height="50"></td>';
                                                } else {
                                                    echo '<td><input name="'.$lugar_dict[$key].'" value="" hidden>No tiene foto</td>';
                                                }
                                            }
                                        }
                                        echo '<td><div class="btn-group" role="group">
                                                <input class="btn btn-warning" type="submit" name="editar" value="Editar">
                                                <input class="btn btn-danger" type="submit" name="eliminar" value="Eliminar">
                                            </div></td></form></tr>';
                                    }
                                    ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </main>
                <?php
                include ROOT . '/static/footer.php';
                ?>
            </div>
        </div>
        <script src="js/jquery.js"></script>
        <script src="js/jquery_min.js"></script>
        <script src="js/data_table.js"></script>
        <script src="js/scripts.js"></script>
    </body>
</html>
