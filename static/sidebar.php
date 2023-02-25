<?php
include 'utils/return_login.php';
require_once 'utils/common.php';
?>
<div id="layoutSidenav_nav">
    <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
        <div class="sb-sidenav-menu">
            <div class="nav">
                <div class="sb-sidenav-menu-heading">Resumen</div>
                    <a class="nav-link" href="index.php">
                        Tu cuenta
                    </a>
                <div class="sb-sidenav-menu-heading">Administrar</div>
                <?php if ($_SESSION['admin'] == 0) { ?>
                    <a class="nav-link" href="">
                        *nombre de tu lugar*
                    </a>
                    <a class="nav-link" href="">
                        Opiniones
                    </a>
                    <a class="nav-link" href="">
                        Estadisticas del *nombre de tu lugar*
                    </a>
                <?php } else { ?>
                    <a class="nav-link" href="lugares.php">
                        Lugares
                    </a>
                    <a class="nav-link" href="">
                        Usuarios
                    </a>
                    <a class="nav-link" href="">
                        Opiniones
                    </a>
                    <a class="nav-link" href="">
                        Estadisticas de los lugares
                    </a>
                <?php } ?>
            </div>
        </div>
        <div class="sb-sidenav-footer">
            <div class="small">Conectado como:</div>
            <span><?= out($_SESSION['name']) ?></span>
        </div>
    </nav>
</div>
