

let array_tabla_raw=[];

let offse=0;







function reiniciarValid(){


$("#Modelo").removeClass("is-invalid");
 $("#ModeloFeedback").removeClass("invalid-feedback");
$("#ModeloFeedback").html("");


$("#Fabricante").removeClass("is-invalid");
 $("#FabricanteFeedback").removeClass("invalid-feedback");
$("#FabricanteFeedback").html("");


$("#Ip").removeClass("is-invalid");
 $("#IpFeedback").removeClass("invalid-feedback");
$("#IpFeedback").html("");




$("#Puerto").removeClass("is-invalid");
 $("#PuertoFeedback").removeClass("invalid-feedback");
$("#PuertoFeedback").html("");


$("#Estado").removeClass("is-invalid");
 $("#EstadoFeedback").removeClass("invalid-feedback");
$("#EstadoFeedback").html("");

 $("#Comando").removeClass("is-invalid");
		 $("#ComandoFeedback").removeClass("invalid-feedback");
		 $("#ComandoFeedback").html("");


}



function validar_ip(ip){

	
	var array_ip=ip.split(".");
	var bol=true;

	if(array_ip.length!=4){
		return false;
	}

	else{

	for(var i=0;i<array_ip.length;i++){

		let chunck= parseInt(array_ip[i]);

		if(chunck<0 || chunck>255){

			bol=false
		}

	}

		return bol;
}



}


function enableCom(){

	$("#Comando").prop('disabled', false);
}


function validarComando(comando){


if($("#TipoCom").val()=="rtu"){

if(comando.length==16){


	
		let reg=/^[a-z0-9]*$/;

		return reg.test(comando);
	


}

else if(comando.length==23){

	let reg= /^(([a-z0-9]{2}) {0,1}){8}$/

			return reg.test(comando);


}


else {return false}


}



else{

if(comando.length==24){


	
		let reg=/^[a-z0-9]*$/;

		return reg.test(comando);
	


}

else if(comando.length==35){

	let reg= /^(([a-z0-9]{2}) {0,1}){12}$/

			return reg.test(comando);


}


else {return false}



}

}




function validar(){
	

	let modelo= $('#Modelo').val();
	let fab= $('#Fabricante').val();
	let ip =$('#Ip').val();
	let port =$('#Puerto').val();
	let estado= $('#Estado').val();
	let com= $('#Comando').val();

	let regex_nombre = /^[a-zA-Z0-9 _.-]*$/;
	let reg_ip = /^(\d|[1-9]\d|1\d\d|2([0-4]\d|5[0-5]))\.(\d|[1-9]\d|1\d\d|2([0-4]\d|5[0-5]))\.(\d|[1-9]\d|1\d\d|2([0-4]\d|5[0-5]))\.(\d|[1-9]\d|1\d\d|2([0-4]\d|5[0-5]))$/;
	let reg_port= /^([0-9]{1,4}|[1-5][0-9]{4}|6[0-4][0-9]{3}|65[0-4][0-9]{2}|655[0-2][0-9]|6553[0-5])$/;

	let valid=true;


	reiniciarValid();



	if(!regex_nombre.test(modelo)){

		valid=false;
		 $("#Modelo").addClass("is-invalid");
		 $("#ModeloFeedback").addClass("invalid-feedback");
		 $("#ModeloFeedback").html("El campo Modelo contiene caracteres invalidos");
	}


	if(!regex_nombre.test(fab)){

		valid=false;
		 $("#Fabricante").addClass("is-invalid");
		 $("#FabricanteFeedback").addClass("invalid-feedback");
		 $("#FabricanteFeedback").html("El campo Fabricante contiene caracteres invalidos");
	}


	if(!validar_ip(ip)){
		valid=false;
		 $("#Ip").addClass("is-invalid");
		 $("#IpFeedback").addClass("invalid-feedback");
		 $("#IpFeedback").html("La dirección ip no es valida");
	}



	if(!reg_port.test(port)){

		valid=false;
		 $("#Puerto").addClass("is-invalid");
		 $("#PuertoFeedback").addClass("invalid-feedback");
		 $("#PuertoFeedback").html("El puerto ingresado no es valido");
	}


	if(estado==null)

		{

		valid=false;
		 $("#Estado").addClass("is-invalid");
		 $("#EstadoFeedback").addClass("invalid-feedback");
		 $("#EstadoFeedback").html("Seleccione el Estado del dispositivo");
	}



	if(!validarComando(com)){

		valid=false;
		 $("#Comando").addClass("is-invalid");
		 $("#ComandoFeedback").addClass("invalid-feedback");
		 $("#ComandoFeedback").html("El comando proporcionado no respeta el formato");

	}

	


	return valid




}




