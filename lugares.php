<?php
include 'utils/return_login.php';

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
        include('static/navbar.html');
        ?>
        <div id="layoutSidenav">
            <?php
            include('static/sidebar.php');
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
Lunes:Martes:Miercoles:Jueves:Viernes:Sabado:Domingo:</textarea>
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
                                        <?php
                                        if (isset($_SESSION['editando'])) {
                                            echo '<input class="btn btn-secondary" type="submit" value="Editar información">';
                                        } else {
                                            echo '<input class="btn btn-secondary" type="submit" value="Ingresar">';
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
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                    <?php
                                    foreach ($_SESSION['lugares'] as $lugar) {
                                        echo '<tr>';
                                        foreach ($lugar as $columna) {
                                            echo '<td>';
                                            echo $columna;
                                            echo '</td>';
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
                include('static/footer.html');
                ?>
            </div>
        </div>
        <script src="js/jquery.js"></script>
        <script src="js/jquery_min.js"></script>
        <script src="js/data_table.js"></script>
        <script src="js/scripts.js"></script>
    </body>
</html>


<tbody>
<?php
for ($i=0; $i < count($_SESSION['lugares']); $i++) { 
    echo '<tr>';
    for ($j=0; $j < count($i); $j++) { 
        echo '<td>';
        echo $_SESSION['lugares'][$i][$j];
        echo '</td>';
    }   
    echo '</tr>';
}
?>
</tbody>