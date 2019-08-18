$(document).ready(function(){
  $("#divMinicursos").load("viewAjaxInscricoes.php");
});
function inscreverMinicurso(codMinicurso){
  var array = codMinicurso.split("_");
  var descricaoMinicurso = $('#'+codMinicurso).attr("data-nome");
  if($("#"+codMinicurso).is(':checked')){
    swal({
      title: '',
      text: "Deseja realmente realizar a inscrição no minicurso " + descricaoMinicurso + "?",
      type: 'warning',
      showCancelButton: true,
      confirmButtonColor: "#DD6B55",
      confirmButtonText: "Sim!",
      cancelButtonText: 'Não, cancelar!',
      closeOnConfirm: true
    },
    function(isConfirm) {
      if (isConfirm) {
        $.ajax({
          type:"POST",
          url:"../controller/InscricoesController.php",
          data: {acao: "inscrever", codMinicurso: array[1]},
          success: function(result){
            if(result == 1){
              $("#divMinicursos").load("viewAjaxInscricoes.php");
              $.notify({
                title: "",
                message: "Inscrição no minicurso " + descricaoMinicurso + " realizada com sucesso! ",
                icon: 'fa fa-check' 
              },{
                type: "success",
                placement: {
                  from: "top",
                  align: "right",
                },
                offset: 20,
                spacing: 10,
                z_index: 1031,
                delay: 5000,
                timer: 1000,
                url_target: '_blank',
                mouse_over: null,
                animate: {
                  enter: 'animated fadeInDown',
                  exit: 'animated fadeOutUp'
                }
              });
            }else if(result == 3){
              $("#divMinicursos").load("viewAjaxInscricoes.php");
              $.notify({
                title: "",
                message: "Todas as vagas já foram preenchidas! ",
                icon: 'fa fa-times' 
              },{
                type: "danger",
                placement: {
                  from: "top",
                  align: "right",
                },
                offset: 20,
                spacing: 10,
                z_index: 1031,
                delay: 5000,
                timer: 1000,
                url_target: '_blank',
                mouse_over: null,
                animate: {
                  enter: 'animated fadeInDown',
                  exit: 'animated fadeOutUp'
                }
              });
            }else if(result == 4){
              $("#divMinicursos").load("viewAjaxInscricoes.php");
              $.notify({
                title: "",
                message: "Você só pode ter inscrição em até 3 minicursos! ",
                icon: 'fa fa-times' 
              },{
                type: "danger",
                placement: {
                  from: "top",
                  align: "right",
                },
                offset: 20,
                spacing: 10,
                z_index: 1031,
                delay: 5000,
                timer: 1000,
                url_target: '_blank',
                mouse_over: null,
                animate: {
                  enter: 'animated fadeInDown',
                  exit: 'animated fadeOutUp'
                }
              });
            }
          }
        });
      }else {
        $("#divMinicursos").load("viewAjaxInscricoes.php");
      }
    });
  }else{
    swal({
      title: '',
      text: "Deseja realmente cancelar a inscrição no minicurso " + descricaoMinicurso + "?",
      type: 'warning',
      showCancelButton: true,
      confirmButtonColor: "#DD6B55",
      confirmButtonText: "Sim, cancelar!",
      cancelButtonText: 'Não!',
      closeOnConfirm: true
    },
    function(isConfirm) {
      if (isConfirm) {
        $.ajax({
          type:"POST",
          url:"../controller/InscricoesController.php",
          data: {acao: "cancInscricao", codMinicurso: array[1]},
          success: function(result){
            if(result == 1){
              $("#divMinicursos").load("viewAjaxInscricoes.php");
              $.notify({
                title: "",
                message: "Inscrição no minicurso " + descricaoMinicurso + " cancelada com sucesso! ",
                icon: 'fa fa-check' 
              },{
                type: "warning",
                placement: {
                  from: "top",
                  align: "right",
                },
                offset: 20,
                spacing: 10,
                z_index: 1031,
                delay: 5000,
                timer: 1000,
                url_target: '_blank',
                mouse_over: null,
                animate: {
                  enter: 'animated fadeInDown',
                  exit: 'animated fadeOutUp'
                }
              });
            }
          }
        });
      }else {
        $("#divMinicursos").load("viewAjaxInscricoes.php");
      }
    });
  }
}

