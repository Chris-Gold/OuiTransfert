<?php
session_start(); // Lancement de session
$_SESSION = array(); // Purge du tableau de session
session_destroy(); // "Destruction" de session
header('Location: ../index.php'); // Renvoie vers index.php
