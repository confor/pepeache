<?php

session_start();

if (array_key_exists('session', $_SESSION) !== true || $_SESSION['session'] !== true) {
    header('Location: login.php');
}
