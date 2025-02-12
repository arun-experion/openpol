<?php
class navigation {
	
	var $currentpage, $previouspage;
	
	function navigation() {
		
		$this->currentpage = basename($_SERVER['REQUEST_URI']);
		if(isset($_SESSION['prev'])) {
			$this->previouspage = $_SESSION['prev'];
		}
		if(isset($_SESSION['current']) && $_SESSION['current'] != $this->currentpage) {
			$_SESSION['prev'] = $this->currentpage;
		}
		$_SESSION['current'] = $this->currentpage;	
					
	}

}
global $navigation;
$navigation = new navigation();
//echo $navigation->previouspage . "=>" . $navigation->currentpage;
?>