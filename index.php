<?php

define('ROOT', '/var/www/html2/pepeache-patch-2');

require ROOT . '/utils/return_login.php';
require_once ROOT . '/utils/common.php';
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
        require ROOT . '/static/navbar.php';
        ?>
        <div id="layoutSidenav">
            <?php
            require ROOT . '/static/sidebar.php';
            ?>
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid px-4">
                        <h1 class="mt-4">Panel administrativo de UtalcaGO</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item active">Tu cuenta</li>
                        </ol>
                        <?php if (isset($_SESSION['userMessage']) && strlen($_SESSION['userMessage']) > 0) { ?>
                            <div class="row">
                                <div class="col-xl-3">
                                    <div class="card text-white mb-4 bg-opacity-50 bg-success">
                                        <div class="card-body"><?= out($_SESSION['userMessage']) ?></div>
                                    </div>
                                </div>
                            </div>
                        <?php
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
                                        <input type="text" class="form-control" id="name" name="name" value="<?= out($_SESSION['name']) ?>" readonly>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="rut" class="form-label">RUT</label>
                                        <input type="text" class="form-control" id="rut" name="rut" value="<?= out($_SESSION['rut']) ?>" readonly>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="email" class="form-label">Correo electrónico</label>
                                        <input type="email" class="form-control" id="email" name="email" value="<?= out($_SESSION['email']) ?>" readonly>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="place" class="form-label">Lugar asociado</label>
                                        <input type="text" class="form-control" id="place" name="place" value="<?= out($_SESSION['lugar']) ?>" readonly>
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
                require ROOT . '/static/footer.php';
                ?>
            </div>
        </div>
        <script src="js/scripts.js"></script>
    </body>
</html>
