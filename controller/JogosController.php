<?php

    session_start();
    
    $acao = $_POST["acao"];

    switch ($acao) {
        case 'inscrever':
            inscreverJogos();
            break;
        case 'cancInscricao':
            cancelarInscricaoJogos();
            break;
    }

     function soNumero($str) {
        return preg_replace("/[^0-9]/", "", $str);
    }

    function inscreverJogos() {
        require_once ('../model/Jogos.php');
        require_once ('../dao/JogosDAO.php');
        require_once ('../BancoDeDados/database.php');
        $db = new Database();
        $dao = new JogosDAO($db);
        $id = $_POST['codJogo'];
        $usuario =  $_SESSION['user_id'];
        $Jogos = new Jogos();
        $Jogos->setId($id);
        $Jogos->setUsuario($usuario);
        $dao->addInscricaoJogos($Jogos);
    }

    function cancelarInscricaoJogos() {
        require_once ('../model/Jogos.php');
        require_once ('../dao/JogosDAO.php');
        require_once ('../BancoDeDados/database.php');
        $db = new Database();
        $dao = new JogosDAO($db);
        $id = $_POST['codJogo'];
        $usuario =  $_SESSION['user_id'];
        $Jogos = new Jogos();
        $Jogos->setId($id);
        $Jogos->setUsuario($usuario);
        $dao->cancelarInscricaoJogos($Jogos);
    }

?>