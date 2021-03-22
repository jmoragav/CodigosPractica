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

<script src="silos_php.js"></script>
<!-- Latest compiled JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script>let datos_usr=<?php echo $json_usr ?>;
console.log(datos_usr);

let datos_disp=<?php echo $json_dis ?>;

console.log(datos_disp);

</script>


</head>

<body onload="initPage()">


  <nav class="navbar navbar-expand-lg navbar-dark bg-info">
  
  <img src="images\logo.png" width="350"  height="45" alt="" class="d-inline-block align-middle mr-2">
  
 

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      
       <li class="nav-item  ">
        <a class="nav-link" href="./reporte_silos.php">Reportes de Silos</a>
      </li>
      <li class="nav-item dropdown active">
        <a class="nav-link dropdown-toggle " href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Administracion de Silos y Dispositivos
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item " href="./dispositivos.php">Dispositivos</a>
          <a class="dropdown-item active" href="#">Silos</a>
       
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






<div class="container-fluid">












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
         <th class="w-10  text-center">Editar Valores</th>
         <th class="w-10  text-center">Eliminar</th>
          
          </tr>
        </thead>
        <tbody id="tabla_datos">

             <!---aca deberia codear de pana --->
          



        </tbody>
        </table>
        </div>




        <div class="row ">

        <div class="col-md-6 text-center">
          <button type="button" id="atras" class="btn btn-secondary" value=0 onclick="tabla_anterior()">Silos anteriores</button>
         
          
        
        </div>

        <div class="col-md-6 text-center">
          

        <button type="button" id="adelante" class="btn btn-secondary" value= 10 onclick="tabla_siguiente()">Silos siguientes</button>
        
        </div>


     



        </div>
          </div>
        </div>
        </div>









    <div class="row bg-secondary ">
        
        <div class="col-sm-12">
          <br>
          <div class="card card-body bg-light">

  <h2 class="text-center" style="margin-bottom: 20px">Registro de silos</h2>

  <br>
  <form id="form-silo" method="post">
  <div class="form-row">
    <div class="col-md-6 mb-3">
      <label for="Nombre">Nombre</label>
      <input type="text" class="form-control" id="Nombre" name="Nombre" required>
      <div id="NombreFeedback" >
      
      </div>
    </div>
    
  
    <div class="col-md-6 mb-3">
      <label for="Ubicacion">Ubicación</label>
      <input type="text" class="form-control" id="Ubicacion"  name="Ubicacion" required>
      <div id="UbicacionFeedback">
       
      </div>
    </div>
  </div>
  <div class="form-row">
    <div class="col-md-6 mb-3">
      <label for="Minimo">Minimo</label>
      <input type="text" class="form-control" id="Minimo" name="Minimo" aria-describedby="MinimoFeedback" required>
      <div id="MinimoFeedback">
        
      </div>
    </div>
    

    <div class="col-md-6 mb-3">
      <label for="Maximo">Maximo</label>
      <input type="text" class="form-control" id="Maximo" name="Maximo" aria-describedby="MaximoFeedback" required>
      <div id="MaximoFeedback">
        
      </div>
    </div>


  </div>


  <div class="form-row">




<div class="col-md-4 mb-3">
      <label for="Usuario">Usuario</label>
      <select class="custom-select " id="Usuario" name="Usuario"  aria-describedby="UsuarioFeedback" required>
             <option selected disabled value="">Elija un Usuario</option>
      </select>
      <div id="UsuarioFeedback" >
      
      </div>
    </div>




<div class="col-md-4 mb-3">
      <label for="Dispositivo">Dispositivo</label>
      <select class="custom-select " id="Dispositivo" name="Dispositivo" aria-describedby="DispositivoFeedback" required>
             <option selected disabled value="">Elija un dispositivo</option>
      </select>
      <div id="DispositivoFeedback" >
      
      </div>
    </div>




<div class="col-md-4 mb-3">
      <label for="Dispositivo">Estado</label>
      <select class="custom-select " id="Estado" name="Estado" aria-describedby="EstadoFeedback" required>
            <option selected disabled value="">Elija un estado</option>
          <option value="Activo">Activo</option>
          <option value="Inactivo">Inactivo</option>
      </select>
      <div id="EstadoFeedback" >
      
      </div>
    </div>








  </div>


<div class="form-group">
    <label for="Descripcion">Descripción</label>
    <textarea class="form-control" id="Descripcion" name="Descripcion" rows="3"></textarea>



  </div>
<button type="button" class="btn btn-primary" onclick="checkVal()">Registrar Silo</button>
 </form>
  
      </div>
          <br>
        </div>
      
      </div>



</div>
































<div id="mensaje"class="modal fade bd-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mensaje" aria-hidden="true">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">


    <div class="modal-header">
        <h5 class="modal-title">Registro exitoso</h5>
      
        
      </div>
      <div class="modal-body">
        <p> Se a registrado de manera existosa el silo</p>
      </div>
      <div class="modal-footer">
      <button type="button" class="btn btn-primary" onclick="comenzar_reg()">Aceptar</button>
      </div>
 
    
    </div>
  </div>
</div>













<div id="editar" class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="editar" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">


    <div class="modal-header">
        <h5 class="modal-title">Editar tabla</h5> 
         <button type="button" class="close" data-dismiss="modal" aria-label="Close">
      
        
      </div>
      <div class="modal-body">
       <div class="form-row">
    <div class="col-md-6 mb-3">
      <label for="Nombre">Nombre</label>
      <input type="text" class="form-control" id="nom_alt" >
      
    </div>
    
  
    <div class="col-md-6 mb-3">
      <label for="Ubicacion">Ubicación</label>
      <input type="text" class="form-control" id="ubc_alt"  >
     
    </div>
  </div>
  <div class="form-row">
    <div class="col-md-6 mb-3">
      <label for="Minimo">Minimo</label>
      <input type="text" class="form-control" id="min_alt" >
    
    </div>
    

    <div class="col-md-6 mb-3">
      <label for="Maximo">Maximo</label>
      <input type="text" class="form-control" id="max_alt" >
    
    </div>


  </div>
  <div class="form-group">
    <label for="Descripcion">Descripción</label>
    <textarea class="form-control" id="desc_alt"  rows="3"></textarea>



    </div>
      </div>
      <div class="modal-footer">
      <button type="button" id="alter_but" class="btn btn-primary" onclick="alterTable()">Aceptar</button>
             <button type="button" class="btn btn-secondary" data-dismiss="modal" aria-label="Close">Cancelar </button>
      </div>
 
    
    </div>
  </div>
</div>








<div id="delete" class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="delete" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">


    <div class="modal-header">
        <h5 class="modal-title">Eliminar Silo</h5> 
         <button type="button" class="close" data-dismiss="modal" aria-label="Close"> </button>
      
        
      </div>
      <div class="modal-body">
        Esta seguro que quiere eliminar este Silo?

      </div>
      <div class="modal-footer">
      <button type="button" id="delete_but" class="btn btn-primary" onclick="borrar_silo()">Aceptar</button>
       <button type="button" class="btn btn-secondary" data-dismiss="modal" aria-label="Close">Cancelar </button>
      </div>
 
    
    </div>
  </div>
</div>




</body>
</html>
