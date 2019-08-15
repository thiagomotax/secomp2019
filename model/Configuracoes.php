<?php 

    class Configuracoes {

        private $id;
        private $dataInicio;
        private $horaInicio;
        private $dataFinal;
        private $horaFinal;
        
        public function getId() {
            return $this->id;
        }

        public function setId($id) {
            $this->id = $id;
        }

        public function getDataInicio() {
            return $this->dataInicio;
        }

        public function setDataInicio($dataInicio) {
            $this->dataInicio = $dataInicio;
        }

        public function setHoraInicio($horaInicio) {
            $this->horaInicio = $horaInicio;
        }

        public function getHoraInicio() {
            return $this->horaInicio;
        }

        public function getDataFinal() {
            return $this->dataFinal;
        }

        public function setDataFinal($dataFinal) {
            $this->dataFinal = $dataFinal;
        }

        public function setHoraFinal($horaFinal) {
            $this->horaFinal = $horaFinal;
        }

        public function getHoraFinal() {
            return $this->horaFinal;
        }

    }
