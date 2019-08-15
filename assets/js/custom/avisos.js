// $(document).ready(function() {
//   $('#avisos-form').submit(function(e) {
//     e.preventDefault();  
//     $.ajax({  
//       url: "../controller/AvisosController.php",  
//       type: "POST",  
//       data: new FormData(this),  
//       contentType: false,  
//       processData: false,  
//       success: function(result) {
//         alert(result);
//         if(result == 1) {
//             swal("Sucesso!", "Parcerias alteradas com sucesso!", "success");
//             // $("#avisos-form")[0].reset();
//         }else {
//             swal("Error!", "Erro ao alterar parcerias!", "error");
//         }
//       }
//     });
//   });
// });