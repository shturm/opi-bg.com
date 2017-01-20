<?php
class CartComponent extends Object {
	
	var $name = 'Cart';
	var $components = array('Auth', 'Session');
	
	var $controller;
	
	var $lacquerCount = NULL;
	var $hologramLacquerCount = NULL;
	var $trueLacquerCount = NULL;
	var $trueHologramLacquerCount = NULL;
	var $paintCount = NULL;
	
	//called before Controller::beforeFilter()
	function initialize(&$controller, $settings = array()) {
		// saving the controller reference for later use
		$this->controller =& $controller;
		// create the session variable if not already done
		if (!$this->Session->read('Cart')) {
			$this->Session->write('Cart', array());
			// $this->Session->write('Cart.debug','just created');
		} else $this->Session->delete('Cart.debug');
		
	}
	
	// add a product to cart
	function add($product = null, $cart_options = null) {
		$cart = $this->Session->read('Cart');
		$item_type = key($product);
		// handle quantity
		if(isset($cart_options['quantity'])) {
			$product[$item_type]['cart_quantity'] = $cart_options['quantity'];
		} else $product[$item_type]['cart_quantity'] = 1;	
	
		if ($product) {
			// add the item type if not already there
			if (!array_key_exists($item_type, $cart)) {
				//register the type
				$this->Session->write('Cart.' . $item_type, array());
				// since the item type has been just created - add the product, there is no instance of it for sure
				$this->_add($product);
			} else { // the type is defined, there might be a instance already
				if (array_key_exists($product[$item_type]['id'], $cart[$item_type])) {
					// there is an instance - increment the quantity as needed
					
					if (isset($cart_options['quantity'])) { 
						// we have quantity selected
						$cart[$item_type][$product[$item_type]['id']]['cart_quantity'] += $cart_options['quantity'];
					} else {
						// dont specified quantity - increment quantity with one
						$cart[$item_type][$product[$item_type]['id']]['cart_quantity']++;
					}
					$this->Session->write('Cart', $cart);
				} else  { 
				// no instance of this product - add it
					$this->_add($product);
				}
			}
			
			
		} else { $this->Session->write('Cart.error','invalid product'); }
		// $products[] = $id;
		// $this->Session->write('Cart',$products);
	}
	
	// delete item from cart
	function delete($item, $reduce = 1) {
		$cart = $this->Session->read('Cart');
		$type = key($item);
		
		if ($reduce < $cart[$type][$item[$type]['id']]['cart_quantity'] ) {
			$cart['status'] = 'quantity[' .$cart[$type][$item[$type]['id']]['cart_quantity'].'] - reduce[$reduce]';
			// just reduce size
			$cart[$type][$item[$type]['id']]['cart_quantity'] -= $reduce;
		} else {
			// delete whole item
			$cart['status'] = 'deleting items';
			unset($cart[$type][$item[$type]['id']]);
		}
		
		$this->Session->write('Cart', $cart);
	}
	
	function remove($item) {
		$cart = $this->Session->read('Cart');
		$type = key($item);
		
		unset($cart[$type][$item[$type]['id']]);
		$this->Session->write('Cart', $cart);
	}
	
	function change($item = null, $quantity = 1) {
		$cart = $this->getCart();
		$type = key($item);
		
		if($this->in_cart($item)) {
			if (!$quantity < 1) {
				$cart[$type][$item[$type]['id']]['cart_quantity'] = $quantity;
				$this->Session->write('Cart',$cart); return true;
			} else { 
				unset($cart[$type][$item[$type]['id']]); 
				$this->Session->write('Cart',$cart);
				return true;
			}
		} else {
		// add the product since its not here
			$this->add($item, array('quantity' => $quantity) );
			// $this->change($item,$quantity);
		}
	}
	
	function in_cart($item) {
		$cart = $this->getCart();
		$type = key($item);
		
		if(array_key_exists($item[$type]['id'], $cart[$type])) {
			return true;
		} else return false;
	}
	
