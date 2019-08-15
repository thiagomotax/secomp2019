<?php

    require_once('../BancoDeDados/database.php');
    
    class ConfiguracoesDAO {

        private $conn;

        public function __construct() {
            $database = new Database();
            $db = $database->dbConnection();
            $this->conn = $db;
        }

        public function runQuery($sql) {
            $stmt = $this->conn->prepare($sql);
            return $stmt;
        }

        public function update(Configuracoes $Configuracoes) {
            try {

                $id = $Configuracoes->getId();
                $dataInicio = $Configuracoes->getDataInicio();
                $horaInicio = $Configuracoes->getHoraInicio();
                $dataFinal = $Configuracoes->getDataFinal();
                $horaFinal = $Configuracoes->getHoraFinal();
                
                $stmt = $this->conn->prepare("UPDATE  configuracoes SET dataInicioInscricao = ?, horaInicioInscricao = ?, dataFinalInscricao = ?, horaFinalInscricao = ? WHERE codConfiguracao = ?");

                $stmt->bindparam(1, $dataInicio);
                $stmt->bindparam(2, $horaInicio);
                $stmt->bindparam(3, $dataFinal);
                $stmt->bindparam(4, $horaFinal);
                $stmt->bindparam(5, $id);

                $stmt->execute();

                if ($stmt->rowCount() > 0) {
                    echo 1;
                } else {
                    echo 2;
                }

            } catch (PDOException $e) {
                echo $e->getMessage();
            }
        }

    }

?>