<?php
set_time_limit(0);
include("includes/config.inc.php");
session_start();  
include(DIR_FUNCTIONS . "database.php");
include(DIR_CLASSES . "order.php");
$order = new Order();
error_reporting(1);
$query  =   $_REQUEST['qry'];
$query  =   stripslashes($query);
$query  =   Query($query);
$data   =   "";
$time   =   date("dmY-g i a");

if($query->num_rows > 0){
    
    $delimiter  = ","; 
    $filename   = "Oders-" .$time. ".csv"; 
     
    // Create a file pointer 
    $f = fopen('php://memory', 'w'); 

    // Set column headers 
    $fields = array('SLNO', 'ORDER NO', 'ORDER DATE', 'CUSTOMER ERP NUMBER', 'ORDER PLACED BY', 'PRODUCT CODE', 'QTY', 
    'RATE', 'REQUESTED DELIVERY DATE','PAYMENT TERMS','ORDER CREDIT','END CUSTOMER NAME',
    'OTHER INSTRUCTIONS','BUSINESS UNIT','CHEQUE NO','CHEQUE AMOUNT','CHEQUE DATE'); 
    fputcsv($f, $fields, $delimiter);
    $i =1;
    while($export = FetchAssoc($query)){
        
        if($export['credit']==0){
            $creditby       ="Zone";
        }else{
            $creditby       = $order->getuserfirstname($export['credit']);	
        }
        $total              = $order->gettotal($export['id']);
        $customer           = $order->getCustomerDetails($export['customer_id']);

        if($export['order_date'] == ''|| $export['order_date'] == '0000-00-00 00:00:00'){
            $order_date       = '00-00-0000';
        } else {
            $order_date       = new DateTime($export['order_date']);
            $order_date       = $order_date->format('d-m-Y');
        }

        
        if($export['prefered_date'] == ''|| $export['prefered_date'] == '0000-00-00 00:00:00'){
            $prefered_date       = '00-00-0000';
        } else {
            $prefered_date       = new DateTime($export['prefered_date']);
            $prefered_date       = $prefered_date->format('d-m-Y');
        }


        if($export['payment_date'] == ''|| $export['payment_date'] == '0000-00-00 00:00:00'){
            $payment_date       = '00-00-0000';
        } else {
            $payment_date       = new DateTime($export['payment_date']);
            $payment_date       = $payment_date->format('d-m-Y');
        }
        
        $lineData = array($i,$export['order_no'],$order_date,$export['erp_number'], $export['first_name'], $export['code'],$export['quantity']
            ,$export['rate'],$prefered_date,$export['payment_terms'],$creditby,$customer['customer_name'],
            $export['instructions'],$export['category_name'],$export['payment_no'],$export['payment_amount'],$payment_date
        ); 
        fputcsv($f, $lineData, $delimiter);
        $i++;
        $data   =   array("is_exported" =>  2); 
        $id     =   $export['id'];
		Update("order",$data,"id=$id");
        
    }

    

    fseek($f, 0);
    header('Content-Type: text/csv'); 
    header('Content-Disposition: attachment; filename="' . $filename . '";'); 
    header('Cache-Control: max-age=0');

    
     
    //output all remaining data on a file pointer 
    fpassthru($f); 
    exit;
}



?>
