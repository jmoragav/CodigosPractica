


function initPage(){

	getDatadisp();
}


function getDatadisp(){




	 $.get({
 			 url: "db_disp_activo.php",// mandatory
  
 			 success:  function(data){

    					let datos= JSON.parse(data);
    				
    					let valores=datos["value"] 
    					var count = Object.keys(valores).length;
    
    					



    					for (var i=0;i<count;i++){
  						let id_disp=valores[i]["value"][0]["value"];
  						let nombre_disp=valores[i]["value"][1]["value"];

  						let texto=id_disp.toString()+" - "+nombre_disp; 


  						var o = new Option(texto, id_disp);
/// jquerify the DOM object 'o' so we can use the html method
						$(o).html(texto);
						$("#select_disp").append(o);
        }

        				

        		

      

					},

  					async:false // to make it synchronous
					} )






}


function DisplayDisp(){






let id= $('#select_disp option:selected').val()

 $.get({
 			 url: "db_datos_con_disp.php?id="+id.toString(),// mandatory
  
 			 success:  function(data){

    					let datos= JSON.parse(data);
    				
    					let valores=datos["value"] 
    					var count = Object.keys(valores).length;
    
    					



    				
  						let ip_disp=valores[0]["value"][0]["value"];
  						let port_disp=valores[0]["value"][1]["value"];



  						$('#ip').val(ip_disp)
  						$('#port').val(port_disp)


  					

        				

        		

      

					},

  					async:false // to make it synchronous
					} )




}

function hasWhiteSpace(s) {
  return /\s/g.test(s);
}


function startTest(){


  $('#result_div').html("");
let ip_val=$('#ip').val()
let port_val=$('#port').val()
let com=$('#comando').val()
let tip_com=$("#select_comando").val()


if($('#select_consulta').val() == 1)
{

let bool= hasWhiteSpace(com)

if(bool){

  let dummy=com
  var res = dummy.replace(/\s+/g, "")
  $('#comando').val(res);

  console.log("transformado")
}


 $.get({
 			 url: "socket.php?ip="+ip_val+"&port="+port_val.toString()+"&message="+com+"&tip="+tip_com.toString(),// mandatory
  
 			 success:  function(data){


              let convert_data= data
              let str="<p> El resultado del registro leido fue "+Number((convert_data).toFixed(2)).toString()+"[mA] </p>"
    					$('#result_div').html(str);
    							
    					$('#mensaje').modal('toggle');
              $('#mensaje').modal('show');


  					

        				

        		

      

					},

  					async:false // to make it synchronous
					} )	



}



else{




  var terminales_check = [];
  $.each($("input[name='terminal']:checked"), function(){
                terminales_check.push(parseInt($(this).val()));
            });







for(let k=0; k<terminales_check.length;k++){


  let term_com=generarModTerminal(terminales_check[k])


   $.get({
       url: "socket.php?ip="+ip_val+"&port="+port_val.toString()+"&message="+term_com+"&tip="+tip_com.toString(),// mandatory
  
       success:  function(data){


           
              


                  let str="<p>" +"La lectura para el terminal "+terminales_check[k].toString()+" es: "+data.toString()+ "[mA] </p>"
              $('#result_div').append(str);
                  
            

            

      

          },

            async:false // to make it synchronous
          } ) 






}




  $('#mensaje').modal('toggle');
              $('#mensaje').modal('show');



}






}




function generarModTerminal(terminal){



return "0000000000060104000"+terminal.toString()+"0001"


}





function DisplayComando(){


if($('#select_consulta').val() == 2){



$('#fake-check').addClass("d-block")

$('#fake-check').removeClass("d-none")

  $('#input_comando').html("")

let str= ""
for(var i=0; i<8;i++){

  let dummmy=`<div class="form-check form-check-inline">
  <input class="form-check-input" type="checkbox" id="Checkbox`+i.toString()+`" name="terminal" value="`+i.toString()+`" >
  <label class="form-check-label" for="`+i.toString()+`">`+i.toString()+` </label>

</div>` 


  str=str+dummmy;
}
  





$('#input_checkbox').html(str)






}





else{


  $('#fake-check').addClass("d-none")

$('#fake-check').removeClass("d-block")
  $('#input_checkbox').html("")
if($('#select_comando').val() == 2){
	
var html=`        <label for="comando">Comando Modbus RTU:</label>
      <input type="text" class="form-control" id="comando" placeholder="Enter comannd" name="comando" >
  `

$('#input_comando').html(html)



}



else{

var html=`        <label for="comando">Comando Modbus TCP:</label>
      <input type="text" class="form-control" id="comando" placeholder="Enter comannd" name="comando" >
  `

$('#input_comando').html(html)



}
	







}


}




function DisplayConsulta(){



var html=` <label for="select_consulta">Forma de consulta</label>
    <select class="form-control" id="select_consulta" onchange="DisplayComando()">
         <option disabled selected>Selecciona una opción</option>
      <option value=1>Consulta por comando directo</option>
      <option value=2>Consulta por terminales</option>
     
    </select>`

$('#consulta_div').html(html)




}