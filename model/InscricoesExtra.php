<?php 

    class InscricoesExtra {

        private $id;
        private $usuario;
        private $data;

        
        public function getId() {
            return $this->id;
        }

        public function setId($id) {
            $this->id = $id;
        }

        public function getUsuario() {
            return $this->usuario;
        }

         public function setUsuario($usuario) {
            $this->usuario = $usuario;
        }

        public function getData() {
            return $this->data;
        }

         public function setData($data) {
            $this->data = $data;
        }

    }
