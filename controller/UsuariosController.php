<?php
    
    $acao = $_POST["acao"];

    switch ($acao) {
        case 'adicionar':
            addUsuario();
            break;
        case 'editar':
            updateUsuario();
            break;
        case 'alterarSenha':
            updateSenha();
            break;
        case 'alterarPerfil':
            updatePerfil();
            break;
        case 'alterarSenhaPerfil':
            updateSenhaPerfil();
            break;
        case 'resetarSenha':
            resetSenha();
            break;
        case 'excluir':
            deleteUsuario();
            break;
    }

    function addUsuario() {
        require_once ('../model/Usuarios.php');
        require_once ('../dao/UsuariosDAO.php');
        require_once ('../BancoDeDados/database.php');
        include "Util.php";
        $db = new Database();
        $dao = new UsuariosDAO($db);
        $nome = $_POST['nome'];
        $cpf = soNumero($_POST['cpf']);
        $email = $_POST['email'];
        $senha = $_POST['senha'];
        $nivel = 1;

        if(!validaCPF($cpf)){
            echo 4;
        }else if(!lengthPassword($senha)){
            echo 5;
        }else{
            $Usuarios = new Usuarios();
            $Usuarios->setNome($nome);
            $Usuarios->setCPF($cpf);
            $Usuarios->setEmail($email);
            $Usuarios->setSenha($senha);
            $Usuarios->setNivel($nivel);
            $dao->add($Usuarios);
        }
        
    }

    function updateUsuario() {
        require_once ('../model/Usuarios.php');
        require_once ('../dao/UsuariosDAO.php');
        require_once ('../BancoDeDados/database.php');
        include "Util.php";
        $db = new Database();
        $dao = new UsuariosDAO($db);
        $id = $_POST['codUsuario'];
        $nome = $_POST['nome'];
        $cpf = soNumero($_POST['cpf']);
        $email = $_POST['email'];
        $nivel = $_POST['nivel'];
        $Usuarios = new Usuarios();
        $Usuarios->setId($id);
        $Usuarios->setNome($nome);
        $Usuarios->setCPF($cpf);
        $Usuarios->setEmail($email);
        $Usuarios->setNivel($nivel);
        $dao->update($Usuarios);
    }

    function deleteUsuario() {
        require_once ('../model/Usuarios.php');
        require_once ('../dao/UsuariosDAO.php');
        require_once ('../BancoDeDados/database.php');
        $db = new Database();
        $dao = new UsuariosDAO($db);
        $id = $_POST['codUsuario'];
        $Usuarios = new Usuarios();
        $Usuarios->setId($id);
        $dao->delete($Usuarios);
    }

    function updateSenha() {
        require_once ('../model/Usuarios.php');
        require_once ('../dao/UsuariosDAO.php');
        require_once ('../BancoDeDados/database.php');
        $db = new Database();
        $dao = new UsuariosDAO($db);
        $id = $_POST['codUsuario'];
        $senha = $_POST['senha'];
        $Usuarios = new Usuarios();
        $Usuarios->setId($id);
        $Usuarios->setSenha($senha);
        $dao->updateSenha($Usuarios);
    }

    function updateSenhaPerfil() {
        require_once ('../model/Usuarios.php');
        require_once ('../dao/UsuariosDAO.php');
        require_once ('../BancoDeDados/database.php');
        $db = new Database();
        $dao = new UsuariosDAO($db);
        $id = $_POST['codUsuario'];
        $senha = $_POST['senhaAtual'];
        $novaSenha = $_POST['senha'];
        $Usuarios = new Usuarios();
        $Usuarios->setId($id);
        $Usuarios->setSenha($senha);
        $Usuarios->setNovaSenha($novaSenha);
        $dao->updateSenhaUsuario($Usuarios);
    }

    function resetSenha() {
        require_once ('../model/Usuarios.php');
        require_once ('../dao/UsuariosDAO.php');
        require_once ('../BancoDeDados/database.php');
        include "Util.php";
        $db = new Database();
        $dao = new UsuariosDAO($db);
        $cpf = soNumero($_POST['cpf']);
        $email = $_POST['email'];
        $Usuarios = new Usuarios();
        $Usuarios->setCpf($cpf);
        $Usuarios->setEmail($email);
        $dao->resetSenha($Usuarios);
    }

    function updatePerfil() {
        require_once ('../model/Usuarios.php');
        require_once ('../dao/UsuariosDAO.php');
        require_once ('../BancoDeDados/database.php');
        $db = new Database();
        $dao = new UsuariosDAO($db);
        $id = $_POST['codUsuario'];
        $nome = $_POST['nome'];
        $email = $_POST['email'];
        $Usuarios = new Usuarios();
        $Usuarios->setId($id);
        $Usuarios->setNome($nome);
        $Usuarios->setEmail($email);
        $dao->updatePerfil($Usuarios);
    }

?>
