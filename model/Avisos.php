<?php 

    class Avisos {

        private $id;
        private $conteudo;
        
        public function getId() {
            return $this->id;
        }

        public function setId($id) {
            $this->id = $id;
        }

        public function getConteudo() {
            return $this->conteudo;
        }

        public function setConteudo($conteudo) {
            $this->conteudo = $conteudo;
        }

    }
