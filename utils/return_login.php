<?php

session_start();

if ($_SESSION['session'] != true) {
    header('Location: login.php');
}
