<?php
  
    session_start();

    if (isset($_SESSION['user_id'])) {

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

        require_once("../dao/InscricoesDAO.php");
        require_once("../dao/UsuariosDAO.php");
        require_once("../dao/MinicursosDAO.php");
        require_once("../dao/ExtrasDAO.php");
    	$InscricoesDAO = new InscricoesDAO();
        $MinicursosDAO = new MinicursosDAO();
        $ExtrasDAO = new MinicursosDAO();


        $encoding = 'UTF-8';

        //SELECT (minicursos.vagasMinicurso - COUNT(minicursos.codMinicurso)) AS VagasRestantesMinicursos, minicursos.* FROM minicursos INNER JOIN inscricoes ON inscricoes.codMinicurso = minicursos.codMinicurso GROUP BY minicursos.codMinicurso

        $stmtMinicursos = $MinicursosDAO->runQuery("SELECT * FROM minicursos ORDER BY nomeMinicurso ASC");
        $stmtMinicursos->execute();

        $stmtExtras = $ExtrasDAO->runQuery("SELECT * FROM extras ORDER BY nomeExtra ASC");
        $stmtExtras->execute();

    	$encoding = 'UTF-8';

    	$stmtInscricoes = $InscricoesDAO->runQuery("SELECT * FROM inscricoes INNER JOIN usuarios ON usuarios.codUsuario = inscricoes.codUsuario INNER JOIN minicursos ON minicursos.codMinicurso = inscricoes.codMinicurso");
        $stmtInscricoes->execute();

        $UsuariosDAO = new UsuariosDAO();
        $stmtUsuarios = $UsuariosDAO->runQuery("SELECT * FROM usuarios WHERE codUsuario = ".$_SESSION['user_id']."");
        $stmtUsuarios->execute();
        $RowUsuarios = $stmtUsuarios->fetch(PDO::FETCH_ASSOC);

        if($RowUsuarios['nivelUsuario'] == 0){

        	$data = array();

        	$i = 0;

        	while ($RowInscricoes = $stmtInscricoes->fetch(PDO::FETCH_ASSOC)) {

        		$data[$i]{'codInscricao'} = $RowInscricoes['codInscricao'];
                $data[$i]{'nomeUsuario'} = $RowInscricoes['nomeUsuario'];
        		$data[$i]{'cpfUsuario'} = mask($RowInscricoes['cpfUsuario'],'###.###.###-##');
        		$data[$i]{'nomeMinicurso'} = $RowInscricoes['nomeMinicurso'];
                $data[$i]{'dataInscricao'} = date('d/m/Y',strtotime($RowInscricoes['dataInscricao']));
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

        }else if($RowUsuarios['nivelUsuario'] == 1){
            echo '<ul class="nav nav-tabs">
            <li class="active"><a data-toggle="tab" href="#home">Minicursos</a></li>
            <li><a data-toggle="tab" href="#menu1">Atividade extras</a></li>
          </ul>
          
          <div class="tab-content">
          <div id="home" class="tab-pane fade in active">
          ';
            echo '<h2 class="text-center">Minicursos</h2>';
            echo '<h5 class="text-center">Você pode realizar inscrição em até 3 minicursos.</h5>';
            echo '<div class="list-group checkbox-list-group">';
            while ($RowMinicursos = $stmtMinicursos->fetch(PDO::FETCH_ASSOC)) {

                $count = 0;

                $stmtVagasMinicursos = $MinicursosDAO->runQuery("SELECT * FROM inscricoes WHERE codMinicurso = '".$RowMinicursos['codMinicurso']."'");
                $stmtVagasMinicursos->execute();

                $stmtInscricaoUsuario = $MinicursosDAO->runQuery("SELECT * FROM inscricoes WHERE codUsuario = '".$_SESSION['user_id']."' AND codMinicurso = '".$RowMinicursos['codMinicurso']."'");
                $stmtInscricaoUsuario->execute();
                $count = $stmtInscricaoUsuario->rowCount();

                if($count > 0){

                    echo 
                    '
                    <div class="list-group-item" style="margin-bottom: 1px">&nbsp;<label><input type="checkbox" onclick=inscreverMinicurso(this.id); id="codMinicurso_'.$RowMinicursos['codMinicurso'].'" data-nome="'.$RowMinicursos['nomeMinicurso'].'" name="minicursoCK[]" value="'.$RowMinicursos['codMinicurso'].'" checked>
                    <span class="list-group-item-text"><i class="fa fa-fw"></i>'.$RowMinicursos['nomeMinicurso'].'  ( '.($RowMinicursos['vagasMinicurso'] - $stmtVagasMinicursos->rowCount()).' vagas )</span>
                    </label></div>

                        ';

                }else{

                    echo 
                    '
                    <div class="list-group-item style="margin-bottom: 1px"">&nbsp;<label><input type="checkbox" onclick=inscreverMinicurso(this.id); id="codMinicurso_'.$RowMinicursos['codMinicurso'].'" data-nome="'.$RowMinicursos['nomeMinicurso'].'" name="minicursoCK[]" value="'.$RowMinicursos['codMinicurso'].'">
                    <span class="list-group-item-text"><i class="fa fa-fw"></i>'.$RowMinicursos['nomeMinicurso'].'  ( '.($RowMinicursos['vagasMinicurso'] - $stmtVagasMinicursos->rowCount()).' vagas )</span>
                    </label></div>';

                }
            }
            echo '</div><br/>';
            echo '</div>';
            echo '
          <div id="menu1" class="tab-pane fade">
          ';
            echo '<h2 class="text-center">Atividades extras</h2>';
            echo '<h5 class="text-center">Você pode realizar a inscrição em quantas atividades extras desejar.</h5>';
            echo '<div class="list-group checkbox-list-group">';
            while ($RowExtra = $stmtExtras->fetch(PDO::FETCH_ASSOC)) {

                $count = 0;

                $stmtInscricaoExtra = $ExtrasDAO->runQuery("SELECT * FROM inscricoesextras WHERE codUsuario = '".$_SESSION['user_id']."' AND codExtra = '".$RowExtra['codExtra']."'");
                $stmtInscricaoExtra->execute();
                $count = $stmtInscricaoExtra->rowCount();

                if($count > 0){

                    echo 
                    '
                    <div class="list-group-item list-group-item" style="margin-bottom: 1px">&nbsp;<label><input type="checkbox" onclick=inscreverExtra(this.id); id="codExtra_'.$RowExtra['codExtra'].'" data-nome="'.$RowExtra['nomeExtra'].'" name="minicursoCK[]" value="'.$RowExtra['codExtra'].'" checked>
                    <span class="list-group-item-text"><i class="fa fa-fw"></i>'.$RowExtra['nomeExtra'].'</span>
                    </label></div>';

                }else{

                    echo 
                    '
                    <div class="list-group-item" style="margin-bottom: 1px">&nbsp;<label><input type="checkbox" onclick=inscreverExtra(this.id); id="codExtra_'.$RowExtra['codExtra'].'" data-nome="'.$RowExtra['nomeExtra'].'" name="minicursoCK[]" value="'.$RowExtra['codExtra'].'">
                    <span class="list-group-item-text"><i class="fa fa-fw"></i>'.$RowExtra['nomeExtra'].'</span>
                    </label></div>';

                }
            }
            echo '</div></div>';
            echo '</div>';
        }

    }else{
        header('Location: viewLogin.php');
    }

?>