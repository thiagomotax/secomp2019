<?php
    
    session_start();
    
    if (isset($_SESSION['user_id'])) {

        require_once("../dao/LoginDAO.php");
        require_once("../dao/UsuariosDAO.php");

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

            $stmtExtra = $RelatoriosDAO->runQuery("SELECT * FROM extras  WHERE codExtra = '".$_POST['extraRD']."'");
            $stmtExtra->execute();
            $RowExtra = $stmtExtra->fetch(PDO::FETCH_ASSOC);

            $stmtInscritos = $RelatoriosDAO->runQuery("SELECT * FROM inscricoesextras INNER JOIN usuarios ON usuarios.codUsuario = inscricoesextras.codUsuario WHERE codExtra = '".$_POST['extraRD']."' ORDER BY nomeUsuario ASC");
            $stmtInscritos->execute();

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
                    $stmtExtra = $RelatoriosDAO->runQuery("SELECT * FROM minicursos  WHERE codMinicurso = '".$_POST['extraRD']."'");
                    $stmtExtra->execute();
                    $RowExtra = $stmtExtra->fetch(PDO::FETCH_ASSOC);

                    $this->SetTitle(utf8_decode("Relatório de inscritos - ".$RowExtra['nomeExtra']));
                    $this->SetSubject(utf8_decode("Relatório de inscritos - ".$RowExtra['nomeExtra']));
                    $this->SetTextColor(0, 0, 0);

                    $this->SetFont("Times","", 8);
                    $this->SetXY(70, 22);
                    $this->SetFont('Times', "B", 14);
                    $texto = utf8_decode("LISTA DE PRESENÇA ".$_POST['dataChamada']);
                    $this->MultiCell(60, 5, $texto, 0, 'C');

                    // Nome minicurso
                    $this->SetFont("Times","", 8);
                    $this->SetXY(20, 42);
                    $this->SetFont('Times', "B", 14);
                    $texto = utf8_decode($RowExtra['nomeExtra']);
                    $this->MultiCell(170, 5, $texto, 0, 'C');

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

            $pdf->Ln(5);
            $pdf->SetX((20));
            $pdf->SetTextColor(0, 0, 0);
            $pdf->SetFont('Times', "B", 12);
            $pdf->Cell(100, 8, utf8_decode("Nome"), true, 0, "L", 0);
            $pdf->Cell(70, 8, utf8_decode("Assinatura"), true, 0, "L", 0);

            while ($RowInscritos = $stmtInscritos->fetch(PDO::FETCH_ASSOC)) {
                
                $pdf->Ln(8);
                $pdf->SetX((20));
                $pdf->SetTextColor(0, 0, 0);
                $pdf->SetFont('Times', "", 10);
                $nomeInscrito = (((strlen($RowInscritos['nomeUsuario']) < 50)) ? mb_convert_case(strtoupper($RowInscritos['nomeUsuario']), MB_CASE_UPPER, $encoding) : substr_replace(mb_convert_case(strtoupper($RowInscritos['nomeUsuario']), MB_CASE_UPPER, $encoding), '', 50));
                
                $pdf->Cell(100, 8, utf8_decode($nomeInscrito), true, 0, "L", 0);
                $pdf->Cell(70, 8, utf8_decode(""), true, 0, "L", 0);

            }

            $pdf->Output(utf8_decode("Relatório de inscritos - ".$RowExtra['nomeExtra'].".pdf"),"I");

        }

     }else {
      header('Location: viewLogin.php');
    }

?>