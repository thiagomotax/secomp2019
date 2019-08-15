<?php 

    class Usuarios {

        private $id;
        private $nome;
        private $cpf;
        private $email;
        private $senha;
        private $novaSenha;
        private $nivel;
        
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

        public function getCpf() {
            return $this->cpf;
        }

         public function setCpf($cpf) {
            $this->cpf = $cpf;
        }

        public function getEmail() {
            return $this->email;
        }

         public function setEmail($email) {
            $this->email = $email;
        }

        public function getSenha() {
            return $this->senha;
        }

         public function setSenha($senha) {
            $this->senha = $senha;
        }

         public function getNovaSenha() {
            return $this->novaSenha;
        }

         public function setNovaSenha($novaSenha) {
            $this->novaSenha = $novaSenha;
        }

        public function getNivel() {
            return $this->nivel;
        }

         public function setNivel($nivel) {
            $this->nivel = $nivel;
        }

    }
