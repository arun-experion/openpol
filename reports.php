<?php 
	include("includes/initialize.php");
 	include(DIR_CLASSES . "order.php");
	require(DIR_CLASSES . "search.php");
	require(DIR_CLASSES . "splitresults.php");

	$perm = array('access_admin','take_report','delivery_report');
	checkpermission($perm);
	$tpl = new template();
	$order = new Order();
 	$tpl -> Load(TEMPLATE_PATH . "reports.tpl");
	
	if(isset($_SESSION['message'])) {
		$tpl -> AssignValue("message", $_SESSION['message']);	
	}
	$myACL = new ACL();
	 
	if($myACL->hasPermission('delivery_report') || $_SESSION['id'] == 1){ 
 		$tpl -> Zone("deliverydatesearch", "enabled");
	} 	
	if($myACL->hasPermission('take_report') || $_SESSION['id'] == 1){ 
 		$tpl -> Zone("reportsearch", "enabled");
	} 
		
	//set order status
	$orderstatustype[''] = 'Select Order status';
	$orderstatustype['0'] = 'Orders Booked';
	$orderstatustype['11'] = 'Orders  Rejected';
	$orderstatustype['7'] = 'Pending Orders';
	$orderstatustype['10'] = 'Fullfilled Orders';
	if(isset($_GET['order_status_type']) && $_GET['order_status_type'] !=''){
		$tpl -> AssignValue("select_orderstatus", createSelect("order_status_type", $orderstatustype, $_GET['order_status_type'], 'class="listmenus" style="width:240px;"'));
	}else{
		$tpl -> AssignValue("select_orderstatus", createSelect("order_status_type", $orderstatustype, '', 'class="listmenus" style="width:240px;"'));
	}	
 	
	// get all products
	$options[''] = 'Select Product';
	$q_ptype = Query("SELECT name,id FROM product");		
		while($r_ptype = FetchAssoc($q_ptype)) {
			$options[$r_ptype["id"]] = $r_ptype["name"];
		}
	if(isset($_GET['product']) && $_GET['product'] !=''){
 		$tpl -> AssignValue("products", createSelect("product", $options,$_GET['product'],'class="listmenus" style="width:240px;"'));
	}else{
 		$tpl -> AssignValue("products", createSelect("product", $options,'','class="listmenus" style="width:240px;"'));
	}
	//Get BA
	$q_user = Query("SELECT u.*, t.* FROM user u, user_roles t WHERE t.roleID REGEXP '^2$' AND u.status REGEXP '1' AND u.id=t.userID");	
	$ba[''] ='Select BA';	
	$bausers = "<select class='listmenus' style='width:240px;' name='ba'><option>Select BA</option>";
	while($r_user = FetchAssoc($q_user)) {
		$ba[$r_user["id"]] = $r_user["first_name"].' '.$r_user["last_name"];
		if( (isset($_GET['ba']) && $_GET['ba'] !='') && ($r_user["id"] == $_GET['ba'])){ $selected = "selected='selected'";}else{ $selected = ""; }
		$bausers .="<option value=".$r_user["id"]." ".$selected.">".$r_user["first_name"].' '.$r_user["last_name"]."</option>";
	}
	$bausers .= "</select>";
	if(isset($_GET['ba']) && $_GET['ba'] !='') { 
		//$tpl -> AssignValue("select_ba", createSelect("ba", $ba, '', 'class="listmenus" style="width:240px;"'));
 		$tpl -> AssignValue("select_ba", $bausers);
	}else{  
		$tpl -> AssignValue("select_ba", createSelect("ba", $ba, '', 'class="listmenus" style="width:240px;"'));
	}
	
	if((isset($_GET['deliverydatesearch']))||(isset($_GET['reportsearch']))){
		
		if(isset($_GET['deliverydatesearch'])) {
		
			//conditions based on login
			$extra ='';
			$condition = array();
			if($_SESSION['utype'] == 'BA') {
				 $extra =" AND o.created_by = {$_SESSION['id']}";		
			}else if($_SESSION['utype'] == 'AM'){
				 $extra =" AND u.area_id = {$_SESSION['areaid']}";
			}else if($_SESSION['utype'] == 'ZH'){
				 $extra =" AND u.zone_id = {$_SESSION['zoneid']}";		
			}
		 
		 
			$extracondition = "";
			if($_GET['from']!='' && $_GET['to'] !='') {
				$tpl -> AssignValue("from", $_GET['from']);
				$tpl -> AssignValue("to", $_GET['to']);
				$from = date('Y-m-d', strtotime($_GET['from']));
				$to = date('Y-m-d', strtotime($_GET['to']));
				$extracondition .=" AND DATE_FORMAT(po.delivery_date, '%Y-%m-%d') >=  '".$from."' AND DATE_FORMAT(po.delivery_date, '%Y-%m-%d') <=  '".$to."'";
			}	 
			 
		 $query= "SELECT po.order_id,po.product_id, o.order_no, o.id, o.created_by, FORMAT(po.value,2) as value, po.quantity, DATE_FORMAT(po.delivery_date, '%Y-%m-%d') as delivery_date, p.name, p.code FROM `product_order` po, `order` o, `product` p, `user` u where po.order_id=o.id" . $extracondition . " AND p.id=po.product_id and u.id=o.created_by".$extra." and o.status = 1 order by po.delivery_date DESC";
	}
	
	else if((isset($_GET['reportsearch']))){
	
		$extra ='';
		$condition = array();	   
		$extracondition = "";
		
		if($_GET['startdate']!='' && $_GET['enddate'] !='') {
			$tpl -> AssignValue("startdate", $_GET['startdate']);
			$tpl -> AssignValue("enddate", $_GET['enddate']);
			$from = date('Y-m-d', strtotime($_GET['startdate']));
			$to = date('Y-m-d', strtotime($_GET['enddate']));
			$extracondition .=" AND DATE_FORMAT(o.created_date, '%Y-%m-%d') >=  '".$from."' AND DATE_FORMAT(o.created_date, '%Y-%m-%d') <=  '".$to."'";
		}	
		
		if(isset($_GET['product']) && $_GET['product'] !=''){
			$product_id = $_GET['product'];
			$extracondition .=" AND po.product_id=$product_id";
		} 
		
		if(isset($_GET['order_status_type']) && $_GET['order_status_type'] !=''){
			$status_type = $_GET['order_status_type'];
			switch($status_type){
				case 7:				
 				$extracondition .= " AND os.status !=11 and os.status < 8";
				break;	
							 
				case 11:
				$extracondition .=" AND os.status =11";
				break;
				
				case 10:				
 				$extracondition .= " AND os.status !=11 and os.status <=10 and os.status >=8";
				break;	
				
				default:				 
				$extracondition .= " ";
				break;
				
			}
		} 
		
		
		if(isset($_GET['ba'])&& $_GET['ba'] !='' && $_GET['ba'] !="Select BA"){
			$ba = $_GET['ba'];
			$extracondition .=" AND u.id=$ba";
		}
		
		if(isset($_GET['zone'])&& $_GET['zone'] !='' && $_GET['zone'] !=0){
			$zone_id = $_GET['zone'];
			$extracondition .=" AND u.zone_id=$zone_id";
		}
		
		if(isset($_GET['product_type']) && $_GET['product_type'] !='' && $_GET['product_type'] !=0){
			 $ptype = $_GET['product_type'];
			$extracondition .=" AND p.product_type_id=$ptype";
		}
			
	  $query = "SELECT po.order_id,po.product_id, o.order_no, o.id, o.created_by, po.value, po.quantity, DATE_FORMAT(po.delivery_date, '%Y-%m-%d') as delivery_date, p.name, p.code From  (Select order_id,MAX(current_status) as status from order_status group by order_id) os INNER JOIN `order` o ON o.id = os.order_id INNER JOIN `user` u ON u.id=o.created_by INNER JOIN `product_order` po ON po.order_id=o.id INNER JOIN `product` p ON p.id=po.product_id ".$extracondition." where o.status = 1 ORDER BY o.id desc"; 
	 
	}
		$tpl -> AssignValue("qry",$query);	
		$q = new splitResults($query);
		$orders []= '';
		if(isset($_GET['page']) && $_GET['page'] !=1) {
			$i=(($_GET['page']-1)*10)+1;
		}else{
			$i=1;
		}
		if(Num($q->out)) {
 		$totalamt = 0;
			$tpl -> Zone("export", "enabled");
			while($r=FetchAssoc($q->out)){	
  				$r['slno'] = $i;
				if($i%2 ==0) {
					$r['class'] = "two";
				}else {
					$r['class'] = "one";
				}		
				$r['fname'] = $order->getordermadeby($r['created_by'],'name');
				$totalamt += $r['value'];
  				$orders[] = $r;
				$i++;
			}
 		 
 	 $ordercnt_query = Query("SELECT SUM(po.value) as value From  (Select order_id,MAX(current_status) as status from order_status group by order_id) os INNER JOIN `order` o ON o.id = os.order_id INNER JOIN `user` u ON u.id=o.created_by INNER JOIN `product_order` po ON po.order_id=o.id INNER JOIN `product` p ON p.id=po.product_id ".$extracondition." where o.status = 1 ORDER BY o.id desc"); 
	 
	  $ocnt = Num(Query("SELECT distinct(o.id) From  (Select order_id,MAX(current_status) as status from order_status group by order_id) os INNER JOIN `order` o ON o.id = os.order_id INNER JOIN `user` u ON u.id=o.created_by INNER JOIN `product_order` po ON po.order_id=o.id INNER JOIN `product` p ON p.id=po.product_id ".$extracondition." where o.status = 1 ORDER BY o.id desc")); 
	  
	   $pocnt = Num(Query("SELECT distinct(po.product_id) From  (Select order_id,MAX(current_status) as status from order_status group by order_id) os INNER JOIN `order` o ON o.id = os.order_id INNER JOIN `user` u ON u.id=o.created_by INNER JOIN `product_order` po ON po.order_id=o.id INNER JOIN `product` p ON p.id=po.product_id ".$extracondition." where o.status =1 ORDER BY o.id desc")); 
 	   
			$tpl -> AssignValue("prdcnt", $pocnt);
			$amtord =0;
 			$tpl -> AssignValue("totalorders", $ocnt);
			$oarray = FetchAssoc($ordercnt_query);			 
			$tpl -> AssignValue("ordertotalsum", number_format($oarray['value'],2));
			$tpl -> AssignValue("start", $q->start);
			$tpl -> AssignValue("end", $q->end);
			$tpl -> AssignValue("total", $q->total);
			$tpl -> AssignValue("split_results", $q->show());
				
		 }else{
			  $orders[] ="";
			  $tpl -> AssignValue("prdcnt", "0");
			  $tpl -> Zone("noorders", "enabled");
			  $tpl -> Zone("export", "disabled");
			  $tpl -> AssignValue("total", '0');
			  $tpl -> AssignValue("totalorders", 0);
			  $tpl -> AssignValue("ordertotalsum", 0);
		 }
	
	
	
}else{
	$orders[] ="";
	$tpl -> Zone("noorders", "enabled");
	$tpl -> Zone("export", "disabled");
	$tpl -> AssignValue("total", '0');
	$tpl -> AssignValue("prdcnt", "0");
	$tpl -> AssignValue("totalorders", 0);
	$tpl -> AssignValue("ordertotalsum", 0);
}
	$tpl -> Loop("orders", $orders);
	$tpl -> CleanTags();
	$tpl -> CleanZones();
	LoadFrame($tpl -> Flush(1));
