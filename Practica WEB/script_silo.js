let topregister=0;
let toplectura=0;
let data_top=[];
let data_db_array=[];
let data_table_array=[];
let bool_inter=true;
let but_sig_val=10;
let but_ant_val=0;
let id_int=0;

let first_page=true;
let maximo_silo=0
let ip_disp="";
let puerto="";
let comando="";
let status_comando=""

function Timer(funct, delayMs, times)
{
  if(times==undefined)
  {
    times=-1;
  }
  if(delayMs==undefined)
  {
    delayMs=10;
  }
  this.funct=funct;
  var times=times;
  var timesCount=0;
  var ticks = (delayMs/10)|0;
  var count=0;
  Timer.instances.push(this);

  this.tick = function()
  {
    if(count>=ticks)
    {
      this.funct();
      count=0;
      if(times>-1)
      {
        timesCount++;
        if(timesCount>=times)
        {
          this.stop();
        }
      }
    }
    count++; 
  };

  this.stop=function()
  {
    var index = Timer.instances.indexOf(this);
    Timer.instances.splice(index, 1);
  };
}

Timer.instances=[];

Timer.ontick=function()
{
  for(var i in Timer.instances)
  {
    Timer.instances[i].tick();
  }
};




function onTick()
{


    statusTerminal();
  consultaDirecta();
  progress();
  dibujar();
}

function getMax(){


	 $.get({
 			 url: "db_maxval.php?id="+topsilo.toString(),// mandatory
  
 			 success:  function(data){

    					let datos= JSON.parse(data);
    				
    					let valores=datos["value"] 
    					var count = Object.keys(valores).length;
    
    					
  						maximo_silo=valores[0]["value"][0]["value"];
        

        				

        		

      

					},

  					async:false // to make it synchronous
					} )


}


function standar(){
	console.log("Se partio el interval");
	

    let url=getOFF(0);
    getDatos(url);
	procesarDatos();
	escribirTabla();




}

function initData(){
 	



try{
 	getTop();

 	getDatosDisp();

 	getMax();
  onTick();
  var timer= new Timer(onTick,60000,-1);
  var timer2 = new Timer(standar,300000,-1);
    let url=getOFF(0);
    getDatos(url);
    statusTerminal();
	procesarDatos();
    $("#atras").hide();
    $("#adelante").hide();
	escribirTabla();

	progress();
	dibujar();
	window.setInterval(Timer.ontick, 10);
	//crearPlot(1,2);

}

catch(err){


}

}
function hasWhiteSpace(s) {
  return /\s/g.test(s);
}






function statusTerminal(){






 $.get({
       url: "socket_status.php?ip="+ip_disp+"&port="+puerto+"&message="+comando,//status_comando si es de 4~20 mA usar status comando pues de 0~20mA se leen valores oscilantes muy pequños y adam cree que los termianles estan activos
  
       success:  function(data){

           
            
            if(data==-1){


              error_hand();
            }

           else if(data==0){



                  $("#estado_terminal").html("");
                  
                  $("#estado_terminal").append("Conectado <br><br>");

                  $("#estado_terminal").append('<img src="images/on.png" width=150 height=150>');



                }



                else if (data==1){



                  $("#estado_terminal").html("");
                  
                  $("#estado_terminal").append("Desconectado <br><br>");

                  $("#estado_terminal").append('<img src="images/off.png" width=150 height=150>');


                  }


                  

              


          },

            async:true // to make it synchronous
          

  
});


}



function consultaDirecta(){


 $.get({
       url: "socket.php?ip="+ip_disp+"&port="+puerto+"&message="+comando,// mandatory
  
       success:  function(data){




                toplectura=data;
               let topfecha=new Date().toLocaleString();
                $("#SiloTOP").html("Silo "+topsilo.toString());




              if(data==-1){


                error_hand();
              }






               else if(data<4){

                     $("#lecturaTOP").css('color', 'red');

                }

                else{ $("#lecturaTOP").css('color', 'black')}
                $("#lecturaTOP").html(data);
                $("#fechaTOP").html(topfecha);

                



            

      

          },

            async:true // to make it synchronous
          } );





}




