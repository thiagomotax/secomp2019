<?php

    require_once('../BancoDeDados/database.php');
    
    class InscricoesExtraDAO {

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

        public function addInscricaoExtra(InscricoesExtra $InscricoesExtra) {
            try {

                    $id = $InscricoesExtra->getId();
                    $usuario = $InscricoesExtra->getUsuario();
                    $data = $InscricoesExtra->getData();

                    $stmt = $this->conn->prepare("INSERT INTO  inscricoesextras(codUsuario, codExtra, dataInscricao) VALUES(:codUsuario, :codExtra, :dataInscricao)");

                    $stmt->bindparam(":codExtra", $id);
                    $stmt->bindparam(":codUsuario", $usuario);
                    $stmt->bindparam(":dataInscricao", $data);
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

        public function calcelarInscricaoExtra(InscricoesExtra $InscricoesExtra) {
            try {

                $usuario = $InscricoesExtra->getUsuario();
                $id = $InscricoesExtra->getId();
                
                $stmt = $this->conn->prepare("DELETE FROM inscricoesextras WHERE codUsuario = ? AND codExtra = ?");

                $stmt->bindparam(1, $usuario);
                $stmt->bindparam(2, $id);

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