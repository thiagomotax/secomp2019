<?php 

    class Extras {

        private $id;
        private $nome;
        private $informacoes;
        
        public function getId() {
            return $this->id;
        }

        public function setId($id) {
            $this->id = $id;
        }

        public function getNome() {
            return $this->nome;
        }

         public function setNome($nome) {
            $this->nome = $nome;
        }


        public function setInformacoes($informacoes) {
            $this->informacoes = $informacoes;
        }

        public function getInformacoes() {
            return $this->informacoes;
        }

    }
