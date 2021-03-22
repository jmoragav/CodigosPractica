

let array_tabla_raw=[];

let offse=0;





function initView(){
	esconderbuton();
	getDatosTabla(offse);
	EscribirTabla();
}



function esconderbuton(){

	$("#adelante").hide();
		$("#atras").hide();


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


