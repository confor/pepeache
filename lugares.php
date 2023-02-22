<?php
include 'utils/return_login.php';

include 'utils/database.php';

$con = connect();

$sql = 'SELECT * FROM lugar';

$_SESSION['lugares'] = select_all($con, $sql);
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
        include 'static/navbar.php';
        ?>
        <div id="layoutSidenav">
            <?php
            include 'static/sidebar.php';
            ?>  
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid px-4">
                        <h1 class="mt-4">Mantenedor de lugares</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item active">Lugares</li>
                        </ol>
                        <?php

                        if (strlen($_SESSION['lugarMessage']) > 0) {
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
                                <?php
                                if (isset($_SESSION['editando'])) {
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
                                        <form class="row g-3" action="utils/validate_edit_lugar.php" method="post">
                                            <input type="number" class="form-control" id="id_lugar" name="id_lugar" value="'.$_GET['a'].'" required hidden>
                                            <div class="col-md-6">
                                                <label for="id_poly" class="form-label">ID OSM (Open Street Map)</label>
                                                <input type="number" class="form-control" id="id_poly" name="id_poly" value="'.$_GET['b'].'" required>
                                            </div>
                                            <div class="col-md-6">
                                                <label for="nombre" class="form-label">Nombre</label>
                                                <input type="text" class="form-control" id="nombre" name="nombre" value="'.$_GET['c'].'" required>
                                            </div>
                                            <div class="col-md-6">
                                                <label for="descripcion" class="form-label">Descripción</label>
                                                <input type="text" class="form-control" id="descripcion" name="descripcion" value="'.$_GET['d'].'" required>
                                            </div>
                                            <div class="col-md-6">
                                                <label for="url" class="form-label">URL foto (opcional)</label>
                                                <input type="text" class="form-control" id="url" name="url_foto" value="'.$_GET['e'].'">
                                            </div>
                                            <div class="col-md-6">
                                                <label for="horario" class="form-label">Horario (Opcional)</label>
                                                <textarea rows="4" cols="20" class="form-control" id="horario" name="horario">'.$_GET['f'].'</textarea>
                                            </div>
                                            <div class="col-md-6">
                                                <label for="etiquetas" class="form-label">Etiquetas</label>
                                                <input type="text" class="form-control" id="etiquetas" name="etiquetas" value="'.$_GET['h'].'" required>
                                            </div>
                                            <div class="col-md-6">
                                                <label for="id_duenho" class="form-label">ID Dueño (opcional)</label>
                                                <input type="number" class="form-control" id="id_duenho" name="id_duenho" value="'.$_GET['j'].'">
                                            </div>
                                            <div class="col-12 text-end">
                                                <a href="utils/volver_editando.php" class="btn btn-light">Cancelar</a>
                                                <input class="btn btn-secondary" type="submit" value="Editar información">';
                                        } else {
                                            echo '
                                        <form class="row g-3" action="utils/validate_insert_lugar.php" method="post">
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
                                            <th>URL foto</th>
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
                                            <th>URL foto</th>
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
                                    foreach ($_SESSION['lugares'] as $lugar) {
                                        echo '<tr>';
                                        $p = array();

                                        foreach ($lugar as $columna) {
                                            echo '<td>';
                                            echo $columna;
                                            echo '</td>';
                                            array_push($p, $columna);
                                        }
                                        echo '<td>';
                                        echo '<a href="utils/ir_editando.php?a='.$p[0].'&b='.$p[1].'&c='.$p[2].'&d='.$p[3].'&e='.$p[4].'&f='.$p[5].'&g='.$p[6].'&h='.$p[7].'&i='.$p[8].'&j='.$p[9].'" class="btn btn-secondary">Editar</a>';
                                        echo '</td>';
                                        echo '</tr>';
                                    }
                                    ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </main>
                <?php
                include 'static/footer.php';
                ?>
            </div>
        </div>
        <script src="js/jquery.js"></script>
        <script src="js/jquery_min.js"></script>
        <script src="js/data_table.js"></script>
        <script src="js/scripts.js"></script>
    </body>
</html>
