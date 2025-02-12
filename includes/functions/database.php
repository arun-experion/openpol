<?php

	function Connect() { 
	
		$GLOBALS["DB_CONNECTION"] = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_DATABASE);
		if (mysqli_connect_errno()) die(mysqli_connect_error());
	}
	
	function Query($content) {
		global $CONF;
		
		if (!isset($GLOBALS["DB_CONNECTION"]) or !$GLOBALS["DB_CONNECTION"]) Connect();
		return mysqli_query($GLOBALS["DB_CONNECTION"], str_replace("[x]", DB_PREFIX, $content)); 
	}
	
	function Fetch($content) {
		if (!isset($GLOBALS["DB_CONNECTION"]) or !$GLOBALS["DB_CONNECTION"]) Connect();
		return mysqli_fetch_array($content);
	}
	
	function FetchAssoc($content) {
		if (!isset($GLOBALS["DB_CONNECTION"]) or !$GLOBALS["DB_CONNECTION"]) Connect();
		return mysqli_fetch_assoc($content);
	}
	
	function Num($content) {
		if (!isset($GLOBALS["DB_CONNECTION"]) or !$GLOBALS["DB_CONNECTION"]) Connect();
		if (!$content || !($content instanceof mysqli_result)) {
			return 0; 
		}
		return mysqli_num_rows($content);
	}
	
	function Insert($table, $data) {
		
		if (!isset($GLOBALS["DB_CONNECTION"]) or !$GLOBALS["DB_CONNECTION"]) Connect();
		$query = "INSERT INTO `[x]". $table . "` (";
		// while (list($columns, ) = each($data)) {
		foreach($data as $columns => $value) {

        	$query .= $columns . ', ';
      	}
		$query = substr($query, 0, -2) . ") VALUES ('";
		reset($data);
		// while (list(, $value) = each($data)) {
		foreach($data as $columns => $value) {

			$query .= $value . "', '";
		}
		$query = substr($query, 0, -3) . ")";
		return mysqli_query($GLOBALS["DB_CONNECTION"],str_replace("[x]", DB_PREFIX, $query)) or die(mysqli_error($GLOBALS["DB_CONNECTION"]));
		//return Query($query);
	}
	
	function Update($table, $data, $condition) {
		if (!isset($GLOBALS["DB_CONNECTION"]) or !$GLOBALS["DB_CONNECTION"]) Connect();
		$query = "UPDATE `[x]". $table . "` SET ";
		
		// while (list($columns, $value) = each($data)) {
		foreach($data as $columns => $value) {

			$query .= $columns . "='" . $value . "', ";
		}
		$query = substr($query, 0, -2);
		$query .= " WHERE " . $condition;

		return Query($query);
	}
	
	function InsertId($table, $data, $fieldname, $val) {
		$q = Query("SELECT * FROM `[x]$table` WHERE $fieldname='{$val}'");
		if(Num($q)) {
			$f = Fetch($q);
			return $f[0] ;
		}
		Insert($table, $data);
		return mysqli_insert_id($GLOBALS["DB_CONNECTION"]);
	}

	function Delete($table, $fieldname, $val) {
		if (!isset($GLOBALS["DB_CONNECTION"]) or !$GLOBALS["DB_CONNECTION"]) Connect();
		$query = "DELETE FROM  `[x]$table` WHERE  $fieldname='{$val}'";
		return Query($query);
	}
	
	function Close() {
		return @mysqli_close();
	}
?>