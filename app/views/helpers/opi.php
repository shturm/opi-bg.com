<?php
class OpiHelper extends AppHelper {
	
	
	// calculate the price to display when listing products
	function productPrice(&$product, $htmlOutput = false) {
		$_price = 0;
		$_discount = false; // will use to check if 
		
		$price = 0;
		$discount = 0;
		$in_action = false;
		$action_price = 0;
		
		// $product is array('Product' => array(...) ) or array('id' => X, 'name' => Z ...)
		if(isset($product['Product'])) {
			$price = $product['Product']['price'];
			$discount = $product['Product']['discount'];
			$in_action = $product['Product']['in_action'];
			$action_price = $product['Product']['action_price'];
		} else {
			$price = $product['price'];
			$discount = $product['discount'];
			$in_action = $product['in_action'];
			$action_price = $product['action_price'];
		}
		
		// apply logic in following  desc priority: in_action price, discount, regular price
		if($in_action) {
			$_price = $action_price;
		} else if ($discount > 0) {
			$_price = $price - ($price/100)*$discount;
		} else {
			$_price = $price;
		}
		
		if($htmlOutput) {
			if ($price > $_price)
			return '<span style="text-decoration:line-through; color: red;">' . 
					$price .
					'</span>' .
					'<span style="color: green; font-weight: bold;"> ' . 
					$_price .
					'</span>';
					
		} 
		return $_price;
	}
}