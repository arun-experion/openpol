<?php

set_time_limit(0);
include("includes/config.inc.php");
session_start();  
include(DIR_FUNCTIONS . "database.php");
include(DIR_CLASSES . "order.php");
$order = new Order();
error_reporting(1);
$query  =   $_REQUEST['qry'];

if($query == 'Select * from ERP_ORDERS'){
    $query  =   'Select * from ERP_ORDERS ORDER BY order_no asc, rate';
} else {
    $query  =   str_replace('o.id desc','o.id asc, pa.rate',$query);
}

$query  =   stripslashes($query);
$query  =   Query($query);
$data   =   "";
$time   =   date("dmY-gia");
$userid =   $_SESSION['id'];
if(!empty($userid) && $userid!=0){
    $name   = $order->getuserfirstname($userid);
    $name   = str_replace(' ', '-', $name);
}

function encode_comma($val){
    $searchForValue = ',';
    $searchForValue1 = ';';
    if((strpos($val, $searchForValue) !== false) || (strpos($val, $searchForValue1) !== false)) {
        return '"'. $val . '"';
    } else {
        return $val;
    }
}

if($query->num_rows > 0){
    
    $delimiter  = ","; 
    $filename   = "Oders-" .$name.'-'.$time. ".csv"; 
     
    /*$fields = array('SLNO', 'ORDER NO', 'ORDER DATE', 'CUSTOMER ERP NUMBER', 'ORDER PLACED BY', 'PRODUCT CODE', 'QTY', 
    'RATE', 'REQUESTED DELIVERY DATE','PAYMENT TERMS','ORDER CREDIT','END CUSTOMER NAME',
    'OTHER INSTRUCTIONS','BUSINESS UNIT','CHEQUE NO','CHEQUE AMOUNT','CHEQUE DATE'); */
    
    $fields = "SLNO, ORDER NO, ORDER DATE, CUSTOMER ERP NUMBER, ORDER PLACED BY, PRODUCT CODE, QTY,RATE, REQUESTED DELIVERY DATE,PAYMENT TERMS,ORDER CREDIT,END CUSTOMER NAME,OTHER INSTRUCTIONS,BUSINESS UNIT,CHEQUE NO,CHEQUE AMOUNT,CHEQUE DATE \n";
    
    $i =1;
    $orders_id    =   array(); 
    while($export = FetchAssoc($query)){
        if($export['credit']==0){
            $creditby       ="Zone";
        }else{
            $creditby       = $order->getuserfirstname($export['credit']);	
        }
        $total              = $order->gettotal($export['id']);
        $customer           = $order->getCustomerDetails($export['customer_id']);

        if($export['order_date'] == ''|| $export['order_date'] == '0000-00-00 00:00:00'){
            $order_date       = '';
        } else {
            $order_date       = new DateTime($export['order_date']);
            $order_date       = $order_date->format('d-m-Y');
        }

        
        if($export['prefered_date'] == ''|| $export['prefered_date'] == '0000-00-00 00:00:00'){
            $prefered_date       = '';
        } else {
            $prefered_date       = new DateTime($export['prefered_date']);
            $prefered_date       = $prefered_date->format('d-m-Y');
        }


        if($export['payment_date'] == ''|| $export['payment_date'] == '0000-00-00 00:00:00'){
            $payment_date       = '';
        } else {
            $payment_date       = new DateTime($export['payment_date']);
            $payment_date       = $payment_date->format('d-m-Y');
        }
        
        /*$lineData = array($i,$export['order_no'],$order_date,$export['erp_number'], $export['first_name'], $export['code'],$export['quantity']
            ,$export['rate'],$prefered_date,$export['payment_terms'],$creditby,$customer['customer_name'],
            $export['instructions'],$export['category_name'],$export['payment_no'],$export['payment_amount'],$payment_date
        ); */
        
        $instructions   = trim(preg_replace('/\s+/',' ',encode_comma($export['instructions'])));
        $payment_terms  = trim(preg_replace('/\s+/',' ',encode_comma($export['payment_terms'])));
        $erp_number     = encode_comma($export['erp_number']);
        $product_code   = encode_comma($export['code']);
        $order_number   = strval("OMS-".$export['order_no']);
        $first_name     = trim(preg_replace('/\s+/',' ',encode_comma($export['first_name'])));
        $creditby       = trim(preg_replace('/\s+/',' ',encode_comma($creditby)));
        $customer_name  = trim(preg_replace('/\s+/',' ',encode_comma($customer['customer_name'])));
        $category_name  = trim(preg_replace('/\s+/',' ',encode_comma($export['category_name'])));

        $fields.= $i.','.$order_number.','.$order_date.','.$erp_number.','.$first_name.','.$product_code.','.$export['quantity'].','.$export['rate'].','.$prefered_date.','.$payment_terms.','.$creditby.','.$customer_name.','.$instructions.','.$category_name.','.$export['payment_no'].','.$export['payment_amount'].','.$payment_date."\n"; 

        $orders_id[]    =   $export['id'];
        $data           =   array("is_exported" =>  2,"exported_by" =>  $userid);
        $i++;
    }

    foreach($orders_id as $order_id){
        Update("order",$data,"id=$order_id");
        $status = $order->get_orderstatus($order_id);
        if(count($status) >0 && $status == 1) {
            Insert("order_status", array("order_id" => $order_id, 
                "current_status" => 3,
                "comment" => '', 
                "updated_by" => $_SESSION['id'], 
                "updated_date" => date('Y-m-d H:i:s')
            ));
        }
    }
    

    $csv_handler = fopen ('templates/default/csv/'.$filename,'w');
    fwrite ($csv_handler,$fields);
    fclose ($csv_handler);
    $data = array('success' => 'yes','filename' =>$filename);
    
} else {
    $data = array('success' => 'no');
}
echo $output = json_encode($data);

?>