let array_tabla_raw=[];

let offse=0;


















function reiniciarValid(){


$("#Nombre").removeClass("is-invalid");
 $("#NombreFeedback").removeClass("invalid-feedback");
$("#NombreFeedback").html("");


$("#Ubicacion").removeClass("is-invalid");
 $("#UbicacionFeedback").removeClass("invalid-feedback");
$("#UbicacionFeedback").html("");


$("#Minimo").removeClass("is-invalid");
 $("#MinimoFeedback").removeClass("invalid-feedback");
$("#MinimoFeedback").html("");




$("#Maximo").removeClass("is-invalid");
 $("#MaximoFeedback").removeClass("invalid-feedback");
$("#MaximoFeedback").html("");


$("#Usuario").removeClass("is-invalid");
 $("#UsuarioFeedback").removeClass("invalid-feedback");
$("#UsuarioFeedback").html("");



$("#Dispositivo").removeClass("is-invalid");
 $("#DispositivoFeedback").removeClass("invalid-feedback");
$("#DispositivoFeedback").html("");



$("#Estado").removeClass("is-invalid");
 $("#EstadoFeedback").removeClass("invalid-feedback");
$("#EstadoFeedback").html("");



}







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




function editClick(row){

		var currentRow=$(row).closest("tr");
		  var id=currentRow.find("td:eq(0)").html();
		 var nombre=currentRow.find("td:eq(1)").html();
		 var ubicacion=currentRow.find("td:eq(2)").html();
		 var min=currentRow.find("td:eq(3)").html();
		 var max=currentRow.find("td:eq(4)").html();
		 var desc=currentRow.find("td:eq(5)").html();
		 prepModal(nombre,ubicacion,min,max,desc,id);
}


function prepModal(nom,ub,min,max,desc,id){



 $('#nom_alt').val(nom);
 $('#ubc_alt').val(ub);
$('#min_alt').val(min);
	$('#max_alt').val(max);
$('#desc_alt').val(desc);
$('#alter_but').val(id);
	editarVals();

}



function alterTable(){


	let nombre= $('#nom_alt').val();
	let ubic= $('#ubc_alt').val();
	let minimio =$('#min_alt').val();
	let maximo =$('#max_alt').val();
	let descrip =$('#desc_alt').val();


	let id=$('#alter_but').val();




	let urls="db_alter_silo.php?name="+nombre+"&ub="+ubic+"&min="+minimio.toString()+"&max="+maximo.toString()+"&desc="+descrip+"&id="+id.toString()


	 $.get({
 			 url: urls ,// mandatory
  
 			 success:  function(){

				    			$('#nom_alt').val("");
								$('#ubc_alt').val("");
								$('#min_alt').val("");
								$('#max_alt').val("");
								$('#desc_alt').val("");
        						$('#alter_but').val("");
								offse=0;
								getDatosTabla(offse);
								EscribirTabla();
									$('#editar').modal('hide');
      

					},

  					async:true // to make it synchronous
					} )




}

function validar(){
	

	let nombre= $('#Nombre').val();
	let ubic= $('#Ubicacion').val();
	let min =$('#Minimo').val();
	let max =$('#Maximo').val();
	let user= $('#Usuario').val();
	let disp= $('#Dispositivo').val();
	let est=  $('#Estado').val();

	let regex_nombre = /^[a-zA-Z ]{2,30}$/;
	let reg_number = /^\d+$/;
	let reg_ubic= /^[a-zA-Z0-9\s,'-]*$/;

	let valid=true;


	reiniciarValid();

	if(!regex_nombre.test(nombre)){

		valid=false;
		 $("#Nombre").addClass("is-invalid");
		 $("#NombreFeedback").addClass("invalid-feedback");
		 $("#NombreFeedback").html("El campo Nombre contiene caracteres invalidos");
	}


	if(!reg_ubic.test(ubic)){

		valid=false;
		 $("#Ubicacion").addClass("is-invalid");
		 $("#UbicacionFeedback").addClass("invalid-feedback");
		 $("#UbicacionFeedback").html("El campo Ubicacion contiene caracteres invalidos");
	}


	if(!reg_number.test(min)){

		valid=false;
		 $("#Minimo").addClass("is-invalid");
		 $("#MinimoFeedback").addClass("invalid-feedback");
		 $("#MinimoFeedback").html("Se ingreso un caracter no numerico al campo Minimo");
	}



	if(!reg_number.test(max)){

		valid=false;
		 $("#Maximo").addClass("is-invalid");
		 $("#MaximoFeedback").addClass("invalid-feedback");
		 $("#MaximoFeedback").html("Se ingreso un caracter no numerico al campo Maximo");
	}


	if(user==null)

		{

		valid=false;
		 $("#Usuario").addClass("is-invalid");
		 $("#UsuarioFeedback").addClass("invalid-feedback");
		 $("#UsuarioFeedback").html("Seleccione un Usuario");
	}

	if(disp==null)

		{

		valid=false;
		 $("#Dispositivo").addClass("is-invalid");
		 $("#DispositivoFeedback").addClass("invalid-feedback");
		 $("#DispositivoFeedback").html("Seleccione un Dispositivo");
	}


	if(est==null)

		{

		valid=false;
		 $("#Estado").addClass("is-invalid");
		 $("#EstadoFeedback").addClass("invalid-feedback");
		 $("#EstadoFeedback").html("Seleccione el Estado del Silo");
	}


	return valid




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

function initPage(){

	esconderbuton();
	agregarOpciones();
	getDatosTabla(offse);
	EscribirTabla();
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
              <td class="w-10 text-center"> <img class="imgEdit" src="images/pencil.png" width="42" height="42"  onclick="editClick(this)" value="`+dato[0]["value"]+`"  /> </td>
           <td class="w-10 text-center"> <img src="images/equis.png" width="42" height="42" value="`+dato[0]["value"]+`" onclick="deleteSilo(this)" /> </td>
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





function deleteSilo(row){

	var currentRow=$(row).closest("tr");
		  var id=currentRow.find("td:eq(0)").html();
		  $("#delete_but").val(id);

			$('#delete').modal('toggle');
		$('#delete').modal('show');

}


function borrar_silo(){

 var id=$("#delete_but").val();
 $.get({
 			 url: "db_delete_silo.php?id="+id.toString() ,// mandatory
  
 			 success:  function(){

    								offse=0;
								getDatosTabla(offse);
								EscribirTabla();
									$('#delete').modal('hide');
        						$("#delete_but").val("");

      

					},

  					async:false // to make it synchronous
					} )


}



function editarVals(){


			$('#editar').modal('toggle');
		$('#editar').modal('show');
}




function comenzar_reg(){


	$("#form-silo").attr('action', './procesar_silo.php');
		$("form#form-silo").submit();
}



function checkVal(){


	if(validar()){


		$('#mensaje').modal('toggle');
		$('#mensaje').modal('show');
		
	}

	else{


		return false;
	}


}