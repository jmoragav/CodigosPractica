
<?php


 if (empty($_POST['confirm'])) {



 	$html=<<<EOD
 <html lang="es">
<head>
  <title>Iniciar Sesión</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<!-- Popper JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>


<!-- Latest compiled JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>


<style>
.login-form {
    width: 340px;
    margin: 50px auto;
  	font-size: 15px;
}
.login-form form {
    margin-bottom: 15px;
    background: #f7f7f7;
    box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.3);
    padding: 30px;
}
.login-form h2 {
    margin: 0 0 15px;
}
.form-control, .btn {
    min-height: 38px;
    border-radius: 2px;
}
.btn {        
    font-size: 15px;
    font-weight: bold;
}
</style>
</head>



<body class="bg-secondary">


<nav class="navbar navbar-expand-lg navbar-dark bg-info">
  
  <img src="images\logo.png" width="350"  height="45" alt="" class="d-inline-block align-middle mr-2">
  
 

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
        <li class="nav-item ">
        <a class="nav-link" href="./reporte_silos.php">Reportes de Silos</a>
      </li>
      <li class="nav-item active">
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

<div class="login-form">
<form action="confirmation.php" method="post">
<img src="images/logo_neptuno.jpg" style="
 margin-left: 45px;
 margin-bottom: 10px;">
<h2 class="text-center">Iniciar Sesión</h2>       
<div class="form-group">
<input type="text" class="form-control" name="Usuario" placeholder="Usuario" required="required">
</div>
<div class="form-group">
<input type="password" class="form-control" name="Password" placeholder="Contraseña" required="required">
</div>
<div class="form-group">
<button type="submit" class="btn btn-info btn-block">Entrar</button>
</div>
<p class="text-center"><a href="/register.php">Crear una cuenta</a></p>
</form>
</div>
</body>
</html>
EOD;
    echo $html;
  }




  else if($_POST['confirm']=="No"){



 	$html= <<<EOT




<html lang="es">
<head>
  <title>Iniciar Sesión</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<!-- Popper JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>


<!-- Latest compiled JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>


<style>
.login-form {
    width: 340px;
    margin: 50px auto;
  	font-size: 15px;
}
.login-form form {
    margin-bottom: 15px;
    background: #f7f7f7;
    box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.3);
    padding: 30px;
}
.login-form h2 {
    margin: 0 0 15px;
}
.form-control, .btn {
    min-height: 38px;
    border-radius: 2px;
}
.btn {        
    font-size: 15px;
    font-weight: bold;
}
</style>
</head>



<body class="bg-secondary">

<nav class="navbar navbar-expand-lg navbar-dark bg-info">
  
  <img src="images\logo.png" width="350"  height="45" alt="" class="d-inline-block align-middle mr-2">
  
 

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item ">
        <a class="nav-link" href="./landing_page.php">Home <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item active">
        <a class="nav-link" href="./login.php">Iniciar Sesion</a>
      </li>
      <li class="nav-item ">
        <a class="nav-link" href="./register.html">Registrar Usuario</a>
      </li>
      <li class="nav-item ">
        <a class="nav-link" href="./reporte_silos.php">Reportes de Silos</a>
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
<div class="login-form">
    <form action="confirmation.php" method="post">
    	<img src="images/logo_neptuno.jpg" style="
    margin-left: 45px;
    margin-bottom: 10px;
			">
        <h2 class="text-center">Iniciar Sesión</h2>       
        <div class="form-group">
            <input type="text" class="form-control" name="Usuario" placeholder="Usuario" required="required">
        </div>
        <div class="form-group">
            <input type="password" class="form-control" name="Password" placeholder="Contraseña" required="required">
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-info btn-block">Entrar</button>
        </div>
     <p class="text-center" style="color:red; font-size:11px" >Los datos entregados son incorrectos o no se a registrado</p>
     <br>
     <p class="text-center"><a href="/register.php">Crear una cuenta</a></p>
    </form>
    
</div>
</body>
</html>
EOT;


echo $html;

  }











?>