function inscreverExtra(codExtra){
  var array = codExtra.split("_");
  var nomeExtra = $('#'+codExtra).attr("data-nome");
  if($("#"+codExtra).is(':checked')){
    swal({
      title: '',
      text: "Deseja realmente realizar a inscrição no extra " + nomeExtra + "?",
      type: 'warning',
      showCancelButton: true,
      confirmButtonColor: "#DD6B55",
      confirmButtonText: "Sim!",
      cancelButtonText: 'Não, cancelar!',
      closeOnConfirm: true
    },
    function(isConfirm) {
      if (isConfirm) {
        $.ajax({
          type:"POST",
          url:"../controller/InscricoesExtraController.php",
          data: {acao: "inscrever", codExtra: array[1]},
          success: function(result){
            if(result == 1){
              $("#divMinicursos").load("viewAjaxInscricoes.php");
              $.notify({
                title: "",
                message: "Inscrição " + nomeExtra + " realizada com sucesso! ",
                icon: 'fa fa-check' 
              },{
                type: "success",
                placement: {
                  from: "top",
                  align: "right",
                },
                offset: 20,
                spacing: 10,
                z_index: 1031,
                delay: 5000,
                timer: 1000,
                url_target: '_blank',
                mouse_over: null,
                animate: {
                  enter: 'animated fadeInDown',
                  exit: 'animated fadeOutUp'
                }
              });        
            }
          }
        });
      }else {
        $("#divMinicursos").load("viewAjaxInscricoes.php");
      }
    });
  }else{
    swal({
      title: '',
      text: "Deseja realmente cancelar a inscrição no extra " + nomeExtra + "?",
      type: 'warning',
      showCancelButton: true,
      confirmButtonColor: "#DD6B55",
      confirmButtonText: "Sim, cancelar!",
      cancelButtonText: 'Não!',
      closeOnConfirm: true
    },
    function(isConfirm) {
      if (isConfirm) {
        $.ajax({
          type:"POST",
          url:"../controller/InscricoesExtraController.php",
          data: {acao: "cancInscricao", codExtra: array[1]},
          success: function(result){
            if(result == 1){
              $("#divMinicursos").load("viewAjaxInscricoes.php");
              $.notify({
                title: '',
                message: "Inscrição no extra " + nomeExtra + " cancelada com sucesso! ",
                icon: 'fa fa-check' 
              },{
                type: "warning",
                placement: {
                  from: "top",
                  align: "right",
                },
                offset: 20,
                spacing: 10,
                z_index: 1031,
                delay: 5000,
                timer: 1000,
                url_target: '_blank',
                mouse_over: null,
                animate: {
                  enter: 'animated fadeInDown',
                  exit: 'animated fadeOutUp'
                }
              });
            }
          }
        });
      }else {
        $("#divMinicursos").load("viewAjaxInscricoes.php");
      }
    });
  }
}

function excluirMinicurso(id)  {
  var codMinicurso = $('#rowDelete_'+(id-1)).attr("data-id");
  var descricaoMinicurso = $('#rowDelete_'+(id-1)).attr("data-nome");
  swal({
    title: '',
    text: "Deseja realmente excluir o minicurso " +descricaoMinicurso+ " ?",
    type: 'warning',
    showCancelButton: true,
    confirmButtonColor: "#DD6B55",
    confirmButtonText: "Sim, excluir!",
    cancelButtonText: 'Não, cancelar!',
    closeOnConfirm: true
  },
  function(){
    $.ajax({
      type:"POST",
      url:"../controller/MinicursosController.php",
      data: {acao: "excluir", codMinicurso: codMinicurso},
      success: function(result){
        if(result == 1) {
          $.notify({
            title: "",
            message: "Minicurso excluído com sucesso!",
            icon: 'fa fa-check' 
          },{
            type: "success",
            placement: {
              from: "top",
              align: "right",
            },
            offset: 20,
            spacing: 10,
            z_index: 1031,
            delay: 5000,
            timer: 1000,
            url_target: '_blank',
            mouse_over: null,
            animate: {
              enter: 'animated fadeInDown',
              exit: 'animated fadeOutUp'
            }
          });
          var table = $('#sampleTable').DataTable();
          table.ajax.reload( null, false );
        }
      }
    });
  });
}

// Função para editar Minicursos
$(document).ready(function(){
  $('#btnEditarMinicurso').click(function(){
    var dados = $('#minicurso-form').serializeArray();
    $.ajax({
      type:"POST",
      url:"../controller/MinicursosController.php",
      data:dados,
      success: function(result){
        if(result == 1){
          $.notify({
            title: "",
            message: "Minicurso alterado com sucesso!",
            icon: 'fa fa-check' 
          },{
            type: "success",
            placement: {
              from: "top",
              align: "right",
            },
            offset: 20,
            spacing: 10,
            z_index: 1031,
            delay: 5000,
            timer: 1000,
            url_target: '_blank',
            mouse_over: null,
            animate: {
              enter: 'animated fadeInDown',
              exit: 'animated fadeOutUp'
            }
          });
          setTimeout(function(){
              location.href = 'viewMinicursos.php';
          }, 4000);
        }else if(result == 2){
          $.notify({
            title: "",
            message: "Erro ao alterar o minicurso!",
            icon: 'fa fa-check' 
          },
          {
            type: "danger",
            placement: {
              from: "top",
              align: "right"
            },
            offset: 20,
            spacing: 10,
            z_index: 1031,
            delay: 5000,
            timer: 1000,
            url_target: '_blank',
            mouse_over: null,
            animate: {
              enter: 'animated fadeInDown',
              exit: 'animated fadeOutUp'
            }
          });
          setTimeout(function(){
              location.href = 'viewMinicursos.php';
          }, 4000);
        }
      }
    });
    return false;
  });
});