function esconderbuton(){

	$("#adelante").hide();
		$("#atras").hide();


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
	getDatosTabla(offse);
	EscribirTabla();
}








function getDatosTabla(off){



array_tabla_raw=[];


	 $.get({
 			 url: "db_data_dispositivo_php.php?off="+off.toString() ,// mandatory
  
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
              <td class="w-20 text-center"> `+dato[6]["value"]+`</td>
              <td class="w-10 text-center"> <img class="imgEdit" src="images/pencil.png" width="42" height="42"  onclick="editClick(this)" value="`+dato[0]["value"]+`"  /> </td>
           <td class="w-10 text-center"> <img src="images/equis.png" width="42" height="42" value="`+dato[0]["value"]+`" onclick="deleteDisp(this)" /> </td>
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




function editClick(row){

		var currentRow=$(row).closest("tr");
		  var id=currentRow.find("td:eq(0)").html();
		 var modelo=currentRow.find("td:eq(1)").html();
		 var fabricante=currentRow.find("td:eq(2)").html();
		 var ip=currentRow.find("td:eq(3)").html();
		 var puerto=currentRow.find("td:eq(4)").html();
		 var comando=currentRow.find("td:eq(5)").html();
		 var desc=currentRow.find("td:eq(6)").html();
		 prepModal(modelo,fabricante,ip,puerto,comando,desc,id);
}


function prepModal(mod,fab,ip,port,coman,desc,id){



 $('#mod_alt').val(mod);
 $('#fab_alt').val(fab);
$('#ip_alt').val(ip);
	$('#port_alt').val(port);
$('#com_alt').val(coman);
$('#alter_but').val(id);


$('#desc_alt').val(desc);
	$('#editar').modal('toggle');
		$('#editar').modal('show');
}







function alterTable(){


	let modelo= $('#mod_alt').val();
	let fabricante= $('#fab_alt').val();
	let ip =$('#ip_alt').val();
	let puerto =$('#port_alt').val();
	let comando =$('#com_alt').val();
	let descrip =$('#desc_alt').val();


	let id=$('#alter_but').val();




	let urls="db_alter_disp.php?mod="+modelo+"&fab="+fabricante+"&ip="+ip+"&puerto="+puerto.toString()+"&com="+comando+"&desc="+descrip+"&id="+id.toString()


	 $.get({
 			 url: urls ,// mandatory
  
 			 success:  function(){

				    			$('#mod_alt').val("");
								$('#fab_alt').val("");
								$('#ip_alt').val("");
								$('#port_alt').val("");
								$('#com_alt').val("");
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





function deleteDisp(row){

	var currentRow=$(row).closest("tr");
		  var id=currentRow.find("td:eq(0)").html();
		  $("#delete_but").val(id);

			$('#delete').modal('toggle');
		$('#delete').modal('show');

}


function borrar_disp(){

 var id=$("#delete_but").val();
 $.get({
 			 url: "db_delete_disp.php?id="+id.toString() ,// mandatory
  
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




function comenzar_reg(){


	
		$('form#form-disp').submit();
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