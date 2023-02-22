<?php
include 'utils/return_login.php';
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <title>UtalcaGO </title>
        <link href="css/styles.css" rel="stylesheet" />
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
                        <h1 class="mt-4">Panel administrativo de UtalcaGO</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item active">Tu cuenta</li>
                        </ol>
                        <?php
                        if (strlen($_SESSION['userMessage']) > 0) {
                            echo '<div class="row">
                                    <div class="col-xl-3">
                                        <div class="card text-white mb-4 bg-opacity-50 bg-success"> 
                                            <div class="card-body">'.$_SESSION['userMessage'].'</div>
                                        </div>
                                    </div>
                                </div>';
                            $_SESSION['userMessage'] = '';
                        }
                        ?>
                        <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-table me-1"></i>
                                Datos de tu cuenta
                            </div>
                            <div class="card-body">
                                <form class="row g-3">
                                    <div class="col-md-6">
                                        <label for="name" class="form-label">Nombre</label>
                                        <input type="text" class="form-control" id="name" name="name" value="<?php echo $_SESSION['name'] ?>" readonly>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="rut" class="form-label">RUT</label>
                                        <input type="text" class="form-control" id="rut" name="rut" value="<?php echo $_SESSION['rut'] ?>" readonly>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="email" class="form-label">Correo electrónico</label>
                                        <input type="email" class="form-control" id="email" name="email" value="<?php echo $_SESSION['email'] ?>" readonly>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="password" class="form-label">Contraseña</label>
                                        <input type="password" class="form-control" id="password" name="password" value="<?php echo $_SESSION['pass'] ?>" readonly>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="place" class="form-label">Lugar asociado</label>
                                        <input type="text" class="form-control" id="place" name="place" value="<?php echo '*nombre de tu lugar*' ?>" readonly>
                                    </div>
                                    <div class="col-12 text-end">
                                        <a href="editar_usuario.php" class="btn btn-secondary">Editar información</a>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </main>
                <?php
                include('static/footer.html');
                ?>
            </div>
        </div>
        <script src="js/scripts.js"></script>
    </body>
</html>
