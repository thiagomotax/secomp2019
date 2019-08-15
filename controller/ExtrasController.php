<?php
    
    $acao = $_POST["acao"];

    switch ($acao) {
        case 'adicionar':
            addExtra();
            break;
        case 'editar':
            updateExtra();
            break;
        case 'excluir':
            deleteExtra();
            break;
    }


    function addExtra() {
        require_once ('../model/Extras.php');
        require_once ('../dao/ExtrasDAO.php');
        require_once ('../BancoDeDados/database.php');
        $db = new Database();
        $dao = new ExtrasDAO($db);
        $nome = $_POST['nome'];
        $informacoes = $_POST['informacoes'];
        $Extras = new Extras();
        $Extras->setNome($nome);
        $Extras->setInformacoes($informacoes);
        $dao->add($Extras);
    }

    function updateExtra() {
        require_once ('../model/Extras.php');
        require_once ('../dao/ExtrasDAO.php');
        require_once ('../BancoDeDados/database.php');
        $db = new Database();
        $dao = new ExtrasDAO($db);
        $id = $_POST['codExtra'];
        $nome = $_POST['nome'];
        $informacoes = $_POST['info'];
        $Extras = new Extras();
        $Extras->setId($id);
        $Extras->setNome($nome);
        $Extras->setInformacoes($informacoes);
        $dao->update($Extras);
    }

    function deleteExtra() {
        require_once ('../model/Extras.php');
        require_once ('../dao/ExtrasDAO.php');
        require_once ('../BancoDeDados/database.php');
        $db = new Database();
        $dao = new ExtrasDAO($db);
        $id = $_POST['codExtra'];
        $Extras = new Extras();
        $Extras->setId($id);
        $dao->delete($Extras);
    }

?>
