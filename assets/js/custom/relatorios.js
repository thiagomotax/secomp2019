function mostrarCampoChamada(){
  $("#divDataChamada").css('display','block');
}
function escondeCampoChamada(){
  $("#divDataChamada").css('display','none');
}
$('#dataChamada').datepicker({
  format: "dd/mm/yyyy",
  autoclose: true,
  todayHighlight: true
});
$(document).ready(function(){
  $('#btnRelatorio').click(function(){
    var dados = $('#relatorios-form').serializeArray();
    if(dados[1].value == 1){
      $("#divDataChamada").css('display','none');
      document.forms['formRelatorio'].action = "relatorioInscritosMinicurso.php";
      document.forms['formRelatorio'].submit();
      document.forms['formRelatorio'].reset();
    }else{
      if(dados[2].value == ""){
        $.notify({
          title: "",
          message: "Por favor escolha a data da chamada!",
          icon: 'fa fa-check' 
        },{
          type: "danger",
          placement: {
            from: "top",
            align: "right",
          },
          offset: 20,
          spacing: 10,
          z_index: 2000,
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
        $("#divDataChamada").css('display','none');
        document.forms['formRelatorio'].action = "chamadaInscritosMinicurso.php";
        document.forms['formRelatorio'].submit();
        document.forms['formRelatorio'].reset();
      }
    }
  });
});

$(document).ready(function(){
  $('#btnRelatorioJogos').click(function(){
    document.forms['formRelatorioJogos'].action = "relatorioInscritosJogo.php";
    document.forms['formRelatorioJogos'].submit();
  });
});
