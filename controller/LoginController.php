<?php  

//INCLUSÃO DOS ARQUIVOS MODELO, DAO E BANCO DE DADOS. 
require_once ('../model/Login.php');
require_once ('../dao/LoginDAO.php');
require_once ('../BancoDeDados/database.php');

function soNumero($str) {
	return preg_replace("/[^0-9]/", "", $str);
}

//INSTANCIANDO OBJETO $db DO BANCO DE DADOS (CLASSE DATABASE).
$db      = new Database();
$dao     = new LoginDAO($db);
//INSTANCIANDO OBJETO $dao DA CLASSE LoginDAO.

//VARIÁVEIS PARA RECEBER OS DADOS DO FORMULÁRIO DE LOGIN.
$usuario = soNumero($_POST['login']);
$senha = $_POST['senha'];

//INSTANCIANDO OBJETO DA CLASSE LOGIN (MODEL).
$login = new Login();

//SETANDO OS ATRIBUTOS NO OBJETO LOGIN (MODEL).
$login->setCpf($usuario);
$login->setSenha($senha);

//OBJETO DA CLASSE LoginDAO CHAMANDO O MÉTODO LOGAR (CLASSE LoginDAO) PARA EFETUAR O LOGIN.
$dao->Logar($login); // aqui grava o resultado enviado do form