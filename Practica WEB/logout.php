<?php


session_start();
session_destroy();
header('Location: ' . "./reporte_silos.php");
die();


?>