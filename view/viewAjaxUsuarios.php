<?php
  
    session_start();

    if (isset($_SESSION['user_id'])) {

        require_once("../dao/UsuariosDAO.php");
        $UsuariosDAO = new UsuariosDAO();
        $stmtUsuariosNivel = $UsuariosDAO->runQuery("SELECT * FROM usuarios WHERE codUsuario = ".$_SESSION['user_id']."");
        $stmtUsuariosNivel->execute();
        $RowUsuariosNivel = $stmtUsuariosNivel->fetch(PDO::FETCH_ASSOC);


        if($RowUsuariosNivel['nivelUsuario'] != 0){

            header('Location: viewPainel.php');

        }

        function mask($val, $mask) {

            $maskared = '';
            $k = 0;
             
            for($i = 0; $i<=strlen($mask)-1; $i++) {
                if($mask[$i] == '#') {
                    if(isset($val[$k])) {
                        $maskared .= $val[$k++];
                    }
                 }else {
                    if(isset($mask[$i])) {
                        $maskared .= $mask[$i];
                    }
                 }
            }
            
            return $maskared;
        
        }

    	$encoding = 'UTF-8';

    	$stmtUsuarios = $UsuariosDAO->runQuery("SELECT * FROM usuarios");
        $stmtUsuarios->execute();

    	$data = array();

    	$i = 0;

    	while ($RowUsuarios = $stmtUsuarios->fetch(PDO::FETCH_ASSOC)) {

    		$data[$i]{'codUsuario'} = $RowUsuarios['codUsuario'];
            $data[$i]{'nomeUsuario'} = $RowUsuarios['nomeUsuario'];
    		$data[$i]{'cpfUsuario'} = mask($RowUsuarios['cpfUsuario'],'###.###.###-##');
    		$data[$i]{'emailUsuario'} = $RowUsuarios['emailUsuario'];
            $data[$i]{'nivelUsuario'} = ($RowUsuarios['nivelUsuario'] == 0) ? 'Administrador' : 'Usuário Comum';
            $data[$i]{'button'} = 
            '<li class="dropdown list-none">
              <a class="dropdown-toggle" href="#" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><span class="mdi mdi-settings"></span></a>
              <ul class="dropdown-menu settings-menu">
                <li><a id="rowResetPassword_'.$i.'" data-id="'.$RowUsuarios['codUsuario'].'" data-nome="'.$RowUsuarios['nomeUsuario'].'" onclick="alterarSenhaUsuario('.($i+1).')" data-tooltip="tooltip" title="Alterar senha"><span class="mdi mdi-account-key"></span> Alterar senha</a></li>
                <li><a href="viewFormEditUsuario.php?codUsuario='.$RowUsuarios['codUsuario'].'"><span class="mdi mdi-pencil"></span> Editar</a></li>
                <li><a id="rowDelete_'.$i.'" data-id="'.$RowUsuarios['codUsuario'].'" data-nome="'.$RowUsuarios['nomeUsuario'].'" onclick="excluirUsuario('.($i+1).')" data-tooltip="tooltip" title="Excluir"><span class="mdi mdi-delete-forever"></span> Excluir</a></li>
              </ul>
            </li>';

    		$i++;

    	}

        $datax = array('data' => $data);

        function raw_json_encode($input, $flags = 0) {
            $fails = implode('|', array_filter(array(
                '\\\\',
                $flags & JSON_HEX_TAG ? 'u003[CE]' : '',
                $flags & JSON_HEX_AMP ? 'u0026' : '',
                $flags & JSON_HEX_APOS ? 'u0027' : '',
                $flags & JSON_HEX_QUOT ? 'u0022' : '',
            )));
            $pattern = "/\\\\(?:(?:$fails)(*SKIP)(*FAIL)|u([0-9a-fA-F]{4}))/";
            $callback = function ($m) {
                return html_entity_decode("&#x$m[1];", ENT_QUOTES, 'UTF-8');
            };
            return preg_replace_callback($pattern, $callback, json_encode($input, $flags));
        }

        echo raw_json_encode($datax);

    }else{
        header('Location: viewLogin.php');
    }

?>