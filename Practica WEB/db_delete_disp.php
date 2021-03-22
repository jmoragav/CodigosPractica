<?php
	$id=$_GET['id'];





	$serverName = ""; 


	$username ="";
	$password ="";
	$database ="";


$conn = mssql_connect($serverName, $username, $password);




$stmt = mssql_init('[dbo].[pkg_Dispositivo.ChangeStateDispositivo]');


mssql_bind($stmt, '@IdDispositivo',   $id,   SQLINT4 ,false,false,4);
$result=mssql_execute($stmt);













?>