	// actually add the item, its unique
	function _add($item) {
		$cart = $this->getCart();
		$type = key($item);
		$cart[$type][$item[$type]['id']] = $item[$type];
		// $cart_current_type = $cart[$type];
		// array_push($cart_current_type ,$item[$type]['id'] => $item[$type]);
		// $cart_current_type[] = array($item[$type]['id'] => $item[$type]);
		$this->Session->write('Cart', $cart);
		// $this->Session->write('Cart.add', 'here');
		// $cart[$type][] = array($item['id'] => $item[$type]);
		
		
		// $this->Session->write('Cart', $cart);
	}
	// applies pricing logic and returns array of calculated products from the cart
	function calculate() {
		$cart = $this->getCart();
		$result = array('total' => 0);
		$total = 0; // total price of whole cart content
		
		
		$count_lacquers = $this->getLacquerCount(); // count of the lacquers (not distinct: 2 blue + 3 red = 5 count)
		$count_hologram_lacquers = $this->getHologramLacquerCount(); // count of the lacquers (not distinct: 2 blue + 3 red = 5 count)
		$count_paints = $this->getPaintCount();
		
		if(!empty($cart['Product'])) {

		
			foreach($cart['Product'] as $item) {
			
				// default values. Applied (but not only) when user is a guest (not registered).
				$discount_text = '';
				$discount = 0;
				$current_price = $this->productSinglePrice($item);
				$subtotal = $current_price*$item['cart_quantity'];
				if ($this->Auth->User()) $role = $this->Auth->User('role'); else $role = 'guest';
				
				// default prices for regular users
				$price_1 = $price_6 = $price_12 = $price_24 = $current_price; 
				
				// discount text logic
				if ($item['type'] == 'promotion') $discount_text = 'Промоция'; 
				if ($role == 'shop') $discount_text == 'Магазинерска';
				if ($role == 'vendor') $discount_text == 'Търговска';
				if ($role == 'user' && $this->Auth->User('discount') > 0 && !$item['discount'] > 0) $discount_text == 'Индивидуална';
				if ($item['in_action'] == true) $discount_text = 'Акция';
				
				// action price logic - every user has its own action price, except user and guest
				if ($item['in_action'] == true && ($role == 'guest' || $role == 'user')) {
					$price_1 = $price_6 = $price_12 = $price_24 = $item['action_price'];
				} else if ($item['in_action'] == true && $role == 'vendor') {
					$price_1 = $price_6 = $price_12 = $price_24 = $item['vendor_action_price'];
				} else if ($item['in_action'] == true && $role == 'shop') {
					$price_1 = $price_6 = $price_12 = $price_24 = $item['shop_action_price'];
				}
				
				// set vendor prices
				if(!$item['in_action'] && $role == 'vendor') {
					$price_1 = $item['vendor_price'];
					$price_6 = $item['vendor_price_6'];
					$price_12 = $item['vendor_price_12'];
					$price_24 = $item['vendor_price_24'];
				}

					

				
				/* Calculate the price for the product applying quantity and discount logic. 
				   Used for total sum
				*/
				$total += $subtotal = $current_price*$item['cart_quantity'];

				if($item['type'] == 'lacquer' || $item['type'] == 'hologram_lacquer') {
					$price_24 = $price_12;

				} else if($item['type'] == 'paint') {
					$price_6 = $price_1;

				} else {
					$price_24 = $price_12;
				}
				
				$result['Product'][$item['id']] = array(
					'id' => $item['id'],
					'name' => $item['name'],
					'description' => $item['description'],
					'price' => $current_price, // this is calculated and ready to be dispalyed to the user
					'discount' => $discount, // this is calculated and ready to be dispalyed to the user
					'discount_text' => $discount_text, // this is calculated and ready to be dispalyed to the user
					'price_1' => $price_1, // this is calculated and ready to be dispalyed to the user
					'price_6' => $price_6, // this is calculated and ready to be dispalyed to the user
					'price_12' => $price_12, // this is calculated and ready to be dispalyed to the user
					'price_24' => $price_24, // this is calculated and ready to be dispalyed to the user
					'subtotal' => $subtotal, // total sum to be payed for this product. Applies with pricing logic
					'code' => $item['code'],
					'is_active' => $item['is_active'],
					'is_featured' => $item['is_featured'],
					'is_pro' => $item['is_pro'],
					'in_action' => $item['in_action'],
					'impressions' => $item['impressions'],
					'type' => $item['type'],
					'image_full' => $item['image_full'],
					'image_thumb' => $item['image_thumb'],
					'tags' => $item['tags'],
					'cart_quantity' => $item['cart_quantity']
				);
				$result['total'] = $total;
			}
		}
		return $result;
	}
	
	// applies pricing logic to get current single price of a single product (e.g. per piece)
	// takes into account cart content. Used for dynamic displaying correct price. Not used in order calculation. See calculate()
	function productSinglePrice($p) {
	
		if($this->Auth->user()) {
			$role = $this->Auth->user('role');
			$user_discount = $this->Auth->user('discount');
		} else {
			$role = 'guest';
			$user_discount = 0;
		}
		
		// check if $product is array('Product' => array(...) ) or array('id' => X, 'name' => Z ...)
		if (isset($p['Product'])) $p = $p['Product'];
		// action price logic
		if($p['in_action']) {
			switch($role) {
				case 'vendor':
					return $p['vendor_action_price'];
					break;
				case 'shop':
					return $p['shop_action_price'];
					break;
				default:
					return $p['action_price'];
					break;
			}
		}
		

		switch($role) {
			case 'vendor':
				$discount = 0;
				if ($p['type'] == 'lacquer') {
					if ($this->getLacquerCount() < 6) {
						return $p['vendor_price'];
					} else if ($this->getLacquerCount() >= 6 && $this->getLacquerCount() < 12) {
						return $p['vendor_price_6'];
					} else if ($this->getLacquerCount() >= 12) {
						return $p['vendor_price_12'];
					}
				} else if ($p['type'] == 'paint') {
					if ($this->getPaintCount() < 12) {
						return $p['vendor_price'];
					} else if ($this->getPaintCount() >= 12 && $this->getPaintCount() < 24) {
						return $p['vendor_price_12'];
					} else if ($this->getPaintCount() >= 24) {
						return $p['vendor_price_24'];
					}
				} else if ($p['type'] == 'holgram_lacquer') {
					if ($this->getHologramLacquerCount() < 6) {
						return $p['vendor_price'];
					} else if ($this->getHologramLacquerCount() >= 6 && $this->getHologramLacquerCount() < 12) {
						return $p['vendor_price_6'];
					} else if ($this->getHologramLacquerCount() >= 12) {
						return $p['vendor_price_12']; }
				} else {
					return $p['vendor_price'];
				}
			break;
			case 'shop':
				return $p['price'] - (($p['price']/100)*$user_discount);
			break;
			case 'user':
				$discount = $user_discount > 0 ? $user_discount : $p['discount'];
				return $p['price'] - (($p['price']/100)*$user_discount);
			break;
			
			default:
				return $p['price'] - (($p['price']/100)*$p['discount']);
			break;
		}

		
	}
	
