<?php

class template {
	var $Buffer;
	
	// Load template file 
	function Load($file) {
		global $CONF;

		if (is_file($file)) $this->Buffer = file_get_contents($file);
		else {
			die("Unable to load {$loadFile}");
			return false;
		}
		$this->AssignValue("theme", TEMPLATE_PATH);
		$this->AssignValue("domain", HTTP_SERVER);
		return true;
	}
	
	// Assign Array
	function AssignArray($array) {
		foreach ($array as $code => $value) {
			$this->Buffer = str_replace("{".$code."}", $value, $this->Buffer);
		}
	}
	
	// Assign Value
	function AssignValue($tag, $value) {
		$this->Buffer = str_replace("{".$tag."}", $value, $this->Buffer);
	}
	
	// Assign Row
	function AssignRow($prefix, $array) {
		foreach ($array as $code => $value) {
			$this->Buffer = str_replace("{".$prefix.".".$code."}", $value, $this->Buffer);
		}
	}
	
	// Assign Loop
	function Loop($name, $array) {
		global $CONF;
		
		preg_match("/\<LOOP {$name}\>(.*)\<\/LOOP {$name}\>/isU", $this->Buffer, $tag);
		
		if (isset($tag[1])) {
			
			$tag[1] = $this->StateZones($tag[1]);
			
			$ret = NULL;
			
			foreach($array as $key => $arr) {
				if (is_array($arr)) {
					$temp = $tag[1];
					foreach ($arr as $arkey => $arval) {
						$temp = str_replace("{".$arkey."}", $arval, $temp);
					}
					$ret .= $temp;
				}
			}
			
			$this->Buffer = str_replace($tag[0], $ret, $this->Buffer);
			return true;
		}
	}

	// Get Objects
	function GetObjects() {

		preg_match_all("|\<OBJ ([^>]+)\>(.*)\</OBJ [^>]+\>|isU", $this->Buffer, $obj, PREG_SET_ORDER);

		if (isset($obj) && is_array($obj)) {
			foreach($obj as $key => $objArray) {
				if (is_array($objArray)) {
					$GLOBALS["OBJ"][$objArray[1]] = $objArray[2];
					$this->Buffer = str_replace($objArray[0], NULL, $this->Buffer);
				}
			}
		}
	}
	
	// Zone
	function Zone($group, $zone, $retmode=false) {
		
		preg_match_all("|\<ZONE {$group} ([^>]+)\>(.*)\<\/ZONE {$group} [^>]+\>|isU", $this->Buffer, $zn, PREG_SET_ORDER);

		if (isset($zn) && is_array($zn)) {
			foreach ($zn as $key => $znArray) {
				if (is_array($znArray)) {
					if ($znArray[1] != $zone) {
						$this->Buffer = strtr($this->Buffer, [$znArray[0] =>Null]);
					} else {
						if ($retmode) return $znArray[2];
						else $this->Buffer = str_replace($znArray[0], $znArray[2], $this->Buffer);
					}
				}
			}
		}		
	}

	//Convert Self User
	function ConvertSelf() {
		if (strstr($this->Buffer, "{self.")) {
		
			if ((!isset($GLOBALS["SELF_DATA"])) || (!$GLOBALS["SELF_DATA"])) { selfData(); }
			
			if (isset($GLOBALS["SELF_DATA"]) && is_array($GLOBALS["SELF_DATA"])) {
			
				foreach ($GLOBALS["SELF_DATA"] as $code => $value) {
					$this->Buffer = str_replace("{self.".$code."}", $value, $this->Buffer);
				}
			}
		}
	}

	// Clean Zones
	function CleanZones() {
	
		preg_match_all("|\<ZONE (.*)\>.*\<\/ZONE \\1\>|isU", $this->Buffer, $zn, PREG_SET_ORDER);

		if (isset($zn) && is_array($zn)) {
			foreach ($zn as $key => $znArray) {
				if (is_array($znArray)) {
					$this->Buffer = strtr($this->Buffer, [$znArray[0] =>Null]);
				}
			}
		}
	}
	
	// Clean Zones
	function CleanTags() {
	
		preg_match_all("|\{(.*)\}|isU", $this->Buffer, $zn, PREG_SET_ORDER);

		if (isset($zn) && is_array($zn)) {
			foreach ($zn as $key => $znArray) {
				if (is_array($znArray)) {
					
					$this->Buffer = strtr($this->Buffer, [$znArray[0] =>Null]);
								}
			}
		}
	}
	
	function CleanCustomTags() {
	
		preg_match_all("|\[(.*)\]|isU", $this->Buffer, $zn, PREG_SET_ORDER);

		if (isset($zn) && is_array($zn)) {
			foreach ($zn as $key => $znArray) {
				if (is_array($znArray)) {
					$this->Buffer = str_replace($znArray[0], NULL, $this->Buffer);
				}
			}
		}
	}
	
	// User States
	function StateZones($buffer) {
	
		if (preg_match('/<is_op>|<is_mop>|<is_guest>|<is_user>/i', $buffer)) {
			$buffer = preg_replace('%(<is_op>(.*)</is_op>)%si', (is_op() ? '\\2' : NULL), $buffer);
			$buffer = preg_replace('%(<is_mop>(.*)</is_mop>)%si', (is_mop() ? '\\2' : NULL), $buffer);
			$buffer = preg_replace('%(<is_guest>(.*)</is_guest>)%si', (!isset($_SESSION["id"]) ? '\\2' : NULL), $buffer);
			$buffer = preg_replace('%(<is_user>(.*)</is_user>)%si', (isset($_SESSION["id"]) ? '\\2' : NULL), $buffer);
		}
		return $buffer;
	}
		

	// Flush Template
	function Flush($return=false) {

		$this->Buffer = $this->StateZones($this->Buffer);
		
		if (!$return) echo $this->Buffer;
		else return $this->Buffer;
	}

}
?>