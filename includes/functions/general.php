<?php

function reload($location, $pause = 0) {
    if (!headers_sent() && $pause != 0) {
        header("Location: $location");
        exit;
    } else {
        echo "<meta http-equiv=\"refresh\" content=\"{$pause};url={$location}\">";
        exit;
    }
}

function optionsList($name, $selected = '') {

    $select = '<select name="' . $name . '" id="' . $name . '">';
    $q = Query("SELECT * FROM `[x]options_list` WHERE options_group='{$name}' ORDER BY name ASC");
    while($r = Fetch($q)) {
        $sel = '';
        if($selected != '') {
            if($r['value'] == $selected) {
                $sel = ' selected="selected"';
            }
        } elseif($r['selected'] == 1) {
            $sel = ' selected="selected"';
        }
        $select .= '<option value="' . $r['value'] . '"' . $sel . '>' . $r['name'] . '</option>';
    }
    $select .= '</select>';
    return $select;
}

function createSelect($name, $options, $selected='', $params = '') {
			
    $select = '<select name="' . $name . '" id="' . $name . '" '. $params .'>';
    // while (list($id, $name) = each($options)) {
    foreach($options as $id => $name) {
        $sel = '';
        if($selected != '') {
            if($id == $selected) {
                $sel = ' selected="selected"';
            }
        }
        $select .= '<option value="' . $id . '"' . $sel . '>' . $name . '</option>';
    }
    $select .= '</select>';
    //print_r($options);
    return $select;
}

function createMultiSelect($name, $options, $selected='', $params = '') {
		$mainid = $name;
        $select = '';
    // while (list($id, $name) = each($options)) {
    foreach($options as $id => $name) {
        $sel = '';
        if (!is_array($selected)) {
            $selected = empty($selected) ? [] : [$selected];
        }
        if($selected != '') {
          if(in_array($id, $selected)) {
              $sel = ' checked';
          }
        }
        $select .= '<input type="checkbox" name="' . $mainid . '[]" class="' . $mainid . '" value="' . $id . '"' . $sel . '> ' . $name. '<br>';
    }
    //print_r($options);
    return $select;
}

function loadSessions($user_id,$area_id,$zone_id) {
 
    	$_SESSION['id'] = $user_id;    
		$result= Fetch(Query("SELECT ur.roleID, r.roleName FROM `user_roles` ur, `roles` r WHERE ur.userID = {$user_id} AND r.ID = ur.roleID"));	
	$_SESSION['rid'] = $result['roleID'];
	
   	 if($result['roleName'] == 'Business Associate') {
		$_SESSION['utype'] = 'BA'; 
		$_SESSION['zoneid'] = $zone_id;
		$_SESSION['areaid'] = $area_id;
	 }else if($result['roleName'] == 'Area Manager') {
	 	$_SESSION['utype'] = 'AM'; 
		$_SESSION['areaid'] = $area_id;
	 }else if($result['roleName'] == 'Zonal Head' || $result['roleName'] == 'Regional Sales Manager') {
	 	$_SESSION['utype'] = 'ZH'; 
		$_SESSION['zoneid'] = $zone_id;
	 }else if($result['roleName'] == 'Sales & Service Engineer') {
	 	$_SESSION['utype'] = 'SE'; 
		$_SESSION['zoneid'] = $zone_id;
		$_SESSION['areaid'] = $area_id;
	 }else{
	 	$_SESSION['utype'] = 'officers'; 
	 }
	
 
}

function setCookies($user_id, $cookie_name = "user") {
    if(testCookie()) {
        setcookie($cookie_name, base64_encode($user_id), time() + COOKIE_EXP_TIME);
    } else header("Location: cookie.php");
}

function clearCookies() {
    setcookie("user", '', time()-3600);
    setcookie("vKey", '', time()-3600);
}

function testCookie() {
    if(!empty($_COOKIE['test']))
        return true;
    return false;
}
//Set Test Cookie
setcookie("test","ok", time() + COOKIE_EXP_TIME + 3600);

function logout() {
    $_SESSION = array();
  //  unset($GLOBALS["SELF_DATA"]);
    session_destroy();
  //  clearCookies();
    reload(HTTP_SERVER);
	
}

function checkLoggedIn() {
	global $navigation;
    if(!isset($_SESSION['id'])) {
        reload(HTTP_SERVER . 'login.php?return=' .urlencode($navigation->currentpage));
        exit;
    }
    return true;
}

