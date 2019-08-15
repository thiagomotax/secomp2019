<?php
    
    session_start();
    
    if (isset($_SESSION['user_id'])) {

        require_once("../dao/LoginDAO.php");
        require_once("../dao/UsuariosDAO.php");
        require_once("../dao/MinistrantesDAO.php");

        $UsuariosDAO = new UsuariosDAO();
        $stmtUsuarios = $UsuariosDAO->runQuery("SELECT * FROM usuarios WHERE codUsuario = ".$_SESSION['user_id']."");
        $stmtUsuarios->execute();
        $RowUsuarios = $stmtUsuarios->fetch(PDO::FETCH_ASSOC);

        if($RowUsuarios['nivelUsuario'] != 0){

            header('Location: viewPainel.php');
            
        }else{

            $encoding = 'UTF-8';
            date_default_timezone_set("America/Sao_Paulo");

            require('../assets/fpdf/fpdf.php');
            require_once("../dao/RelatoriosDAO.php");
            $RelatoriosDAO = new RelatoriosDAO();

            $RelatoriosDAO = new RelatoriosDAO();
            $stmtMinicurso = $RelatoriosDAO->runQuery("SELECT * FROM minicursos  WHERE codMinicurso = '".$_POST['minicursoRD']."'");
            $stmtMinicurso->execute();
            $RowMinicurso = $stmtMinicurso->fetch(PDO::FETCH_ASSOC);

            $stmtInscritos = $RelatoriosDAO->runQuery("SELECT * FROM inscricoes INNER JOIN usuarios ON usuarios.codUsuario = inscricoes.codUsuario WHERE codMinicurso = '".$_POST['minicursoRD']."' ORDER BY nomeUsuario ASC");
            $stmtInscritos->execute();
            $count = $stmtInscritos->rowCount();

            function mask($val, $mask) {

                $maskared = '';
                $k = 0;
                 
                for($i = 0; $i<=strlen($mask)-1; $i++) {
                    if($mask[$i] == '#') {
                        if(isset($val[$k])) {
                            $maskared .= $val[$k++];
                        }
                     }else {
                        if(isset($mask[$i])) {
                            $maskared .= $mask[$i];
                        }
                     }
                }
                
                return $maskared;
                
            }

            class PDF extends FPDF{

                function AutoPrint($dialog = false){
                    $param = ($dialog ? 'true' : 'false');
                    $script = "print($param);";
                    $this->IncludeJS($script);
                }

                function AutoPrintToPrinter($server, $printer, $dialog = false){
                    $script = "var pp = getPrintParams();";
                    if($dialog){
                        $script .= "pp.interactive = pp.constants.interactionLevel.full;";
                    }else{
                        $script .= "pp.interactive = pp.constants.interactionLevel.automatic;";
                    }
                    $script .= "pp.printerName = '\\\\\\\\".$server."\\\\".$printer."';";
                    $script .= "print(pp);";
                    $this->IncludeJS($script);
                }

                function Header()   {

                    $RelatoriosDAO = new RelatoriosDAO();
                    $stmtMinicurso = $RelatoriosDAO->runQuery("SELECT * FROM minicursos  WHERE codMinicurso = '".$_POST['minicursoRD']."'");
                    $stmtMinicurso->execute();
                    $RowMinicurso = $stmtMinicurso->fetch(PDO::FETCH_ASSOC);

                    $this->SetTitle(utf8_decode("Relatório de inscritos - ".$RowMinicurso['nomeMinicurso']));
                    $this->SetSubject(utf8_decode("Relatório de inscritos - ".$RowMinicurso['nomeMinicurso']));
                    $this->SetTextColor(0, 0, 0);

                    $this->SetFont("Times","", 8);
                    $this->SetXY(52, 22);
                    $this->SetFont('Times', "B", 14);
                    $texto = utf8_decode("RELAÇÃO DE INSCRITOS");
                    $this->MultiCell(80, 5, $texto, 0, 'R');

                    // Nome minicurso
                    $this->SetFont("Times","", 8);
                    $this->SetXY(20, 42);
                    $this->SetFont('Times', "B", 14);
                    $texto = utf8_decode($RowMinicurso['nomeMinicurso']);
                    $this->MultiCell(170, 7, $texto, 0, 'C');

                    $this->Image('../assets/images/logo-horizontal.png' , 10 ,8, 50, 30);
                    $this->Image('../assets/images/IF-09.png' , 140 ,8, 62, 35);
                }

                function Footer()  {
                    $this->SetFont("Times","BI", 8);
                    $this->setXY("10","284");
                    $texto = "PAG. ";
                    $this->MultiCell(190, 5, utf8_decode($texto).$this->PageNo()."", 0, 'C');
                }

            }

            $pdf = new PDF();
            $pdf->AddPage();


            while ($RowInscritos = $stmtInscritos->fetch(PDO::FETCH_ASSOC)) {
                
                $pdf->Ln(10);
                $pdf->SetX((20));
                $pdf->SetTextColor(0, 0, 0);
                $pdf->SetFont('Times', "", 10);
                $nomeInscrito = (((strlen($RowInscritos['nomeUsuario']) < 50)) ? mb_convert_case(strtoupper($RowInscritos['nomeUsuario']), MB_CASE_UPPER, $encoding) : substr_replace(mb_convert_case(strtoupper($RowInscritos['nomeUsuario']), MB_CASE_UPPER, $encoding), '', 50));
                
                $pdf->Cell(25, 8, utf8_decode(mask($RowInscritos['cpfUsuario'],'###.###.###-##')), false, 0, "C", 0);
                $pdf->SetFont('Times', "", 9);
                $pdf->Cell(85, 8, utf8_decode($nomeInscrito), false, 0, "L", 0);
                $pdf->SetFont('Times', "", 10);
                $pdf->Cell(70, 8, utf8_decode($RowInscritos['emailUsuario']), false, 0, "L", 0);

            }

            $pdf->Ln(10);
            $pdf->SetX(20);
            $pdf->SetFont('Times', "B", 11);
            $pdf->Cell(165, 8, utf8_decode("Total de inscritos: ".$count), 0, 0, "L");

            $pdf->Output(utf8_decode("Relatório de inscritos - ".$RowMinicurso['nomeMinicurso'].".pdf"),"I");

        }

    }else {
      header('Location: viewLogin.php');
    }
?>