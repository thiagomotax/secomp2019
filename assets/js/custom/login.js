$(document).ready(function(){
  $('#cpf').mask('000.000.000-00');
  $('#cpfReset').mask('000.000.000-00');
  $('#loginButton').click(function(){
    var dados = $('#login-form').serializeArray();
    $.ajax({
      type:"POST",
      url:"../controller/LoginController.php",
      data:dados,
      success: function(result){
        if(result == 1){
          swal("", "Login efetuado com sucesso! Aguarde", "success");
          setTimeout(function(){
              location.href = 'viewPainel.php';
          }, 2000);               
        }else if(result == 2){
          swal("Oops...", "Login ou senha incorretos! Tente novamente", "error");
          $("#login-form")[0].reset();
          $('#login').focus();
        }else if(result == 3){
          swal("Oops...", "Login inexistente! Tente novamente", "error");
          $('#login').focus();
        }
      }
    });
    return false;
  });
});

$(document).ready(function(){
  $('#btnResetSenha').click(function(){
    var dados = $('#form-reset').serializeArray();
    $.ajax({
      type:"POST",
      url:"../controller/UsuariosController.php",
      data: dados,
      success: function(result){

        if(result == 1){
          swal("", "Senha recuperada com sucesso! Verifique seu email.", "success");
          $("#form-reset")[0].reset();
        }else if(result == 2){
          swal("Oops...", "Erro ao recuperar a senha! Tente novamente", "error");
          $("#form-reset")[0].reset();
        }else if(result == 3){
          swal("Oops...", "Dados incorretos! Tente novamente", "error");
          $("#form-reset")[0].reset();
        }else if(result == 4){
          swal("Oops...", "Erro ao enviar o email! Tente novamente", "error");
          $("#form-reset")[0].reset();
        }
      }
    });
    return false;
  });
});