$(document).ready(function() {
  var oTable = $('#sampleTable').dataTable( {
    "columnDefs": [
      { className: "text-center", "targets": 0 },
      { className: "text-center", "targets": 1 },
      { className: "text-center", "targets": 2 },
      { className: "text-center", "orderable": false, "targets": 3 }],
      "ajax": {
        "url": "viewAjaxExtras.php",
        "type": "POST"
      },
      "columns": [
      { "data": "codExtra" },
      { "data": "nomeExtra" },
      { "data": "infoExtra" },
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
function excluirExtra(id)  {
  var codExtra = $('#rowDelete_'+(id-1)).attr("data-id");
  var descricaoExtra = $('#rowDelete_'+(id-1)).attr("data-nome");
  swal({
    title: '',
    text: "Deseja realmente excluir o extra " + descricaoExtra+ " ?",
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
      url:"../controller/ExtrasController.php",
      data: {acao: "excluir", codExtra: codExtra},
      success: function(result){
        if(result == 1) {
          $.notify({
            title: "",
            message: "Extra excluído com sucesso!",
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

// Função para editar Extras
$(document).ready(function(){
  $('#btnEditarExtra').click(function(){
    var dados = $('#extra-form').serializeArray();
    $.ajax({
      type:"POST",
      url:"../controller/ExtrasController.php",
      data:dados,
      success: function(result){
        if(result == 1){
          $.notify({
            title: "",
            message: "Extra alterado com sucesso!",
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
              location.href = 'viewExtras.php';
          }, 2000);
        }else if(result == 2){
          $.notify({
            title: "",
            message: "Erro ao alterar o extra!",
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
              location.href = 'viewExtras.php';
          }, 2000);
        }
      }
    });
    return false;
  });
});

// Função para cadastrar Extras
$(document).ready(function(){
  $('#btnCadastrarExtra').click(function(){
    var dados = $('#extra-form').serializeArray();
    $.ajax({
      type:"POST",
      url:"../controller/ExtrasController.php",
      data:dados,
      success: function(result){
        if(result == 1){
          $("#extra-form")[0].reset();
          $.notify({
            title: "",
            message: "Extra cadastrado com sucesso!",
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
              location.href = 'viewExtras.php';
          }, 2000);
        }else if(result == 2){
          $("#extra-form")[0].reset();
          $.notify({
            title: "",
            message: "Erro ao cadastrar o extra!",
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
              location.href = 'viewExtras.php';
          }, 2000);
        }
      }
    });
    return false;
  });
});