?>
<!--<script type="text/javascript" src="js/jquery.js"></script>-->
<script type="text/javascript" src="js/jquery-3.6.4.min.js"></script>
<script type="text/javascript" src="js/jquery.ui.core.js"></script>
<script type="text/javascript" src="js/jquery.ui.widget.js"></script>
<script type="text/javascript" src="js/jquery.ui.datepicker.js"></script>
<script type="text/javascript" src="js/thickbox.js"></script>
<script type="text/javascript">
$(function() {
			   
		var dates = $('#formtextfiledsomall, #totextfiledsomall').datepicker({
 			dateFormat: 'dd-mm-yy',
			changeMonth: true,
			numberOfMonths: 1,
			disabled: true,
			onSelect: function(selectedDate) {
				var option = this.id == "formtextfiledsomall" ? "minDate" : "maxDate";
				var instance = $(this).data("datepicker");
				var date = $.datepicker.parseDate(instance.settings.dateFormat || $.datepicker._defaults.dateFormat, selectedDate, instance.settings);
				dates.not(this).datepicker("option", option, date);
			}
		});
 	
	
	var deliverydates = $('#deliveryfromdate, #deliverytodate').datepicker({
 			dateFormat: 'dd-mm-yy',
			changeMonth: true,
			numberOfMonths: 1,
			disabled: true,
			onSelect: function(selectedDate) {
				var option = this.id == "deliveryfromdate" ? "minDate" : "maxDate";
				var instance = $(this).data("datepicker");
				var ddate = $.datepicker.parseDate(instance.settings.dateFormat || $.datepicker._defaults.dateFormat, selectedDate, instance.settings);
				deliverydates.not(this).datepicker("option", option, ddate);
			}
		});
	});
	
	$('.reportsearch').click(function() {
		var qry 	= $("#qry").val();		
		document.location.href ='export_report.php?qry='+qry ;
	 }); 

</script>