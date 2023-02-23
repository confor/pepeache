<?php

require 'return_login.php';

unset($_SESSION['editando']);

header('Location: ../lugares.php');
