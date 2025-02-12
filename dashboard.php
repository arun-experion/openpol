<?php  
/**
 * TPL :: Order Management Software
 *
 * @copyright		Copyright (c) Terumo Penpol. All rights reserved.
 * @category 		Order Processing
 * @identity		Terumo Penpol is India's largest manufacturer of Blood Bags. This web portal would help order management. 
 * @author			Syamnath
 * @version			$Id: dashboard.php  Wednessday, June 3, 2010, 10:47:41 AM $
 *		
 */

	include("includes/initialize.php");
	include(DIR_CLASSES . "order.php");
	include(DIR_CLASSES . "complaint.php");
	$order = new Order();
	$complaint = new Complaint();
 	 
  	$tpl = new template();
	$tpl -> Load(TEMPLATE_PATH . "dashboard.tpl");
	if(!isset($_SESSION['id'])) {
	 reload("login.php");	  
	}
	$zone_id=0;
	$product_type_id=0;
	$tpl -> Zone("select", "enabled");
	// select zone
	$zonequery = Query("SELECT * FROM `[x]zone`");	
	$zoneoptions[""]	='---Select Zone---';
	$zoneoptions[0]	='All Zone';
	while($zoneresults = FetchAssoc($zonequery)) {
		$zoneoptions[$zoneresults["id"]] = $zoneresults["name"];
	}
	$myACL = new ACL();
	$reportpermission = $myACL->hasPermission('take_report');
	if($reportpermission || $_SESSION['id'] ==1){
		if(isset($_GET['zone']) && $_GET['zone'] != "") {
			$tpl -> AssignValue("select_zone", createSelect("zones", $zoneoptions,$_GET['zone']));
		}else{
			$tpl -> AssignValue("select_zone", createSelect("zones", $zoneoptions));
		}
	}
	
		 
	//Get Product type
	$q_ptype = Query("SELECT * FROM product_type");	
	$options[""]	='---Select Category---';
	$options["0"]	='All Category';	
	while($r_ptype = FetchAssoc($q_ptype)) {
		$options[$r_ptype["id"]] = $r_ptype["name"];
	}
	if(isset($_GET['product_type']) && $_GET['product_type'] !="") {
	$tpl -> AssignValue("select_producttype", createSelect("product_type", $options,$_GET['product_type']));
	}else{
	$tpl -> AssignValue("select_producttype", createSelect("product_type", $options));
	}	
		
	if(isset($_GET['zone'])) {
		$zone_id=$_GET['zone'];
	}
	
	if(isset($_GET['product_type'])) {
		$product_type_id=$_GET['product_type'];
	}	
        $tpl -> AssignValue("selected_zone", $zone_id);
		$tpl -> AssignValue("selected_type", $product_type_id);
	//calculation of firstday and last day of a month, get quarter and year
	$currentTime         = time();
	$dateTime            = getdate($currentTime);
	$currentFullYear     = $dateTime["year"];
	$currentMonthNumeric = $dateTime["mon"];
	$firstDayOfTheMonth  = date('Y-m-d',mktime(0,0,0,$currentMonthNumeric,1,$currentFullYear));
	$lastDayOfTheMonth   = date('Y-m-d',mktime(0,0,0,$currentMonthNumeric + 1,0,$currentFullYear));
   	$today = date('Y-m-d');
 	  $q=Query("SELECT DATE_FORMAT(from_date , '%Y-%m-%d' ) as from_date , DATE_FORMAT(to_date , '%Y-%m-%d' ) as to_date FROM `quarter` WHERE '".$today."' BETWEEN `from_date` AND `to_date`");
	  
	//$r = '';
 	if(Num($q)){
		$r = FetchAssoc($q);
		$tpl -> AssignValue("quarterstartdate", $r['from_date']);
		$tpl -> AssignValue("quarterenddate", $r['to_date']);
		//this quarter all orders

		$thisquarter = $order->dasboardallorder($r['from_date'],$r['to_date'],0,$zone_id,$product_type_id);
		$tpl -> AssignValue("thisquarternumber", $thisquarter['number']);
		$tpl -> AssignValue("thisquartertotal", number_format($thisquarter['total'],2));
		
		if($reportpermission || $_SESSION['id'] ==1){
		$tpl -> AssignValue("thisquaterallorderlink", "<a href='reports.php?q=&startdate=".$r['from_date']."&status=0&enddate=".$r['to_date']."&product_type=".$product_type_id."&zone=".$zone_id."&reportsearch=Search&type=all&order_status_type=0'>".$thisquarter['number']."</a>");
		}else{
		$tpl -> AssignValue("thisquaterallorderlink", $thisquarter['number']);
		}
	
		//this quarter fulfilled orders
		$thisquarterfulfilled = $order->dasboardallorder($r['from_date'],$r['to_date'],8,$zone_id,$product_type_id);
		$tpl -> AssignValue("thisquarter_fullfilednumber", $thisquarterfulfilled['number']);
		$tpl -> AssignValue("thisquarter_fulfilledtotal", number_format($thisquarterfulfilled['total'],2));
		
		if($reportpermission || $_SESSION['id'] ==1){
		$tpl -> AssignValue("thisquaterfulfiledorderlink", "<a href='reports.php?q=&startdate=".$r['from_date']."&status=0&enddate=".$r['to_date']."&product_type=".$product_type_id."&zone=".$zone_id."&reportsearch=Search&type=fulfilled&order_status_type=10'>".$thisquarterfulfilled['number']."</a>");
		}else{
		$tpl -> AssignValue("thisquaterfulfiledorderlink", $thisquarterfulfilled['number']);
		}
		
		//this quarter cancelled orders
		$thisquartercancelled = $order->dasboardallorder($r['from_date'],$r['to_date'],11,$zone_id,$product_type_id);
		$tpl -> AssignValue("thisquarter_cancellednumber", $thisquartercancelled['number']);
		$tpl -> AssignValue("thisquarter_cancelledtotal", number_format($thisquartercancelled['total'],2));
		
		$tpl -> AssignValue("thisquartercomplaint", $complaint->dasboardcomplaints($r['from_date'],$r['to_date']));
		
		if($reportpermission || $_SESSION['id'] ==1){
		$tpl -> AssignValue("thisquatercancelledorderlink", "<a href='reports.php?q=&startdate=".$r['from_date']."&status=0&enddate=".$r['to_date']."&product_type=".$product_type_id."&zone=".$zone_id."&reportsearch=Search&order_status_type=11'>".$thisquarterfulfilled['number']."</a>");
		}else{
		$tpl -> AssignValue("thisquatercancelledorderlink", $thisquarterfulfilled['number']);
		}
	
	}
 	 $yearstart = date('Y-m-d', mktime(0, 0, 0, 4 , 1, date('Y')));
	 $yearend = date('Y-m-d', mktime(23, 59, 59, 03, 31, date('Y')+1));
	//calculation ends
	
	
	
	
	$tpl -> AssignValue("firstdayofmonth", $firstDayOfTheMonth);
	$tpl -> AssignValue("lastdayofmonth", $lastDayOfTheMonth);	
	$tpl -> AssignValue("yearstartdate", $yearstart);
	$tpl -> AssignValue("yearenddate", $yearend);
	
	//this month all orders		
	$thismonth = $order->dasboardallorder($firstDayOfTheMonth,$lastDayOfTheMonth,0,$zone_id,$product_type_id);
	$tpl -> AssignValue("thismonthnumber", $thismonth['number']);
	$tpl -> AssignValue("thismonthtotal", number_format($thismonth['total'],2));
	
	if($reportpermission || $_SESSION['id'] ==1){
		$tpl -> AssignValue("thismonthallorderlink", "<a href='reports.php?q=&startdate=".$firstDayOfTheMonth."&status=0&enddate=".$lastDayOfTheMonth."&product_type=".$product_type_id."&zone=".$zone_id."&reportsearch=Search&type=all&order_status_type=0'>".$thismonth['number']."</a>");
	}else{
		$tpl -> AssignValue("thismonthallorderlink", $thismonth['number']);
	}
	//this month fullfilled orders		
	$thismonthfullfilled = $order->dasboardallorder($firstDayOfTheMonth,$lastDayOfTheMonth,8,$zone_id,$product_type_id);
	$tpl -> AssignValue("thismonth_fullfilednumber", $thismonthfullfilled['number']);
	$tpl -> AssignValue("thismonth_fulfilledtotal", number_format($thismonthfullfilled['total'],2));
	if($reportpermission || $_SESSION['id'] ==1){
		$tpl -> AssignValue("thismonthfullfiledorderlink", "<a href='reports.php?q=&startdate=".$firstDayOfTheMonth."&status=0&enddate=".$lastDayOfTheMonth."&product_type=".$product_type_id."&zone=".$zone_id."&reportsearch=Search&type=fulfilled&order_status_type=10'>".$thismonthfullfilled['number']."</a>");
	}else{
		$tpl -> AssignValue("thismonthfullfiledorderlink", $thismonthfullfilled['number']);
	}
	//this month cancelled orders
	$thismonthcancelled = $order->dasboardallorder($firstDayOfTheMonth,$lastDayOfTheMonth,11,$zone_id,$product_type_id);
	$tpl -> AssignValue("thismonth_cancellednumber", $thismonthcancelled['number']);
	$tpl -> AssignValue("thismonth_cancelledtotal", number_format($thismonthcancelled['total'],2));
	
	if($reportpermission || $_SESSION['id'] ==1){
		$tpl -> AssignValue("thismonthcancelledorderlink", "<a href='reports.php?q=&startdate=".$firstDayOfTheMonth."&status=0&enddate=".$lastDayOfTheMonth."&product_type=".$product_type_id."&zone=".$zone_id."&reportsearch=Search&order_status_type=11'>".$thismonthcancelled['number']."</a>");
	}else{
		$tpl -> AssignValue("thismonthcancelledorderlink", $thismonthcancelled['number']);
	}
	
		
	//this year all orders
	$thisyear = $order->dasboardallorder($yearstart,$yearend,0,$zone_id,$product_type_id);
	$tpl -> AssignValue("thisyearnumber", $thisyear['number']);
	$tpl -> AssignValue("thisyeartotal", number_format($thisyear['total'],2));	
	
	if($reportpermission || $_SESSION['id'] ==1){
		$tpl -> AssignValue("thisyearallorderlink", "<a href='reports.php?q=&startdate=".$yearstart."&status=0&enddate=".$yearend."&product_type=".$product_type_id."&zone=".$zone_id."&reportsearch=Search&type=all&order_status_type=0'>".$thisyear['number']."</a>");
	}else{
		$tpl -> AssignValue("thisyearallorderlink", $thisyear['number']);
	}
	
	//this year fulfilled orders
	$thisyearfulfilled = $order->dasboardallorder($yearstart,$yearend,8,$zone_id,$product_type_id);
	$tpl -> AssignValue("thisyear_fulfillednumber", $thisyearfulfilled['number']);
	$tpl -> AssignValue("thisyear_fulfilledtotal", number_format($thisyearfulfilled['total'],2));	
	if($reportpermission || $_SESSION['id'] ==1){
		$tpl -> AssignValue("thisyearfulfiledorderlink", "<a href='reports.php?q=&startdate=".$yearstart."&status=0&enddate=".$yearend."&product_type=".$product_type_id."&zone=".$zone_id."&reportsearch=Search&type=fulfilled&order_status_type=10'>".$thisyearfulfilled['number']."</a>");
	}else{
		$tpl -> AssignValue("thisyearfulfiledorderlink", $thisyearfulfilled['number']);
	}
	//this year cancelled orders
	$thisyearcancelled = $order->dasboardallorder($yearstart,$yearend,11,$zone_id,$product_type_id);
	$tpl -> AssignValue("thisyear_cancellednumber", $thisyearcancelled['number']);
	$tpl -> AssignValue("thisyear_cancelledtotal", number_format($thisyearcancelled['total'],2));
	if($reportpermission || $_SESSION['id'] ==1){
		$tpl -> AssignValue("thisyearcancelledorderlink", "<a href='reports.php?q=&startdate=".$yearstart."&status=11&enddate=".$yearend."&product_type=".$product_type_id."&zone=".$zone_id."&reportsearch=Search&order_status_type=11'>".$thisyearcancelled['number']."</a>");
	}else{
		$tpl -> AssignValue("thisyearcancelledorderlink", $thisyearcancelled['number']);
	}
	
 	$tpl -> AssignValue("thismonthcomplaint", $complaint->dasboardcomplaints($firstDayOfTheMonth,$lastDayOfTheMonth));
	$tpl -> AssignValue("thisyearcomplaint", $complaint->dasboardcomplaints($yearstart,$yearend));
	
	$tpl -> CleanTags();
	$tpl -> CleanZones();
	LoadFrame($tpl -> Flush(1));
?>
<!--<script type="text/javascript" src="js/jquery.js"></script>-->
<script type="text/javascript" src="js/jquery-3.6.4.min.js"></script>
<script type="text/javascript" src="js/dashboard.js"></script>