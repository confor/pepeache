<?php

require 'return_login.php';

$_SESSION['editando'] = true;

header('Location: ../lugares.php?a='.$_GET['a'].'&b='.$_GET['b'].'&c='.$_GET['c'].'&d='.$_GET['d'].'&e='.$_GET['e'].'&f='.$_GET['f'].'&g='.$_GET['g'].'&h='.$_GET['h'].'&i='.$_GET['i'].'&j='.$_GET['j']);
