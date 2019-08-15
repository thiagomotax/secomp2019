$(document).ready(function() {
  $('#material-form').submit(function(e) {
    var dados = $('#material-form').serializeArray();
    console.log(dados);
    e.preventDefault();
    if(dados[1].value == "") {
      $.notify({
        title: "",
        message: "O nome do material precisa ser preeenchido!",
        icon: 'fa fa-check' 
      },{
        type: "warning",
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
      $.ajax({  
        url: "../controller/MateriaisController.php",  
        type: "POST",  
        data: new FormData(this),  
        contentType: false,  
        processData:false,  
        success: function(result) {
          if(result == 1) {
             $.notify({
              title: "",
              message: "Material cadastrado com sucesso!",
              icon: 'fa fa-check' 
            },{
              type: "success",
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
            $("#material-form")[0].reset();
            $('#cadastrarMaterial').modal('hide');
            var table = $('#sampleTable').DataTable();
            table.ajax.reload( null, false );
          }else if(result == 2){
            $.notify({
              title: "",
              message: "Erro ao cadastrar o material!",
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
            $("#material-form")[0].reset();
            $('#cadastrarMaterial').modal('hide');
            var table = $('#sampleTable').DataTable();
            table.ajax.reload( null, false );
          }else if(result == 3) {
            $.notify({
              title: "",
              message: "Extensão do arquivo não permitida!",
              icon: 'fa fa-check' 
            },{
              type: "warning",
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
          }
        }
      });
    }
  });
});
function showFileName(inputFile) {
  inputFile.offsetParent.getElementsByClassName('fileName')[0].innerHTML = inputFile.value.replace(/\\/g, '/').split('/').pop();
}

function excluirMaterial(id)  {
  var codMaterial = $('#rowDelete_'+(id-1)).attr("data-id");
  var nomeMaterial = $('#rowDelete_'+(id-1)).attr("data-nome");
  swal({
    title: '',
    text: "Deseja realmente excluir o material " + nomeMaterial + " ?",
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
      url:"../controller/MateriaisController.php",
      data: {acao: "excluir", codMaterial: codMaterial},
      success: function(result){
        if(result == 1) {
          $.notify({
            title: "",
            message: "Material excluído com sucesso!",
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
        }else if(result == 2){
          $.notify({
            title: "",
            message: "Erro ao excluir o material!",
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
        }
      }
    });
  });
}
