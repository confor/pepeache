<?php

require 'return_login.php';

if (isset($_SESSION['eliminando'])) {
    unset($_SESSION['eliminando']);
}

if (isset($_SESSION['editando'])) {
    unset($_SESSION['editando']);    
}

header('Location: ../lugares.php');
