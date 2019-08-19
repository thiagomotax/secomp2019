<?php

    session_start();
    
    if (isset($_SESSION['user_id'])) {

      require_once("../dao/LoginDAO.php");
      require_once("../dao/UsuariosDAO.php");
      require_once("../dao/ConfiguracoesDAO.php");
      require_once("../dao/MinistrantesDAO.php");
      require_once("../dao/JogosDAO.php");


      $UsuariosDAO = new UsuariosDAO();
      $stmtUsuarios = $UsuariosDAO->runQuery("SELECT * FROM usuarios WHERE codUsuario = ".$_SESSION['user_id']."");
      $stmtUsuarios->execute();
      $RowUsuarios = $stmtUsuarios->fetch(PDO::FETCH_ASSOC);

      $ConfiguracoesDAO = new ConfiguracoesDAO();
      $stmtConfiguracoes = $ConfiguracoesDAO->runQuery("SELECT * FROM configuracoes");
      $stmtConfiguracoes->execute();
      $RowConfiguracoes = $stmtConfiguracoes->fetch(PDO::FETCH_ASSOC);

?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="../assets/css/custom.min.css">
    <link rel="stylesheet" type="text/css" href="../assets/css/main.min.css">
    <link rel="stylesheet" href="../assets/css/materialdesignicons.min.css">
    <link rel="stylesheet" type="text/css" href="../assets/fonts/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="../assets/css/bootstrap-checkbox-radio-list-group-item.min.css">
    <title>VIII Secomp - Inscrições</title>
  </head>
  <body class="sidebar-mini fixed">
    <div class="wrapper">
      <!-- Navbar-->
      <header class="main-header hidden-print"><a class="logo" href="#"><img class="logo-nav" src="../assets/images/secomp-transparente.png"></a>
        <nav class="navbar navbar-static-top">
          <!-- Sidebar toggle button--><a class="sidebar-toggle" href="#" data-toggle="offcanvas"></a>
          <!-- Navbar Right Menu-->
          <div class="navbar-custom-menu">
            <ul class="top-nav">
              <li class="dropdown">
                <a class="dropdown-toggle" href="#" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                <?php
                  echo $RowUsuarios['nomeUsuario'];
                ?>
                <span class="mdi mdi-account mdi-lg"></span></a>
                <ul class="dropdown-menu settings-menu">
                  <li><a href="viewPerfil.php"><span class="mdi mdi-account mdi-lg"></span> Perfil</a></li>
                  <li><a href="logout.php"><span class="mdi mdi-logout mdi-lg"></span> Logout</a></li>
                </ul>
              </li>
            </ul>
          </div>
        </nav>
      </header>
      <!-- Side-Nav-->
      <aside class="main-sidebar hidden-print">
        <section class="sidebar">
          <?php
            if($RowUsuarios['nivelUsuario'] == 0){
              echo 
                '<ul class="sidebar-menu">
                  <li><a href="viewPainel.php"><i class="mdi mdi-view-dashboard"></i> <span>Painel</span></a></li>
                  <li class="treeview"><a href="#"><i class="mdi mdi-school mdi-lg"></i> <span>Minicursos</span><i class="fa fa-angle-right"></i></a>
                    <ul class="treeview-menu">
                      <li><a href="viewMinicursos.php"><span class="mdi mdi-format-list-bulleted mdi-lg"></span> Listar Minicursos</a></li>
                      <li><a href="viewFormCadMinicurso.php"><span class="mdi mdi-playlist-plus mdi-lg"></span> Cadastrar Minicurso</a></li>
                      <li><a href="viewRelatoriosMinicursos.php"><span class="mdi mdi-file-pdf mdi-lg"></span> Relatórios Minicursos</a></li>
                    </ul>
                  </li>
                  <li class="treeview"><a href="#"><i class="mdi mdi-plus mdi-lg"></i> <span>Extras</span><i class="fa fa-angle-right"></i></a>
                    <ul class="treeview-menu">
                      <li><a href="viewExtras.php"><span class="mdi mdi-format-list-bulleted mdi-lg"></span> Listar Extras</a></li>
                      <li><a href="viewFormCadExtra.php"><span class="mdi mdi-playlist-plus mdi-lg"></span> Cadastrar Extra</a></li>
                      <li><a href="viewRelatoriosExtras.php"><span class="mdi mdi-file-pdf mdi-lg"></span> Relatórios Extras</a></li>
                    </ul>
                  </li>
                  <li  class="active"><a href="viewInscricoes.php"><i class="mdi mdi-checkbox-marked-outline mdi-lg"></i> <span>Inscrições</span></a></li>
                  <li><a href="viewUsuarios.php"><i class="mdi mdi-account-multiple mdi-lg"></i> <span>Usuarios</span></a></li>
                  <li><a href="viewConfiguracoes.php"><i class="mdi mdi-settings mdi-lg"></i> <span>Configurações</span></a></li>
                </ul>';
            }else{
              echo
                '<ul class="sidebar-menu">
                  <li><a href="viewPainel.php"><i class="mdi mdi-view-dashboard mdi-lg"></i> <span>Painel</span></a></li>
                  <li><a href="viewMinicursos.php"><i class="mdi mdi-format-list-bulleted mdi-lg"></i> <span>Minicursos</span></a></li>
                  <li><a href="viewExtras.php"><i class="mdi mdi-plus-box mdi-lg"></i> <span>Extras</span></a></li>
                  <li class="active"><a href="viewInscricoes.php"><i class="mdi mdi-checkbox-marked-outline mdi-lg"></i> <span>Inscrições</span></a></li>
                </ul>';
            }
          ?>
        </section>
      </aside>
      <div class="content-wrapper">
        <div class="page-title">
          <div>
            <ul class="breadcrumb side">
              <li><a href="viewPainel.php"><i class="mdi mdi-view-dashboard mdi-lg"></i></a></li>
              <li class="active">Inscrições</li>
            </ul>
          </div>
        </div>
        <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="card-body">
                <?php
                  
                  $inicioInscricao = $RowConfiguracoes['dataInicioInscricao']. " ".$RowConfiguracoes['horaInicioInscricao'];
                  $finalInscricao = $RowConfiguracoes['dataFinalInscricao']. " ".$RowConfiguracoes['horaFinalInscricao'];

                  date_default_timezone_set('America/Sao_Paulo');

                  $d1 = strtotime($finalInscricao);
                  $d2 = strtotime(date("Y-m-d H:i:s"));
                  $minutosFinal = round(($d1 - $d2) / 60,2);

                  $d3 = strtotime($inicioInscricao);
                  $d4 = strtotime(date("Y-m-d H:i:s"));
                  $minutosInicial = round(($d4 - $d3) / 60,2);

                  if(($minutosInicial <= 0) && ($RowUsuarios['nivelUsuario'] != 0)) {

                     echo
                      '<div class="row">
                        <div class="col-md-12 text-center">
                          <h1>Inscrições ainda não liberadas ...</h1>
                        </div>
                      </div>
                      ';

                  }else if(($minutosFinal <= 0) && ($RowUsuarios['nivelUsuario'] != 0)) {

                    echo
                      '<div class="row">
                        <div class="col-md-12 text-center">
                          <h4>As inscrições para os minicursos estão encerradas ...</h4>
                        </div>
                      </div>
                      ';

                  }else{
                    if($RowUsuarios['nivelUsuario'] == 1){
                      echo '<div id="divMinicursos" class="margin-top-30"></div>';
                      echo '<div class="row" style="margin-top: 40px">
                      <div class="col-md-12 text-center">
                        <a href="confirmacaoMatricula.php" class="btn btn-primary btn-block" target="_blank">Gerar relatório de inscrições</a>
                      </div>
                    </div>';
                    }else if($RowUsuarios['nivelUsuario'] == 0){
                      echo 
                        '<table class="table table-hover table-bordered  table-custom" id="sampleTable">
                          <thead>
                            <tr>
                              <th class="text-center" width="5%">#</th>
                              <th class="text-center" width="20%">Nome</th>
                              <th class="text-center" width="10%">CPF</th>
                              <th class="text-center" width="20%">Minicursos</th>
                              <th class="text-center" width="10%">Data inscrição</th>
                            </tr>
                          </thead>
                          <tbody>
                          </tbody>
                        </table>';
                    }
                  }

                  echo '<div id="divJogos"></div>';

                ?>
                
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <script src="../assets/js/jquery-2.1.4.min.js"></script>
    <script src="../assets/js/bootstrap.min.js"></script>
    <script src="../assets/js/plugins/pace.min.js"></script>
    <script src="../assets/js/main.min.js"></script>
    <script src="../assets/js/custom/inscricoes.js"></script>
    <script src="../assets/js/custom/jogos.min.js"></script>
    <script src="../assets/js/plugins/jquery.dataTables.min.js" type="text/javascript"></script>
    <script src="../assets/js/plugins/dataTables.bootstrap.min.js" type="text/javascript"></script>
    <script src="../assets/js/plugins/bootstrap-notify.min.js" type="text/javascript"></script>
    <script src="../assets/js/plugins/sweetalert.min.js" type="text/javascript"></script>
    <script type="text/javascript">
      $(document).ready(function() {
        var oTable = $('#sampleTable').dataTable( {
          "columnDefs": [
            { className: "text-center", "targets": 0 },
            { className: "text-center", "targets": 1 },
            { className: "text-center", "targets": 2 },
            { className: "text-center", "targets": 4 }],
            "ajax": {
              "url": "viewAjaxInscricoes.php",
              "type": "POST"
            },
            "columns": [
            { "data": "codInscricao" },
            { "data": "nomeUsuario" },
            { "data": "cpfUsuario" },
            { "data": "nomeMinicurso" },
            { "data": "dataInscricao" }
            ],
            "dom": '<"top"i>rt<"bottom"flp><"clear">',
            "order": [[0, 'asc']],
            "oPaginate": {
                "sPrevious": "Prev",
                "sNext": "Next"
            },
            "info": false,
            "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "Todos"]],
            responsive: true,
            language: {
            }
        }); 
      });
    </script>
  </body>
</html>
<?php
    }else {
      header('Location: viewLogin.php');
    }
?>