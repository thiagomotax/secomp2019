<?php

    require_once('../BancoDeDados/database.php');
    
    class JogosDAO {

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

        public function addInscricaoJogos(Jogos $Jogos) {
            try {

                $vagasRestantes = 0;    
                $id = $Jogos->getId();
                $usuario = $Jogos->getUsuario();

                $stmt = $this->conn->prepare("INSERT INTO  inscricoesjogos(codJogo, codUsuario) VALUES(:codJogo, :codUsuario)");

                $stmt->bindparam(":codJogo", $id);
                $stmt->bindparam(":codUsuario", $usuario);
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

        public function cancelarInscricaoJogos(Jogos $Jogos) {
            try {

                $usuario = $Jogos->getUsuario();
                $id = $Jogos->getId();
                
                $stmt = $this->conn->prepare("DELETE FROM inscricoesjogos WHERE codUsuario = ? AND codJogo = ?");

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