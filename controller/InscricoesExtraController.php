<?php

    session_start();
    
    $acao = $_POST["acao"];

    switch ($acao) {
        case 'inscrever':
            inscreverExtra();
            break;
        case 'cancInscricao':
            cancelarInscricaoExtra();
            break;
    }

    function inscreverExtra() {
        require_once ('../model/InscricoesExtra.php');
        require_once ('../dao/InscricoesExtraDAO.php');
        require_once ('../BancoDeDados/database.php');
        $db = new Database();
        $dao = new InscricoesExtraDAO($db);
        $id = $_POST['codExtra'];
        $usuario =  $_SESSION['user_id'];
        $data = date("Y-m-d");
        $InscricoesExtra = new InscricoesExtra();
        $InscricoesExtra->setId($id);
        $InscricoesExtra->setUsuario($usuario);
        $InscricoesExtra->setData($data);
        $dao->addInscricaoExtra($InscricoesExtra);
    }

    function cancelarInscricaoExtra() {
        require_once ('../model/InscricoesExtra.php');
        require_once ('../dao/InscricoesExtraDAO.php');
        require_once ('../BancoDeDados/database.php');
        $db = new Database();
        $dao = new InscricoesExtraDAO($db);
        $id = $_POST['codExtra'];
        $usuario =  $_SESSION['user_id'];
        $InscricoesExtra = new InscricoesExtra();
        $InscricoesExtra->setId($id);
        $InscricoesExtra->setUsuario($usuario);
        $dao->calcelarInscricaoExtra($InscricoesExtra);
    }

    // function updateExtra() {
    //     require_once ('../model/Extras.php');
    //     require_once ('../dao/ExtrasDAO.php');
    //     require_once ('../BancoDeDados/database.php');
    //     $db = new Database();
    //     $dao = new ExtrasDAO($db);
    //     $id = $_POST['codExtra'];
    //     $nome = $_POST['nome'];
    //     $informacoes = $_POST['informacoes'];
    //     $Extras = new Extras();
    //     $Extras->setId($id);
    //     $Extras->setNome($nome);
    //     $Extras->setInformacoes($informacoes);
    //     $dao->update($Extras);
    // }

    // function deleteExtra() {
    //     require_once ('../model/Extras.php');
    //     require_once ('../dao/ExtrasDAO.php');
    //     require_once ('../BancoDeDados/database.php');
    //     $db = new Database();
    //     $dao = new ExtrasDAO($db);
    //     $id = $_POST['codExtra'];
    //     $Extras = new Extras();
    //     $Extras->setId($id);
    //     $dao->delete($Extras);
    // }

?>
