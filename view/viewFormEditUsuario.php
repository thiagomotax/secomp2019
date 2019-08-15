<?php

    session_start();
    
    if (isset($_SESSION['user_id'])) {

      require_once("../dao/LoginDAO.php");
      require_once("../dao/UsuariosDAO.php");

      $UsuariosDAO = new UsuariosDAO();
      $stmtUsuarios = $UsuariosDAO->runQuery("SELECT * FROM usuarios WHERE codUsuario = ".$_SESSION['user_id']."");
      $stmtUsuarios->execute();
      $RowUsuarios = $stmtUsuarios->fetch(PDO::FETCH_ASSOC);

      $UsuariosDAO = new UsuariosDAO();
      $stmtEditUsuarios = $UsuariosDAO->runQuery("SELECT * FROM usuarios WHERE codUsuario = ".$_REQUEST['codUsuario']."");
      $stmtEditUsuarios->execute();
      $RowEditUsuarios = $stmtEditUsuarios->fetch(PDO::FETCH_ASSOC);

      if($RowUsuarios['nivelUsuario'] != 0){
      
        header("Location: viewPainel.php");

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
              <li class="dropdown"><a class="dropdown-toggle" href="#" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class="fa fa-user fa-lg"></i></a>
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
                  <li><a href="viewInscricoes.php"><i class="mdi mdi-checkbox-marked-outline mdi-lg"></i> <span>Inscrições</span></a></li>
                  <li class="active"><a href="viewUsuarios.php"><i class="mdi mdi-account-multiple mdi-lg"></i> <span>Usuarios</span></a></li>
                  <li><a href="viewConfiguracoes.php"><i class="mdi mdi-settings mdi-lg"></i> <span>Configurações</span></a></li>
                </ul>';
            }else{
              echo
                '<ul class="sidebar-menu">
                  <li><a href="viewPainel.php"><i class="mdi mdi-view-dashboard mdi-lg"></i> <span>Painel</span></a></li>
                  <li><a href="viewMinicursos.php"><i class="mdi mdi-format-list-bulleted mdi-lg"></i> <span>Minicursos</span></a></li>
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
              <li><a href="viewPainel.php"><i class="mdi mdi-view-dashboard mdi-lg"></i></a></li>
              <li><a href="viewUsuarios.php">Usuarios</i></a></li>
              <li class="active">Editar</li>
            </ul>
          </div>
        </div>
        <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="card-body">
                <form class="form-horizontal" id="usuario-form" method="POST">
                  <legend>Editar usuário / <?php echo $RowEditUsuarios['nomeUsuario']; ?> </legend>
                  <input type="hidden" name="acao" value="editar">
                  <input type="hidden" name="codUsuario" value="<?php echo $RowEditUsuarios['codUsuario']; ?>">
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label class="col-lg-2 control-label">Nome</label>
                        <div class="col-lg-10">
                          <input class="form-control" type="text" name="nome" placeholder="Nome do usuário" value="<?php echo $RowEditUsuarios['nomeUsuario']; ?>" required autocomplete="off">
                        </div>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label class="col-lg-2 control-label">CPF</label>
                        <div class="col-lg-10">
                          <input class="form-control" type="text" name="cpf" id="cpf" placeholder="CPF do usuário" value="<?php echo $RowEditUsuarios['cpfUsuario']; ?>" required autocomplete="off">
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label class="col-lg-2 control-label">Email</label>
                        <div class="col-lg-10">
                          <input class="form-control" type="email" name="email" placeholder="Ministrante do minicurso" value="<?php echo $RowEditUsuarios['emailUsuario']; ?>" required autocomplete="off">
                        </div>
                      </div>
                    </div>
                     <div class="col-md-6">
                      <div class="form-group">
                        <label class="col-lg-2 control-label">Nível de acesso</label>
                        <div class="col-lg-10">
                          <select class="form-control te" name="nivel" id="select">
                            <?php
                              if($RowEditUsuarios['nivelUsuario'] == 0){
                                echo
                                    '<option value="0" selected>Administrador</option>
                                    <option value="1">Usuário Comum</option>';
                              }else{
                                echo
                                    '<option value="0">Administrador</option>
                                    <option value="1" selected>Usuário Comum</option>';
                              }
                            ?>
                          </select>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-12 text-center">
                      <div class="form-group">
                        <a href="viewUsuarios.php" class="btn btn-default">Cancelar</a>
                        <button id="btnEditarUsuario" class="btn btn-primary" type="button">Editar</button>
                      </div>
                    </div>
                  </div>
                </form>
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
    <script src="../assets/js/custom/usuarios.min.js"></script>
    <script src="../assets/js/plugins/bootstrap-notify.min.js" type="text/javascript"></script>
    <script src="../assets/js/plugins/sweetalert.min.js" type="text/javascript"></script>
    <script type="text/javascript" src="../assets/js/jquery.mask.min.js"></script>
    <script type="text/javascript">
      $(document).ready(function(){
        $('#cpf').mask('000.000.000-00');
      });
    </script>
  </body>
</html>
<?php
    }else {
      header('Location: viewLogin.php');
    }
?>