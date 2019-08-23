$(document).ready(function() {
  var oTable = $('#sampleTable').dataTable( {
    "columnDefs": [
      { className: "text-center", "targets": 0 },
      { className: "text-center", "targets": 1 },
      { className: "text-center", "targets": 2 },
      { className: "text-center", "targets": 3 },
      { className: "text-center", "targets": 4 },
      { className: "text-center", "orderable": false, "targets": 5 },
      { className: "text-center", "targets": 6 }],
      "ajax": {
        "url": "viewAjaxMinicursos.php",
        "type": "POST"
      },
      "columns": [
      { "data": "codMinicurso" },
      { "data": "nomeMinicurso" },
      { "data": "ministranteMinicurso" },
      { "data": "vagasMinicurso" },
      { "data": "vagasRestantesMinicurso" },
      { "data": "informacoesMinicurso" },
      { "data": "buttons" }
      ],
      "dom": '<"top"i>rt<"bottom"flp><"clear">',
      "order": [[0, 'asc']],
      "oPaginate": {
          "sPrevious": "Prev",
          "sNext": "Next"
      },
      "info": false,
      "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "Todos"]],
      "responsive": true,
      language: {
      }
  }); 
});
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