<?php 
class PriceListPDF extends FPDF {
   private $PG_W = 190;
   public function __construct($data,$product_type,$quarter_name,$from,$to,$ed,$cst,$type) {
   define("QUARTER",$quarter_name);
   define("FROM",$from);
   define("TO",$to);
   define("ED",$ed);
   define("CST",$cst);
   define("TYPE",$type);
   parent::__construct(); 
   $this->ListItems($data,$product_type); 
  }
 
 public function Header() {
  
  $this->SetFont('Arial', 'B', 12);
  $this->Cell($this->PG_W, 8, SITE_NAME, 0, 0, 'C');
  $this->Ln();
  $this->SetFont('Arial', 'B', 8);
  $this->Cell($this->PG_W, 5, "Price list for ".QUARTER."  ( Valid from  ".FROM ."  to  ".TO." )", 0, 0, 'C');
  $this->Ln();
  $this->SetFont('Arial', 'B', 10);
  $this->Cell($this->PG_W ,8,"Price list for : ".TYPE." , " ."Date : ".date('d.m.Y', time()),0,0,'C');
  $this->Cell($this->PG_W ,8," Date : ".date('d.m.Y', time()), 0,5, 'R');
  $this->Ln(1);
  
 }
  
 public function ListItems($data,$product_type) {
 
  $this->setHeaderFont();
  $this->AddPage();
  if($product_type!=3){
  	$header = array("Sl No","Product", "Product Code", "Rate (Rs)", "ED ".ED." %", "CST ".CST." %", "Hospital Price","MRP");
	$w = array(10, 50, 30, 20, 20, 20, 25, 20);
  }else{
  
   $header = array("Sl No","Product", "Product Code", "Rate","Hospital Price","MRP");
   $w = array(10, 70, 40, 25,25, 25);
  
  }
  
  
  // Headers and widths
  
  for($i = 0; $i < count($header); $i++) {
   $this->Cell($w[$i], 7, $header[$i], 1, 0, 'C');
  }
  $this->Ln();
  
  // Mark start coords
  $x = $this->GetX();
  $y = $this->GetY();
  $this->SetDataFont();
  $i=0;
	foreach($data as $row){ 
	   $string_length = strlen($row['name']);
	   if($string_length>62){
		$yH=18;
	   }elseif($string_length>31) {
		$yH=12;
	   }else{
	   	$yH=6;
	   }
		 
	   $this->Cell($w[0], $yH, $row['slno'], 'LRB');
	   $y1 = $this->GetY();
	   $this->MultiCell($w[1], 6, $row['name'], 'LRB'); 
	   $y2 = $this->GetY();
	   $zH = $y2 - $y1;
	   $this->SetXY($x + $w[1]+$w[0], $this->GetY() - $zH);
	   $this->Cell($w[2], $zH, $row['code'], 'LRB', 0, 'L');   
	   $this->Cell($w[3], $zH, $row['rate'], 'LRB', 0, 'R');
	  if($product_type!=3){ 
	   $this->Cell($w[4], $zH, $row['ed'], 'LRB', 0, 'R');
	   $this->Cell($w[5], $zH, $row['cst'] ,'LRB', 0, 'R');
	   $this->Cell($w[6], $zH, $row['hospital_price'] ,'LRB', 0, 'R');
	   $this->Cell($w[7], $zH, $row['mrp'], 'LRB', 0, 'R');
	   }else{
	   $this->Cell($w[4], $zH, $row['hospital_price'] ,'LRB', 0, 'R');
	   $this->Cell($w[5], $zH, $row['mrp'], 'LRB', 0, 'R');
	   }
	   $this->Ln();
	   $i++;
	   if($i%35==0){
	   $this->Ln();
	   $this->AddPage();
	   $this->setHeaderFont();
	   for($i = 0; $i < count($header); $i++) {
			$this->Cell($w[$i], 7, $header[$i], 1, 0, 'C');
	   }
	   $this->Ln();
	   $this->SetDataFont();
	   }
	}
  
  $this->Ln(10);
 }
 public function Footer() {
    
 }
 private function setHeaderFont() {
  $this->SetFont('Arial', 'B', 8);
 }
 
 private function setDataFont($isBold = false) {
  $this->SetFont('Arial', $isBold ? 'B' : '', 8);
 }


	  

}
?>