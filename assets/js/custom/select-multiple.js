(function($){
  $(function(){
    $('.multiselect').multiSelect({});
    $('#ministrantesSelect').multiSelect({
      afterSelect: function(values){
        var codMinicurso = $('#codMinicurso').val();
        $.ajax({  
          url: "../controller/MinistrantesController.php",  
          type: "POST",  
          data: {acao: "adicionar", codUsuario : ""+ values +"", codMinicurso : codMinicurso},
          success: function(result) {
            if(result == 1){
              $.notify({
                title: "",
                message: "Ministrante cadastrado com sucesso!",
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
            }else{
              $.notify({
                title: "",
                message: "Erro ao cadastrar o ministrante",
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
        lengthSelect();
      },
      afterDeselect: function(values){
        var codMinicurso = $('#codMinicurso').val();
        $.ajax({  
          url: "../controller/MinistrantesController.php",  
          type: "POST",  
          data: {acao: "excluir", codUsuario : ""+ values +"", codMinicurso : codMinicurso},
          success: function(result) {
            if(result == 1){
              $.notify({
                title: "",
                message: "Ministrante excluído com sucesso!",
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
            }else{
              $.notify({
                title: "",
                message: "Erro ao excluir o ministrante",
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
        lengthSelect();
      }
    });

  });
})(jQuery);


function lengthSelect(){
  var length = $('#ministrantesSelect option').length;
  var countMinistrantes = $('#ministrantesSelect option:selected').length;
  $("#countUsuario").html("Não ministrantes: " + parseInt(length - countMinistrantes));
  if(countMinistrantes <= 0){
    $("#countUsuariosMinistrantes").html("Este curso não possui ministrante(s)");
  }else{
    $("#countUsuariosMinistrantes").html("Ministrante(s): " + countMinistrantes);
  }
}
$(document).ready(function() {
  lengthSelect();
});
(function($){
  $(function(){
    $('.multiselect').multiSelect({});
    $('#ministrantesSelect').multiSelect({
      afterSelect: function(values){
        var codMinicurso = $('#codMinicurso').val();
        $.ajax({  
          url: "../controller/MinistrantesController.php",  
          type: "POST",  
          data: {acao: "adicionar", codUsuario : ""+ values +"", codMinicurso : codMinicurso},
          success: function(result) {
            if(result == 1){
              $.notify({
                title: "",
                message: "Ministrante cadastrado com sucesso!",
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
            }else{
              $.notify({
                title: "",
                message: "Erro ao cadastrar o ministrante",
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
        lengthSelect();
      },
      afterDeselect: function(values){
        var codMinicurso = $('#codMinicurso').val();
        $.ajax({  
          url: "../controller/MinistrantesController.php",  
          type: "POST",  
          data: {acao: "excluir", codUsuario : ""+ values +"", codMinicurso : codMinicurso},
          success: function(result) {
            if(result == 1){
              $.notify({
                title: "",
                message: "Ministrante excluído com sucesso!",
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
            }else{
              $.notify({
                title: "",
                message: "Erro ao excluir o ministrante",
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
        lengthSelect();
      }
    });

  });
})(jQuery);


function lengthSelect(){
  var length = $('#ministrantesSelect option').length;
  var countMinistrantes = $('#ministrantesSelect option:selected').length;
  $("#countUsuario").html("Não ministrantes: " + parseInt(length - countMinistrantes));
  if(countMinistrantes <= 0){
    $("#countUsuariosMinistrantes").html("Este curso não possui ministrante(s)");
  }else{
    $("#countUsuariosMinistrantes").html("Ministrante(s): " + countMinistrantes);
  }
}
$(document).ready(function() {
  lengthSelect();
});
