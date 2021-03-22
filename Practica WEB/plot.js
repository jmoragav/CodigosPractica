



let data_plot_raw=[];
let data_x=[];
let data_y=[];


function plotear(){

bool_inter=false;
if(bool_inter){

		console.log("Se termino el interval");
		clearInterval(id_int);
	}




	data_plot_raw=[];
	data_x=[];
	data_y=[];

let valor= $( "#sel_plt" ).val();
if(valor.localeCompare("")){


	let num_val=parseInt(valor);

	let url_st='db_plot.php?limit='+valor+'&id='+topsilo.toString();


	 $.get({
 			 url: url_st,// mandatory
  
 			 success:  function(data){

    					let datos= JSON.parse(data);
    					let keys = Object.keys(datos);
    					keys = keys.reverse();
    					let valores=datos["value"] 
    					var count = Object.keys(valores).length;
    
    					
              if(num_val>count){for(var i=0;i<count;i++){
        
              data_plot_raw.push(valores[i]["value"]);

                }
}

              else{for(var i=0;i<num_val;i++){
        
              data_plot_raw.push(valores[i]["value"]);

                }
}
  						
        				

        		

      

					},

  					async:false // to make it synchronous
					} )


	 formar_arreglos(num_val);


}

}


function reformatDate(dateStr)
{
  dArr = dateStr.split("-");  // ex input "2010-01-18"
  return dArr[2]+ "-" +dArr[1]+ "-" +dArr[0].substring(2); //ex out: 
}





function plot_hour(){



let fecha= $( "#start" ).val();
let time_in= $( "#time_init" ).val();

let time_fin= $( "#time_fins" ).val();

fecha_buena=reformatDate(fecha);

	data_plot_raw=[];
	data_x=[];
	data_y=[];


	let fechain=fecha_buena+"_"+time_in+":00";
	let fechafin=fecha_buena+"_"+time_fin+":00";


	let url_st='db_date_hour_plot.php?init='+fechain+'&fin='+fechafin+'&id='+topsilo.toString();



	 $.get({
 			 url: url_st,// mandatory
  
 			 success:  function(data){

    					let datos= JSON.parse(data);
    					let keys = Object.keys(datos);
    					keys = keys.reverse();
    					let valores=datos["value"] 
    					var count = Object.keys(valores).length;
    
    					if(count==0){

  								
  								alert("No hay registros en este dia");
  							}

  						else{
  						for(var i=0;i<count;i++){
  							

  							if(typeof valores[i] == 'undefined'){

  								break;
  									  formar_arreglos(data_plot_raw.length);
  							}
        
  						data_plot_raw.push(valores[i]["value"]);
        				}

        					  formar_arreglos(count);

        		

      

					}},

  					async:false // to make it synchronous
					} )





}

function plotear_fecha_cant(){




let fecha= $( "#start" ).val();
let lmt= $( "#sel_plt" ).val();
bool_inter=false;
if(!bool_inter){

		console.log("Se termino el interval");
		clearInterval(id_int);
	}


	fecha_buena=reformatDate(fecha);

	data_plot_raw=[];
	data_x=[];
	data_y=[];

	let fechain=fecha_buena+"_"+"00:00:00";
	let fechafin=fecha_buena+"_"+"23:59:59";

	let url_st='db_date_plot.php?limit='+lmt+'&date='+fechain+'&date_fin='+fechafin+'&id='+topsilo.toString();


	 $.get({
 			 url: url_st,// mandatory
  
 			 success:  function(data){

    					let datos= JSON.parse(data);
    					let keys = Object.keys(datos);
    					keys = keys.reverse();
    					let valores=datos["value"] 
    					var count = Object.keys(valores).length;
    
    					if(count==0){

  								
  								alert("No hay registros en este dia");
  							}
  						else{
  						for(var i=0;i<count;i++){
  							

  							if(typeof valores[i] == 'undefined'){

  								break;
  									  formar_arreglos(data_plot_raw.length);
  							}
        
  						data_plot_raw.push(valores[i]["value"]);
        				}

        					  formar_arreglos(count);

        		

      

					}},

  					async:false // to make it synchronous
					} )









}


function mostrarMenu(){

let html_menu=  `    <div class="form-group">
              <label for="sel_plt" class="text-center">Como desea seleccionar los valores para visualizar el grafico</label>
               <select class="form-control" id="sel_viz" onchange="select_mode();">
                <option selected>Seleccione una opcion</option>
                 <option value="1">Por valores</option>
                  <option value="2">Por fecha - Rango de horas</option>
                  <option value="3">Por fecha - Cantidad de registros</option>
                  
      
              </select>
             </div>

`

$("#plot_area").html(html_menu);


$("#boton_col").html("");


$("#grafico").html("");

}



function formar_arreglos(largo){


  if(data_plot_raw.length<largo){



    for(i=0;i<data_plot_raw.length;i++){

    let valor_x=data_plot_raw[data_plot_raw.length-1-i][0]["value"];
    let valor_y=data_plot_raw[data_plot_raw.length-1-i][1]["value"];

    data_x.push(valor_x);
    data_y.push(valor_y);


  }
  }


    else{

      for(i=0;i<largo;i++){

    let valor_x=data_plot_raw[largo-1-i][0]["value"];
    let valor_y=data_plot_raw[largo-1-i][1]["value"];

    data_x.push(valor_x);
    data_y.push(valor_y);


  }


    }



	

	crearPlot(data_x,data_y);
}





function crearPlot(x_axis,y_axis){
	


Highcharts.chart('grafico', {
    chart: {
        type: 'line'
    },
    title: {
        text: 'Registro de valores'
    },
    subtitle: {
        text: 'Medidas con dispositivos USR'
    },
    xAxis: {
        categories: data_x
    },
    yAxis: {
        title: {
            text: 'mA'
        }
    },
    plotOptions: {
        line: {
            dataLabels: {
                enabled: true
            },
            enableMouseTracking: false
        }
    },
    series: [{
        name: 'Mediciones',
        data: data_y
    }]
});





let boton_back= `<button type="button" id="back_graph" class="btn btn-primary" onclick="mostrarMenu()" >Seleccionar otra busqueda</button>`

$("#boton_col").html(boton_back);


interval();


}