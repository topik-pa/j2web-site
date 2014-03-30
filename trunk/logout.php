<?php
session_start();
// Desetta tutte le variabili di sessione.
session_unset();
session_destroy();
header('Location: login.php');
	exit;
?>