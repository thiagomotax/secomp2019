<?php
    
    $acao = $_POST["acao"];

    switch ($acao) {
        case 'editar':
            updateConfiguracoes();
            break;
    }

    function updateConfiguracoes() {
        require_once ('../model/Configuracoes.php');
        require_once ('../dao/ConfiguracoesDAO.php');
        require_once ('../BancoDeDados/database.php');
        $db = new Database();
        $dao = new ConfiguracoesDAO($db);
        $id = $_POST['codConfiguracao'];
        $dataInicio = $_POST['dataInicioInscricao'];
        $dataFinal = $_POST['dataFinalInscricao'];
        $arrayInicio = explode("/", $dataInicio);
        $dataInicioBD = $arrayInicio[2].'-'.$arrayInicio[1].'-'.$arrayInicio[0];
        $arrayFinal = explode("/", $dataFinal);
        $dataFinalBD = $arrayFinal[2].'-'.$arrayFinal[1].'-'.$arrayFinal[0];
        $horaInicio = $_POST['horaInicioInscricao'];
        $horaFinal = $_POST['horaFinalInscricao'];
        $Configuracoes = new Configuracoes();
        $Configuracoes->setId($id);
        $Configuracoes->setDataInicio($dataInicioBD);
        $Configuracoes->setDataFinal($dataFinalBD);
        $Configuracoes->setHoraInicio($horaInicio);
        $Configuracoes->setHoraFinal($horaFinal);
        $dao->update($Configuracoes);
    }

?>
