<?php

	$usr=$_POST['Username'];
	$pass=$_POST['Password'];
	$apell=$_POST['apellido'];
	$nom=$_POST['nombre'];
	$em=$_POST['email'];
	$est="Activo";

	$serverName = "NEP-DC-F02"; 


$username ="practica";
$password ="practica";
$database ="SilosPractica";



$conn = mssql_connect($serverName, $username, $password);




$stmt = mssql_init('[dbo].[pkg_Usuario.Registrar]');

mssql_bind($stmt, '@Username',   $usr,   SQLVARCHAR ,false,false,50);
mssql_bind($stmt, '@Password',   $pass,   SQLVARCHAR ,false,false,50);
mssql_bind($stmt, '@Nombre',   $nom,   SQLVARCHAR ,false,false,50);
mssql_bind($stmt, '@Apellido',   $apell,   SQLVARCHAR ,false,false,50);
mssql_bind($stmt, '@Correo',   $em,   SQLVARCHAR ,false,false,50);
mssql_bind($stmt, '@Estado',   $est,   SQLVARCHAR ,false,false,50);
$result=mssql_execute($stmt);




header('Location: ' . "./landing_page.php");
die();











?>