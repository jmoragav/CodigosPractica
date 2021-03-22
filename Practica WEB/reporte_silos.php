<?php
session_start();


$html_nav="";
if(isset($_SESSION['username']) && !empty($_SESSION['username'])) {

  $html_nav=<<<EOT


<nav class="navbar navbar-expand-lg navbar-dark bg-info">
  
  <img src="images\logo.png" width="350"  height="45" alt="" class="d-inline-block align-middle mr-2">
  
 

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      
       <li class="nav-item active ">
        <a class="nav-link" href="#">Reportes de Silos</a>
      </li>
       <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle " href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Administracion de Silos y Dispositivos
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="./dispositivos.php">Dispositivos</a>
           <a class="dropdown-item" href="./red_silos.php">Silos</a>
       
        
        </div>
      </li>
      <li class="nav-item  ">
        <a class="nav-link" href="./test_conexion.php">Prueba de conexión</a>
      </li>

            <li class="nav-item  ">
        <a class="nav-link" href="./data_logger.php">Data Logger</a>
      </li>
      <li class="nav-item  ">
        <a class="nav-link" href="./logout.php">Cerrar Sesión</a>
      </li>



   
    </ul>
    
  </div>
</nav>


EOT;
  
}


else{
session_destroy();
$html_nav= <<<EOT


<nav class="navbar navbar-expand-lg navbar-dark bg-info">
  
  <img src="images\logo.png" width="350"  height="45" alt="" class="d-inline-block align-middle mr-2">
  
 

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
  <li class="nav-item  active">
        <a class="nav-link" href="#">Reportes de Silos</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="./login.php">Iniciar Sesion</a>
      </li>
      <li class="nav-item ">
        <a class="nav-link" href="./register.html">Registrar Usuario</a>
      </li>
       
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle " href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Administracion de Silos y Dispositivos
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="./dispositivos.php">Dispositivos</a>
           <a class="dropdown-item" href="./red_silos.php">Silos</a>
       
        
        </div>
      </li> 

      <li class="nav-item  ">
        <a class="nav-link" href="./data_logger.php">Data Logger</a>
      </li>
   
    </ul>
    
  </div>
</nav>
EOT;


}

function dumpToJson($var, $encode = true, array $recursionCache = array()) {
    $tmp = serialize($var);
    if (isset($recursionCache[$tmp])) {
        return 'recursion';
    }
    $recursionCache[$tmp] = true;
    $result = array();
    $result['type'] = gettype($var);
    switch ($result['type']) {

        case 'resource':
            $result['resourceType'] = get_resource_type($var);
        case 'boolean':
            $result['value'] = (int) $var;
            break;
        case 'array':
            $result['value'] = array();
            foreach ($var as $key => $value) {
                $result['value'][$key] = dumpToJson($value, false, $recursionCache);
            }
            break;
        case 'object':
            $r = new ReflectionObject($var);
            $result['class'] = $r->getName();
            $result['value'] = array();
            foreach ($r->getProperties() as $prop) {
                $prop->setAccessable(true);
                $result['value'][$prop->getName()] = dumpToJson($prop->getValue($var), false, $recursionCache);
            }
            break;
        case 'integer':
        case 'double':
        case 'string':
        case 'NULL':
        default:
            $result['value'] = $var;
            break;
    }
    if ($encode) {
        return json_encode($result);
    }
    return $result;
}


$serverName = "NEP-DC-F02"; 


$username ="practica";
$password ="practica";
$database ="SilosPractica";



$conn = mssql_connect($serverName, $username, $password);

$stmt = mssql_init('[dbo].[pkg_Silo.Activo]');

$result=mssql_execute($stmt);


$Array = array();
while ( $record = mssql_fetch_array($result) )
{
	array_push($Array, $record);
}



$test=dumpToJson($Array);

?>



<html lang="es">
<head>
  <title>Reportes de Silos</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<!-- Popper JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>


<!-- Latest compiled JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<script>let datos_silos=<?php echo $test ?>;
console.log(datos_silos);
</script>

<script src="reporte_silos.js"></script>

</head>
<body class="bg-secondary" onload="colocar_silos()">



<?php  echo $html_nav; ?>

<br>
<br>

<div class="container" >
  <div class="row justify-content-center">
  	<div class="col-sm-8 justify-content-center">
  	<div class="card text-center ">
  		<h2 class="text-center">Reporte de Silos</h2>  
  			<br>
  		<div class="form-row">
  			<div class="form-group col">


  				<label  for="inputState">Silo a reportar</label>
      <select id="selec_silo" class="form-control">
    
        
    </select>
  			</div>



  		</div>
  		<div class="form-group row">
    <div class="col text-center">
      <button type="button" class="btn btn-info" onclick="generarReporte()">Generar reporte</button>
    </div>
  </div>
  </div>

  	</div>
  </div>
</div>
</div>

</body>
</html>