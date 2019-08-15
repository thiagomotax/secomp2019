<?php 

    class Minicursos {

        private $id;
        private $nome;
        private $ministrante;
        private $vagas;
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

        public function setMinistrante($ministrante) {
            $this->ministrante = $ministrante;
        }

        public function getMinistrante() {
            return $this->ministrante;
        }

        public function setVagas($vagas) {
            $this->vagas = $vagas;
        }

        public function getVagas() {
            return $this->vagas;
        }

        public function setInformacoes($informacoes) {
            $this->informacoes = $informacoes;
        }

        public function getInformacoes() {
            return $this->informacoes;
        }

    }
