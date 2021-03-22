let array_tabla_raw=[];

let offse=0;


function agregarOpciones(){

	let array_usr=datos_usr["value"];
	let tope=array_usr.length;

	for(var i=0;i<tope; i++){

		var id_usr=array_usr[i]["value"][0]["value"];
		var nombre=array_usr[i]["value"][1]["value"];
		var apellido=array_usr[i]["value"][2]["value"];

		str=id_usr.toString()+" - "+nombre+" "+apellido;
		var o = new Option(str, id_usr);
/// jquerify the DOM object 'o' so we can use the html method
		$(o).html(str);
		$("#Usuario").append(o);


	}




		let array_dis=datos_disp["value"];

	for(var i=0;i<array_dis.length; i++){

		var id_dis=array_dis[i]["value"][0]["value"];
		var modelo=array_dis[i]["value"][1]["value"];

		stri=id_dis.toString()+" - "+modelo
		var o = new Option(stri, id_dis);
/// jquerify the DOM object 'o' so we can use the html method
		$(o).html(stri);
		$("#Dispositivo").append(o);


	}
}



function tabla_siguiente()
{



		let val_sgt=  parseInt($("#adelante").attr("value"));
	let val_ant=parseInt($("#atras").attr("value"));
	offse=val_sgt;
	getDatosTabla(offse);
	EscribirTabla();

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


offse=val_ant

  getDatosTabla(offse);
	EscribirTabla();


  


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





function getDatosTabla(off){



array_tabla_raw=[];


	 $.get({
 			 url: "db_data_silo_php.php?off="+off.toString() ,// mandatory
  
 			 success:  function(data){

    					let datos= JSON.parse(data);
    				
    					let valores=datos["value"] 
    					var count = Object.keys(valores).length;
    
    					
    					for(var i=0;i<count;i++){



    						array_tabla_raw.push(valores[i]["value"]);

    					}
        		

      

					},

  					async:false // to make it synchronous
					} )



}

function esconderbuton(){

	$("#adelante").hide();
		$("#atras").hide();


}


function EscribirTabla(){




 $("#tabla_datos").html("");
  let string_tabla="";


  for(let i=0;i<array_tabla_raw.length;i++){
    dato=array_tabla_raw[i];

     let celdas=`
    <tr class="m-0">
              <td class="w-20 text-center"> `+dato[0]["value"]+`</td>
              <td class="w-20 text-center"> `+dato[1]["value"]+ `</td>
              <td class="w-20 text-center"> `+dato[2]["value"]+`</td>
              <td class="w-20 text-center"> `+dato[3]["value"]+`</td>
              <td class="w-20 text-center"> `+dato[4]["value"]+`</td>
              <td class="w-20 text-center"> `+dato[5]["value"]+`</td>
   
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



function initView(){

	esconderbuton();
	agregarOpciones();
	getDatosTabla(offse);
	EscribirTabla();
}
