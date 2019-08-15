$(document).ready(function(){
  $("#divJogos").load("viewAjaxInscricoesJogos.php");
});
function inscreverJogos(codJogo){
  var array = codJogo.split("_");
  var descricaoJogo = $('#'+codJogo).attr("data-nome");
  if($("#"+codJogo).is(':checked')){
    swal({
      title: '',
      text: "Deseja realmente realizar a inscrição no minicurso " + descricaoJogo + "?",
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
          url:"../controller/JogosController.php",
          data: {acao: "inscrever", codJogo: array[1]},
          success: function(result){
            if(result == 1){
              $("#divJogos").load("viewAjaxInscricoesJogos.php");
              $.notify({
                title: "",
                message: "Inscrição " + descricaoJogo + " realizada com sucesso! ",
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
      }
    });
  }else{
    swal({
      title: '',
      text: "Deseja realmente cancelar a inscrição no jogo " + descricaoJogo + "?",
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
          url:"../controller/JogosController.php",
          data: {acao: "cancInscricao", codJogo: array[1]},
          success: function(result){
            if(result == 1){
              $("#divJogos").load("viewAjaxInscricoesJogos.php");
              $.notify({
                title: "",
                message: "Inscrição no jogo " + descricaoJogo + " cancelada com sucesso! ",
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
      }
    });
  }
}