function checkpermission($perm) {
	global $navigation;
	if(!isset($_SESSION['id'])) {
        reload(HTTP_SERVER . 'login.php?return=' .urlencode($navigation->currentpage));
        exit;
    }
	
	$myACL = new ACL();
 	foreach($perm as $val)
	{
		if ($myACL->hasPermission($val) == true || $_SESSION['id'] ==1)
		{ 
			return true;
			exit;
		}
 	}
	reload("access_denied.php");
 }

function getUserData($uid) {
	$q= Query("SELECT id, erp_number, title, first_name, last_name, username, password, email, phone, mobile, address, zone_id, area_id, status, created_by, DATE_FORMAT(`created_date` , ".SHORT_DATE_WITHTIME." ) as created_date FROM `[x]user` WHERE id='{$uid}'");	 
 
	 if(Num($q))
	 {
	  $r = FetchAssoc($q);	 	 
	  return $r;
	 }

}


function getAllUser() {
 
	$q= Query("SELECT * FROM `[x]user`");
	if(Num($q))
	{
		while($r = FetchAssoc($q)){
		$users [] = $r;
		}
	   return $users;
	}
}

function getZoneName($zid) {
 
	$q= Query("SELECT name FROM `[x]zone` WHERE id='{$zid}'");	 
 
	 if(Num($q))
	 {
	  $r = FetchAssoc($q);		 	 
	  return $r['name'];
	 }
}

function getUserZoneName($uid) {

  $q= Query("SELECT zone.name  FROM `[x]user_zones` INNER JOIN `[x]zone` ON `[x]user_zones`.`zoneID` = `[x]zone`.`id` WHERE `userID` = ".$uid); 
   if(Num($q))
   {
    while($r = FetchAssoc($q)){
      $zones [] = $r['name'];
    }
    return implode(', ', $zones);
   }
}

function getUserAreaName($uid) {

  $q= Query("SELECT area.name  FROM `[x]user_areas` INNER JOIN `[x]area` ON `[x]user_areas`.`areaID` = `[x]area`.`id` WHERE `userID` = ".$uid); 
   if(Num($q))
   {
    while($r = FetchAssoc($q)){
      $zones [] = $r['name'];
    }
    return implode(', ', $zones);
   }
}


function getAreaName($aid) {
 
	$q= Query("SELECT name FROM `[x]area` WHERE id='{$aid}'");	 
 
	 if(Num($q))
	 {
	  $r = FetchAssoc($q);		 	 
	  return $r['name'];
	 }
}

function getUserType($utid) {
 	$q= Query("SELECT r.roleName FROM `roles` r, `user_roles` ur WHERE ur.userID ={$utid} AND r.ID = ur.roleId");	 
 
	 if(Num($q))
	 {
		 while($r = FetchAssoc($q)){
			$utype  = $r;
			}
		  return $utype['roleName'];
	 }
}

function getProductType($pid) {
 
	$q= Query("SELECT name FROM `[x]product_type` WHERE id='{$pid}'");	 
 
	 if(Num($q))
	 {
	  $r = FetchAssoc($q);		 	 
	  return $r['name'];
	 }
}

function getProductCategory($pid) {
 
	$q= Query("SELECT name FROM `[x]product_category` WHERE id='{$pid}'");	 
 
	 if(Num($q))
	 {
	  $r = FetchAssoc($q);		 	 
	  return $r['name'];
	 }
}

function messages($message) {
	$_SESSION['message'] = $message;
}

function formatDescription($desc) {
    $desc = strip_tags($desc);
    $desc = preg_replace("#(<a\s[^>]+>http://\S+</a>)|(<[^>]+http://[^>]+>)|http://\S+#ie",
                  '"$0"=="$1" || "$0"=="$2" ? "$0" : "<a href=\"$0\">$0</a>"',
                  $desc);
    return nl2br($desc);
}

function formatKeywords($keywords) {
    $keywords = str_replace(" ", "_", $keywords);
    return strtolower($keywords);
}

 

function strtrim($str, $maxlen=100, $elli=NULL, $maxoverflow=15) {
    
    if (strlen($str) > $maxlen) {
        
        $output = NULL;
        $body = explode(" ", $str);
        $body_count = count($body);
    
        $i=0;
    
        do {
            $output .= $body[$i]." ";
            $thisLen = strlen($output);
            $cycle = ($thisLen < $maxlen && $i < $body_count-1 && ($thisLen+strlen($body[$i+1])) < $maxlen+$maxoverflow?true:false);
            $i++;
        } while ($cycle);
        return $output.$elli." ... ";
    }
    else return $str;
}