// Função para cadastrar Minicursos
$(document).ready(function(){
  $('#btnCadastrarMinicurso').click(function(){
    var dados = $('#minicurso-form').serializeArray();
    $.ajax({
      type:"POST",
      url:"../controller/MinicursosController.php",
      data:dados,
      success: function(result){
        if(result == 1){
          $("#minicurso-form")[0].reset();
          $.notify({
            title: "",
            message: "Minicurso cadastrado com sucesso!",
            icon: 'fa fa-check' 
          },{
            type: "success",
            placement: {
              from: "top",
              align: "right",
            },
            offset: 20,
            spacing: 10,
            z_index: 1031,
            delay: 5000,
            timer: 1000,
            url_target: '_blank',
            mouse_over: null,
            animate: {
              enter: 'animated fadeInDown',
              exit: 'animated fadeOutUp'
            }
          });
          setTimeout(function(){
              location.href = 'viewMinicursos.php';
          }, 4000);
        }else if(result == 2){
          $("#minicurso-form")[0].reset();
          $.notify({
            title: "",
            message: "Erro ao cadastrar o minicurso!",
            icon: 'fa fa-check' 
          },
          {
            type: "danger",
            placement: {
              from: "top",
              align: "right"
            },
            offset: 20,
            spacing: 10,
            z_index: 1031,
            delay: 5000,
            timer: 1000,
            url_target: '_blank',
            mouse_over: null,
            animate: {
              enter: 'animated fadeInDown',
              exit: 'animated fadeOutUp'
            }
          });
          setTimeout(function(){
              location.href = 'viewMinicursos.php';
          }, 4000);
        }
      }
    });
    return false;
  });
});

$(document).ready(function(){
  $('#btnInscricao').click(function(){
    $("#sign-form").validate({
      rules: {
        nome: { required: true, minlength: 5 },
        cpf: { required: true, cpfBR: true },
        email: { required: true, email: true },
        senha: { required: true, minlength: 8 },
        confirmasenha: { required: true, equalTo: '#senha'},
      },
      messages: {
        nome: { required: 'Preencha seu nome!', minlength: "Digite seu nome completo!" },
        cpf: { required: 'Preencha seu CPF!', cpfBR: "CPF inválido!" },
        email: { required: "Preencha seu email!", email: "Digite um e-mail válido!" },
        senha: { required: 'Preencha sua senha!',minlength: "Sua senha têm no mínimo 8 caracteres!" },
        confirmasenha: { required: "Preencha a confirmação de senha", equalTo: "As senhas não conferem!"},
      },
      submitHandler: function (form) {
    var dados = $('#sign-form').serializeArray();
    $body = $("body");
    $body.addClass("loading");  
        $.ajax({
          type:"POST",
          url:"../controller/UsuariosController.php",
          data:dados,
          success: function(result){
            if(result == 1){
              $body.removeClass("loading");
              swal("", "Cadastro realizado com sucesso! Faça seu login", "success");
              $("#sign-form")[0].reset();
              setTimeout(function(){
                  location.href = 'viewLogin.php';
              }, 5000);               
            }else if(result == 2){
              $body.removeClass("loading");
              swal("Oops...", "Erro ao realizar o cadastro! Tente novamente", "error");
              $("#sign-form")[0].reset();
            }else if(result == 6){
              $body.removeClass("loading");
              $('input[name=cpf').val('');
              $.notify({
                title: "",
                message: "Este CPF já está em uso! ",
                icon: 'fa fa-check' 
              },{
                type: "danger",
                placement: {
                  from: "top",
                  align: "right",
                },
                offset: 20,
                spacing: 10,
                z_index: 1031,
                delay: 5000,
                timer: 1000,
                url_target: '_blank',
                mouse_over: null,
                animate: {
                  enter: 'animated fadeInDown',
                  exit: 'animated fadeOutUp'
                }
                
              });
            }
            else if(result == 7){
              $body.removeClass("loading");
              $('input[name=email').val('');
              $.notify({
                title: "",
                message: "Este e-mail já está em uso! ",
                icon: 'fa fa-check' 
              },{
                type: "danger",
                placement: {
                  from: "top",
                  align: "right",
                },
                offset: 20,
                spacing: 10,
                z_index: 1031,
                delay: 5000,
                timer: 1000,
                url_target: '_blank',
                mouse_over: null,
                animate: {
                  enter: 'animated fadeInDown',
                  exit: 'animated fadeOutUp'
                }
              });
            }
          }
        });
    return false;
      }
    });
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