<?php

    session_start();
    
    $acao = $_POST["acao"];

    switch ($acao) {
        case 'adicionar':
            addMinicurso();
            break;
        case 'inscrever':
            inscreverMinicurso();
            break;
        case 'cancInscricao':
            cancelarInscricaoMinicurso();
            break;
        case 'editar':
            updateMinicurso();
            break;
        case 'excluir':
            deleteMinicurso();
            break;
    }

     function soNumero($str) {
        return preg_replace("/[^0-9]/", "", $str);
    }

    function inscreverMinicurso() {
        require_once ('../model/Inscricoes.php');
        require_once ('../dao/InscricoesDAO.php');
        require_once ('../BancoDeDados/database.php');
        $db = new Database();
        $dao = new InscricoesDAO($db);
        $id = $_POST['codMinicurso'];
        $usuario =  $_SESSION['user_id'];
        $data = date("Y-m-d");
        $Inscricoes = new Inscricoes();
        $Inscricoes->setId($id);
        $Inscricoes->setUsuario($usuario);
        $Inscricoes->setData($data);
        $dao->addInscricaoMinicurso($Inscricoes);
    }

    function cancelarInscricaoMinicurso() {
        require_once ('../model/Inscricoes.php');
        require_once ('../dao/InscricoesDAO.php');
        require_once ('../BancoDeDados/database.php');
        $db = new Database();
        $dao = new InscricoesDAO($db);
        $id = $_POST['codMinicurso'];
        $usuario =  $_SESSION['user_id'];
        $Inscricoes = new Inscricoes();
        $Inscricoes->setId($id);
        $Inscricoes->setUsuario($usuario);
        $dao->calcelarInscricaoMinicurso($Inscricoes);
    }

    function updateMinicurso() {
        require_once ('../model/Minicursos.php');
        require_once ('../dao/MinicursosDAO.php');
        require_once ('../BancoDeDados/database.php');
        $db = new Database();
        $dao = new MinicursosDAO($db);
        $id = $_POST['codMinicurso'];
        $nome = $_POST['nome'];
        $ministrante = $_POST['ministrante'];
        $vagas = soNumero($_POST['vagas']);
        $informacoes = $_POST['informacoes'];
        $Minicursos = new Minicursos();
        $Minicursos->setId($id);
        $Minicursos->setNome($nome);
        $Minicursos->setMinistrante($ministrante);
        $Minicursos->setVagas($vagas);
        $Minicursos->setInformacoes($informacoes);
        $dao->update($Minicursos);
    }

    function deleteMinicurso() {
        require_once ('../model/Minicursos.php');
        require_once ('../dao/MinicursosDAO.php');
        require_once ('../BancoDeDados/database.php');
        $db = new Database();
        $dao = new MinicursosDAO($db);
        $id = $_POST['codMinicurso'];
        $Minicursos = new Minicursos();
        $Minicursos->setId($id);
        $dao->delete($Minicursos);
    }

?>