function datetoString($date) {
    $ago =  time() - $date;
    //$string = date(SHORT_DATE_WITHTIME, $date);
    $months = floor($ago / ( 30 * 24 * 60 * 60));
    $weeks = floor($ago / ( 7 * 24 * 60 * 60));
    $days = floor($ago / ( 24 * 60 * 60));
    $hours = floor($ago / ( 60 * 60));
    $minutes = ceil($ago / ( 60));
    if($months >  0 ) return $months . $string . ' months ago';
    elseif($weeks > 0)return $weeks . ($weeks==1 ? ' week ago' : ' weeks ago');
    elseif($days > 0)return $days . ($days == 1 ? ' day ago' : ' days ago');
    elseif($hours > 0)return $hours . ($hours == 1 ? ' hour ago' : ' hours ago');
    else return $minutes . ($minutes <= 1 ? ' minute ago' : ' minutes ago');

}

function deleteDirectory($dirname,$only_empty=false) {
  if (!is_dir($dirname))
     return false;
  $dscan = array(realpath($dirname));
  $darr = array();
  while (!empty($dscan)) {
        $dcur = array_pop($dscan);
        $darr[] = $dcur;
        if ($d=opendir($dcur)) {
           while ($f=readdir($d)) {
                 if ($f=='.' || $f=='..')
                    continue;
                 $f=$dcur.'/'.$f;
                 if (is_dir($f))
                 $dscan[] = $f;
                 else
                     unlink($f);
                 }
           closedir($d);
        }
  }
  $i_until = ($only_empty)? 1 : 0;
  for ($i=count($darr)-1; $i>=$i_until; $i--) {
      @rmdir($darr[$i]);
  }
  return (($only_empty)? (count(scandir)<=2) : (!is_dir($dirname)));
}

function isValidFileType($filename , $extensions = '')  {
	$filename = explode('.', $filename);

   // take the last part of the file to get the file extension
   $fileext =  $filename[count($filename)-1];   
   $valid = false;
   $ext = split(",", $extensions);
   if(is_array($ext)) {
   		foreach($ext as $extension) {
			if(trim($extension) == strtolower($fileext))
				$valid = true;
		}
   } 
   
   return $valid;
}

function createRandomString($length = 7) {    
	$chars = "ABCDEFGHJKLMNPQRSTUVWXYZabcdefghijkmnopqrstuvwxyz23456789";    
	srand((double)microtime()*1000000);    
	$i = 0;    $pass = '' ;    
	while ($i <= $length) {        
		$num = rand() % 33;        
		$tmp = substr($chars, $num, 1);        
		$pass = $pass . $tmp;        $i++;    
	}    
	return $pass;
}

function getEmailGroup($groupid,$isrole=''){   
	$reults_email ="";
	$query=Query("SELECT * FROM email_group Where id=".$groupid);
	if(Num($query)){
		$result  = Fetch($query);
		$userids = $result['user_id'];
		$userids_array = explode(",",$userids);
		$count = sizeof($userids_array);
		if(!$isrole) {
			for($i=0;$i<$count;$i++){
                $reults_email=array();
				$reults_email=FetchAssoc(Query("SELECT id,email,first_name,last_name FROM `[x]user` Where id=".$userids_array[$i]));
			} 
		}else{
			for($i=0;$i<$count;$i++){
				$emailids=FetchAssoc(Query("SELECT id,email,first_name,last_name,zone_id,area_id FROM `[x]user` Where id=".$userids_array[$i]));
				$emailids['rolename'] = getUserType($emailids['id']);
				$reults_email[] = $emailids;
			} 
		}
	}
	return $reults_email; 
}


function getGroupName($groupid) {
	$group_name ="";
	$query=Query("SELECT name FROM email_group Where id=".$groupid);
		if(Num($query)){
		$result  = Fetch($query);
		$group_name = $result['name'];
		}
	return $group_name;

}

function getGroupId($groupname) {
  	$query=Query("SELECT id FROM email_group Where name='".$groupname."'");
		if(Num($query)){
		$result  = Fetch($query);
		$group_id = $result['id'];
		}
	return $group_id;

}

 

?> 