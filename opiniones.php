<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
define('ROOT', '/var/www/html');

require ROOT . '/utils/return_login.php';
require ROOT . '/utils/database.php';

$con = connect();

$sql = 'SELECT * FROM opinion';

$OPINIONES = select_all($con, $sql);

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
                        <h1 class="mt-4">Visualizador de opiniones</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item active">Opiniones</li>
                        </ol>
                        <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-table me-1"></i>
                                Tabla de opiniones
                            </div>
                            <div class="card-body">
                                <table id="datatablesSimple">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Opinión</th>
                                            <th>Fecha de cración</th>
                                            <th>ID Lugar</th>
                                            <th>Nombre lugar</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>ID</th>
                                            <th>Opinión</th>
                                            <th>Fecha de cración</th>
                                            <th>ID Lugar</th>
                                            <th>Nombre lugar</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                    <?php
                                    foreach ($OPINIONES as $opinion) {
                                        echo '<tr>';
                                        foreach ($opinion as $key => $columna) {
                                            if ($key != 'id_lugar') {
                                                echo '<td><input name="'.$key.'" value="'.$columna.'" hidden>'.$columna.'</td>';
                                            } else {
                                                if ($columna == NULL) {
                                                    echo '<td><input name="'.$key.'" value="" hidden>No tiene</td>';
                                                    echo '<td><input name="nombre_lugar" value="" hidden>No tiene</td>';
                                                } else {
                                                    echo '<td><input name="'.$key.'" value="'.$columna.'" hidden>'.$columna.'</td>';

                                                    foreach ($LUGARES as $lugar) {
                                                        if ($lugar['id_lugar'] == $columna) {
                                                            $lugar_opinion = $lugar;
                                                            break;
                                                        }
                                                    }

                                                    if ($lugar === false) {
                                                        echo '<td><input name="error" value="" hidden>Error en la base de datos</td>';
                                                    } else {
                                                        echo '<td><input name="'.$lugar_opinion['nombre'].'" value="" hidden>'.$lugar_opinion['nombre'].'</td>';
                                                    }
                                                }
                                            }
                                        }
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
                include ROOT . '/static/footer.html';
                ?>
            </div>
        </div>
        <script src="js/jquery.js"></script>
        <script src="js/jquery_min.js"></script>
        <script src="js/data_table.js"></script>
        <script src="js/scripts.js"></script>
    </body>
</html>
