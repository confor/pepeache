<?php
// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);

define('ROOT', '/var/www/html');

session_start();

if (isset($_SESSION['session'])) {
    header('Location: index.php');
}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <title>Login UtalcaGO</title>
        <link href="css/styles.css" rel="stylesheet" />
    </head>
    <body class="bg-light">
        <div id="layoutAuthentication">
            <div id="layoutAuthentication_content">
                <main>
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-lg-5">
                                <div class="card shadow-lg border-0 rounded-lg mt-5">
                                    <div class="card-header">
                                        <h3 class="text-center font-weight-light my-4">Pagina administrativa de UtalcaGO</h3>
                                    </div>
                                    <div class="card-body">
                                        <form action="utils/validate_login.php" method="post">
                                            <div class="form-floating mb-3">
                                                <input class="form-control" name="email" type="email" required/>
                                                <label for="inputEmail">Correo electrónico</label>
                                            </div>
                                            <div class="form-floating mb-3">
                                                <input class="form-control" name="pass" type="password" required/>
                                                <label for="inputPassword">Contraseña</label>
                                            </div>
                                            <?php if (isset($_SESSION['validate'])) {
                                                if ($_SESSION['validate'] == 1) { ?>
                                                    <div class="alert alert-danger d-flex align-items-center justify-content-start mt-4 mb-0" role="alert">
                                                        Credenciales incorrectas!
                                                    </div>
                                            <?php $_SESSION['validate'] = 0; } elseif ($_SESSION['validate'] == 1) { ?>
                                                    <div class="alert alert-danger d-flex align-items-center justify-content-start mt-4 mb-0" role="alert">
                                                        Error en la base de datos
                                                    </div>
                                            <?php $_SESSION['validate'] = 0;}}?>
                                            <div class="d-flex align-items-center justify-content-end mt-4 mb-0">
                                                <input class="btn btn-secondary" type="submit" value="Iniciar sesión">
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </main>
            </div>
            <?php
            include ROOT . '/static/footer.html';
            ?>
        </div>
    </body>
</html>
