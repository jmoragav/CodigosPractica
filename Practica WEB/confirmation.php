<?php
session_start();




	$usr=$_POST['Usuario'];
	$pass=$_POST['Password'];


	$serverName = "NEP-DC-F02"; 


$username ="practica";
$password ="practica";
$database ="SilosPractica";



$conn = mssql_connect($serverName, $username, $password);




$stmt = mssql_init('[dbo].[pkg_Usuario.Logear]');

mssql_bind($stmt, '@Usuario',   $usr,   SQLVARCHAR ,false,false,55);
mssql_bind($stmt, '@Password',   $pass,   SQLVARCHAR ,false,false,55);
$result=mssql_execute($stmt);

$Array = array();
while ( $record = mssql_fetch_array($result) )
{


	array_push($Array, $record);
}


if (count($Array)==0){

session_destroy();
$html=<<<EOD
<html>
<head>

<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<script src="confirmation.js"></script>
</head>

<body>

<form  id="forma" style="display:none" action="login.php" method="post">
 
  <input type="text" id="confirm" name="confirm" value="No"><br>

</form> 

</body>
</html>



EOD;


echo $html;


}




else{


$_SESSION["username"] = $usr;

$html=<<<EOD
<html>

<head>

<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<script src="confirmation.js"></script>
</head>
<body>

<form  id="forma" style="display:none" action="reporte_silos.php" method="post">
 


</form> 

</body>
</html>



EOD;


echo $html;


}





?>