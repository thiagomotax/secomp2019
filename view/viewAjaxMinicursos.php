<?php
  
    session_start();

    if (isset($_SESSION['user_id'])) {

        require_once("../dao/MinicursosDAO.php");
        require_once("../dao/UsuariosDAO.php");
        require_once("../dao/InscricoesDAO.php");
        $MinicursosDAO = new MinicursosDAO();

        $encoding = 'UTF-8';

        //SELECT (minicursos.vagasMinicurso - COUNT(minicursos.codMinicurso)) AS VagasRestantesMinicursos, minicursos.* FROM minicursos INNER JOIN inscricoes ON inscricoes.codMinicurso = minicursos.codMinicurso GROUP BY minicursos.codMinicurso

        $stmtMinicursos = $MinicursosDAO->runQuery("SELECT * FROM minicursos ORDER BY nomeMinicurso ASC");
        $stmtMinicursos->execute();

        $UsuariosDAO = new UsuariosDAO();
        $stmtUsuarios = $UsuariosDAO->runQuery("SELECT * FROM usuarios WHERE codUsuario = ".$_SESSION['user_id']."");
        $stmtUsuarios->execute();
        $RowUsuarios = $stmtUsuarios->fetch(PDO::FETCH_ASSOC);

        if($RowUsuarios['nivelUsuario'] == 0){

            $data = array();

            $i = 0;

            while ($RowMinicursos = $stmtMinicursos->fetch(PDO::FETCH_ASSOC)) {

                $stmtVagasMinicursos = $MinicursosDAO->runQuery("SELECT * FROM inscricoes WHERE codMinicurso = '".$RowMinicursos['codMinicurso']."'");
                $stmtVagasMinicursos->execute();

                $data[$i]{'codMinicurso'} = $RowMinicursos['codMinicurso'];
                $data[$i]{'nomeMinicurso'} = $RowMinicursos['nomeMinicurso'];
                $data[$i]{'ministranteMinicurso'} = $RowMinicursos['ministranteMinicurso'];
                $data[$i]{'vagasMinicurso'} = $RowMinicursos['vagasMinicurso'];
                $data[$i]{'vagasRestantesMinicurso'} = ($RowMinicursos['vagasMinicurso'] - $stmtVagasMinicursos->rowCount());
                $data[$i]{'informacoesMinicurso'} = substr_replace($RowMinicursos['informacoesMinicurso'],'...', 10);
                $data[$i]{'buttons'} =
                '<li class="dropdown list-none">
                  <a class="dropdown-toggle" href="#" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><span class="mdi mdi-settings"></span></a>
                  <ul class="dropdown-menu settings-menu">
                    <li><a href="viewFormEditMinicurso.php?codMinicurso='.$RowMinicursos['codMinicurso'].'"><span class="mdi mdi-pencil"></span> Editar</a></li>
                    <li><a id="rowDelete_'.$i.'" data-id="'.$RowMinicursos['codMinicurso'].'" data-nome="'.$RowMinicursos['nomeMinicurso'].'" onclick="excluirMinicurso('.($i+1).')" data-tooltip="tooltip" title="Excluir"><span class="mdi mdi-delete-forever"></span> Excluir</a></li>
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

        }else if($RowUsuarios['nivelUsuario'] == 1){

            echo '<div class="row">';
            while ($RowMinicursos = $stmtMinicursos->fetch(PDO::FETCH_ASSOC)) {

                $stmtVagasMinicursos = $MinicursosDAO->runQuery("SELECT * FROM inscricoes WHERE codMinicurso = '".$RowMinicursos['codMinicurso']."'");
                $stmtVagasMinicursos->execute();

                echo
                '
                      <div class="col-md-6 col-md-offset-0 margin-top--25">
                        <div class="card">
                            <div class="card-body" style="min-height: 120px; height: auto">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="row">
                                            <div class="col-md-12"><b>Minicurso: </b>'.$RowMinicursos['nomeMinicurso'].'  ( '.($RowMinicursos['vagasMinicurso'] - $stmtVagasMinicursos->rowCount()).' vagas )</div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12"><b>Ministrante: </b>'.$RowMinicursos['ministranteMinicurso'].'</div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12"><b>Informações: </b>'.$RowMinicursos['informacoesMinicurso'].'</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                      </div>';

            }

        }

    }else{
        header('Location: viewLogin.php');
    }

?>