function getDatosDisp(){



	 $.get({
 			 url: "db_datos_disp.php?id="+topsilo.toString(),// mandatory
  
 			 success:  function(data){

    					let datos= JSON.parse(data);
    				
    					let valores=datos["value"] 
    					var count = Object.keys(valores).length;
    
    					
  						ip_disp=valores[0]["value"][1]["value"];
  						puerto=valores[0]["value"][2]["value"];
  						dummy=valores[0]["value"][3]["value"];
  						if(hasWhiteSpace(dummy)){

  							comando = dummy.replace(/\s/g, '');
  						}
        				else{


        					comando=dummy;
        				}

        		

      

					},

  					async:false // to make it synchronous
					} )




   if(comando.length==24){



      let terminal=comando.charAt(19);



      let adress=120+parseInt(terminal);

      let hex_add=decimalToHex(adress,0);


      status_comando="000000000006010100"+hex_add+"0001"



   }




}


function decimalToHex(d, padding) {
    var hex = Number(d).toString(16);
    padding = typeof (padding) === "undefined" || padding === null ? padding = 2 : padding;

    while (hex.length < padding) {
        hex = "0" + hex;
    }

    return hex;
}



function progress(){



if(toplectura>=4){

var total = maximo_silo-4;


$("#barra").html("");
var bar = new ProgressBar.Circle("#barra", {
  color: '#aaa',
  // This has to be the same size as the maximum width to
  // prevent clipping
  strokeWidth: 4,
  trailWidth: 1,
  easing: 'easeInOut',
  duration: 1400,
  text: {
    autoStyleContainer: false
  },
  from: { color: '#aaa', width: 1 },
  to: { color: '#333', width: 4 },
  // Set default step function for all animate calls
  step: function(state, circle) {
    circle.path.setAttribute('stroke', state.color);
    circle.path.setAttribute('stroke-width', state.width);

    var value = Math.round(circle.value() * 100);
    if (value === 0) {
      circle.setText('');
    } else {
      circle.setText(value+"%");
    }

  }
});
bar.text.style.fontFamily = '"Raleway", Helvetica, sans-serif';
bar.text.style.fontSize = '2rem';

bar.animate((toplectura-4)/total);

}

}















function getDatos(url_st){

 
	 $.get({
 			 url: url_st,// mandatory
  
 			 success:  function(data){

    					let datos= JSON.parse(data);
    					let keys = Object.keys(datos);
    					keys = keys.reverse();
    					let valores=datos["value"] 
    					var count = Object.keys(valores).length;
    
    					
  						for(var i=0;i<10;i++){


 							if (typeof valores[i] == 'undefined') {
   									 break;
									}
        
  						data_db_array.push(valores[i]["value"]);
        				}

        				

        		

      

					},

  					async:false // to make it synchronous
					} )




	}


function getTop(){

		topregister=0;
	 $.get({
 			 url: "db_top.php?id="+topsilo.toString() ,// mandatory
  
 			 success:  function(data){

    					let datos= JSON.parse(data);
    				
    					let valores=datos["value"] 
    					var count = Object.keys(valores).length;
    
              if(count!=0){
  						data_top.push(valores[0]["value"]);
        

        				    topregister=data_top[0][0]["value"];
       

              topsilo=data_top[0][3]["value"];



                data_top=[];}

        		

      

					},

  					async:false // to make it synchronous
					} )





}



function error_hand(){
window.location.replace("http://neptunocl3:8080/siloslog/Pagina%20Silos");
alert("Error al conecterse con el dispositivo del silo, porfavor verificar la conexion")

}

function procesarDatos(){


	
	let array_final=[];
	
	for(let i=0;i<data_db_array.length;i++){
		let array_procesado=[];
 		for(let j=0; j<4;j++){

 			

 			array_procesado.push(data_db_array[i][j]["value"]);	

 			
 		}
 		array_final.push(array_procesado);
 	}
 	data_table_array=array_final;

 	data_db_array=[];

}

function escribirTabla_copia(){




 $("#tabla_datos").html("");
  let string_tabla="";


  for(let i=0;i<data_table_array.length;i++){
    dato=data_table_array[i];

     let celdas=`
    <tr class="m-0">
              <td class="w-25 text-center"> `+dato[0]+`</td>
              <td class="w-25 text-center"> `+dato[1]+ `</td>
              <td class="w-25 text-center"> `+dato[2]+`</td>
            </tr>
        `;


        string_tabla=string_tabla+celdas;



         if(i==9){
          $("#adelante").show();


        }


        else{

          $("#adelante").hide();

        }

  }


  data_table_array=[];




  $("#tabla_datos").html(string_tabla);
}





