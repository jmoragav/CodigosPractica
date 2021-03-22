<?php 

session_start();
if(isset($_SESSION['username']) && !empty($_SESSION['username'])){






   $html=<<<EOT


<html lang="es">
<head>
  <title>Registro de Dispositivos</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<!-- Popper JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>

<script src="dispositivos_php.js"></script>
<!-- Latest compiled JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

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
          <a class="dropdown-item active" href="#">Dispositivos</a>
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

<div class="container-fluid">
  

     <div class="row bg-secondary">
      <br>
             </div>

<div class="row bg-secondary">
        <div class="col-md-12">
          <div class="card card-body bg-light">
            <h2 class="text-center" style="margin-bottom: 20px">Dispositivos Activos</h2>


          
         <div class="table table-bordered">          
         <table class="table">
        <thead>
          <tr class="m-0">
          <th class="w-14 text-center">Numero de dispositivo</th>
          <th class="w-14 text-center">Modelo</th>
          <th class="w-14 text-center">Fabricante</th>
          <th class="w-14 text-center">Ip</th>
          <th class="w-14 text-center">Puerto</th>
          <th class="w-14 text-center">Comando</th>
          <th class="w-14 text-center">Descripcion</th>
          <th class="w-10 text-center">Editar</th>
          <th class="w-10 text-center">Eliminar</th>
          
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











    <div class="row bg-secondary ">
        
        <div class="col-sm-12">
          <br>
          <div class="card card-body bg-light">
            

<h2 class="text-center" style="margin-bottom: 20px">Registro de Dispositivos</h2>

  <form id="form-disp" method="post" action="procesar_dispositivo.php">
  <div class="form-row">
    <div class="col-md-6 mb-3">
      <label for="Modelo">Modelo</label>
      <input type="text" class="form-control" id="Modelo" name="Modelo" required>
      <div id="ModeloFeedback" >
      
      </div>
    </div>
    
  
    <div class="col-md-6 mb-3">
      <label for="Fabricante">Fabricante</label>
      <input type="text" class="form-control" id="Fabricante" name="Fabricante" required>
      <div id="FabricanteFeedback">
       
      </div>
    </div>
  </div>
  <div class="form-row">
    <div class="col-md-6 mb-3">
      <label for="Ip">Ip</label>
      <input type="text" class="form-control" id="Ip" name="Ip"  aria-describedby="IpFeedback" required>
      <div id="IpFeedback">
        
      </div>
    </div>
    

    <div class="col-md-6 mb-3">
      <label for="Puerto">Puerto</label>
      <input type="text" class="form-control" id="Puerto" name="Puerto" aria-describedby="PuertoFeedback" required>
      <div id="PuertoFeedback">
        
      </div>
    </div>


  </div>




  <div class="form-row">
<div class="col-md-12 mb-3">
      <label for="TipoCom">Tipo del comando</label>
      <select class="custom-select " id="TipoCom" name="TipoCom" onchange="enableCom()"  required>
        <option selected disabled value="">Elija el tipo del comando</option>
          <option value="ip">TCP</option>
          <option value="rtu">RTU</option>
      </select>
      
    </div>



  </div>


<div class="form-row">
    <div class="col-md-12 mb-3">
      <label for="Comando">Comando MODBUS por defecto</label>
      <input type="text" class="form-control" id="Comando" name="Comando" disabled  required>
      <div id="ComandoFeedback">
       
      </div>
    </div>
  </div>


  <div class="form-row">




<div class="col-md-12 mb-3">
      <label for="Estado">Estado</label>
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
    <button type="button" class="btn btn-primary" onclick="checkVal()">Registrar Dispositivo</button>

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
        <p> Se a registrado de manera existosa el dispositivo</p>
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
      <label for="Modelo">Modelo</label>
      <input type="text" class="form-control" id="mod_alt">
    
    </div>
    
  
    <div class="col-md-6 mb-3">
      <label for="Fabricante">Fabricante</label>
      <input type="text" class="form-control" id="fab_alt" >
      
    </div>
  </div>



  <div class="form-row">
    <div class="col-md-6 mb-3">
      <label for="Ip">Ip</label>
      <input type="text" class="form-control" id="ip_alt" >
      
    </div>
    

    <div class="col-md-6 mb-3">
      <label for="Puerto">Puerto</label>
      <input type="text" class="form-control" id="port_alt" >
         </div>


  </div>



<div class="form-row">
    <div class="col-md-12 mb-3">
      <label for="Comando">Comando MODBUS por defecto</label>
      <input type="text" class="form-control" id="com_alt" >
      
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
      <button type="button" id="delete_but" class="btn btn-primary" onclick="borrar_disp()">Aceptar</button>
       <button type="button" class="btn btn-secondary" data-dismiss="modal" aria-label="Close">Cancelar </button>
      </div>
 
    
    </div>
  </div>
</div>

</body>
</html>






EOT;



echo $html;


}


else{





session_destroy();

  $html=<<<EOT


<html lang="es">
<head>
  <title>Registro de Dispositivos</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<!-- Popper JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>

<script src="disp_view.js"></script>
<!-- Latest compiled JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</head>

<body class="bg-secondary" onload="initView()">


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
          <a class="dropdown-item active" href="#">Dispositivos</a>
          <a class="dropdown-item" href="./red_silos.php">Silos</a>
       
        </div>
      </li>
   
       <li class="nav-item  ">
        <a class="nav-link" href="./data_logger.php">Data Logger</a>
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
            <h2 class="text-center" style="margin-bottom: 20px">Dispositivos Activos</h2>


          
         <div class="table table-bordered">          
         <table class="table">
        <thead>
          <tr class="m-0">
          <th class="w-14 text-center">Numero de dispositivo</th>
          <th class="w-14 text-center">Modelo</th>
          <th class="w-14 text-center">Fabricante</th>
          <th class="w-14 text-center">Ip</th>
          <th class="w-14 text-center">Puerto</th>
          <th class="w-14 text-center">Comando</th>
          <th class="w-14 text-center">Descripcion</th>
          
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












</body>
</html>






EOT;


echo $html;


}
?>

