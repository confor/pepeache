<?php

session_start();

include 'return_login.php';

unset($_SESSION['editando']);

header('Location: ../lugares.php');