function tabla_siguiente(){

  


	let val_sgt=  parseInt($("#adelante").attr("value"));
	let val_ant=parseInt($("#atras").attr("value"));

	if(val_sgt!=but_sig_val && val_ant!=but_ant_val){
			first_page=false;
	
	}


 	let url=getOFF(val_sgt);


 	    getDatos(url);
	procesarDatos();
	escribirTabla_copia();


	
	val_sgt+=10;
	val_ant+=10;

	
	$("#adelante").val(val_sgt.toString());
	$("#atras").val(val_ant.toString());

	if(val_ant!=0){
		$("#atras").show();

	}

}



function tabla_anterior(){






  let val_sgt=  parseInt($("#adelante").attr("value"));
  let val_ant=parseInt($("#atras").attr("value"));



  if(val_sgt==but_sig_val && val_ant==but_ant_val){
          first_page=true;
  }


  else{
      first_page=false;
  
  }


  


  let url=getOFF(val_ant);


      getDatos(url);
  procesarDatos();
  escribirTabla_copia();


  


  if(val_ant==0){
    $("#atras").hide();

  }
  
  if(val_ant!=0){
  val_sgt-=10;
  val_ant-=10;


  $("#adelante").val(val_sgt.toString());
  $("#atras").val(val_ant.toString());


  }


}


function getOFF(off){

    let url_st='db_tabla.php?off='+off.toString()+"&id="+topsilo.toString();
  
      

      return url_st;

    

}


function escribirTabla(){


  if(first_page){
  $("#tabla_datos").html("");
  let string_tabla="";


  for(let i=0;i<data_table_array.length;i++){
    dato=data_table_array[i];

     let celdas=`
    <tr class="m-0">
              <td class="w-25 text-center"> `+dato[0]+`</td>
              <td class="w-25 text-center"> `+dato[1]+ `</td>
              <td class="w-25 text-center"> `+dato[2]+`</td>
            </tr>
        `;


        string_tabla=string_tabla+celdas;


 if(i==9){
          $("#adelante").show();


        }
  }


  data_table_array=[];




  $("#tabla_datos").html(string_tabla);
}
}









 $(document).ready(function () {
       $('input[type=radio][name=optradio]').change(function() {
        if (this.value == '1') {
        $("#fechainit").prop('disabled', true);
        $("#fechafinal").prop('disabled', true);
    }
    else if (this.value == '2') {
        $("#fechainit").prop('disabled', false);
        $("#fechafinal").prop('disabled', false);
    }
});
    });






function exportar(){
  if($('#exportarTodo').is(':checked')){

  







     $.get({
       url: "db_silo_data.php?id="+topsilo.toString(),// mandatory
  
       success:  function(data){

              let datos= JSON.parse(data);
            
              let valores=datos["value"] 
              var count = Object.keys(valores).length;
    
              
                  $('#silo_act').val(valores[0]["value"]["nombre"]["value"]);
     $('#Excel_form').attr('action', 'db_excel_total.php');

     $("#Excel_form").submit()
              
        

                

            

      

          },

            async:false // to make it synchronous
          } )





  }

  else if($('#exportarFecha').is(':checked')){




$.get({
       url: "db_silo_data.php?id="+topsilo.toString(),// mandatory
  
       success:  function(data){

              let datos= JSON.parse(data);
            
              let valores=datos["value"] 
              var count = Object.keys(valores).length;
        

      let fecha_init= $( "#fechainit" ).val();
      let fecha_final= $( "#fechafinal" ).val();

      

      let fechain=reformatDate(fecha_init)+"_"+"00:00:00";
      let fechafin=reformatDate(fecha_final)+"_"+"23:59:59";

      $('#date').val(fechain);
      $('#date_fin').val(fechafin)
              
                  $('#silo_act').val(valores[0]["value"]["nombre"]["value"]);
    let url_st='db_excel_fecha.php' ;


      $('#Excel_form').attr('action', url_st);
       $("#Excel_form").submit()  

                

            

      

          },

            async:false // to make it synchronous
          } )
;
  


      
  }
}







