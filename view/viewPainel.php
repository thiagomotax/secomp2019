<?php

    session_start();
    
    if (isset($_SESSION['user_id'])) {

      require_once("../dao/LoginDAO.php");
      require_once("../dao/AvisosDAO.php");
      require_once("../dao/UsuariosDAO.php");
      require_once("../dao/ConfiguracoesDAO.php");

      $UsuariosDAO = new UsuariosDAO();
      $stmtUsuarios = $UsuariosDAO->runQuery("SELECT * FROM usuarios WHERE codUsuario = ".$_SESSION['user_id']."");
      $stmtUsuarios->execute();
      $RowUsuarios = $stmtUsuarios->fetch(PDO::FETCH_ASSOC);

      $ConfiguracoesDAO = new ConfiguracoesDAO();
      $stmtConfiguracoes = $ConfiguracoesDAO->runQuery("SELECT * FROM configuracoes");
      $stmtConfiguracoes->execute();
      $RowConfiguracoes = $stmtConfiguracoes->fetch(PDO::FETCH_ASSOC);

      $AvisosDAO = new AvisosDAO();
      $stmtAvisos = $AvisosDAO->runQuery("SELECT * FROM avisos");
      $stmtAvisos->execute();
      $RowAvisos = $stmtAvisos->fetch(PDO::FETCH_ASSOC);

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
    <title>VIII Secomp - Painel</title>
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
                  <li class="active"><a href="viewPainel.php"><i class="mdi mdi-view-dashboard"></i> <span>Painel</span></a></li>
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
                  <li><a href="viewInscricoes.php"><i class="mdi mdi-checkbox-marked-outline mdi-lg"></i> <span>Inscrições</span></a></li>
                  <li><a href="viewUsuarios.php"><i class="mdi mdi-account-multiple mdi-lg"></i> <span>Usuarios</span></a></li>
                  <li><a href="viewConfiguracoes.php"><i class="mdi mdi-settings mdi-lg"></i> <span>Configurações</span></a></li>
                </ul>';
            }else{
              echo
                '<ul class="sidebar-menu">
                  <li class="active"><a href="viewPainel.php"><i class="mdi mdi-view-dashboard mdi-lg"></i> <span>Painel</span></a></li>
                  <li><a href="viewMinicursos.php"><i class="mdi mdi-format-list-bulleted mdi-lg"></i> <span>Minicursos</span></a></li>
                  <li><a href="viewExtras.php"><i class="mdi mdi-plus-box mdi-lg"></i> <span>Extras</span></a></li>
                  <li><a href="viewInscricoes.php"><i class="mdi mdi-checkbox-marked-outline mdi-lg"></i> <span>Inscrições</span></a></li>
                </ul>';
            }
          ?>
        </section>
      </aside>
      <div class="content-wrapper">
      <div class="page-title">
          <div>
            <ul class="breadcrumb side">
              <li><a href="#"><i class="mdi mdi-view-dashboard mdi-lg"></i></a></li>
              <li><a href="#">Painel</i></a></li>
            </ul>
          </div>
        </div>
       <div class="row">
          <div class="col-md-12 text-center">
            <div class="card">
              <div class="card-body">
                <?php
                if($RowUsuarios['nivelUsuario'] == 0){
                ?>
                  <form id="avisos-form" action="../controller/AvisosController.php/" method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="acao" value="editar">
                    <input type="hidden" name="codAviso" value="<?php echo $RowAvisos['codAviso']; ?>">
                    <div class="row">
                      <div class="col-md-10 col-md-offset-1 text-center">
                        <textarea name="conteudo"><?php echo $RowAvisos['conteudoAviso']; ?></textarea>
                      </div>
                    </div>
                    <div class="row margin-top-20">
                      <div class="col-md-12 text-center">
                        <div class="form-group">
                          <button class="btn btn-primary" type="submit">Editar</button>
                        </div>
                      </div>
                    </div>
                  </form>
                <?php
                  }

                  $inicioInscricao = $RowConfiguracoes['dataInicioInscricao']. " ".$RowConfiguracoes['horaInicioInscricao'];
                  $finalInscricao = $RowConfiguracoes['dataFinalInscricao']. " ".$RowConfiguracoes['horaFinalInscricao'];
                  date_default_timezone_set('America/Sao_Paulo');
                  $d1 = strtotime($finalInscricao);
                  $d2 = strtotime(date("Y-m-d H:i:s"));
                  $minutosFinal = round(($d1 - $d2) / 60,2);

                  $d3 = strtotime($inicioInscricao);
                  $d4 = strtotime(date("Y-m-d H:i:s"));
                  $minutosInicial = round(($d4 - $d3) / 60,2);
                  if($minutosInicial <= 0) {
                     echo
                      '<div class="row">
                        <div class="col-md-12 text-center">
                          <h1>Inscrições ainda não liberadas ...</h1>
                        </div>
                      </div>
                      ';

                  }else if($minutosFinal <= 0){
                    echo
                      '<div class="row">
                          <p style="font-weight: bold; font-size: 18px">Clique no botão abaixo para gerar a confirmação de matrícula</p>
                          <a href="confirmacaoMatricula.php" class="btn btn-primary" target="_blank">Gerar</a>
                        </div>
                      </div>
                      ';
                  }else if($RowUsuarios['nivelUsuario'] != 0){
                    echo
                      '<div class="row">
                        <div class="col-md-10 col-md-offset-1 text-left">
                          '.$RowAvisos['conteudoAviso'].'
                      </div>
                      ';
                  }
                ?>
              </div>
            </div>
            
          </div>
        </div>
    </div>
    <script src="../assets/js/jquery-2.1.4.min.js"></script>
    <script src="../assets/js/bootstrap.min.js"></script>
    <script src="../assets/js/plugins/pace.min.js"></script>
    <script src="../assets/js/main.min.js"></script>
    <script src="../assets/js/tinymce/tinymce.min.js"></script>
    <script type="text/javascript" src="../assets/js/plugins/bootstrap-notify.min.js"></script>
    <script type="text/javascript" src="../assets/js/plugins/sweetalert.min.js"></script>
    <script>
      tinymce.init({
        selector: 'textarea',
        language : 'pt_BR',
        height: 200,
        theme: 'modern',
        plugins: [
                "advlist autolink autosave link image lists charmap print preview hr anchor pagebreak spellchecker",
                "searchreplace wordcount visualblocks visualchars code insertdatetime media nonbreaking",
                "table contextmenu directionality emoticons template textcolor paste textcolor colorpicker textpattern"
        ],
        toolbar1: "cut copy paste | searchreplace | bullist numlist | outdent indent blockquote | alignleft aligncenter alignright | undo redo | link unlink image media | insertdatetime preview",
        toolbar2: "table | hr removeformat | bold subscript superscript | charmap emoticons | print fullscreen | ltr rtl | spellchecker | visualchars visualblocks nonbreaking template pagebreak restoredraft",
        image_advtab: true,
        templates: [
          { title: 'Test template 1', content: 'Test 1' },
          { title: 'Test template 2', content: 'Test 2' }
        ]
       });
    </script>
  </body>
</html>
<?php
    }else {
      header('Location: viewLogin.php');
    }
?>