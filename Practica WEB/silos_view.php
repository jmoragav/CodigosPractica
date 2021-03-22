<?php
session_start();

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

$stmt_disp=   mssql_init('[dbo].[pkg_Dispositivo.Activo]');

$result_disp=mssql_execute($stmt_disp);

$array_disp=array();
while ( $record_disp = mssql_fetch_array($result_disp) )
{
  array_push($array_disp, $record_disp);
}


mssql_free_statement($stmt_disp);



$stmt_usr=   mssql_init('[dbo].[pkg_Usuario.Activo]');

$result_usr=mssql_execute($stmt_usr);

$array_usr=array();
while ( $record_usr = mssql_fetch_array($result_usr) )
{
  array_push($array_usr, $record_usr);
}


mssql_free_statement($stmt_usr);



$json_usr=dumpToJson($array_usr);
$json_dis=dumpToJson($array_disp);


?>

<html lang="es">
<head>
  <title>Registro de Silos</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<!-- Popper JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>

<!-- Latest compiled JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script>let datos_usr=<?php echo $json_usr ?>;
console.log(datos_usr);

let datos_disp=<?php echo $json_dis ?>;

console.log(datos_disp);

</script>
<script src="silos_view_php.js"></script>


</head>

<body class="bg-secondary" onload="initView()" >

<nav class="navbar navbar-expand-lg navbar-dark bg-info">
  
  <img src="images\logo.png" width="350"  height="45" alt="" class="d-inline-block align-middle mr-2">
  
 

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
         <li class="nav-item  ">
        <a class="nav-link" href="./reporte_silos.php">Reportes de Silos</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="./login.php">Iniciar Sesion</a>
      </li>
      <li class="nav-item ">
        <a class="nav-link" href="./register.html">Registrar Usuario</a>
      </li>
    
       <li class="nav-item dropdown active">
        <a class="nav-link dropdown-toggle " href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Administracion de Silos y Dispositivos
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item " href="./dispositivos.php">Dispositivos</a>
          <a class="dropdown-item active" href="./red_silos.php">Silos</a>
       
        </div>
      </li>
       <li class="nav-item  ">
        <a class="nav-link" href="./data_logger.php">Data Logger</a>
      </li>
   
   
    </ul>
    
  </div>
</nav>






<div class="container-fluid ">












     <div class="row bg-secondary">
      <br>
             </div>

<div class="row bg-secondary">
        <div class="col-md-12">
          <div class="card card-body bg-light">
            <h2 class="text-center" style="margin-bottom: 20px">Silos Activos</h2>


          
         <div class="table table-bordered">          
         <table class="table">
        <thead>
          <tr class="m-0">
          <th class="w-20 text-center">Numero de Silo</th>
          <th class="w-20 text-center">Nombre</th>
          <th class="w-20 text-center">Ubicación</th>
          <th class="w-20 text-center">Valor Minimo</th>
          <th class="w-20  text-center">Valor Maximo</th>
         <th class="w-20  text-center">Descripción</th>
          
          </tr>
        </thead>
        <tbody id="tabla_datos">

             <!---aca deberia codear de pana --->
          



        </tbody>
        </table>
        </div>




        <div class="row ">

        <div class="col-md-6 text-center">
          <button type="button" id="atras" class="btn btn-secondary" value=0 onclick="tabla_anterior()">Registros anteriores</button>
         
          
        
        </div>

        <div class="col-md-6 text-center">
          

        <button type="button" id="adelante" class="btn btn-secondary" value= 10 onclick="tabla_siguiente()">Registros siguientes</button>
        
        </div>


     



        </div>
          </div>
        </div>
        </div>











</div>

































</body>
</html>