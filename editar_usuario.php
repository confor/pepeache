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
        include('navbar.html');
        ?>
        <div id="layoutSidenav">
            <?php
            include('sidebar.php');
            ?>  
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid px-4">
                        <h1 class="mt-4">Panel administrativo de UtalcaGO</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item active">Tu cuenta</li>
                        </ol>
                        <?php
                        if (strlen($_SESSION['editMessage']) > 0) {
                            echo '<div class="row">
                                    <div class="col-xl-3">
                                        <div class="card text-white mb-4 bg-opacity-50 bg-danger"> 
                                            <div class="card-body">'.$_SESSION['editMessage'].'</div>
                                        </div>
                                    </div>
                                </div>';
                            $_SESSION['editMessage'] = '';
                        }
                        ?>
                        <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-table me-1"></i>
                                Edición de los datos de tu cuenta
                            </div>
                            <div class="card-body">
                                <form action="utils/validate_edit_user.php" method="post">
                                    <div class="row g-3">
                                        <div class="col-md-6">
                                            <label for="name" class="form-label">Nuevo nombre</label>
                                            <input type="text" class="form-control" id="name" name="name" value="<?php echo $_SESSION['name'] ?>" required>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="rut" class="form-label">Nuevo RUT (solo números, utilizar 0 en lugar de k)</label>
                                            <input type="text" class="form-control" id="rut" name="rut" value="<?php echo $_SESSION['rut'] ?>" pattern="\d+" required>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="email" class="form-label">Nuevo correo electrónico</label>
                                            <input type="email" class="form-control" id="email" name="email" value="<?php echo $_SESSION['email'] ?>" required>
                                        </div>
                                    </div>
                                    <div class="row g-3">
                                        <div class="col-md-6">
                                            <label for="new_password" class="form-label">Nueva contraseña</label>
                                            <input type="password" class="form-control" id="new_password" name="new_password" required>
                                            <input class="form-check-input" type="checkbox" value="" id="view_pass">
                                            <label class="form-check-label" for="view_pass">
                                                Ver contraseña
                                            </label>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="rep_new_password" class="form-label">Repetir nueva contraseña</label>
                                            <input type="password" class="form-control" id="rep_new_password" name="rep_new_password" required>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="password" class="form-label">Contraseña actual</label>
                                            <input type="password" class="form-control" id="password" name="password" required>
                                        </div>
                                        <div class="col-md-12 text-end">
                                            <input class="btn btn-light" type="submit" value="Cancelar">
                                            <input class="btn btn-secondary" type="submit" value="Editar">
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </main>
                <?php
                include('footer.html');
                ?>
            </div>
        </div>
        <script src="js/scripts.js"></script>
    </body>
</html>
