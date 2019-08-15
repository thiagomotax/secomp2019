<?php 

    class Login {

        private $cpf;
        private $senha;
   
        /**
         * @return mixed
         */
        public function getCpf()
        {
            return $this->cpf;
        }

        /**
         * @param mixed $cpf
         *
         * @return self
         */
        public function setCpf($cpf)
        {
            $this->cpf = $cpf;

            return $this;
        }

        /**
         * @return mixed
         */
        public function getSenha()
        {
            return $this->senha;
        }

        /**
         * @param mixed $senha
         *
         * @return self
         */
        public function setSenha($senha)
        {
            $this->senha = $senha;

            return $this;
        }

    }
