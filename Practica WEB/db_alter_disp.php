<?php
	$id=$_GET['id'];
	$fab=$_GET['fab'];
	$ip=$_GET['ip'];
	$puerto=strval($_GET['puerto']);
	$com=$_GET['com'];
	$desc=$_GET['desc'];
	$mod=$_GET['mod'];
	$est="Activo";




	$serverName = ""; 


	$username ="";
	$password ="";
	$database ="";



$conn = mssql_connect($serverName, $username, $password);




$stmt = mssql_init('[dbo].[pkg_Dispositivo.UpdateDispositivo]');

mssql_bind($stmt, '@Modelo',   $mod,   SQLVARCHAR ,false,false,50);
mssql_bind($stmt, '@Fabricante',   $fab,   SQLVARCHAR ,false,false,50);
mssql_bind($stmt, '@Ip',   $ip,   SQLVARCHAR ,false,false,50);
mssql_bind($stmt, '@Puerto',   $puerto,   SQLINT4 ,false,false,4);
mssql_bind($stmt, '@Estado',   $est,   SQLVARCHAR ,false,false,50);
mssql_bind($stmt, '@DefaultComando',   $com,   SQLVARCHAR ,false,false,50);
mssql_bind($stmt, '@Descripcion',   $desc,   SQLVARCHAR ,false,false,50);
mssql_bind($stmt, '@ID',   $id,   SQLINT4 ,false,false,4);
$result=mssql_execute($stmt);













?>