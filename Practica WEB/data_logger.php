<?php
session_start();

$nav="";

if(isset($_SESSION['username']) && !empty($_SESSION['username'])) {
  


  $nav=<<<EOT


  <nav class="navbar navbar-expand-lg navbar-dark bg-info">
  
  <img src="images\logo.png" width="350"  height="45" alt="" class="d-inline-block align-middle mr-2">
  
 

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      
       <li class="nav-item  ">
        <a class="nav-link" href="./reporte_silos.php">Reportes de Silos</a>
      </li>
      <li class="nav-item dropdown ">
        <a class="nav-link dropdown-toggle " href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Administracion de Silos y Dispositivos
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item " href="./dispositivos.php">Dispositivos</a>
          <a class="dropdown-item " href="#">Silos</a>
       
        </div>
      </li>

      <li class="nav-item  ">
        <a class="nav-link" href="./test_conexion.php">Prueba de conexión</a>
      </li>

           <li class="nav-item active ">
        <a class="nav-link" href="#">Data Logger</a>
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

$nav=<<<EOT


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
       
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle " href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Administracion de Silos y Dispositivos
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="./dispositivos.php">Dispositivos</a>
           <a class="dropdown-item" href="./red_silos.php">Silos</a>
       
        
        </div>
      </li> 

        <li class="nav-item active ">
        <a class="nav-link" href="#">Data Logger</a>
      </li>
   
    </ul>
    
  </div>
</nav>


EOT;
}





?>



<html lang="es">
<head>
  <title>Data Logger</title>
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
<script src="data_log.js"></script>

</head>
<body class="bg-secondary" onload="getDataSilo()">

<?php echo $nav; ?>



<div class="container-fluid">
    <div class="row bg-secondary ">
        
        <div class="col-sm-12">
          <br>
          <div class="card card-body bg-light">

  <h2 class="text-center" style="margin-bottom: 20px">Data Logger</h2>

  <br>
   <div class="form-group">
    <label for="select_silo">Silo a registrar datos</label>
    <select class="form-control" id="select_silo" onchange="DisplayDisp()">
         <option disabled selected>Selecciona una opción</option>
      
     
    </select>
  </div>
    <div class="form-group">
      <label for="Dispositivo">Dispositivo:</label>
      <input type="text" class="form-control" id="Dispositivo" disabled>
    </div>
    <div class="form-group">
      <label for="modbus">Comando Modbus por defecto:</label>
      <input type="text" class="form-control" id="modbus" disabled>
    </div>
    <div class="form-group">
      <label for="Tiempo">Intervalo de tiempo del registro (en segundos)</label>
      <input type="text" class="form-control" id="Tiempo" >
    </div>









    <button type="button " class="btn  btn-info mx-auto" onclick="startLog()">Comenzar registro</button>
  
  
      </div>
          <br>
        </div>
      
      </div>

      </div>





          <div id="mensaje"class="modal fade bd-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mensaje" aria-hidden="true">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">


    <div class="modal-header">
        <h5 class="modal-title">Comienzo datalogger</h5>
      
        
      </div>
      <div  id="result_div" class="modal-body">
        <p> Se a comenzado el proceso de registro de datos</p>
      </div>
      <div class="modal-footer">
       <button type="button" class="btn btn-secondary" data-dismiss="modal" aria-label="Close">Ok </button>
      </div>
 
    
    </div>
  </div>
</div>



<br>
<br>
