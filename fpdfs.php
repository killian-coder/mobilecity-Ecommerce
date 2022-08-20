<?php
require "fpdf/fpdf.php";
require_once 'core/init.php';
class  myPDF extends FPDF{
	function header(){
		$this->image('image/moblogo.png',10,6);
		$this->SetFont('Arial','B',14);
		$this->Cell(276,5,'CUSTOMER RECIEPT',0,0,'C');
		$this->Ln();
		$this->SetFont('Times','',12);
		$this->Cell(276,10,'Cairo Road Town Center P.O.Box 31009 Lusaka, Zambia',0,0,'C');
        $this->Ln(10);
		$this->Cell(276,10,'Cairo Road Town Center P.O.Box 31009 Lusaka, Zambia',0,0,'C');
		$this->Ln(20);
	}
	function footer(){
		$this->SetY(-15);
		$this->SetFont('Arial','',8);
		$this->Cell(0,10,'page '.$this->PageNo().'/{nb}',0,0,'C');

	}
	function headerTable(){
		$this->SetFont('Times','B',12);
		$this->Cell(20,10,'Customer Name',0,0,'C');
		$this->Cell(45,10,'Transaction No#:',0,0,'C');
		$this->Cell(40,10,'Refrerence No#:',0,0,'C');
		$this->Cell(60,10,'Delivery Address:',0,0,'C');
		$this->Cell(36,10,'Customer NRC No#:',0,0,'C');
		$this->Cell(30,10,'Contact No#',0,0,'C');
		$this->Cell(50,10,'gender',0,0,'C');
		$this->Ln();

	}

	function viewTable($db){
		$transactions = $db->query("SELECT * FROM mobile_money");
			while($transaction = mysqli_fetch_assoc($transactions)) {
				$this->SetFont("Arial","","12");
            	$this->Cell(20,10,$transaction['customer_name'],0,0,'C');
            	$this->Cell(40,10,$transaction['transaction_id'],0,0,'C');
            	$this->Cell(40,10,$transaction['reference_number'],0,0,'C');
            	$this->Cell(60,10,$transaction['delivery_address'],0,0,'C');
            	$this->Cell(36,10,$transaction['customer_nrc'],0,0,'C');
            	$this->Cell(30,10,$transaction['phone_number'],0,0,'C');
            	$this->Cell(50,10,$transaction['gender'],0,0,'C');
            	$this->Ln();

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