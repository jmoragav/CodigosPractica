<?php
	$id=$_GET['id'];
	$val=$_GET['val'];





	$serverName = ""; 


	$username ="";
	$password ="";
	$database ="";

$conn = mssql_connect($serverName, $username, $password);




$stmt = mssql_init('[dbo].[pkg_Registro.InsertarDatos]');

mssql_bind($stmt, '@IdSilo',   $id,   SQLINT4 ,false,false,3);
mssql_bind($stmt, '@Valor',   $val,   SQLINT4 ,false,false,3);

$result=mssql_execute($stmt);













?>