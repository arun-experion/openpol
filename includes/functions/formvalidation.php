<?php
function email($val) {
	
	if(!preg_match("/^[A-z0-9][\w.-]*@[A-z0-9][\w\-\.]+\.[A-z0-9]{2,6}$/", $val)) {
		return false;
	}
	return true;
}

function username($val) {
	
	if(!preg_match("/^[\w\d\._-]+$/", $val)) {
		return false;
	}
	return true;
}

function dupData($table, $fieldname, $val, $condition = '') {

	if(Num(Query("SELECT $fieldname FROM `[x]{$table}` WHERE {$fieldname}='{$val}' {$condition}"))) {
	
		return true;
	}
	return false;
}

function isEmpty($fieldname, $errmsg) {
	global $_POST;
	if(!isset($_POST[$fieldname]))
		return true;
		
	if(empty($_POST[$fieldname]))
		return true;
		
	else return false;
}

function validate_telephone_number($phone)
{
	if (preg_match('/\(?\d{3}\)?[-\s.]?\d{3}[-\s.]\d{4}/x', $phone)) {
	 return true;
	} else {
	 return false;
	}
}
?>