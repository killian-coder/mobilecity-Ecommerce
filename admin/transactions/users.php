<?php
require "fpdf/fpdf.php";
require_once $_SERVER['DOCUMENT_ROOT'].'/mobilecity-Ecommerce/core/init.php';

class  myPDF extends FPDF{
	function header(){
		$this->image('logo2.jpg',10,6);
		$this->SetFont('Arial','B',14);
		$this->Cell(276,5,'Employee Log',0,0,'C');
		$this->Ln(10);
		$this->SetFont('Times','',12);
		$this->Cell(276,10,'Cairo Road Town Center',0,0,'C');
        $this->Ln(6);
		$this->Cell(276,10,' P.O.Box 31009',0,0,'C');
		$this->Ln(6);
		$this->Cell(276,10,'Lusaka, Zambia',0,0,'C');
		$this->Ln(20);
	}
	function footer(){
		$this->SetY(-15);
		$this->SetFont('Arial','',8);
		$this->Cell(0,10,'page '.$this->PageNo().'/{nb}',0,0,'C');

	}
	function headerTable(){
		$this->SetFont('Times','B',12);
		$this->Cell(20,10,'Customer Id',0,0,'C');
		$this->Cell(45,10,'Full name',0,0,'C');
		$this->Cell(40,10,'Email',0,0,'C');
		$this->Cell(60,10,'join date',0,0,'C');
		$this->Cell(36,10,'Last Login',0,0,'C');
		$this->Cell(30,10,'permission',0,0,'C');
		//$this->Cell(50,10,'gender',0,0,'C');
		$this->Ln();

	}

	function viewTable($db){
		
		
		$userQuery = $db->query("SELECT * FROM users ORDER BY full_name ");
		while($user = mysqli_fetch_assoc($userQuery)){
			$this->SetFont("Arial","","12");
            $this->Cell(20,5,$user['id'],0,0,'C');
           	$this->Cell(40,10,$user['full_name'],0,0,'C');
            $this->Cell(40,10,$user['email'],0,0,'C');
            $this->Cell(60,10, $user['join_date'],0,0,'C');
            $this->Cell(36,10,$user['last_login'],0,0,'C');
            $this->Cell(36,10,$user['permission'],0,0,'C');
           
 
            $this->Ln(20);
            }
         }

	  }

$pdf = new myPDF();
$pdf-> AliasNbPages();
$pdf->AddPage('L','A4',0);
$pdf->headerTable();
$pdf->viewTable($db);
$pdf->Output(); 

?>