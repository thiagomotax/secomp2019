<?php

    session_start();

    $acao = $_POST["acao"];

    switch ($acao) {
        case 'adicionar':
            addMinistrante();
            break;
        case 'excluir':
            deleteMinistrante();
            break;
    }

    function addMinistrante() {
        require_once ('../model/Ministrantes.php');
        require_once ('../dao/MinistrantesDAO.php');
        require_once ('../BancoDeDados/database.php');
        $db = new Database();
        $dao = new MinistrantesDAO($db);
        $codUsuario = $_POST['codUsuario'];
        $codMinicurso = $_POST['codMinicurso'];
        $ministrantes = new Ministrantes();
        $ministrantes->setCodMinicurso($codMinicurso);
        $ministrantes->setCodUsuario($codUsuario);
        $dao->add($ministrantes);
    }


    function deleteMinistrante() {
        require_once ('../model/Ministrantes.php');
        require_once ('../dao/MinistrantesDAO.php');
        require_once ('../BancoDeDados/database.php');
        $db = new Database();
        $dao = new MinistrantesDAO($db);
        $codUsuario = $_POST['codUsuario'];
        $codMinicurso = $_POST['codMinicurso'];
        $ministrantes = new Ministrantes();
        $ministrantes->setCodMinicurso($codMinicurso);
        $ministrantes->setCodUsuario($codUsuario);
        $dao->delete($ministrantes);
    }

?>
