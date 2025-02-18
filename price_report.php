<?php  
/**
 * TPL :: Order Management Software
 *
 * @copyright		Copyright (c) Terumo Penpol. All rights reserved.
 * @category 		Order Processing
 * @identity		Terumo Penpol is India's largest manufacturer of Blood Bags. This web portal would help order management. 
 * @author			Vidhya H
 * @version			$Id:price_report.php  Friday, July 05, 2010, 10:44:00 AM $
 *		
 */

	include("includes/config.inc.php");
    include(DIR_FUNCTIONS . "database.php");
	include(DIR_CLASSES .	'quarter.php'); 
	include('includes/fpdf/fpdf.php');
	define("FPDF_FONTPATH", "includes/fpdf/font/");
    include ("price_list.php");
    $quarter = new Quarter();
	//$perm = array('access_admin');
	//checkpermission($perm);
	//error_reporting(0);
	$quarter_id=$_GET['id'];
	$product_type_id=$_GET['ptype'];
    $product_type_name ="";
	$q= Query("SELECT name FROM `[x]product_type` WHERE id='{$product_type_id}'");	 
    if(Num($q))
	 {
	  $r = FetchAssoc($q);		 	 
	  $product_type_name = $r['name'];
	 }
	$tax_details=$quarter->getTaxForProductType($quarter_id,$product_type_id);
	$ed=$tax_details['ed'];
	$cst=$tax_details['cst'];	
	$ed_percent=$ed;
	$cst_percent=$cst;
	$result=$quarter->getQuarterFromId($quarter_id);
	$quarter_id = isset($result['id']) ? $result['id'] : null;
	$quarter_name=$result['name'];
	$from=$result['from_date'];
	$to=$result['to_date'];
	$price_query ="";
	$query = Query("SELECT p.name, p.code, p.id AS product_id, q.mrp, q.rate, q.hospital_price
                  FROM product p LEFT JOIN quarter_price q ON p.id = q.product_id
                  AND q.quarter_id =$quarter_id WHERE p.product_type_id =$product_type_id");
	$quarters="";
	$i=1;
	if(Num($query )){
			while($r = FetchAssoc($query)){
			$r['slno'] = $i;
				if($i%2 ==0) {
					$r['class'] ="two";
				}else {
					$r['class'] ="one";
				}
			if($product_type_id!=3)	{
				$ed_value = $quarter->calculateTax($r['rate'],$ed);
				$r['ed']  = $ed_value;
				$r['cst'] = $quarter->calculateTax($ed_value,$cst);
			}
			$quarters[] = $r;
			$i++;
			}
	}
	
    $pdf = new PriceListPDF($quarters,$product_type_id,$quarter_name,$from,$to,$ed,$cst,$product_type_name);
	$file_name = $quarter_name."_".$product_type_name;
	$file_name = str_replace(" ","_",$file_name);
	$file=$file_name.'.pdf';
	$pdf->Output($file);
	header("Cache-Control: public");
	header('Cache-control: private');
	header("Content-Description: File Transfer");
	header("Content-Disposition: attachment; filename=$file");
	header("Content-Transfer-Encoding: binary");
	header("Content-Type: application/pdf");
	readfile($file);
	unlink($file);
  ?>
