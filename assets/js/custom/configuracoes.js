// Função para editar Minicursos
$(document).ready(function(){
  $('#btnEditarConfiguracoes').click(function(){
    var dados = $('#configuracoes-form').serializeArray();
    $.ajax({
      type:"POST",
      url:"../controller/ConfiguracoesController.php",
      data:dados,
      success: function(result){
        if(result == 1){
          $.notify({
            title: "",
            message: "Configurações alteradas com sucesso! ",
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
          $.notify({
            title: "",
            message: "Erro ao alterar as configurações! ",
            icon: 'fa fa-close' 
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
        }
      }
    });
    return false;
  });
});
$(document).ready(function(){
  $('#horaInicioInscricao').mask('00:00:00');
  $('#horaFinalInscricao').mask('00:00:00');
});
$('#dataInicioInscricao').datepicker({
  format: "dd/mm/yyyy",
  autoclose: true,
  todayHighlight: true
});
$('#dataFinalInscricao').datepicker({
  format: "dd/mm/yyyy",
  autoclose: true,
  todayHighlight: true
});
