<?php

define('ROOT', '/var/www/html2/pepeache-patch-2');
require ROOT . '/utils/return_login.php';

if (isset($_SESSION['eliminando'])) {
    unset($_SESSION['eliminando']);
}

if (isset($_SESSION['editando'])) {
    unset($_SESSION['editando']);
}

header('Location: ../lugares.php');
