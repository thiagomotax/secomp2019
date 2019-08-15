<?php

    session_start();
    
    if (isset($_SESSION['user_id'])) {

      require_once("../dao/LoginDAO.php");
      require_once("../dao/ExtrasDAO.php");
      require_once("../dao/UsuariosDAO.php");

      $UsuariosDAO = new UsuariosDAO();
      $stmtUsuarios = $UsuariosDAO->runQuery("SELECT * FROM usuarios WHERE codUsuario = ".$_SESSION['user_id']."");
      $stmtUsuarios->execute();
      $RowUsuarios = $stmtUsuarios->fetch(PDO::FETCH_ASSOC);

      if($RowUsuarios['nivelUsuario'] != 0){

        header('Location: viewPainel.php');

      }else{

        if($RowUsuarios['nivelUsuario'] == 0){
          $ExtrasDAO = new ExtrasDAO();
          $stmtExtras = $ExtrasDAO->runQuery("SELECT * FROM extras ORDER BY nomeExtra ASC");
          $stmtExtras->execute();

        }

      }

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
    <title>VI Secomp - Painel</title>
  </head>
  <body class="sidebar-mini fixed">
    <div class="wrapper">
      <!-- Navbar-->
      <header class="main-header hidden-print"><a class="logo" href="https://sistemas.riopomba.ifsudestemg.edu.br/secomp" target="_blank"><img class="logo-nav" src="../assets/images/secomp-transparente.png"></a>
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
                      <li class="active"><a href="viewRelatoriosExtras.php"><span class="mdi mdi-file-pdf mdi-lg"></span> Relatórios Extras</a></li>
                    </ul>
                  </li>
                  <li><a href="viewInscricoes.php"><i class="mdi mdi-checkbox-marked-outline mdi-lg"></i> <span>Inscrições</span></a></li>
                  <li><a href="viewUsuarios.php"><i class="mdi mdi-account-multiple mdi-lg"></i> <span>Usuarios</span></a></li>
                  <li><a href="viewConfiguracoes.php"><i class="mdi mdi-settings mdi-lg"></i> <span>Configurações</span></a></li>
                </ul>';
            }else{
              echo
                '<ul class="sidebar-menu">
                  <li class="active"><a href="viewPainel.php"><i class="mdi mdi-view-dashboard mdi-lg"></i> <span>Painel</span></a></li>'.(($countMinistrantes > 0) ? '<li class="treeview"><a href="#"><i class="mdi mdi-school mdi-lg"></i> <span>Minicursos</span><i class="fa fa-angle-right"></i></a>
                    <ul class="treeview-menu">
                      <li><a href="viewMinicursos.php"><span class="mdi mdi-format-list-bulleted mdi-lg"></span> Listar Minicursos</a></li>
                      <li><a href="viewRelatoriosMinicursos.php"><span class="mdi mdi-file-pdf mdi-lg"></span> Relatórios Minicursos</a></li>
                    </ul>
                  </li>' : '<li><a href="viewMinicursos.php"><i class="mdi mdi-format-list-bulleted mdi-lg"></i> <span>Minicursos</span></a></li>').'
                  <li><a href="viewInscricoes.php"><i class="mdi mdi-checkbox-marked-outline mdi-lg"></i> <span>Inscrições</span></a></li>
                </ul>';
            }
          ?>
        </section>
      </aside>
      <div class="content-wrapper">
        <div class="page-title">
          <div>
            <ul class="breadcrumb">
              <li><a><i class="mdi mdi-view-dashboard mdi-lg"></i> Painel</a></li>
            </ul>
          </div>
        </div>
       <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="card-body">
                <form class="form-horizontal" target="_blank" name="formRelatorio" id="relatorios-form" method="POST">
                  <div class="row">
                    <div class="col-md-12">
                      <h4>Inscrições nos Extras</h4>
                      <?php
                        while ($RowExtras = $stmtExtras->fetch(PDO::FETCH_ASSOC)) {
                          echo 
                          '
                            <div class="animated-radio-button">
                                <label><input type="radio" id="extra" data-nome="'.$RowExtras['nomeExtra'].'" name="extraRD" value="'.$RowExtras['codExtra'].'" checked><span class="label-text">'.$RowExtras['nomeExtra'].'</span>
                                </label>
                            </div>';
                        }
                      ?>
                    </div>
                    <div class="col-md-12">
                      <h4>Opções de relatório</h4>
                      <div class="animated-radio-button">
                        <label><input type="radio" id="relacao" name="relatorio" value="1" onclick="escondeCampoChamada()" checked="">
                          <span class="label-text">Relação de inscritos</span>
                        </label>
                        <label><input type="radio" id="chamada" name="relatorio" value="2" onclick="mostrarCampoChamada()">
                          <span class="label-text">Chamada</span>
                        </label>
                      </div>
                    </div>
                    <div class="col-md-12" id="divDataChamada" style="display: none">
                      <div class="form-group">
                        <div class="col-lg-3">
                          <input class="form-control" type="text" name="dataChamada" id="dataChamada" placeholder="Data da chamada  " required>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="row margin-top-20">
                    <div class="col-md-12 text-center">
                      <div class="form-group">
                        <button id="btnRelatorio" class="btn btn-primary" type="button">Gerar</button>
                      </div>
                    </div>
                  </div>
                </form>

                <div class="row margin-top-20"  style="border-top: 2px solid #CCC">
                  <h4>Relação Geral de Inscritos</h4>
                  <div class="col-md-12 text-center">
                    <div class="form-group">
                      <a href="relatorioInscritosGeral.php" class="btn btn-primary" target="_blank">Gerar</a>
                    </div>
                  </div>
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
    <script type="text/javascript" src="../assets/js/plugins/bootstrap-notify.min.js"></script>
    <script type="text/javascript" src="../assets/js/plugins/sweetalert.min.js"></script>
    <script type="text/javascript" src="../assets/js/plugins/bootstrap-datepicker.min.js"></script>
    <script src="../assets/js/custom/relatoriosextra.js"></script>
  </body>
</html>
<?php
  }else {
    header('Location: viewLogin.php');
  }
?>