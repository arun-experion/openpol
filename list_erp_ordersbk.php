<?php 
    /**
    * @category 		ERP Order Listing
    * @author			Abilash
    * @version			$Id: list_erp_orders.php  FEB 17, 2022
    *		
    */
	include("includes/initialize.php");
 	include(DIR_CLASSES . "order.php");
	require(DIR_CLASSES . "search.php");
	require(DIR_CLASSES . "splitresults.php");

	$perm = array('export_erp_order');
	checkpermission($perm);
	$tpl = new template();
	$order = new Order();
 	$tpl -> Load(TEMPLATE_PATH . "list_erp_orders.tpl");
	
	if(isset($_GET['action']) AND $_GET['action'] == 1)
	{
		messages(ORDER_DELETE_SUCCESS);
	}
        
	if(isset($_SESSION['message'])) {
		$tpl -> AssignValue("message", $_SESSION['message']);	
	}	

        
	// Delete Order 
	if(isset($_POST['mode']) AND $_POST['mode'] == '_delete_order')
	{
		header('Content-type: application/json');
		
		Query("DELETE FROM `order` WHERE id = '".$_POST['id']."'");
		Query("DELETE FROM order_status WHERE order_id = '".$_POST['id']."'");
		Query("DELETE FROM product_order WHERE order_id = '".$_POST['id']."'");
		
		$data = array('success' => 'yes');
		$output = json_encode($data);
		echo $output;
		exit();           
	}
    if(isset($_POST['export_csv'])) {
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
			fclose($f);
			
			exit;
		}
		
	} 
	//hide business associate name
	$bavisibility = "AND status='open'";
	if($_SESSION['utype'] != 'BA') {
		$tpl -> Zone("ba", "enabled");
        
	}else{
		$tpl -> Zone("ba", "disabled");
		$bavisibility = "AND ba_visibility=1 AND status='open'";
	}

	if($_SESSION['utype'] != 'BA'){
		$tpl -> Zone("balist", "enabled");
	}
	
	//get all status depending on usertype
 	$statusquery = Query("SELECT * FROM `[x]status` where complaint=0 " . $bavisibility);	
	//$statusoptions[] = '---Select---';
	while($statusresults = FetchAssoc($statusquery)) {
		$statusoptions[$statusresults["id"]] = $statusresults["status"];
	}
	if(isset($_GET['status']) && $_GET['status'] !='') {
 		$tpl -> AssignValue("select_status", createSelect("status", $statusoptions, $_GET['status'],'class="listmenus" style="width:155px;"'));
	} else {
		$tpl -> AssignValue("select_status", createSelect("status", $statusoptions,'','class="listmenus" style="width:155px;"'));
	}

	//Get Export status
	$exportstatus[1] = 'Pending to Export';
	$exportstatus[2] = 'Exported';
	$exportstatus[0] = 'All';
	
	if(isset($_GET['ex_status']) && $_GET['ex_status'] !='') {
		$tpl -> AssignValue("ex_status", createSelect("ex_status", $exportstatus, $_GET['ex_status']));
   	} else {
	   $tpl -> AssignValue("ex_status", createSelect("ex_status", $exportstatus));
   	}

    //Get Product type
	$q_ptype = Query("SELECT * FROM product_type");	
	$options["0"]	='All';	
	while($r_ptype = FetchAssoc($q_ptype)) {
		$options[$r_ptype["id"]] = $r_ptype["name"];
	}
	if(isset($_GET['product_type']) && $_GET['product_type'] !="") {
	$tpl -> AssignValue("select_producttype", createSelect("product_type", $options,$_GET['product_type']));
	}else{
	$tpl -> AssignValue("select_producttype", createSelect("product_type", $options));
	}	
	
	//conditions based on login
	$extra 			='';
	$extracondition = '1';
	$condition 		= array();
 	if($_SESSION['utype'] == 'BA') {
		$condition['o.created_by'] =$_SESSION['id'];	
		$extra =" AND o.created_by = {$_SESSION['id']}";		
	}else if($_SESSION['utype'] == 'AM'){
		// $condition['ua.areaID'] =$_SESSION['areaid'];
		$extracondition .= " AND ua.areaID IN (SELECT `areaID` FROM `user_areas` WHERE `userID` = {$_SESSION['id']}) ";
		$extra =" AND ua.areaID IN (SELECT `areaID` FROM `user_areas` WHERE `userID` = {$_SESSION['id']})";
		// $extra =" AND u.area_id = {$_SESSION['areaid']}";
	}else if($_SESSION['utype'] == 'ZH'){
		// $condition['uz.zoneID'] =$_SESSION['zoneid'];	
		$extracondition .= " AND uz.zoneID IN (SELECT `zoneID` FROM `user_zones` WHERE `userID` = {$_SESSION['id']}) ";
		$extra =" AND uz.zoneID IN (SELECT `zoneID` FROM `user_zones` WHERE `userID` = {$_SESSION['id']})";
		// $extra =" AND u.zone_id = {$_SESSION['zoneid']}";		
	}
	
    $statusflag = '';
	
	if(isset($_GET['submit'])) {
	//search case	
		if(isset($_GET['q'])) {
			$tpl -> AssignValue("name", $_GET['q']);
		}	
		$searchFields = "o.order_no";
		
		if($_GET['from']!='' && $_GET['to'] !='') {
			$tpl -> AssignValue("from", $_GET['from']);
			$tpl -> AssignValue("to", $_GET['to']);
			$from = date('Y-m-d', strtotime($_GET['from']));
 			$to = date('Y-m-d', strtotime($_GET['to']));
 			$extracondition .=" AND DATE_FORMAT(o.created_date, '%Y-%m-%d') >=  '".$from."' AND DATE_FORMAT(o.created_date, '%Y-%m-%d') <=  '".$to."'";
		}
		
		$condition['u.status'] =1;
		
		//get BA Value

		if($_GET['ba']!=''){
			$tpl -> AssignValue("ba",$_GET['ba']);
		}
		
		if($_GET['ex_status']!='' && $_GET['ex_status']!=0) {
			$condition['o.is_exported'] = '^' .  $_GET['ex_status'] . '$';	
		}
 		if(isset($_GET['ba']) && $_GET['ba']!=0) {
			 $condition['u.id'] = '^' .  $_GET['ba'] . '$';	
		}
		if(isset($_GET['type']) && $_GET['type']=='all'){
			$extracondition .= " AND os.status !=11";
		}
		if(isset($_GET['type']) && $_GET['type']=='fulfilled'){
			$extracondition .= " AND os.status >=8 AND os.status <=10 AND os.status !=11";
		}
		//search query
		
        $statusCondition = "AND u.status REGEXP '1' AND os.status REGEXP '^1$' AND 1 and o.status = 1 and o.created_date <= NOW() - INTERVAL 15 MINUTE";        
        if($_SESSION['rid'] == 2){
            $statusCondition 	= "AND u.status REGEXP '1' AND os.status REGEXP '^1$' AND 1 and o.status = 1 and o.created_date <= NOW() - INTERVAL 15 MINUTE";
            $statusflag 		= ' o.status, ';
        }
	  	$s 		= new search($searchFields, $condition, $extracondition);		
	  	//$query 	= "Select distinct(o.id), o.order_no,o.payment_terms,o.customer_id,customer_id,o.payment_term,o.payment_no,o.payment_date,o.payment_amount,$statusflag u.first_name,u.erp_number, DATE_FORMAT(o.created_date , ".SHORT_DATE_WITHTIME." ) as order_date,o.credit, o.created_by From (Select order_id,MAX(current_status) as status from order_status group by order_id) os INNER JOIN `order` o ON o.id = os.order_id INNER JOIN `user` u ON u.id=o.created_by INNER JOIN user_zones uz ON o.created_by = uz.userID INNER JOIN user_areas ua ON o.created_by = ua.userID". $s->query. " $statusCondition ORDER BY o.id desc";
		$s_query 	= "Select distinct(o.id), o.order_no,o.payment_terms,o.customer_id,customer_id,o.payment_term,o.payment_no,o.payment_date,o.payment_amount,$statusflag u.first_name,u.erp_number, DATE_FORMAT(o.created_date , ".SHORT_DATE_WITHTIME." ) as order_date,o.credit, o.created_by,o.prefered_date,o.is_exported,pa.rate,pa.quantity,pt.name as category_name,p.code
		  	 		From (Select order_id,MAX(current_status) as status from order_status group by order_id) os INNER JOIN `order` o ON o.id = os.order_id INNER JOIN `user` u ON u.id=o.created_by INNER JOIN user_zones uz ON o.created_by = uz.userID INNER JOIN user_areas ua ON o.created_by = ua.userID 
					INNER JOIN product_order pa ON pa.order_id = o.id INNER JOIN product p ON p.id = pa.product_id INNER JOIN product_type pt ON pt.id = p.product_type_id". $s->query. " $statusCondition ORDER BY o.id desc";
		//Category Search Query
		if(isset($_GET['product_type']) && $_GET['product_type']!='0'){
			$statusCondition = " AND os.status REGEXP '^1$' AND 1 and o.status = 1 and o.created_date <= NOW() - INTERVAL 15 MINUTE and p.product_type_id = '".$_GET['product_type']."' ";         
			if($_SESSION['rid'] == 2){
				$statusCondition 	= "AND os.status REGEXP '^1$' AND 1 and o.status = 1 and o.created_date <= NOW() - INTERVAL 15 MINUTE and p.product_type_id = '".$_GET['product_type']."'";
				$statusflag 		= ' o.status, ';
			}
	  		$s 		= new search($searchFields, $condition, $extracondition);		
	  		//$query 	= "Select distinct(o.id), o.order_no,o.payment_terms,o.customer_id,o.payment_term,o.payment_no,o.payment_date,o.payment_amount,$statusflag u.first_name,u.erp_number, DATE_FORMAT(o.created_date , ".SHORT_DATE_WITHTIME." ) as order_date,o.credit, o.created_by From (Select order_id,MAX(current_status) as status from order_status group by order_id) os INNER JOIN `order` o ON o.id = os.order_id INNER JOIN `user` u ON u.id=o.created_by INNER JOIN user_zones uz ON o.created_by = uz.userID INNER JOIN user_areas ua ON o.created_by = ua.userID INNER JOIN product_order pa ON pa.order_id = o.id INNER JOIN product p ON p.id = pa.product_id INNER JOIN product_type pt ON pt.id = p.product_type_id ". $s->query. "  $statusCondition GROUP BY pa.order_id ORDER BY o.id desc";
			$query 	= "Select distinct(o.id), o.order_no,o.payment_terms,o.customer_id,o.payment_term,o.payment_no,o.payment_date,o.payment_amount,$statusflag u.first_name,u.erp_number, DATE_FORMAT(o.created_date , ".SHORT_DATE_WITHTIME." ) as order_date,o.credit, o.created_by,o.prefered_date,o.is_exported,pa.rate,pa.quantity,pt.name as category_name,p.code
			  			From (Select order_id,MAX(current_status) as status from order_status group by order_id) os INNER JOIN `order` o ON o.id = os.order_id INNER JOIN `user` u ON u.id=o.created_by INNER JOIN user_zones uz ON o.created_by = uz.userID INNER JOIN user_areas ua ON o.created_by = ua.userID 
						INNER JOIN product_order pa ON pa.order_id = o.id INNER JOIN product p ON p.id = pa.product_id INNER JOIN product_type pt ON pt.id = p.product_type_id ". $s->query. "  $statusCondition  ORDER BY o.id desc";
		} else {
			$query = $s_query;
		}

		
		$tpl -> AssignValue("qry",$query);	
	} else {	
	//else case	 
        /*$statusCondition = "AND u.status REGEXP '1' AND os.status REGEXP '^1$' AND 1 and o.status = 1 and o.is_exported = 1 and o.created_date <= NOW() - INTERVAL 15 MINUTE";
        if($_SESSION['rid'] == 2){
            $statusCondition 	= "AND u.status REGEXP '1' AND os.status REGEXP '^1$' AND 1 and o.status = 1 and o.is_exported = 1 and o.created_date <= NOW() - INTERVAL 15 MINUTE";
            $statusflag 		= ' o.status, ';
        }*/

	    //$query = "Select distinct(o.id), o.order_no,o.payment_terms,o.customer_id,o.payment_term,o.payment_no,o.payment_date,o.payment_amount,$statusflag u.first_name,u.erp_number, DATE_FORMAT(o.created_date , ".SHORT_DATE_WITHTIME." ) as order_date,o.credit, o.created_by From (Select order_id,MAX(current_status) as status from order_status group by order_id) os INNER JOIN `order` o ON o.id = os.order_id INNER JOIN `user` u ON u.id=o.created_by INNER JOIN user_zones uz ON o.created_by = uz.userID INNER JOIN user_areas ua ON o.created_by = ua.userID". $extra . " $statusCondition ORDER BY o.id desc";
        // $query = "Select distinct(o.id), o.order_no,o.payment_terms,o.customer_id,o.payment_term,o.payment_no,o.payment_date,o.payment_amount,$statusflag u.first_name,u.erp_number, DATE_FORMAT(o.created_date , ".SHORT_DATE_WITHTIME." ) as order_date,o.credit, o.created_by,o.prefered_date,o.is_exported,pa.rate,pa.quantity,pt.name as category_name,p.code
		// 	From (Select order_id,MAX(current_status) as status from order_status group by order_id) os INNER JOIN `order` o ON o.id = os.order_id INNER JOIN `user` u ON u.id=o.created_by INNER JOIN user_zones uz ON o.created_by = uz.userID INNER JOIN user_areas ua ON o.created_by = ua.userID 
		// 	INNER JOIN product_order pa ON pa.order_id = o.id INNER JOIN product p ON pa.product_id = p.id INNER JOIN product_type pt ON pt.id = p.product_type_id". $extra . " $statusCondition ORDER BY o.id desc";
		$query = "Select * from ERP_ORDERS";
		$tpl -> AssignValue("qry",$query);
	}
	
 	$q = new splitResults($query);
	$orders []= '';
	if(isset($_GET['page']) && $_GET['page'] !=1) {
		$i=(($_GET['page']-1)*10)+1;
	}else{
		$i=1;
	}
    $count = 0;
	if(Num($q->out)) {
		$tpl -> Zone("export", "enabled");
		while($r=FetchAssoc($q->out)){
			$r['slno'] = $i;
			if($i%2 ==0) {
				$r['class'] = "two";
			}else {
				$r['class'] = "one";
			}
                        
			$r['fname'] 		= 	$order->getordermadeby($r['id'],'name');
			if($r['is_exported'] ==2){
				$r['exportstatus'] = 	'Exported';
			} else {
				$r['exportstatus'] = 	'New';
			}
			
			$r['statusflag'] 	= 	'';
			//$tpl -> Zone("editoption", "disabled");
			
			$orders[] = $r;
			$i++;
		}
		
		if($count == 0)
		{
			$tpl -> Zone("editoption", "disabled");
		}
		else
		{
			$tpl -> Zone("editoption", "enabled"); 
		}
		$tpl -> AssignValue("start", $q->start);
		$tpl -> AssignValue("end", $q->end);
		$tpl -> AssignValue("total", $q->total);
		$tpl -> AssignValue("split_results", $q->show());
 			
	} else {
		$tpl -> Zone("noorders", "enabled");
		$tpl -> Zone("export", "disabled");
		$tpl -> AssignValue("total", '0');
	}
	
	$tpl -> Loop("orders", $orders);
	$tpl -> CleanTags();
	$tpl -> CleanZones();
	LoadFrame($tpl -> Flush(1));
