<?php 

    class Inscricoes {

        private $id;
        private $usuario;
        private $data;
        private $tipo;
        
        public function getId() {
            return $this->id;
        }

        public function setId($id) {
            $this->id = $id;
        }

        public function getUsuario() {
            return $this->usuario;
        }

        public function getTipo(){
            return $this->tipo;
        }

         public function setUsuario($usuario) {
            $this->usuario = $usuario;
        }

        public function setTipo($tipo){
            $this->tipo = $tipo;
        }
        public function getData() {
            return $this->data;
        }

         public function setData($data) {
            $this->data = $data;
        }

    }
