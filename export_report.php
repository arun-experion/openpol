<?php

use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Style\Alignment;

use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Style\Color;

include("includes/config.inc.php");
 session_start();  
include(DIR_FUNCTIONS . "database.php");
include(DIR_CLASSES . "order.php");
$order = new Order();
//error_reporting(0);
	$query= $_GET['qry'];
	$query = stripslashes($query);
	//echo $query ;
	$query = str_replace('-','/',$query);
	$query  = Query($query);
	 
	$data = "";
 //	
 
/** PHPSpreadsheet */
require DIR_INCLUDES. 'PhpSpreadsheet/vendor/autoload.php';
require_once DIR_INCLUDES . 'PhpSpreadsheet/src/PhpSpreadsheet/Spreadsheet.php';


// Create new PHPExcel object
$objPhpSpeadsheet = new Spreadsheet();

// Set properties
$objPhpSpeadsheet->getProperties()->setCreator(SITE_OWNER)
							 ->setLastModifiedBy(SITE_OWNER)
							 ->setTitle("Penpol orders")
							 ->setSubject("Penpol orders")
							 ->setDescription("Penpol Orders")
							 ->setKeywords("Penpol")
							 ->setCategory("Penpol");

// Create a first sheet, representing sales data
 
$objPhpSpeadsheet->getActiveSheet()->setCellValue('A1', '#12566');

   
$objPhpSpeadsheet->getActiveSheet()->getStyle('A1:H1')->applyFromArray(
		array(
			'font'    => array(
				'bold'      => true
			),
			'alignment' => array(
				'horizontal' => Alignment::HORIZONTAL_CENTER,
			),
			'borders' => array(
				'bottom'     => array(
 					'style' => Border::BORDER_THIN
 				)
			),
			'fill' => array(
	 			'type'       => Fill::FILL_GRADIENT_LINEAR,
	  			'rotation'   => 90,
	 			'startcolor' => array(
	 				'argb' => 'FFA0A0A0'
	 			),
	 			'endcolor'   => array(
	 				'argb' => 'FFFFFFFF'
	 			)
	 		)
		)
);

  

// Add some data
$objPhpSpeadsheet->setActiveSheetIndex(0)
            ->setCellValue('A1', 'Sl No')
            ->setCellValue('B1', 'Order No')
            ->setCellValue('C1', 'Product Name')
            ->setCellValue('D1', 'Product Code')
			->setCellValue('E1', 'Quantity')
			->setCellValue('F1', 'Value')
			->setCellValue('G1', 'Ordered By')
			->setCellValue('H1', 'Delivery Date');
			
$objPhpSpeadsheet->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(Alignment::VERTICAL_CENTER);			
 
$objPhpSpeadsheet->getActiveSheet()->getStyle('A1:H1')->getFill()->setFillType(Fill::FILL_SOLID);
$objPhpSpeadsheet->getActiveSheet()->getStyle('A1:H1')->getFill()->getStartColor()->setARGB('FF146ac1');
  
$objPhpSpeadsheet->getActiveSheet()->getStyle('A1:H1')->getFont()->getColor()->setARGB(Color::COLOR_WHITE);
 
		
$objPhpSpeadsheet->getActiveSheet()->getColumnDimension('B')->setWidth(20);
$objPhpSpeadsheet->getActiveSheet()->getColumnDimension('C')->setWidth(30);
$objPhpSpeadsheet->getActiveSheet()->getColumnDimension('D')->setWidth(20);
$objPhpSpeadsheet->getActiveSheet()->getColumnDimension('E')->setWidth(20);
$objPhpSpeadsheet->getActiveSheet()->getColumnDimension('F')->setWidth(25);
$objPhpSpeadsheet->getActiveSheet()->getColumnDimension('G')->setWidth(20);
$objPhpSpeadsheet->getActiveSheet()->getColumnDimension('H')->setWidth(20);
$i=1;
$row =2;
 
 	while($export = FetchAssoc($query)){ 
   	  	$onum = ' '.$export['order_no']; 
		$objPhpSpeadsheet->getActiveSheet()
            ->setCellValue('A'.$row, $i)
            ->setCellValue('B'.$row, $onum)
            ->setCellValue('C'.$row, $export['name'])
			->setCellValue('D'.$row, $export['code'])
			->setCellValue('E'.$row, $export['quantity'])
			->setCellValue('F'.$row, $export['value'].'')
			->setCellValue('G'.$row, $order->getordermadeby($export['created_by'],'name'))
			->setCellValue('H'.$row, $export['delivery_date']);		 
		$row = $row+1;
		$i = $i+1;
	 }
  
	
$objPhpSpeadsheet->getActiveSheet()->mergeCells('A'.$row.':E'.$row);
$objPhpSpeadsheet->getActiveSheet()->setCellValue('A'.$row, 'Total');
$objPhpSpeadsheet->getActiveSheet()->getStyle('A'.$row)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_RIGHT);	
$lastrow=$row-1;
$objPhpSpeadsheet->getActiveSheet()->setCellValue('F'.$row, '=SUM(F2:F'.$lastrow.')');
$objPhpSpeadsheet->getActiveSheet()->setCellValue('G'.$row, ' ');
$objPhpSpeadsheet->getActiveSheet()->setCellValue('H'.$row, ' ');
$objPhpSpeadsheet->getActiveSheet()->getStyle('A3:A'.$lastrow)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);		
$objPhpSpeadsheet->getActiveSheet()->getStyle('A2')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);	
$objPhpSpeadsheet->getActiveSheet()->getStyle('E2:E'.$lastrow)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);	

// Rename sheet
$objPhpSpeadsheet->getActiveSheet()->setTitle('Orders');


// Set active sheet index to the first sheet, so Excel opens this as the first sheet
$objPhpSpeadsheet->setActiveSheetIndex(0);
 
// Redirect output to a client�s web browser (Excel5)
header('Content-Type: application/vnd.ms-excel');
header('Content-Disposition: attachment;filename="orders.xls"');
header('Cache-Control: max-age=0');

// $objWriter = PHPExcel_IOFactory::createWriter($objPhpSpeadsheet, 'Excel5');
$objWriter = IOFactory::createWriter($objPhpSpeadsheet, 'Xlsx');
$objWriter->save('php://output');
exit; 
?>