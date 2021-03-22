<?php

$id=$_GET["id"];


?>

<html lang="es">
<head>
  <title>Silos</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
<link rel="stylesheet" href="estilo.css">
<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<!-- Popper JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>


<!-- Latest compiled JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="script_silo.js"></script>
<script src="progressbar.js"></script>
<script src="plot.js"></script>
<script src="https://code.highcharts.com/highcharts.src.js"></script>

<script > let topsilo=<?php echo intval($id);?></script>


</head>
<body onload="initData()">




<div class="container-fluid" >
  <div class="row content">

    <br>
    
    <div class="col-sm-12" id="principal" >
    	 <div class="row bg-info">
      
      	      <img src="logo-neptuno-2.svg" class="	mx-auto d-block " alt="logo" width="500" height="40" style= "margin-top: 10px ; margin-bottom: 10px;">
     
      
 	
      </div>
      <div class="row bg-info">
      	   <h2 class="text-center mx-auto">Silos de arena</h2>
      	     </div>
      <div class="row bg-secondary ">
        <div class="col-sm-4">
          <div class="card card-body bg-light">
            <h4 class="text-center">Silo Activo</h4>
            <p class="text-center" id="SiloTOP"></p> 
          </div>
        </div>
        <div class="col-sm-4">
          <div class="card card-body bg-light">
            <h4 class= "text-center">Ultima lectura</h4>
            <p class="text-center" id="lecturaTOP"></p> 
          </div>
        </div>
        <div class="col-sm-4">
          <div class="card card-body bg-light">
            <h4 class= "text-center">Fecha y hora </h4>
            <p class="text-center" id="fechaTOP"></p> 
          </div>
        </div>
      
      </div>
       <div class="row bg-secondary">
        <div class="col-sm-4">
          <div class="card card-body bg-light ">
            <h4 class="text-center">Estado del terminal leido</h4>
            <div class="row">
           
            <div class="col-sm-12">
            <div class="text-center" id="estado_terminal">
                
               </div>
               </div>

             </div>
          </div>
        </div>





        <div class="col-sm-8">
          <div class="card card-body bg-light ">
            <h4 class="text-center">Estado de capacidad del Silo</h4>
            <div class="row">
            <div class="col-sm-6">
            <div class="mx-auto" id="dibujo">
           <canvas  id="canvas" width="182" height="192">Sorry, your browser doesn't support the &lt;canvas&gt; element.</canvas>
               </div>
               </div>
            <div class="col-sm-6">
            <div class="mx-auto" id="barra">
              
               </div>
               </div>

             </div>
          </div>
        </div>
       

      </div>
      <div class="row bg-secondary">
        <div class="col-md-12">
          <div class="card card-body bg-light">
          	<h2 class="text-center" style="margin-bottom: 20px">Lecturas anteriores</h2>


          
         <div class="table table-bordered">          
  		   <table class="table">
    		<thead>
      		<tr class="m-0">
        	<th class="w-25 text-center">Numero de registro</th>
        	<th class="w-25 text-center">Valor</th>
        	<th class="w-25 text-center">Fecha</th>
        	
      		</tr>
    		</thead>
   			<tbody id="tabla_datos">

   		       <!---aca deberia codear de pana --->
      		



    		</tbody>
  			</table>
  			</div>




  			<div class="row ">

				<div class="col-md-4 text-center">
					<button type="button" id="atras" class="btn btn-secondary" value=0 onclick="tabla_anterior()">Registros anteriores</button>
         
					
				
				</div>

				<div class="col-md-4 text-center">
					

        <button type="button" id="adelante" class="btn btn-secondary" value= 10 onclick="tabla_siguiente()">Registros siguientes</button>
				
				</div>


        <div class="col-md-4 text-center">
          

        <button type="button" id="exportar" class="btn  btn-success" data-toggle="modal" data-target="#modExportar" >Exporta a Excel</button>
        
        </div>



  			</div>
          </div>
        </div>
        </div>
        <div class="row bg-secondary">
        	<div class="col-md-12">
        		<div class="card card-body bg-light">
        			<h2 class="text-center" style="margin-bottom: 20px">Graficos</h2>
              <div class="row">
                  <div class="col-sm-12 text-center"  id="plot_area">

    <div class="form-group">
              <label for="sel_plt" class="text-center">Como desea seleccionar los valores para visualizar el grafico</label>
               <select class="form-control" id="sel_viz" onchange="select_mode();">
                <option selected>Seleccione una opcion</option>
                 <option value="1">Por valores</option>
                  <option value="2">Por fecha - Rango de horas</option>
                  <option value="3">Por fecha - Cantidad de registros</option>
                  
      
              </select>
             </div>


        </div>
         </div>
       <div class="container-fluid" id="grafico"></div>
         <div class="col-md-12  text-center" id="boton_col">

         
        </div>      
      </div>

        		</div>
        	</div>
        </div>
        
     
    </div>



  </div>





<form id="Excel_form">
<div class="modal fade " id="modExportar">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Exportar a Excel</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
         <fieldset class="form-group">
    <div class="row">
      <legend class="col-form-label col-sm-2 pt-0">Forma a exportar</legend>
      <div class="col-sm-10">
        <div class="form-check">
          <input class="form-check-input" type="radio"  id="exportarTodo" name="optradio" value="1" checked>
          <label class="form-check-label" for="exportarTodo">
            Exportar todo
          </label>
        </div>
        <div class="form-check">
          <input class="form-check-input" type="radio"  id="exportarFecha"  name="optradio" value="2">
          <label class="form-check-label" for="exportarFecha">
            Exportar por fechas
          </label>
        </div>
       
      </div>
    </div>
  </fieldset>


     <div class="form-group row">
    <label for="fechainit" class="col-sm-2 col-form-label">Fecha inicial</label>
    <div class="col-sm-10">
      <input type="date" class="form-control" id="fechainit" disabled="true" >
    </div>
  </div>

  <div class="form-group row">
    <label for="fechainit" class="col-sm-2 col-form-label">Fecha final</label>
    <div class="col-sm-10">
      <input type="date" class="form-control" id="fechafinal" disabled="true">
    </div>
  </div>
  <div class="d-none"><input type="text" id="date" name="date">     </div>
 <div class="d-none"><input type="text" id="date_fin" name="date_fin"></div>
<div class="d-none"><input type="text" id="silo_act" name="silo_act"></div>

      </div>

      <!-- Modal footer -->
      <div class="modal-footer">
        <button type="button" class="btn btn-success" onclick="exportar()">Exportar</button>
      </div>

    </div>
  </div>
</div>
</form>

</body>
</html>
