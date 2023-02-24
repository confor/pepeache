<?php

session_start();
unset($_SESSION['validate']);
session_destroy();

header('Location: ../login.php');