	// gets an array of products and changes the products' Product.price field to the actual
	// single (per piece) price using Cart::productSinglePrice()
	function setCalculatedPrices(&$products) {
		foreach ($products as $key => $p) {
			$products[$key]['Product']['price'] = $this->productSinglePrice($p['Product']);
		}
	}
	
	
	// gets count of lacquers in cart. If $realCount is false, it will add 12 lacquers in count
	// to reduce price if vendor buys a collection - then all other lacquers are at lowest price
	function getLacquerCount($realCount = false) {
		if ($realCount == false) {
			if ($this->lacquerCount === NULL) {
				$cart = $this->getCart();
				$lacquer_count = 0;
				if (empty($cart['Product'])) return 0;
				foreach($cart['Product'] as $p) {
					if ($p['type'] == 'lacquer' && !$p['in_action']) {
						$lacquer_count += $p['cart_quantity'];
					}
					if ($p['type'] == 'collection') {
						$lacquer_count += 12;
					}
				}
				$this->lacquerCount = $lacquer_count;
				return $lacquer_count;
			} else return $this->lacquerCount;
		} else {
			if ($this->trueLacquerCount === NULL) {
				$cart = $this->getCart();
				$lacquer_count = 0;
				if (empty($cart['Product'])) return 0;
				foreach($cart['Product'] as $p) {
					if ($p['type'] == 'lacquer') {
						$lacquer_count += $p['cart_quantity'];
					}
				}
				$this->truelacquerCount = $lacquer_count;
				return $lacquer_count;
			} else return $this->trueLacquerCount;
		}
	}
	
	// gets count of HOLOGRAM lacquers in cart. If $realCount is false, it will add 12 lacquers in count
	// to reduce price if vendor buys a collection - then all other lacquers are at lowest price
	function getHologramLacquerCount($realCount = false) {
		if ($realCount == false) {
			if ($this->hologramLacquerCount === NULL) {
				$cart = $this->getCart();
				$lacquer_count = 0;
				if (empty($cart['Product'])) return 0;
				foreach($cart['Product'] as $p) {
					if ($p['type'] == 'lacquer' && !$p['in_action']) {
						$lacquer_count += $p['cart_quantity'];
					}
					if ($p['type'] == 'collection') {
						$lacquer_count += 12;
					}
				}
				$this->hologramLacquerCount = $lacquer_count;
				return $lacquer_count;
			} else return $this->hologramLacquerCount;
		} else {
			if ($this->trueHologramLacquerCount === NULL) {
				$cart = $this->getCart();
				$lacquer_count = 0;
				if (empty($cart['Product'])) return 0;
				foreach($cart['Product'] as $p) {
					if ($p['type'] == 'lacquer') {
						$lacquer_count += $p['cart_quantity'];
					}
				}
				$this->trueHologramLacquerCount = $lacquer_count;
				return $lacquer_count;
			} else return $this->trueHologramLacquerCount;
		}
	}
	
	// gets count of paints in cart. 
	function getPaintCount() {
		if ($this->paintCount === NULL) {
			$cart = $this->getCart();
			$paint_count = 0;
			if (empty($cart['Product'])) return 0;
			foreach($cart['Product'] as $p) {
				if ($p['type'] == 'paint') {
					$paint_count += $p['cart_quantity'];
				}
			}
			return $paint_count;	
		} else return $this->paintCount;
	}
	
	function setOrder(array $order) {
		$this->Session->write('Cart.Order', $order);
	}
	
	function getCart() {
		return $this->Session->read('Cart');
	}
	
	// empty the cart
	function trim() {
		$this->Session->write('Cart', array());
	}
	
	function trimProducts() {
		$this->Session->write('Cart.Product', array());
	}
	
	function trimOrder() {
		$this->Session->write('Cart.Order', array());
	}
	//called after Controller::beforeFilter()
	function startup(&$controller) {
	}

	//called after Controller::beforeRender()
	function beforeRender(&$controller) {
	}

	//called after Controller::render()
	function shutdown(&$controller) {
	}

	//called before Controller::redirect()
	function beforeRedirect(&$controller, $url, $status=null, $exit=true) {
	}

	function redirectSomewhere($value) {
		// utilizing a controller method
		$this->controller->redirect($value);
	}
	
	
}
?>