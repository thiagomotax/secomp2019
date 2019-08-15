<?php
    
    $acao = $_POST["acao"];

    switch ($acao) {
        case 'editar':
            updateAvisos();
            break;
    }

    function updateAvisos() {
        require_once ('../model/Avisos.php');
        require_once ('../dao/AvisosDAO.php');
        require_once ('../BancoDeDados/database.php');
        $db = new Database();
        $dao = new AvisosDAO($db);
        $id = $_POST['codAviso'];
        $conteudo = $_POST['conteudo'];
        $Avisos = new Avisos();
        $Avisos->setId($id);
        $Avisos->setConteudo($conteudo);
        $dao->update($Avisos);
    }

?>
