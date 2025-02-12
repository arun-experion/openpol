<?php
class splitResults {
	
	var $pages;
	var $prev = 0;
	var $next = 0;
	var $page;
	var $out;
	var $start;
	var $end;
	var $total;
	function splitResults($query, $results_per_page = SEARCH_RESULTS_PER_PAGE) {
		global $GET;
		$GET = $_GET;
		
		if(isset($_GET['page']) && is_numeric($_GET['page'])) {
			$this->page = $_GET['page'];
		} else {
			$this->page = 1;
		}
			
		// Current page
		$start = (($this->page * $results_per_page) - $results_per_page);
		
		$total = Num(Query($query));
		$this->pages = ceil($total / $results_per_page);
		//return $total;
		
		if($this->page > 1) {
			$this->prev = $this->page - 1;
		}
		
		if($this->page < $this->pages) {
			$this->next = ($this->page + 1);
		}
		$this->start = $start + 1;
		
		if(($start + $results_per_page) > $total) {
			$this->end = $total;
		} else {
			$this->end = $start + $results_per_page;
		}
		if($this->end < $this->start) {
			$this->start = $this->end;
		}
		$this->total = $total;
		$this->out = Query($query . " LIMIT $start, " . $results_per_page);
		
	}
	function show() {
	
		global $GET;
		$_GET = $GET;

		$link = basename($_SERVER['SCRIPT_NAME']);
		$params = '';
		foreach ($_GET as $var => $val) {
			if($var != 'page') $params .= "&{$var}={$val}";
		}
		
		if($params != ''){
			$params = "?". substr($params, 1, strlen($params));
		}
		$link .= $params;
		$tpl = new template();
		$tpl -> Load("templates/default/splitresults.tpl");
		$sign = '&';
		if($params == ''){
			$sign = "?";
		}
		if($this->next != 0) {
			$tpl -> AssignValue("next_link", $link . "{$sign}page=" . $this->next);
			$tpl -> Zone("next", "enabled");
		}
		if($this->prev != 0) {
			$tpl -> AssignValue("prev_link", $link . "{$sign}page=" . $this->prev);
			$tpl -> Zone("prev", "enabled");
		}
		
		$tpl -> AssignValue("first_link", $link . "{$sign}page=1");
		$tpl -> AssignValue("last_link", $link . "{$sign}page=" . $this->pages);
		$tpl -> AssignValue("current_page", $this->page);
		$tpl -> AssignValue("total_pages", $this->pages);
		
		$paddingLimit = SEARCH_RESULTS_PADDING;
		$paddingStart = 1;
		$paddingEnd = $paddingLimit;
		
		if(($this->page - ceil($paddingLimit / 2)) > 0) {
			$paddingStart = $this->page - ceil($paddingLimit / 2);
		} 
		
		if(($this->page + ceil($paddingLimit / 2)) < $this->pages) {
			$paddingEnd = $paddingStart + $paddingLimit;
		} else {
			$paddingEnd = $this->pages;		
		}
		
		$pageNo = array();
		if(($paddingEnd - $paddingLimit) > 0) $paddingStart = $paddingEnd - $paddingLimit;
		for($i=$paddingStart; $i<=$paddingEnd; $i++) {
			if($this->page == $i) {
				$pageNo[$i]["pageNo"] = "<span class='currentpage'>$i</span>";
			} else {
				$pageNo[$i]["pageNo"] = $i;
			}
			$pageNo[$i]["link"] = $link . "{$sign}page=" . $i;
			if($i < $this->page)
				$pageNo[$i]["arrow"] = "prev";
			else
				$pageNo[$i]["arrow"] = "next";
		}
		$tpl -> Loop("pages", $pageNo);
		if($paddingEnd < $this->pages) {
		//echo $pageNo[$paddingEnd]["pageNo"] .'->' . $this->pages;
			$tpl -> Zone("paddingDot", "enabled");
		}
		$tpl -> CleanZones();
		return $tpl -> Flush(1);
	}
}
?>