<?php
include 'utils/database.php';

session_start();

if ($_SESSION['session'] == true) {
    header('Location: index.php');
}

if ($_SESSION['validate'] == NULL) {
    $_SESSION['validate'] = 0;
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
                                            <?php
                                            if ($_SESSION['validate'] == 1) {
                                                echo '<div class="alert alert-danger d-flex align-items-center justify-content-start mt-4 mb-0" role="alert">
                                                        Credenciales incorrectas!
                                                    </div>';
                                            }
                                            ?>
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
            include('footer.html');
            ?>
        </div>
    </body>
</html>
