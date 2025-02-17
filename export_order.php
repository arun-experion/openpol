<?php

use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Style\Alignment;

use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Style\Color;

set_time_limit(0);
include("includes/config.inc.php");
 session_start();  
include(DIR_FUNCTIONS . "database.php");
include(DIR_CLASSES . "order.php");
$order = new Order();
//error_reporting(0);
	$query= $_REQUEST['qry'];
	$query = stripslashes($query);
	//echo $query ;
	$query = str_replace('-','/',$query);
	$query  = Query($query);
	 
	$data = "";

/** PHPSpreadsheet */
require DIR_INCLUDES. 'PhpSpreadsheet/vendor/autoload.php';
require_once DIR_INCLUDES . 'PhpSpreadsheet/src/PhpSpreadsheet/Spreadsheet.php';

// Create new PHPExcel object
$objPhpSpreadSheet = new Spreadsheet();

// Set properties
$objPhpSpreadSheet->getProperties()->setCreator(SITE_OWNER)
							 ->setLastModifiedBy(SITE_OWNER)
							 ->setTitle("Penpol orders")
							 ->setSubject("Penpol orders")
							 ->setDescription("Penpol Orders")
							 ->setKeywords("Penpol")
							 ->setCategory("Penpol");

// Create a first sheet, representing sales data
 
$objPhpSpreadSheet->getActiveSheet()->setCellValue('A1', '#12566');

$objPhpSpreadSheet->getActiveSheet()->mergeCells('D1:H1');
$objPhpSpreadSheet->getActiveSheet()->mergeCells('A1:A2');
$objPhpSpreadSheet->getActiveSheet()->mergeCells('B1:B2');
$objPhpSpreadSheet->getActiveSheet()->mergeCells('C1:C2');

$objPhpSpreadSheet->getActiveSheet()->mergeCells('I1:I2');
$objPhpSpreadSheet->getActiveSheet()->mergeCells('J1:J2');
$objPhpSpreadSheet->getActiveSheet()->mergeCells('K1:K2');
$objPhpSpreadSheet->getActiveSheet()->mergeCells('L1:L2');
$objPhpSpreadSheet->getActiveSheet()->setCellValue('D1', '#12566');
$objPhpSpreadSheet->getActiveSheet()->getStyle('D1')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);		
$objPhpSpreadSheet->getActiveSheet()->getColumnDimension('D')->setWidth(30);
$objPhpSpreadSheet->getActiveSheet()->setCellValue('D2', 'Name');
$objPhpSpreadSheet->getActiveSheet()->getColumnDimension('E')->setWidth(10);
$objPhpSpreadSheet->getActiveSheet()->setCellValue('E2', 'Carton');
$objPhpSpreadSheet->getActiveSheet()->getColumnDimension('F')->setWidth(10);
$objPhpSpreadSheet->getActiveSheet()->setCellValue('F2', 'Quantity');
$objPhpSpreadSheet->getActiveSheet()->getColumnDimension('G')->setWidth(15);
$objPhpSpreadSheet->getActiveSheet()->setCellValue('G2', 'Rate');
$objPhpSpreadSheet->getActiveSheet()->getColumnDimension('H')->setWidth(15);
$objPhpSpreadSheet->getActiveSheet()->setCellValue('H2', 'Value');
 
