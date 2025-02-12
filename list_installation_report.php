<?php  
	include("includes/initialize.php");
 	include(DIR_CLASSES . "order.php");
	require(DIR_CLASSES . "search.php");
	require(DIR_CLASSES . "splitresults.php");

	$perm = array('add_order');
	checkpermission($perm);
	$tpl = new template();
	$order = new Order();
 	$tpl -> Load(TEMPLATE_PATH . "list_installation_report.tpl");
	
	$query= "SELECT install.order_no,install.id,install.created_by,DATE_FORMAT(install.end_date, ".SHORT_DATE." ) as install_date,  p.name as name FROM product AS p,product_installation AS install WHERE install.product_id = p.id ORDER BY install.id DESC";
        if(isset($_GET['p name'])||isset($_GET['number']))
	    {
        $condition  = "";
        if(isset($_GET['pname'])){
         $pname =  trim($_GET['pname']); 
		if(strlen($pname)>0){ 
        $condition.="AND p.name LIKE '$pname%'";
		}
        $tpl -> AssignValue("pname", $pname);
        }
        if(isset($_GET['number'])){
        $order_no = trim($_GET['number']);
		if(strlen($order_no)>0){
        $condition.=" AND  install.order_no LIKE '$order_no%'";
		}
        $tpl -> AssignValue("number", $order_no);
        }
         $query= "SELECT install.order_no,install.id,install.created_by,DATE_FORMAT(install.end_date, ".SHORT_DATE." )
		 as install_date,p.name FROM product AS p,product_installation AS install WHERE install.product_id = p.id $condition 
		 ORDER BY install.id DESC";
        }
	
    $q = new splitResults($query);
	$reports[]= '';
	if(isset($_GET['page']) && $_GET['page'] !=1) {
		$i=(($_GET['page']-1)*10)+1;
	}else{
		$i=1;
	}
	if(Num($q->out)) {
		while($r=FetchAssoc($q->out)){
			$r['slno'] = $i;
			if($i%2 ==0) {
				$r['class'] = "two";
			}else {
				$r['class'] = "one";
			}	
		   $userq= Query("SELECT first_name,last_name FROM `[x]user` WHERE id=".$r['created_by']);	 
           if(Num($userq)){
			  $result = FetchAssoc($userq);		 	 
			  $r['ba_name'] =$result['first_name']." ".$result['last_name']; 
		  }
				
			
			$reports[] = $r;
			$i++;
		}
		
		$tpl -> AssignValue("start", $q->start);
		$tpl -> AssignValue("end", $q->end);
		$tpl -> AssignValue("total", $q->total);
		$tpl -> AssignValue("split_results", $q->show());
 			
	 }else{
		  $tpl -> Zone("noresults", "enabled");
		  $tpl -> AssignValue("total", '0');
	 }
	if(isset($_SESSION['message'])) {
		$tpl -> AssignValue("message", $_SESSION['message']);	
	}
	$tpl -> Loop("reports", $reports);
    if($_SESSION['utype'] !=="BA"){	 
	$tpl -> Zone("ba", "enabled");
	} 
	$tpl -> CleanTags();
	$tpl -> CleanZones();
	LoadFrame($tpl -> Flush(1));
?>
