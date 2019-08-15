<?php

	function validaCPF($cpf = null) {
		// Verifica se um número foi informado
		if(empty($cpf)) {
			return false;
		}
		// return preg_replace("/[^0-9]/", "", $str);
		// Elimina possivel mascara
		$cpf = preg_replace('/[^0-9]/', '', $cpf);
		$cpf = str_pad($cpf, 11, '0', STR_PAD_LEFT);
		// Verifica se o numero de digitos informados é igual a 11 
		if (strlen($cpf) != 11) {
			return false;
		}
		// Verifica se nenhuma das sequências invalidas abaixo 
		// foi digitada. Caso afirmativo, retorna falso
		else if ($cpf == '00000000000' || 
			$cpf == '11111111111' || 
			$cpf == '22222222222' || 
			$cpf == '33333333333' || 
			$cpf == '44444444444' || 
			$cpf == '55555555555' || 
			$cpf == '66666666666' || 
			$cpf == '77777777777' || 
			$cpf == '88888888888' || 
			$cpf == '99999999999') {
			return false;
		 // Calcula os digitos verificadores para verificar se o
		 // CPF é válido
		 } else {   
			for ($t = 9; $t < 11; $t++) {
				for ($d = 0, $c = 0; $c < $t; $c++) {
					$d += $cpf{$c} * (($t + 1) - $c);
				}
				$d = ((10 * $d) % 11) % 10;
				if ($cpf{$c} != $d) {
					return false;
				}
			}
			return true;
		}
	}

	function soNumero($str) {
        return preg_replace("/[^0-9]/", "", $str);
    }

    function lengthPassword($senha = null){
    	$count = strlen($senha);
    	if($count >= 8){
    		return true;
    	}else{
    		return false;
    	}
    }

	function geraSenha($tamanho = 8, $maiusculas = true, $numeros = true, $simbolos = false){
		$lmin = 'abcdefghjkmnpqrstuvwxyz';
		$lmai = 'ABCDEFGHJKMNPQRSTUVWXYZ';
		$num = '23456789';
		$simb = '!@#$%*';
		$retorno = '';
		$caracteres = '';
		$caracteres .= $lmin;
		if ($maiusculas){
			$caracteres .= $lmai;
		}
		if ($numeros){
			$caracteres .= $num;
		}
		if ($simbolos){
			$caracteres .= $simb;
		}
		$len = strlen($caracteres);
		for ($n = 1; $n <= $tamanho; $n++) {
			$rand = mt_rand(1, $len);
			$retorno .= $caracteres[$rand-1];
		}
		return $retorno;
	}

	function isMail($email){

		$conta = '/^[a-zA-Z0-9\._-]+?@';
		$domino = '[a-zA-Z0-9_-]+?\.';	
		$gTLD = '[a-zA-Z]{2,6}'; //.com; .coop; .gov; .museum; etc.	
		$ccTLD = '((\.[a-zA-Z]{2,4}){0,1})$/'; //.br; .us; .scot; etc.
		$pattern = $conta.$domino.$gTLD.$ccTLD;
		if (preg_match($pattern, $email)){
			return true;
		}else{
			return false;
		}
		 //    $er = "/^(([0-9a-zA-Z]+[-._+&])*[0-9a-zA-Z]+@([-0-9a-zA-Z]+[.])+[a-zA-Z]{2,6}){0,1}$/";
		 //    if (preg_match($er, $email)){
			// 	return true;
		 //    }else{
			// 	return false;
			// }
    }

?>
