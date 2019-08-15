<?php
	/*
		Desenvolvido por Marco Antoni <marquinho9.10@gmail.com>
	*/

	class Upload{
		private $arquivo;
		private $pasta;

		function __construct($arquivo, $pasta){
			$this->arquivo = $arquivo;
			$this->pasta   = $pasta;
		}
		
		private function getExtensao(){
			//retorna a extensao da imagem	
			$tmp = explode('.', $this->arquivo['name']);
			$file_extension = end($tmp);
			return $extensao = $file_extension;
			/*echo $extensao;*/
			/*return $extensao = strtolower(end(explode('.', $this->arquivo['name'])));*/
		}
		
		private function extFile($extensao){
			$extensoes = array('gif', 'jpeg', 'jpg', 'png', 'pdf', 'zip', 'docx', 'txt', 'pptx', 'opt', 'csv');	 // extensoes permitidas
			if (in_array($extensao, $extensoes))
				return true;	
		}
		
		public function salvar(){									
			$extensao = $this->getExtensao();

			if(!($this->extFile($extensao))){

				return false;

			}else{
			
				//gera um nome unico para a imagem em funcao do tempo
				$novo_nome = md5(time()) . '.' . $extensao;
				//localizacao do arquivo 
				$destino = $this->pasta . $novo_nome;
				
				//move o arquivo
				if (! move_uploaded_file($this->arquivo['tmp_name'], $destino)){
					if ($this->arquivo['error'] == 1)
						return "Tamanho excede o permitido";
					else
						return "Erro " . $this->arquivo['error'];
				}
				
				return $novo_nome;

			}

		}						
	}
?>