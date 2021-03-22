<?php

$serverName = "NEP-DC-F02"; 


$username ="practica";
$password ="practica";
$database ="SilosPractica";



$conn = mssql_connect($serverName, $username, $password);





	$nom=$_POST['Nombre'];
	$ub=$_POST['Ubicacion'];
	$min=$_POST['Minimo'];
	$max=$_POST['Maximo'];
	$usr=$_POST['Usuario'];
	$dis=$_POST['Dispositivo'];
	$est=$_POST['Estado'];
	$des=$_POST['Descripcion'];



$stmt = mssql_init('[dbo].[pkg_Silo.InsertarDatos]');

mssql_bind($stmt, '@NombreSilo',   $nom,   SQLVARCHAR ,false,false,50);
mssql_bind($stmt, '@Ubicacion',   $ub,   SQLVARCHAR ,false,false,50);
mssql_bind($stmt, '@Descripcion',   $des,   SQLVARCHAR ,false,false,50);
mssql_bind($stmt, '@Min',   $min,   SQLINT4 ,false,false,4);
mssql_bind($stmt, '@Max',   $max,   SQLINT4 ,false,false,4);
mssql_bind($stmt, '@IdDisp',   $dis,   SQLINT4 ,false,false,4);
mssql_bind($stmt, '@IdUsr',   $usr,   SQLINT4 ,false,false,4);
mssql_bind($stmt, '@Estado',   $est,   SQLVARCHAR ,false,false,50);
$result=mssql_execute($stmt);




header('Location: ' . "./silos.php");
die();

?>