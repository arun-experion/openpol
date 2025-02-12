<?php

class search {

	var $q;
	var $searchFields; 
	var $condition;
	var $query;
	function search($searchFields, $condition = array(), $extraConditions = ''){
	
		$searchCondition = '';
		$conditions = '';
		$this->searchFields = preg_split("/,/", $searchFields);
		if(isset($_GET['q'])) {
			if($_GET['q'] != '') {
			
				$this->q = $_GET['q'];
				$searchCondition = $this->prepare();
				//echo $searchCondition;
			}
		}
		if(!empty($condition) && is_array($condition)) {
			$this->condition = $condition;
			$conditions = $this->prepareCondition();
		}
		if($searchCondition != '' || $conditions != '' || $extraConditions != '') {
			$this->query = " WHERE ";
			if($searchCondition != '') {
				$this->query .= $searchCondition;
			}
			if($searchCondition != '' && $conditions != '') {
				$this->query .= " AND ";
			}
			if($conditions != '') {
				$this->query .=  $conditions;
			}
			if($conditions != '' && $extraConditions != '') {
				$this->query .= " AND ";
			}
			if($extraConditions != '') {
				$this->query .= $extraConditions;
			}
		}
	}
	
	function prepare() {
		$chunks = preg_split("/[ ,|]/", $this->q);	
		$chunks = array_filter($chunks);
		
		$regExp = join(" ", $chunks);
		foreach ($chunks as $chunk) {
			$regExp .= "|" . $chunk;
		}
		$searchConditon = "";
		foreach ($this->searchFields as $fields) {
			$searchConditon .= trim($fields) . " REGEXP '$regExp' OR ";
		}
		
		$searchConditon = "(" . substr($searchConditon, 0, -3) .")";
		return $searchConditon;
	}
	
	function prepareCondition() {

		$condition = "";
		foreach($this->condition as $key => $value) {
			$condition .= trim($key). " REGEXP '$value' AND "; 
		}
		$condition = substr($condition, 0, -4);
		return $condition;
	}

}

?>
