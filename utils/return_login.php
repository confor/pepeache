<?php

session_start();

include 'utils/database.php';

if ($_SESSION['session'] != true) {
    header('Location: login.php');
}
