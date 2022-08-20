<?php
require "fpdf.php";


class  myPDF extends FPDF{
	function header(){

		$this->Image('moblog.png',10,6);
		$this->SetFont('Arial','B',14);
		$this->Cell(276,5,'CUSTOMER DOCCUMENT',0,0,'C');
		$this->Ln();
		$this->SetFont('Times','',12);
		$this->Cell(276,10,'street address of Employee office',0,0,'C');
		$this->Ln(20);
	}
	function footer(){
		$this->SetY(-15);
		$this->SetFont('Arial','',8);
		$this->Cell(0,10,'page '.$this->PageNo().'/{nb}',0,0,'C');

	}
	function headerTable(){
		$this->SetFont('Times','B',12);
		$this->Cell(20,10,'ID',1,0,'C');
		$this->Cell(40,10,'Name',1,0,'C');
		$this->Cell(40,10,'Position',1,0,'C');
		$this->Cell(60,10,'Ofice',1,0,'C');
		$this->Cell(36,10,'Age',1,0,'C');
		$this->Cell(30,10,'Start Date',1,0,'C');
		$this->Cell(50,10,'Salary',1,0,'C');
		$this->Ln();

	}

}

$pdf = new myPDF();
$pdf-> AliasNbPages();
$pdf->AddPage('L','A4',0);
$pdf->headerTable();
$pdf->output; 

?>