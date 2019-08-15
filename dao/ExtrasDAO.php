<?php

    require_once('../BancoDeDados/database.php');
    
    class ExtrasDAO {

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

        public function add(Extras $Extras) {
            try {

                $nome = $Extras->getNome();
                $informacoes = $Extras->getInformacoes();

                $stmt = $this->conn->prepare("INSERT INTO extras(nomeExtra, infoExtra) VALUES(:nomeExtra, :infoExtra)");
                $stmt->bindparam(":nomeExtra", $nome);
                $stmt->bindparam(":infoExtra", $informacoes);
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

        public function update(Extras $Extras) {
            try {

                $id = $Extras->getId();
                $nome = $Extras->getNome();
                $informacoes = $Extras->getInformacoes();
                
                $stmt = $this->conn->prepare("UPDATE extras SET nomeExtra = ?, infoExtra = ? WHERE codExtra = ?");

                $stmt->bindparam(1, $nome);
                $stmt->bindparam(2, $informacoes);
                $stmt->bindparam(3, $id);

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

        public function delete(Extras $Extras) {
            try {

                $id = $Extras->getId();
                
                $stmt = $this->conn->prepare("DELETE FROM extras WHERE codExtra = ?");

                $stmt->bindparam(1, $id);

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