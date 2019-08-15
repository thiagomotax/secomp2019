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

        require('../assets/fpdf/fpdf.php');
        require_once("../dao/RelatoriosDAO.php");
        $RelatoriosDAO = new RelatoriosDAO();

        $stmtInscritos = $RelatoriosDAO->runQuery("SELECT * FROM minicursos INNER JOIN inscricoes ON inscricoes.codMinicurso = minicursos.codMinicurso WHERE inscricoes.codUsuario = ".$_SESSION['user_id']."");
        $stmtInscritos->execute();
        $count = $stmtInscritos->rowCount();

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

                $this->SetTitle(utf8_decode("Confirmação de Matrícula"));
                $this->SetSubject(utf8_decode("Confirmação de Matrícula"));
                $this->SetTextColor(0, 0, 0);

                $this->SetFont("Times","", 8);
                $this->SetXY(70, 30);
                $this->SetFont('Times', "B", 14);
                $texto = utf8_decode("CONFIRMAÇÃO DE INSCRIÇÃO");
                $this->MultiCell(50, 5, $texto, 0, 'C');

                $this->Image('../assets/images/logo-horizontal.png' , 10 ,8, 50, 30);
                $this->Image('../assets/images/IF-09.png' , 140 ,8, 62, 35);

                $this->Ln(5);

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
        $pdf->Cell(170, 7, utf8_decode("Código da inscrição: ".str_pad($RowUsuarios['codUsuario'], 5, '0', STR_PAD_LEFT)), false, 0, "L", 0);
        
        if($count > 0){

            $pdf->Ln(8);
            $pdf->SetX((20));
            $pdf->SetTextColor(0, 0, 0);
            $pdf->SetFont('Times', "B", 12);
            $pdf->Cell(170, 7, utf8_decode("Minicursos inscritos: "), false, 0, "L", 0);
            $i = 0;

            while ($RowInscritos = $stmtInscritos->fetch(PDO::FETCH_ASSOC)) {
                $i++;
                $pdf->Ln(7);
                $pdf->SetX((20));
                $pdf->SetTextColor(0, 0, 0);
                $pdf->SetFont('Times', "", 12);
                $pdf->Cell(170, 7, utf8_decode($i . " - " .$RowInscritos['nomeMinicurso']), false, 0, "L", 0);

                $pdf->Ln(7);
                $pdf->SetX((25));
                $pdf->SetTextColor(0, 0, 0);
                $pdf->SetFont('Times', "", 12);
                $pdf->Cell(170, 7, str_replace(" ? ", " - ", utf8_decode($RowInscritos['informacoesMinicurso'])), false, 0, "L", 0);

            }

        }else{

            $pdf->SetFont("Times","B", 12);
            $pdf->setXY("10","75");
            $texto = "Você não realizou inscrição em nenhum minicurso.";
            $pdf->MultiCell(190, 5, utf8_decode($texto), 0, 'C');

        }


        $pdf->Output(utf8_decode("Confirmação de Matrícula.pdf"),"I");

    }else {
        header('Location: viewLogin.php');
    }

?>