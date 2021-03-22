<?php



$mod=$_POST['Modelo'];
$fab=$_POST['Fabricante'];
$ip=$_POST['Ip'];
$port=intval($_POST['Puerto']);
$com=$_POST['Comando'];

$est=$_POST['Estado'];
$des=$_POST['Descripcion'];



	

$serverName = "NEP-DC-F02"; 


$username ="practica";
$password ="practica";
$database ="SilosPractica";


$conn = mssql_connect($serverName, $username, $password);







$stmt = mssql_init('[dbo].[pkg_Dispositivo.InsertDispositivo]');

mssql_bind($stmt, '@Modelo',   $mod,   SQLVARCHAR ,false,false,50);
mssql_bind($stmt, '@Fabricante',   $fab,   SQLVARCHAR ,false,false,50);

mssql_bind($stmt, '@Ip',   $ip,   SQLVARCHAR ,false,false,50);
mssql_bind($stmt, '@Puerto',   $port,   SQLINT4 ,false,false,3);
mssql_bind($stmt, '@Estado',   $est,   SQLVARCHAR ,false,false,50);
mssql_bind($stmt, '@DefaultComando',   $com,   SQLVARCHAR ,false,false,50);
mssql_bind($stmt, '@Descripcion',   $des,   SQLVARCHAR ,false,false,50);

$result=mssql_execute($stmt);




header('Location: ' . "./dispositivos.php");
die();

?>