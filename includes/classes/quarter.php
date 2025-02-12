<?php
/**
 * TPL :: Order Management Software
 *
 * @copyright		Copyright (c) Terumo Penpol. All rights reserved.
 * @category 		Order Processing
 * @identity		Terumo Penpol is India's largest manufacturer of Blood Bags. This web portal would help order management. 
 * @author			Vidhya haridas 
 * @version			$Id: login.php  Monday, June 6, 2007, 10:47:41 PM $
 *		
 */
	class Quarter
	{
	/*
	getQuarterdetails From ID
	*/	
		
		function getQuarterFromId($id)
		{
			$q = Query("SELECT id, name,DATE_FORMAT(`from_date` , ".SHORT_DATE." ) AS from_date, DATE_FORMAT( `to_date` , ".SHORT_DATE.") 
			AS to_date FROM `[x]quarter`  WHERE id={$id}");
				if(Num($q)) {
					$r = Fetch($q);
					return $r;
				}
		}
		
		
		
		function getQuarterTaxFromId($id)
		{
			$q=Query("SELECT * FROM `[x]quarter_tax` WHERE `quarter_id`={$id}");
			if(Num($q)) {
				$r = Fetch($q);
				return $r;
			}
		}
		
		
	   function formatDate($dDate)
	   {
		  $dNewDate = strtotime($dDate);
		  return date('Y/m/d H:i:s',$dNewDate);
	   }
	   
	   
	   function calculateTax($rate,$tax)
	   {
		   
		   $tax_value=($rate*$tax)/100;
		   $result = $rate+$tax_value;
		   $result = round($result,2);
	   return $result;
	   }
	   
	   
	   function checkPriceExists($quarter_id,$product_type_id)
	   {
	    			
	        $q=Query("SELECT q.rate, p.id, p.name, q.quarter_id FROM product AS p, quarter_price AS q
                      WHERE q.quarter_id = $quarter_id AND p.product_type_id = $product_type_id AND q.product_id = p.id");
			if(Num($q)) {
			   
				return 1;
			}else{
			
			return 0;
			
			}
			
	   
	   }
	   
	   
	function getTaxForProductType($quarter_id,$product_type_id)
	{
	 	if ($product_type_id==1){$q=Query("SELECT ed_tax_blood_bag as ed ,cst_tax_blood_bag as cst 
		                                   FROM `[x]quarter_tax` WHERE `quarter_id`={$quarter_id}");
		}else{
		$q=Query("SELECT ed_tax_equipment as ed ,cst_tax_equipment as cst 
		          FROM `[x]quarter_tax` WHERE `quarter_id`={$quarter_id}");
		}
		if(Num($q)) {
			$r = Fetch($q);
			return $r;
		}
	
	}	
	
	
	
	function dupDataCheckExists($check_date,$id) {

	if(Num(Query("SELECT from_date FROM `quarter`WHERE '$check_date' BETWEEN `from_date` AND `to_date`  AND id NOT IN ($id)"))) {
	
		return true;
	}
	return false;
	
    }
	
	
  function dupDataCheck($check_date){

	if(Num(Query("SELECT from_date FROM `quarter`WHERE '$check_date' BETWEEN `from_date` AND `to_date` "))) {
	
		return true;
	}
	return false;
	
	
	}
	
 function numericCheck($tax){
		
	if(!is_numeric($tax) === TRUE){
	  return true;
	
	}
	return false;
	}
	
	
  function checkProductPriceExists($product_id,$quarter_id)
  {
  
   $q=Query("SELECT product_id  FROM quarter_price
                      WHERE quarter_id = $quarter_id AND product_id = $product_id");
	if(Num($q)) {
	   
		return 1;
	}else{
	
	return 0;
	
	}
  
  }	
		
	}

?>