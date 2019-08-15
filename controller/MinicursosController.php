<?php
    
    $acao = $_POST["acao"];

    switch ($acao) {
        case 'adicionar':
            addMinicurso();
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

    function addMinicurso() {
        require_once ('../model/Minicursos.php');
        require_once ('../dao/MinicursosDAO.php');
        require_once ('../BancoDeDados/database.php');
        $db = new Database();
        $dao = new MinicursosDAO($db);
        $nome = $_POST['nome'];
        $ministrante = $_POST['ministrante'];
        $vagas = soNumero($_POST['vagas']);
        $informacoes = $_POST['informacoes'];
        $Minicursos = new Minicursos();
        $Minicursos->setNome($nome);
        $Minicursos->setMinistrante($ministrante);
        $Minicursos->setVagas($vagas);
        $Minicursos->setInformacoes($informacoes);
        $dao->add($Minicursos);
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
