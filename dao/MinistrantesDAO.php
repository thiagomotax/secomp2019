<?php

    require_once('../BancoDeDados/database.php');

    class MinistrantesDAO {

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

        public function add(Ministrantes $Ministrantes) {
            try {
                
                $codMinicurso = $Ministrantes->getCodMinicurso();
                $codUsuario = $Ministrantes->getCodUsuario();
                
                $stmt = $this->conn->prepare("INSERT INTO ministrantes(codUsuario, codMinicurso) VALUES(:codUsuario, :codMinicurso)");
                $stmt->bindparam(":codUsuario", $codUsuario);
                $stmt->bindparam(":codMinicurso", $codMinicurso);
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


        public function delete(Ministrantes $Ministrantes) {
            try {
                
                $codMinicurso = $Ministrantes->getCodMinicurso();
                $codUsuario = $Ministrantes->getCodUsuario();
                
                $stmt = $this->conn->prepare("DELETE FROM  ministrantes WHERE codUsuario = ? AND codMinicurso = ?");
                $stmt->bindparam(1, $codUsuario);
                $stmt->bindparam(2, $codMinicurso);
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