function reiniciarValid(){


$("#Nombre").removeClass("is-invalid");
 $("#NombreFeedback").removeClass("invalid-feedback");
$("#NombreFeedback").html("");


$("#Apellido").removeClass("is-invalid");
 $("#ApellidoFeedback").removeClass("invalid-feedback");
$("#ApellidoFeedback").html("");


$("#email").removeClass("is-invalid");
 $("#emailFeedback").removeClass("invalid-feedback");
$("#emailFeedback").html("");




$("#Username").removeClass("is-invalid");
 $("#UsernameFeedback").removeClass("invalid-feedback");
$("#UsernameFeedback").html("");


$("#pass").removeClass("is-invalid");
 $("#passFeedback").removeClass("invalid-feedback");
$("#passFeedback").html("");


$("#pass_conf").removeClass("is-invalid");
 $("#pass_confFeedback").removeClass("invalid-feedback");
$("#pass_confFeedback").html("");



}









function validar(){
	

	let nomb= $('#Nombre').val();
	let apell= $('#Apellido').val();
	let email =$('#email').val();
	let usr =$('#Username').val();
	let pass= $('#pass').val();
	let pass_confi= $('#pass_conf').val();


	let regex_nombre = /^[a-zA-Z ]{2,30}$/;
	let reg_usr=/^[a-zA-Z0-9]+([_ -]?[a-zA-Z0-9])*$/;
	let reg_email= /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
	let reg_pass=/^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{8,}$/;
	let valid=true;


	reiniciarValid();

	if(!regex_nombre.test(nomb)){

		valid=false;
		 $("#Nombre").addClass("is-invalid");
		 $("#NombreFeedback").addClass("invalid-feedback");
		 $("#NombreFeedback").html("El campo Nombre contiene caracteres invalidos");
	}


	if(!reg_email.test(email)){

		valid=false;
		 $("#email").addClass("is-invalid");
		 $("#emailFeedback").addClass("invalid-feedback");
		 $("#emailFeedback").html("Ingrese un Email valido");
	}


	if(!reg_usr.test(usr)){

		valid=false;
		 $("#Username").addClass("is-invalid");
		 $("#UsernameFeedback").addClass("invalid-feedback");
		 $("#UsernameFeedback").html("El nombre de usuario contiene algun caracter no valido");
	}



	if(!reg_pass.test(pass)){

		valid=false;
		 $("#pass").addClass("is-invalid");
		 $("#passFeedback").addClass("invalid-feedback");
		 $("#passFeedback").html("La contraseña no cumple con los requisitos");
	}


	if(pass!=pass_confi)

		{

		valid=false;
		 $("#pass_conf").addClass("is-invalid");
		 $("#pass_confFeedback").addClass("invalid-feedback");
		 $("#pass_confFeedback").html("Las contraseñas son distintas");
	}

	


	return valid




}



function comenzar_reg(){


	$('#registro-form').attr('action', './procesar_registro.php');
		$('form#registro-form').submit();
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