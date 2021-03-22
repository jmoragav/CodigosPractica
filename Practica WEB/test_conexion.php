







<html lang="es">
<head>
  <title>Test conexion</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<!-- Popper JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>


<!-- Latest compiled JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script  src="conexion.js"></script>


</head>

<body class="bg-secondary" onload="initPage()">

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

      <li class="nav-item active ">
        <a class="nav-link" href="#">Prueba de conexión</a>
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
    <div class="row bg-secondary ">
        
        <div class="col-sm-12">
          <br>
          <div class="card card-body bg-light">

  <h2 class="text-center" style="margin-bottom: 20px">Test de conexión</h2>

  <br>
   <div class="form-group">
    <label for="select_disp">Dispositivo a probar</label>
    <select class="form-control" id="select_disp" onchange="DisplayDisp()">
         <option disabled selected>Selecciona una opción</option>
      
     
    </select>
  </div>
    <div class="form-group">
      <label for="Ip">Ip:</label>
      <input type="text" class="form-control" id="ip" placeholder="Enter Ip" name="ip">
    </div>
    <div class="form-group">
      <label for="port">Puerto:</label>
      <input type="text" class="form-control" id="port" placeholder="Enter port" name="port">
    </div>

     <div class="form-group">
    <label for="select_comando">Tipo de comunicación MODBUS</label>
    <select class="form-control" id="select_comando" onchange="DisplayConsulta()">
         <option disabled selected>Selecciona una opción</option>
      <option value=1>TCP</option>
      <option value=2>RTU</option>
     
    </select>
  </div>





   <div class="form-group" id="consulta_div">
   
  </div>


<div  class="d-none" id="fake-check">

    Seleccione los terminales a leer
    <br>
  <div class="text-center" id="input_checkbox">

</div>
</div>



     <div class="form-group" id="input_comando">
    
    </div>






    <button type="button " class="btn  btn-info mx-auto" onclick="startTest()">Probar conexion</button>
  
  
      </div>
          <br>
        </div>
      
      </div>

      </div>





          <div id="mensaje"class="modal fade bd-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mensaje" aria-hidden="true">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">


    <div class="modal-header">
        <h5 class="modal-title">Resultado conexion</h5>
      
        
      </div>
      <div  id="result_div" class="modal-body">
        <p> Se a registrado de manera existosa el silo</p>
      </div>
      <div class="modal-footer">
       <button type="button" class="btn btn-secondary" data-dismiss="modal" aria-label="Close">Ok </button>
      </div>
 
    
    </div>
  </div>
</div>


    </body>
    </html> 