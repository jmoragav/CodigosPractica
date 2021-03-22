<?php
	$id=$_GET['id'];
	$name=$_GET['name'];
	$ub=$_GET['ub'];
	$min=strval($_GET['min']);
	$max=strval($_GET['max']);
	$desc=$_GET['desc'];




	$serverName = ""; 


	$username ="";
	$password ="";
	$database ="";



$conn = mssql_connect($serverName, $username, $password);




$stmt = mssql_init('[dbo].[pkg_Silo.AlterTable]');

mssql_bind($stmt, '@Nombre',   $name,   SQLVARCHAR ,false,false,50);
mssql_bind($stmt, '@Ubicacion',   $ub,   SQLVARCHAR ,false,false,50);
mssql_bind($stmt, '@Minimo',   $min,   SQLINT4 ,false,false,4);
mssql_bind($stmt, '@Maximo',   $max,   SQLINT4 ,false,false,4);
mssql_bind($stmt, '@Descripcion',   $desc,   SQLVARCHAR ,false,false,50);
mssql_bind($stmt, '@IdSilo',   $id,   SQLINT4 ,false,false,4);
$result=mssql_execute($stmt);













?>