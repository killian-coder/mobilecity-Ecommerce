<?php
require "fpdf/fpdf.php";
require_once $_SERVER['DOCUMENT_ROOT'].'/Project_ecommerce/core/init.php';
class  myPDF extends FPDF{
	function header(){
		$this->image('logo2.jpg',10,6);
		$this->SetFont('Arial','B',14);
		$this->Cell(276,5,'MONTHLY TRANSACTION',0,0,'C');
		$this->Ln();
		$this->SetFont('Times','',12);
		$this->Cell(276,10,'Cairo Road Town Center next to post office',0,0,'C');
        $this->Ln(5);
		$this->Cell(276,10,' P.O.Box 31009 Lusaka, Zambia',0,0,'C');
		$this->Ln(20);
	}
	function footer(){
		$this->SetY(-15);
		$this->SetFont('Arial','',8);
		$this->Cell(0,10,'page '.$this->PageNo().'/{nb}',0,0,'C');

	}
	function headerTable(){
		$this->SetFont('Times','B',12);
		$this->Cell(20,10,'TRSCT ID',0,0,'C');
		$this->Cell(45,10,'CUSTOMER NAME',0,0,'C');
		$this->Cell(40,10,'TNSCT NUMBER',0,0,'C');
		$this->Cell(60,10,'Phone number',0,0,'C');
		$this->Cell(30,10,'TOTAL Amount',0,0,'C');
		
		$this->Ln();

	}

	function viewTable($db){
		$transactions = $db->query("SELECT * FROM cash_on_delivery");
			while($transaction = mysqli_fetch_assoc($transactions)) {
				$this->SetFont("Arial","","12");
             	$this->Cell(20,10,$transaction['id'],0,0,'C');
            	$this->Cell(40,10,$transaction['last_name'],0,0,'C');
            	$this->Cell(40,10,$transaction['nrc_number'],0,0,'C');
            	$this->Cell(60,10,$transaction['phone_number'],0,0,'C');
            	$this->Cell(30,10,money($transaction['Amount']),0,0,'C');
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