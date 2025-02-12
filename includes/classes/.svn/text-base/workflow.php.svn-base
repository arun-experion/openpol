<?php

class Workflow {
	
	var $options = array();
	
	function getoptionlist($status, $user_role) {
 
 		$query = Query("SELECT w.*, s.* FROM `[x]workflow` w, `[x]status` s WHERE w.status={$status} AND w.user_role={$user_role} AND s.id=w.next AND s.complaint=0");
		if(Num($query)) {
			while($result = FetchAssoc($query)) {
				$options[] = $result;
			}
			return $options;
		}
	}
	
	function getcomplaintoptionlist($status, $user_role) { 
 
 		$query = Query("SELECT w.*, s.* FROM `[x]workflow` w, `[x]status` s WHERE w.status={$status} AND w.user_role={$user_role} AND s.id=w.next AND s.complaint=1");
		if(Num($query)) {
			while($result = FetchAssoc($query)) {
				$options[] = $result;
			}
			return $options;
		}
	}
}