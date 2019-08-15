function excluirUsuario(id)  {
  var codUsuario = $('#rowDelete_'+(id-1)).attr("data-id");
  var nomeUsuario = $('#rowDelete_'+(id-1)).attr("data-nome");
  swal({
    title: '',
    text: "Deseja realmente excluir o usuário " +nomeUsuario+ " ?",
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
      url:"../controller/UsuariosController.php",
      data: {acao: "excluir", codUsuario: codUsuario},
      success: function(result){
        if(result == 1) {
          $.notify({
            title: "",
            message: "Usuário excluído com sucesso!",
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

// Função para editar Usuarios
$(document).ready(function(){
  $('#btnEditarUsuario').click(function(){
    alert
    var dados = $('#usuario-form').serializeArray();
    $.ajax({
      type:"POST",
      url:"../controller/UsuariosController.php",
      data:dados,
      success: function(result){
        if(result == 1){
          $.notify({
            title: "",
            message: "Usuário alterado com sucesso!",
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
              location.href = 'viewUsuarios.php';
          }, 4000);
        }else if(result == 2){
          $.notify({
            title: "",
            message: "Erro ao alterar o usuário!",
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
              location.href = 'viewUsuarios.php';
          }, 4000);
        }
      }
    });
    return false;
  });
});

// Função para cadastrar Usuarios
$(document).ready(function(){
  $('#btnCadastrarUsuario').click(function(){
    var dados = $('#usuario-form').serializeArray();
    $.ajax({
      type:"POST",
      url:"../controller/UsuariosController.php",
      data:dados,
      success: function(result){
        if(result == 1){
          $("#usuario-form")[0].reset();
          $.notify({
            title: "",
            message: "Usuário cadastrado com sucesso!",
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
              location.href = 'viewUsuarios.php';
          }, 4000);
        }else if(result == 2){
          $("#usuario-form")[0].reset();
          $.notify({
            title: "",
            message: "Erro ao cadastrar o usuário!",
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
              location.href = 'viewUsuarios.php';
          }, 4000);
        }
      }
    });
    return false;
  });
});

// Função para cadastrar Usuarios
$(document).ready(function(){
  $('#btnAlterarSenha').click(function(){
    var dados = $('#resetpswd-form').serializeArray();
    var senha = dados[2].value;
    var confirmaSenha = dados[3].value;
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
            $('#alterarSenha').modal('hide');
            $("#resetpswd-form")[0].reset();
            $.notify({
              title: "",
              message: "Senha do usuário alterada com sucesso!",
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
          }else if(result == 2){
            $('#alterarSenha').modal('hide');
            $("#resetpswd-form")[0].reset();
            $.notify({
              title: "",
              message: "Erro ao alterar a senha do usuário!",
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
    return false;
  });
});

function alterarSenhaUsuario(id)  {
  var codUsuario = $('#rowResetPassword_'+(id-1)).attr("data-id");
  var nomeUsuario = $('#rowResetPassword_'+(id-1)).attr("data-nome");
  $('#alterarSenha').modal('show');
  $('.modal .modal-dialog .modal-content .modal-header #nome-usuario').text("Alterar senha do usuário " + nomeUsuario);
  $('.modal .modal-dialog .modal-content .modal-body #codUsuario').val(codUsuario);
}