$objPhpSpreadSheet->getActiveSheet()->getStyle('A1:L1')->applyFromArray(
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

$objPhpSpreadSheet->getActiveSheet()->getStyle('A2:H2')->applyFromArray(
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
$objPhpSpreadSheet->setActiveSheetIndex(0)
            ->setCellValue('A1', 'Sl No')
            ->setCellValue('B1', 'Order No')
            ->setCellValue('C1', 'Order Date')
            ->setCellValue('D1', 'Product')
			->setCellValue('I1', 'Total')
			->setCellValue('J1', 'Ordered By')
			->setCellValue('K1', 'Status')
			->setCellValue('L1', 'Credit');
$objPhpSpreadSheet->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(Alignment::VERTICAL_CENTER);			
$objPhpSpreadSheet->getActiveSheet()->getStyle('D1:H1')->getAlignment()->setVertical(Alignment::VERTICAL_CENTER);

$objPhpSpreadSheet->getActiveSheet()->getStyle('A1:L1')->getFill()->setFillType(Fill::FILL_SOLID);
$objPhpSpreadSheet->getActiveSheet()->getStyle('A1:L1')->getFill()->getStartColor()->setARGB('FF146ac1');
$objPhpSpreadSheet->getActiveSheet()->getStyle('D2:H2')->getFill()->setFillType(Fill::FILL_SOLID);
$objPhpSpreadSheet->getActiveSheet()->getStyle('D2:H2')->getFill()->getStartColor()->setARGB('FF146ac1');

$objPhpSpreadSheet->getActiveSheet()->getStyle('A1:L1')->getFont()->getColor()->setARGB(Color::COLOR_WHITE);
$objPhpSpreadSheet->getActiveSheet()->getStyle('D2:H2')->getFont()->getColor()->setARGB(Color::COLOR_WHITE);

		
$objPhpSpreadSheet->getActiveSheet()->getColumnDimension('B')->setWidth(20);
$objPhpSpreadSheet->getActiveSheet()->getColumnDimension('C')->setWidth(30);
$objPhpSpreadSheet->getActiveSheet()->getColumnDimension('I')->setWidth(20);
$objPhpSpreadSheet->getActiveSheet()->getColumnDimension('J')->setWidth(20);
$objPhpSpreadSheet->getActiveSheet()->getColumnDimension('K')->setWidth(20);
$objPhpSpreadSheet->getActiveSheet()->getColumnDimension('L')->setWidth(20);
$i=1;
$row =3;
 
 	while($export = FetchAssoc($query)){
		$status=$order->getstatusname($order->getcurrentorderstatus($export['id']));
	 	$products = $order->getproductsreport($export['id']);
		if($export['credit']==0){
			$creditby ="Zone";
		}else{
			$creditby = $order->getuserfirstname($export['credit']);	
		}
	 	$total    = $order->gettotal($export['id']);
	 	$status = $status['status'];
	  	$onum = ' '.$export['order_no']; 
		$objPhpSpreadSheet->getActiveSheet()
            ->setCellValue('A'.$row, $i)
            ->setCellValue('B'.$row, $onum)
            ->setCellValue('C'.$row, $export['order_date']);
			
 		$pr=0;		
		foreach($products as $p) {			
 			$objPhpSpreadSheet->getActiveSheet()
				->setCellValue('D'.$row, $p['name'])
				->setCellValue('E'.$row, $p['carton_no'])
				->setCellValue('F'.$row, $p['quantity'])
				->setCellValue('G'.$row, number_format($p['rate'],2))
				->setCellValue('H'.$row, '=F'.$row.'*G'.$row);
				
 			$objPhpSpreadSheet->getActiveSheet()->setCellValue('J'.$row, $export['first_name'])
										  ->setCellValue('K'.$row, $status)
										  ->setCellValue('L'.$row, $creditby);
			
			$row = $row+1; 
			$pr=$pr+1;			
		}
		$prevrow=$row-1;
		$rowfirst=$row-$pr;
        $objPhpSpreadSheet->getActiveSheet()->mergeCells('I'.$rowfirst.':I'.$prevrow);
		$objPhpSpreadSheet->getActiveSheet()->mergeCells('K'.$rowfirst.':K'.$prevrow);	
		$objPhpSpreadSheet->getActiveSheet()->setCellValue('I'.$rowfirst, '=SUM(H'.$rowfirst.':H'.$prevrow.')');
		$objPhpSpreadSheet->getActiveSheet()->mergeCells('J'.$rowfirst.':J'.$prevrow);
		$objPhpSpreadSheet->getActiveSheet()->mergeCells('L'.$rowfirst.':L'.$prevrow);
		
		$i = $i+1;
	 }
 	/*echo $row=$row-1;
  die();*/
	
$objPhpSpreadSheet->getActiveSheet()->mergeCells('A'.$row.':H'.$row);
$objPhpSpreadSheet->getActiveSheet()->setCellValue('A'.$row, 'Total');
$objPhpSpreadSheet->getActiveSheet()->getStyle('A'.$row)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_RIGHT);	
$lastrow=$row-1;
$objPhpSpreadSheet->getActiveSheet()->setCellValue('I'.$row, '=SUM(I3:I'.$lastrow.')');
$objPhpSpreadSheet->getActiveSheet()->setCellValue('J'.$row, ' ');
$objPhpSpreadSheet->getActiveSheet()->setCellValue('K'.$row, ' ');
$objPhpSpreadSheet->getActiveSheet()->getStyle('A3:A'.$lastrow)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);		
 
// Rename sheet
$objPhpSpreadSheet->getActiveSheet()->setTitle('Orders');


// Set active sheet index to the first sheet, so Excel opens this as the first sheet
$objPhpSpreadSheet->setActiveSheetIndex(0);
 
// Redirect output to a client�s web browser (Excel5)
header('Content-Type: application/vnd.ms-excel');
header('Content-Disposition: attachment;filename="orders.xls"');
header('Cache-Control: max-age=0');

$objWriter = IOFactory::createWriter($objPhpSpreadSheet, 'Xlsx');
$objWriter->save('php://output');
exit; 
?>
