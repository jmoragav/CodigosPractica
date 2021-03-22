function colocar_silos(){
	
	let array=datos_silos["value"];
	let tope=array.length;

	for(var i=0;i<tope; i++){

		var id_sil=array[i]["value"][0]["value"];
		var nombre=array[i]["value"][1]["value"];

		str=id_sil.toString()+" - "+nombre;
		var o = new Option(str, id_sil);
/// jquerify the DOM object 'o' so we can use the html method
		$(o).html(str);
		$("#selec_silo").append(o);


	}

}


function generarReporte(){

	try{

	let id_sil=$( "#selec_silo" ).val();
	let silo= "./reporte.php?id="+id_sil.toString();
	let str='http://neptunocl3:8080/siloslog/Pagina%20Silos/redirect.php?url='+silo
	window.open(
  str,
  '_blank' // <- This is what makes it open in a new window.
			);
}

catch(e){


	alert("bruh")
}


}