?>
<!-- <form method="post" action="export_order_csv.php" id="ReportForm">
<input type="hidden" name="qry" id="query">
</form> -->
<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript" src="js/jquery.ui.core.js"></script>
<script type="text/javascript" src="js/jquery.ui.widget.js"></script>
<script type="text/javascript" src="js/jquery.ui.datepicker.js"></script>
<script type="text/javascript" src="js/thickbox.js"></script>
<script type="text/javascript" src="js/erp_orders.js"></script>
<script type="text/javascript">
$(function() {
			   
		var dates = $('#fromdate, #todate').datepicker({
 			dateFormat: 'dd-mm-yy',
			changeMonth: true,
			numberOfMonths: 1,
			disabled: true,
			onSelect: function(selectedDate) {
				var option = this.id == "fromdate" ? "minDate" : "maxDate";
				var instance = $(this).data("datepicker");
				var date = $.datepicker.parseDate(instance.settings.dateFormat || $.datepicker._defaults.dateFormat, selectedDate, instance.settings);
				dates.not(this).datepicker("option", option, date);
			}
		});
	});
	
	// $('.orderreport').click(function() {
	// 	//$("#pageloader").fadeIn();
	// });

    function deleteOrder(id)
    {
        var params = {mode : '_delete_order', id : id};
        
        if(confirm("Are you sure to delete this Order? Press OK to continue."))
        {
            $.ajax({
                type : 'POST',
                url  : 'list_orders.php',
                data : params,
                dataType : 'json',
                success  : function(data)
                {
                    if(data.success == 'yes')
                    {
                        redirect('list_orders.php?action=1');
                    }
                }
            });
        }
    }

	$(window).load(function() {
		$("#pageloader").fadeOut("slow");
	})

	$('#button1').click(function() {
		$("#pageloader").fadeIn();
	})

	$('#button2').click(function() {
		$("#pageloader").fadeIn();
	})
	

</script>
