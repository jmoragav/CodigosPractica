let ip="";
let port=0;
let  id_silo_sel=0
let dato=0;
function getDataSilo(){




	 $.get({
 			 url: "db_silo_activo.php",// mandatory
  
 			 success:  function(data){

    					let datos= JSON.parse(data);
    				
    					let valores=datos["value"] 
    					var count = Object.keys(valores).length;
    
    					



    					for (var i=0;i<count;i++){
  						let id_silo=valores[i]["value"][0]["value"];
  						let nombre_silo=valores[i]["value"][1]["value"];

  						let texto=id_silo.toString()+" - "+nombre_silo; 


  						var o = new Option(texto, id_silo);
/// jquerify the DOM object 'o' so we can use the html method
						$(o).html(texto);
						$("#select_silo").append(o);
        }

        				


      

					},

  					async:false // to make it synchronous
					} )






}










function DisplayDisp(){


  let id=$("#select_silo").val().toString();
  id_silo_sel=id

   $.get({
       url: "db_datos_disp.php?id="+id,// mandatory
  
       success:  function(data){

              let datos= JSON.parse(data);
            
              let valores=datos["value"] 
              var count = Object.keys(valores).length;
    
              


               let modelo=valores[0]["value"][0]["value"];
               ip=valores[0]["value"][1]["value"];
               port=valores[0]["value"][2]["value"];
              let comando=valores[0]["value"][3]["value"];
     
                
                $("#Dispositivo").val(modelo)

                $("#modbus").val(comando)

          },

            async:false // to make it synchronous
          } )








}





function startLog(){





  let interval= parseInt($("#Tiempo").val())
  setInterval( procesar, interval)


 $('#mensaje').modal('toggle');
              $('#mensaje').modal('show');




}




function procesar(){

    registrar();
 insertar_registro();
         console.log("se inserto dato")

}



function insertar_registro(){


   $.get({
       url: "db_datalogger.php?id="+id_silo_sel+"&val="+dato.toString(),// mandatory
  
       success:  function(data){


      


            

                

            

      

          },

            async:false // to make it synchronous
          } ) 




}


function registrar(){

let com=$("#modbus").val()
 $.get({
       url: "socket.php?ip="+ip+"&port="+port.toString()+"&message="+com,// mandatory
  
       success:  function(data){


              

              dato = data
            

                

            

      

          },

            async:false // to make it synchronous
          } ) 

  }