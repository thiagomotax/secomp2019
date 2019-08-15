<?php

    require_once('../BancoDeDados/database.php');
    
    class AvisosDAO {

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

        public function update(Avisos $Avisos) {
            try {

                $id = $Avisos->getId();
                $conteudo = $Avisos->getConteudo();
                
                $stmt = $this->conn->prepare("UPDATE avisos SET conteudoAviso = ? WHERE codAviso = ?");

                $stmt->bindparam(1, $conteudo);
                $stmt->bindparam(2, $id);

                $stmt->execute();

                if ($stmt->rowCount() > 0) {
                    // header("Refresh:3; url=../view/viewFormLogin.php");
                    header("Location: ../../view/viewPainel.php");
                } else {
                    header("Location: ../../view/viewPainel.php");
                }

            } catch (PDOException $e) {
                echo $e->getMessage();
            }
        }

    }

?>