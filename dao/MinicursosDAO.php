<?php

    require_once('../BancoDeDados/database.php');
    
    class MinicursosDAO {

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

        public function add(Minicursos $Minicursos) {
            try {

                $nome = $Minicursos->getNome();
                $ministrante = $Minicursos->getMinistrante();
                $vagas =$Minicursos->getVagas();
                $informacoes = $Minicursos->getInformacoes();

                $stmt = $this->conn->prepare("INSERT INTO  minicursos(nomeMinicurso, ministranteMinicurso, vagasMinicurso, informacoesMinicurso) VALUES(:nomeMinicurso, :ministranteMinicurso, :vagasMinicurso, :informacoesMinicurso)");

                $stmt->bindparam(":nomeMinicurso", $nome);
                $stmt->bindparam(":ministranteMinicurso", $ministrante);
                $stmt->bindparam(":vagasMinicurso", $vagas);
                $stmt->bindparam(":informacoesMinicurso", $informacoes);
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

        public function update(minicursos $Minicursos) {
            try {

                $id = $Minicursos->getId();
                $nome = $Minicursos->getNome();
                $ministrante = $Minicursos->getMinistrante();
                $vagas =$Minicursos->getVagas();
                $informacoes = $Minicursos->getInformacoes();
                
                $stmt = $this->conn->prepare("UPDATE  minicursos SET nomeMinicurso = ?, ministranteMinicurso = ?, vagasMinicurso = ?, informacoesMinicurso = ? WHERE codMinicurso = ?");

                $stmt->bindparam(1, $nome);
                $stmt->bindparam(2, $ministrante);
                $stmt->bindparam(3, $vagas);
                $stmt->bindparam(4, $informacoes);
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

        public function delete(minicursos $Minicursos) {
            try {

                $id = $Minicursos->getId();
                
                $stmt = $this->conn->prepare("DELETE FROM minicursos WHERE codMinicurso = ?");

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