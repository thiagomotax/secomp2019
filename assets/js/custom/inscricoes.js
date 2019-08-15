$(document).ready(function(){
  $("#divMinicursos").load("viewAjaxInscricoes.php");
});
function inscreverMinicurso(codMinicurso){
  var array = codMinicurso.split("_");
  alert(array[1]);
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
                message: "Inscrição " + descricaoMinicurso + " realizada com sucesso! ",
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
                message: "Você tem direito de realizar inscrição em até 3 minicursos! ",
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
            alert(result);
            if(result == 1){
              $("#divMinicursos").load("viewAjaxInscricoes.php");
              $.notify({
                title: "",
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
                title: "",
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
    var dados = $('#sign-form').serializeArray();
    if((dados[0].value == "") || (dados[1].value == "") || (dados[2].value == "") || (dados[3].value == "") || (dados[4].value == "")){
      $.notify({
        title: "",
        message: "Preencha todos os campos ",
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
    }else{
      var senha = dados[4].value;
      var confirmaSenha = dados[5].value;
      if(senha != confirmaSenha){
        $.notify({
          title: "",
          message: "Senhas não correspondem! ",
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
      }else{
        $.ajax({
          type:"POST",
          url:"../controller/UsuariosController.php",
          data:dados,
          success: function(result){
            if(result == 1){
              swal("", "Cadastro realizado com sucesso! Faça seu login", "success");
              $("#sign-form")[0].reset();
              setTimeout(function(){
                  location.href = 'viewLogin.php';
              }, 5000);               
            }else if(result == 2){
              swal("Oops...", "Erro ao realizar o cadastro! Tente novamente", "error");
              $("#sign-form")[0].reset();
            }else if(result == 3){
              swal("Oops...", "Preencha todos os campos", "error");
              $("#sign-form")[0].reset();
            }else if(result == 4){
              $.notify({
                title: "",
                message: "CPF inválido! ",
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
              $("#cpf").focus();
            }else if(result == 5){
              $.notify({
                title: "",
                message: "A senha precisa ter pelo menos 8 caracteres! ",
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
            }else if(result == 6){
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
          }
        });
      }
    }
    return false;
  });
});