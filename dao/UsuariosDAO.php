<?php

    require_once('../BancoDeDados/database.php');
    
    class UsuariosDAO {

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

        public function add(Usuarios $Usuarios) {
            try {

                $nome = $Usuarios->getNome();
                $cpf = $Usuarios->getCpf();
                $email =$Usuarios->getEmail();
                $senha = $Usuarios->getSenha();
                $nivel = $Usuarios->getNivel();

                // if(($nome == "") || ($cpf == "") || ($email == "") || ($senha == "")){
                //     echo 3;
                // }

                $stmtIsCPF = $this->conn->prepare("SELECT * FROM usuarios WHERE cpfUsuario = '".$cpf."'");
                $stmtIsCPF->execute();

                if($stmtIsCPF->rowCount() > 0){
                    echo 6;
                }else{

                    $senhaCriptografada = hash('sha512', md5($senha));

                    $stmt = $this->conn->prepare("INSERT INTO  usuarios(nomeUsuario, cpfUsuario, emailUsuario, senhaUsuario, nivelUsuario) VALUES(:nomeUsuario, :cpfUsuario, :emailUsuario, :senhaUsuario, :nivelUsuario)");

                    $stmt->bindparam(":nomeUsuario", $nome);
                    $stmt->bindparam(":cpfUsuario", $cpf);
                    $stmt->bindparam(":emailUsuario", $email);
                    $stmt->bindparam(":senhaUsuario", $senhaCriptografada);
                    $stmt->bindparam(":nivelUsuario", $nivel);
                    $stmt->execute();

                    if ($stmt->rowCount() > 0) {
                        echo 1;
                    } else {
                        echo 2;
                    }

                }

            } catch (PDOException $e) {
                echo $e->getMessage();
            }
        }

        public function update(Usuarios $Usuarios) {
            try {

                $id = $Usuarios->getId();
                $nome = $Usuarios->getNome();
                $cpf = $Usuarios->getCpf();
                $email =$Usuarios->getEmail();
                $nivel = $Usuarios->getNivel();
                $stmt = $this->conn->prepare("UPDATE  usuarios SET nomeUsuario = ?, cpfUsuario = ?, emailUsuario = ?, nivelUsuario = ? WHERE codUsuario = ?");

                $stmt->bindparam(1, $nome);
                $stmt->bindparam(2, $cpf);
                $stmt->bindparam(3, $email);
                $stmt->bindparam(4, $nivel);
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

        public function delete(Usuarios $Usuarios) {
            try {

                $id = $Usuarios->getId();
                
                $stmt = $this->conn->prepare("DELETE FROM usuarios WHERE codUsuario = ?");

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

        public function updateSenha(Usuarios $Usuarios) {
            try {

                $id = $Usuarios->getId();
                $senha = $Usuarios->getSenha();

                $senhaCriptografada = hash('sha512', md5($senha));

                $stmt = $this->conn->prepare("UPDATE  usuarios SET senhaUsuario = ? WHERE codUsuario = ?");

                $stmt->bindparam(1, $senhaCriptografada);
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

        public function updateSenhaUsuario(Usuarios $Usuarios) {
            try {

                $id = $Usuarios->getId();
                $senha = $Usuarios->getSenha();
                $novaSenha = $Usuarios->getNovaSenha();

                $senhaAtualCriptografada = hash('sha512', md5($senha));

                $stmtSenha = $this->conn->prepare("SELECT * FROM usuarios WHERE codUsuario = '".$id."' AND senhaUsuario = '".$senhaAtualCriptografada."'");
                $stmtSenha->execute();
                $stmtSenha->rowCount();
                if ($stmtSenha->rowCount() <= 0) {
                    echo 3;
                }else{
                    $senhaCriptografada = hash('sha512', md5($novaSenha));
                    $stmt = $this->conn->prepare("UPDATE  usuarios SET senhaUsuario = ? WHERE codUsuario = ?");
                    $stmt->bindparam(1, $senhaCriptografada);
                    $stmt->bindparam(2, $id);
                    $stmt->execute();
                    if ($stmt->rowCount() > 0) {
                        echo 1;
                    } else {
                        echo 2;
                    }
                }

            } catch (PDOException $e) {
                echo $e->getMessage();
            }
        }

        public function updatePerfil(Usuarios $Usuarios) {
            try {

                $id = $Usuarios->getId();
                $nome = $Usuarios->getNome();
                $email =$Usuarios->getEmail();
                $stmt = $this->conn->prepare("UPDATE  usuarios SET nomeUsuario = ?, emailUsuario = ? WHERE codUsuario = ?");

                $stmt->bindparam(1, $nome);
                $stmt->bindparam(2, $email);
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
        public function resetSenha(Usuarios $Usuarios) {
            try {

                $cpf = $Usuarios->getCpf();
                $email =$Usuarios->getEmail();

                $stmtIsCPFEMail = $this->conn->prepare("SELECT * FROM usuarios WHERE cpfUsuario = '".$cpf."' AND emailUsuario = '".$email."'");
                $stmtIsCPFEMail->execute();

                if($stmtIsCPFEMail->rowCount() <= 0){
                    echo 3;
                }else{

                    $RowIsCPFEmail = $stmtIsCPFEMail->fetch(PDO::FETCH_ASSOC);
                    $novaSenha = geraSenha(8, true, true, true);

                    require '../assets/PHPMailer/PHPMailerAutoload.php';

                    $mail = new PHPMailer;
                    // //Tell PHPMailer to use SMTP
                    // $mail->isSMTP();
                    // $mail->SMTPDebug = 2;
                    // $mail->Host = 'smtp.gmail.com';
                    // $mail->Port = 465;
                    // $mail->SMTPSecure = 'ssl';
                    // $mail->SMTPAuth = true;
                    // $mail->Charset = 'UTF-8';   // Autenticação ativada
                    // $mail->IsHTML(true);
                    // $mail->Username = "secompifrp@gmail.com";
                    // $mail->Password = "secomp2018";
                    // $mail->setFrom('secompifrp@gmail.com', 'Sistema de Inscrições SECOMP 2018 - Campus Rio Pomba');
                    // $mail->addAddress('jhonatanifet2011@gmail.com');
                    // //Set the subject line
                    // $mail->Subject = utf8_decode(("Recuperação de senha de acesso ao sistema"));
                    // //Read an HTML message body from an external file, convert referenced images to embedded,
                    // //convert HTML into a basic plain-text alternative body
                    // $mail->msgHTML("Olá teste você solicitou uma nova senha para acesso ao Sistema de Inscrições SECOMP 2018 - Campus Rio Pomba.</br> Sua nova senha de acesso é: <b> teste </b>");

                    $assunto = '=?UTF-8?B?'.base64_encode("Sistema de Inscrições SECOMP 2018 - Campus Rio Pomba").'?=';
                    $mail= new PHPMailer;
                    $mail->IsSMTP();        // Ativar SMTP
                    $mail->SMTPDebug = false;       // Debugar: 1 = erros e mensagens, 2 = mensagens apenas
                    $mail->SMTPAuth = true;
                    $mail->Charset = 'UTF-8';   // Autenticação ativada
                    $mail->SMTPSecure = 'ssl';  // SSL REQUERIDO pelo GMail
                    $mail->Host = 'mail.emcomp.net.br'; // SMTP utilizado
                    $mail->Port = 465; 
                    $mail->Username = 'secomp@emcomp.net.br';
                    $mail->Password = 's3c0mp';
                    $mail->IsHTML(true);
                    $mail->SetFrom('secomp@emcomp.net.br', $assunto);
                    $mail->addAddress($RowIsCPFEmail['emailUsuario']);
                    $mail->Subject = utf8_decode(("Recuperação de senha de acesso ao sistema"));
                    $mail->msgHTML("Olá ".$RowIsCPFEmail['nomeUsuario']." você solicitou uma nova senha para acesso ao Sistema de Inscrições SECOMP 2018 - Campus Rio Pomba.</br></br>

                        Sua nova senha de acesso é: <b>".$novaSenha."</b>");

                    if ($mail->Send()){
                        $senhaAtualCriptografada = hash('sha512', md5($novaSenha));
                        $stmt = $this->conn->prepare("UPDATE  usuarios SET senhaUsuario = ? WHERE codUsuario = ?");
                        $stmt->bindparam(1, $senhaAtualCriptografada);
                        $stmt->bindparam(2, $RowIsCPFEmail['codUsuario']);
                        $stmt->execute();
                        if ($stmt->rowCount() > 0) {
                            echo 1;
                        } else {
                            echo 2;
                        }
                    }else{
                        echo 4;
                    }

                }

            } catch (PDOException $e) {
                echo $e->getMessage();
            }
        }
    }

?>