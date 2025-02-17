<?php
/**
 * TPL :: Order Management Software
 *
 * @copyright		Copyright (c) Terumo Penpol. All rights reserved.
 * @category 		Order Processing
 * @identity		Terumo Penpol is India's largest manufacturer of Blood Bags. This web portal would help order management. 
 * @author			Syamnath
 * @version			$Id: complaint.php  Wednessday, july 15, 2010, 03:18:41 PM $
 *		
 */
 
class Complaint
{
	function getComplaintStatus($cid) { 		
	
  		$cmpstatus= Query("SELECT c.comment, c.updated_by, c.current_status, DATE_FORMAT(c.updated_date , ".SHORT_DATE_WITHTIME." ) as updated_date, u.first_name, u.last_name FROM `[x]complaint_status` c, `[x]user` u, `[x]status` s where complaint_id={$cid} and u.id=c.updated_by and s.id = c.current_status order by c.updated_date");
 		$i=0;
		if(Num($cmpstatus)) {
		  	while($r = FetchAssoc($cmpstatus)) {
				$r['slno'] = $i;
				if($i%2 ==0) {
					$r['class'] = 'one';
				}else { 
					$r['class'] = 'two';
				}
				$complaintremarks = $this->getstatusname($r['current_status']);
				$r['cstatus'] = $complaintremarks['status'];
				$r['action'] = $complaintremarks['action'];
 				$r['doneby'] = $this->getdoenby($r['updated_by']);
 				$result[] =$r;
				$i++;
			}	
			
 	 	 	return $result;
		}	
	}
	
	function getcurrentcomplaintstatus($cid) { 
 		$complaintstatus= Query("SELECT c.current_status,s.ba_visibility FROM `[x]complaint_status` c, `[x]status` s  where c.complaint_id={$cid} and c.current_status=s.id order by c.id desc limit 0,1");
		if(Num($complaintstatus)) {
		  	 $r = FetchAssoc($complaintstatus);				  
   		  		return $r['current_status'];			 
		 }
	}
	
	function getstatusname($sid) {
		
			$cmpstatus= Query("SELECT * FROM `[x]status` where id={$sid}");
			if(Num($cmpstatus)) {
				$r = FetchAssoc($cmpstatus);
				return $r;
			 }	
	}
	
	function getdoenby($utid) {
 	$q= Query("SELECT r.roleName FROM `roles` r, `user_roles` ur WHERE ur.userID ={$utid} AND r.ID = ur.roleId");	 
 
		 if(Num($q))
		 {
			 while($r = FetchAssoc($q)){
				$utype  = $r;
				}
			  return $utype['roleName'];
		 }
	}
	
	function getworkflows() {
		$workflowquery = Query("SELECT * FROM workflow where complaint=1");
			if(Num($workflowquery)) {
			$i=0;
				while($workflowresult = FetchAssoc($workflowquery)) {
					if($i%2 ==0) {
						$workflowresult['class'] = "two";
					}else {
						$workflowresult['class'] = "one";
					}		
					$workflowresult['role'] =$this->getrolename($workflowresult['user_role']);
					$getstatus =$this->getstatusname($workflowresult['status']);
					$workflowresult['statusname'] = $getstatus['status'];
					$getnextstatus =$this->getstatusname($workflowresult['next']);
					$workflowresult['nextstatus'] = $getnextstatus['status'];
					$workflows[] = $workflowresult;
					$i++;
				}
				
				return $workflows;
			}
	}
	
	function getrolename($rid) {	
		$query= Query("SELECT roleName FROM `[x]roles` WHERE ID='{$rid}'");		
		 if(Num($query))
		 {
		  $result = FetchAssoc($query);		 	 
		  return $result['roleName'];
		 }
	}
	
	function dasboardcomplaints($from,$to){ 
	
		$extra = '';
 		if($_SESSION['utype'] == 'SE') {			
			 $extra =" AND pc.created_by = {$_SESSION['id']}";		
 		}else if($_SESSION['utype'] == 'AM'){
			$extra =" AND u.area_id = {$_SESSION['areaid']}";
 		}else if($_SESSION['utype'] == 'ZH'){
			$extra =" AND u.zone_id = {$_SESSION['zoneid']}";		
 		}
		 
		$cmpnum= Num(Query("SELECT pc.id FROM `[x]product_complaint` pc, user u where  DATE_FORMAT(pc.created_date, '%Y-%m-%d') >= '".$from."' AND DATE_FORMAT(pc.created_date, '%Y-%m-%d') <= '".$to."' AND pc.created_by=u.id" . $extra));
		return $cmpnum;
	}
	
	function getComplaintMailGroup($cmptype){   
		$reults_email =[];
		$query=Query("SELECT * FROM email_group Where name='".$cmptype."'");
		if(Num($query)){
			$result  = Fetch($query);
			$userids = $result['user_id'];
			$userids_array = explode(",",$userids);
			$count = sizeof($userids_array);
			 
				for($i=0;$i<$count;$i++){
					$emailids=FetchAssoc(Query("SELECT id,email,first_name,last_name,zone_id,area_id FROM `[x]user` Where id=".$userids_array[$i]));
					$emailids['rolename'] = getUserType($emailids['id']);
					$reults_email[] = $emailids;
				} 
			 
		}
		return $reults_email; 
	}
}	
	