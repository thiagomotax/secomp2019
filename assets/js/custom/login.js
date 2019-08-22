$(document).ready(function(){
  $('#cpf').mask('000.000.000-00');
  $('#cpfReset').mask('000.000.000-00');
  $('#loginButton').click(function(){
    $("#login-form").validate({
      rules: {
        login: { required: true, cpfBR: true },
        senha: { required: true, minlength: 8 },
      },
      messages: {
        login: { required: 'Preencha seu CPF!', cpfBR: "CPF inválido!" },
        senha: { required: 'Preencha sua senha!',minlength: "Sua senha têm no mínimo 8 caracteres!" },
      },
      submitHandler: function (form) {
    var dados = $('#login-form').serializeArray();
    $body = $("body");
    $body.addClass("loading");
    $.ajax({
      type:"POST",
      url:"../controller/LoginController.php",
      data:dados,
      success: function(result){
        if(result == 1){
          $body.removeClass("loading");
          swal("", "Login efetuado com sucesso! Aguarde", "success");
          setTimeout(function(){
              location.href = 'viewPainel.php';
          }, 2000);               
        }else if(result == 2){
          $body.removeClass("loading");
          swal("Oops...", "Login ou senha incorretos! Tente novamente", "error");
          $("#login-form")[0].reset();
          $('#login').focus();
        }else if(result == 3){
          $body.removeClass("loading");
          swal("Oops...", "Login inexistente! Tente novamente", "error");
          $('#login').focus();
        }
      }
    });
    return false;
  }
  });
});
});


$(document).ready(function(){
  $('#btnResetSenha').click(function(){
    var dados = $('#form-reset').serializeArray();
    $body = $("body");
    $body.addClass("loading");
    $.ajax({
      type:"POST",
      url:"../controller/UsuariosController.php",
      data: dados,
      success: function(result){

        if(result == 1){
          $body.removeClass("loading");
          swal("", "Senha recuperada com sucesso! Verifique seu email.", "success");
          $("#form-reset")[0].reset();
        }else if(result == 2){
          $body.removeClass("loading");
          swal("Oops...", "Erro ao recuperar a senha! Tente novamente", "error");
          $("#form-reset")[0].reset();
        }else if(result == 3){
          $body.removeClass("loading");
          swal("Oops...", "Dados incorretos! Tente novamente", "error");
          $("#form-reset")[0].reset();
        }else if(result == 4){
          $body.removeClass("loading");
          swal("Oops...", "Erro ao enviar o email! Tente novamente", "error");
          $("#form-reset")[0].reset();
        }
      }
    });
    return false;
  });
});

$.validator.addMethod( "cpfBR", function( value, element ) {
	"use strict";

	if ( this.optional( element ) ) {
		return true;
	}

	// Removing special characters from value
	value = value.replace( /([~!@#$%^&*()_+=`{}\[\]\-|\\:;'<>,.\/? ])+/g, "" );

	// Checking value to have 11 digits only
	if ( value.length !== 11 ) {
		return false;
	}

	var sum = 0,
		firstCN, secondCN, checkResult, i;

	firstCN = parseInt( value.substring( 9, 10 ), 10 );
	secondCN = parseInt( value.substring( 10, 11 ), 10 );

	checkResult = function( sum, cn ) {
		var result = ( sum * 10 ) % 11;
		if ( ( result === 10 ) || ( result === 11 ) ) {
			result = 0;
		}
		return ( result === cn );
	};

	// Checking for dump data
	if ( value === "" ||
		value === "00000000000" ||
		value === "11111111111" ||
		value === "22222222222" ||
		value === "33333333333" ||
		value === "44444444444" ||
		value === "55555555555" ||
		value === "66666666666" ||
		value === "77777777777" ||
		value === "88888888888" ||
		value === "99999999999"
	) {
		return false;
	}

	// Step 1 - using first Check Number:
	for ( i = 1; i <= 9; i++ ) {
		sum = sum + parseInt( value.substring( i - 1, i ), 10 ) * ( 11 - i );
	}

	// If first Check Number (CN) is valid, move to Step 2 - using second Check Number:
	if ( checkResult( sum, firstCN ) ) {
		sum = 0;
		for ( i = 1; i <= 10; i++ ) {
			sum = sum + parseInt( value.substring( i - 1, i ), 10 ) * ( 12 - i );
		}
		return checkResult( sum, secondCN );
	}
	return false;

}, "Please specify a valid CPF number" );