function dibujar(){




console.log("dibujamos")
let treinta_por=Math.round(30*(maximo_silo-4)/100);


let och_por= Math.round(80*(maximo_silo-4)/100);




  var c = document.getElementById("canvas");
var ctx = c.getContext("2d");
ctx.clearRect(0, 0, canvas.width, canvas.height);
ctx.beginPath();
let altura=(toplectura-4)*192/(maximo_silo-4);
let diff= Math.round( 192-altura );
ctx.rect(0, diff, 182, 192);




if(toplectura>=4)
{
if(toplectura-4<treinta_por){
ctx.fillStyle = "red";
ctx.fill();

  }


else if(toplectura-4>treinta_por && toplectura<och_por){


  ctx.fillStyle= "goldenrod";
  ctx.fill();
}


else{


  ctx.fillStyle="green";
  ctx.fill();
}


} 


}



function select_mode(){
  let sel_by_values=`

           <div class="form-group">
              <label for="sel_plt" class="text-center">Cantidad de registros a graficar</label>
               <select class="form-control" id="sel_plt" onchange="plotear();">
                 <option value="">Seleccione un valor</option>
               <option value="30">30</option>
                <option value="60">60</option>
               <option value="90">90</option>
      
              </select>
             </div>
            
              
   

  `

  let sel_by_date_cant=  `  
 <div class="form-row">
                      <div class="col  " >
                     
                      <label for="start">Fecha de inicio:</label>

                    <input  class=" mx-auto  w-25 " type="date" id="start" name="trip-start"
                            value="2021-03-01"
                          min="2021-02-25" max="2021-03-01" >

                    </div>

                    <div class="col   " >
                   
        <label for="sel_plt">Cantidad de registros en el dia</label>
               <select class="  mx-auto" id="sel_plt" >
                 <option value="">Seleccione un valor</option>
               <option value="30">30</option>
                <option value="60">60</option>
               <option value="90">90</option>
      
              </select>
            
                  </div>

                       
                     


              <div class="col " >

                             <button type="button" " class="btn btn-secondary" onclick="plotear_fecha_cant()">Graficar</button>

                        

                      </div>

                      <br>
     
                  

                    </div>

                    <br>
`;

let sel_by_date_hour=  ` 
       <div class="form-row">               

<div class="col" >
                      <label for="start">Fecha:</label>

                     <input class="form-control  mx-auto  w-50 " type="date" id="start" name="trip-start"
                            value="2021-03-01"
                          min="2021-02-25" max="2021-03-01" >
  </div>

<div class="col" >
  
                      <label for="time_init">Hora de inicio:</label>

                     <input class="form-control text-center  w-25 mx-auto" type="time" id="time_init">
                      </div>
                      <div class="col" >
                      <label for="time_init">Hora de termino:</label>

                     <input class="form-control text-center  w-25 mx-auto " type="time" id="time_fins">
  
</div>
 <div class="col " >
        <label for="graf"  > </label>
        <br>
        <br>
        <button type="button" class="btn btn-secondary mx-auto" id="graf" onclick="plot_hour()" >Graficar</button>
      </div>

</div>
<br>

`



   var today = new Date();
  var dd = String(today.getDate()).padStart(2, '0');
  var mm = String(today.getMonth() + 1).padStart(2, '0'); //January is 0!
  var yyyy = today.getFullYear();

  today = yyyy + '-' + mm + '-' + dd;


  let opt_value=parseInt($("#sel_viz").val());



  if(opt_value==1){


      $("#plot_area").html(sel_by_values);
      

  }
  else if(opt_value ==3){



      $("#plot_area").html(sel_by_date_cant);

      $('#start').val(today);
      document.getElementById("start").setAttribute("max", today);
      document.getElementById("start").setAttribute("min", "2018-01-01");
      let boton_back= `<button type="button" id="back_graph" class="btn btn-primary" onclick="mostrarMenu()" >Seleccionar otra busqueda</button>`

$("#boton_col").html(boton_back);

  }

  else {



      $("#plot_area").html(sel_by_date_hour);
      today=today+'T00:00:00'
      $('#start').val(today);
      document.getElementById("start").setAttribute("max", today);
      document.getElementById("start").setAttribute("min", "2021-02-24T00:00:00:00");
      let boton_back= `<button type="button" id="back_graph" class="btn btn-primary" onclick="mostrarMenu()" >Seleccionar otra busqueda</button>`

  $("#boton_col").html(boton_back);}

  
   }