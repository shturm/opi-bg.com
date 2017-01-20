<?php
class CartController extends AppController {
	var $name = 'Cart';
	var $uses = array('Product');
	var $components = array('Cart', 'OpiMailer', 'RequestHandler');
	var $background_for_layout = '/img/backgrounds/flowers.png';
	
	//delivery values
	var $delivery_price = 5; // price of the delivery
	//var $min_total_for_no_delivery = 20; // minimum total sum for not to get charged with delivery fees
	
	var $orderValidationErrors = array();
	function index() {
		// debug($this->params);
		// debug($this->Cart->calculate());
		unset($_SESSION['Cart']['Product']['000']); // to hide the delivery product
		$this->set('cart', $this->Cart->calculate());
	}
	
	function step2() {
		$cart = $this->Cart->calculate();
		if(empty($cart['Product'])) {
			$this->Session->setFlash('Нямате добавени продукти в кошницата !','flash_bad');
			$this->redirect(array('action' => 'index'));
		}
	}
	
	function step3() {
		$cart = $this->Cart->calculate();	
		// debug($this->Session->read('Cart'));
		
		if(empty($cart['Product'])) {
			$this->Session->setFlash('Нямате добавени продукти в кошницата !','flash_bad');
			$this->redirect(array('action' => 'index'));
		}
		$this->Cart->trimOrder(); // clear old order details
		// see if order info is correct
		$this->loadModel('Order');
		$this->Order->set($this->data);
		if(!$this->Order->validates()) {
			$errors = '';
			foreach($this->Order->validationErrors as $error) {
				$errors .= $error . '<br/>';
			}
			// $this->step2();
			// debug($this->Order->validationErrors);
			$this->Session->setFlash('Има грешно попълнени полета. <br/>' . $errors);
			$this->redirect($this->referer());
		}
		// check if unregistered/registered tries to use registered user's email
		if($this->_orderEmailExists($this->data)) {
			if(!$this->Auth->user('email') == $this->data['Order']['email']) {
				$this->Session->setFlash('Този имейл е регистриран. Ако искате да го ползвате, трябва да <a href="/users/login">влезете</a> с този акаунт');
				$this->redirect($this->referer());
			}
		}
	
		$this->set('cart', $cart);
		
		$this->data['Order']['ip_of_order'] = $_SERVER['REMOTE_ADDR'];
		$this->set('order', $this->data); // used to display the order details for last time
		$this->Cart->setOrder($this->data['Order']); // puts the order in the session
		// debug($this->data);
	}
	
	function step4() {
		$cart = $this->Cart->calculate();
		if(empty($cart['Product'])) {
			$this->Session->setFlash('Нямате добавени продукти в кошницата !','flash_bad');
			$this->redirect(array('action' => 'index'));
		}
		// check if user made too many orders last 24 hours
		if(!$this->ipMayOrder()) {
			$this->Session->setFlash('Поръчката не е създадена. Не можете да правите повече поръчки за следващото денонощие');
			$this->redirect('/');
		}
		$products = array();
		foreach($cart['Product'] as $p) {
			$products['OrderedProduct'][] = array( 
				'name' => $p['name'],
				'product_id' => $p['id'],
				'price' => $p['price'],
				'cart_quantity' => $p['cart_quantity'],
				'discount' => $p['discount'],
				'discount_text' => $p['discount_text'],
				'subtotal' => $p['subtotal'],
				'image_thumb' => $p['image_thumb'],
				'image_full' => $p['image_full'],
				'type' => $p['type']
			);
		}
		$order['Order'] = $this->Session->read('Cart.Order');
		$order['Order']['user_id'] = $this->Auth->user('id');
		if($this->Auth->user())	$order['Order']['user_role'] = $this->Auth->user('role');
		$order['Order']['track_hash'] = md5( $cart['total'] . date(time()) );
		$order['Order']['total_sum'] = $cart['total'];
		$order = $order + $products;
		// debug($order);
		
		// attemp to save the order, send emails, redirect to /users/ with success/failure order
		$this->loadModel('Order');
		if($this->Order->saveAll($order/*,  array('validate' => false)  */)) {
			$this->Cart->trim();
			$this->Session->setFlash('Успешна поръчка');
			$this->OpiMailer->notifyNewOrder($order);
			$this->OpiMailer->notifyAdminForOrder($order);
			$this->redirect('/users');
			// debug($order);
		} else {
			$this->Session->setFlash('Неуспешна поръчка');
			$this->redirect('/');
		}

			
	}
	
	function _orderEmailExists(&$data) {
		$this->loadModel('User');
		if($this->User->findByEmail($data['Order']['email'])) return true;
		return false;
	}
	
	// validates that the needed
	function _validateOrder($data) {
		if(empty($data['Order']['name'])) {
			$this->orderValidationErrors[] = array('field' => 'Име', 'message' => 'Трябва да посочите име');
			return false;
		}
		if(empty($data['Order']['email'])) {
			$this->orderValidationErrors[] = array('field' => 'Име', 'message' => 'Трябва да посочите имейл за контакт');
			return false;
		}
		if(empty($data['Order']['phone'])) {
			$this->orderValidationErrors[] = array('field' => 'Име', 'message' => 'Трябва да посочите телефон за контакт');
			return false;
		}
		if(empty($data['Order']['delivery_address'])) {
			$this->orderValidationErrors[] = array('field' => 'Име', 'message' => 'Трябва да посочите адрес за доставка');
			return false;
		}
		if(empty($data['Order']['payment'])) {
			$this->orderValidationErrors[] = array('field' => 'Име', 'message' => 'Трябва да посочите тип плащане');
			return false;
		}
		return true;
	}
	
	function add($id = null, $quantity = 1) {
		$this->Product->recursive = 2;
		// argument supplied
		if ($id) {
			// product exists
			if ($p = $this->Product->findById($id)) {
				// product is available
				if ($p['Product']['is_active'] > 0) {
					if($this->Auth->user('role') != 'vendor' && $p['Product']['is_pro'] == true) {
						$this->set('cart', $this->Cart->calculate());
					} else {
						$this->Cart->add($p, array('quantity' => $quantity));

						$this->set('cart', $this->Cart->calculate());
						if ($this->params['isAjax']) {
							$this->set('cart', $this->Cart->calculate());
							// header('Content-Type:application/json; charset=utf-8');
							$this->layout = 'ajax';
							header('Expires: -1');
							$this->render('ajax');
						} else $this->redirect(array('action' => 'index'));
					}
				}
			}
		}
		// $this->redirect(array('action' => 'index'));
		// debug($_SESSION);
	}
	// removes $reduce from product.cart_quantity
	function delete($id = null, $reduce = 1) {
		if ($id) {
			if($product = $this->Product->findById($id)) {
				$this->Cart->delete($product, $reduce);
				if ($this->params['isAjax']) {
					$this->set('cart', $this->Cart->calculate());
					// header('Content-Type:application/json; charset=utf-8');
					$this->layout = 'ajax';
					$this->render('ajax');
				} else $this->redirect(array('action' => 'index'));
			} else $this->Session->setFlash(__('No product with this ID', true));
			// $this->redirect(array('action'=>'index'));
		} else $this->Session->setFlash(__('ID not as expected', true));
		$this->redirect(array('action' => 'index'));
		// debug($this->Cart->calculate());
		// debug($this->params);
	}
	// removes product from cart
	function remove($id = null) {
		if ($id) {
			if ($product = $this->Product->findById($id)) {
				$this->Cart->remove($product);
				if ($this->params['isAjax']) {
					$this->set('cart', $this->Cart->calculate());
					// header('Content-Type:application/json; charset=utf-8');
					$this->layout = 'ajax';
					$this->render('ajax');
				} else $this->redirect(array('action' => 'index'));
			}
		}
	}
	
	// empty the cart
	function trim() {
		// debug(Router::parse($this->referer()));
		$this->Cart->trim();
		if ($this->params['isAjax']) {
			$this->set('cart', $this->Cart->calculate());
			// header('Content-Type:application/json; charset=utf-8');
			$this->layout = 'ajax';
			$this->render('ajax');
		} else $this->redirect(array('action' => 'index'));
	}
	
	function change($id= null, $quantity = 1) {

		if ($id) {
			$conditions['Product.is_active'] = true;
			$conditions['Product.id'] = $id;
			$conditions['Product.is_pro'] = false;
			if($this->Auth->user('role') == 'vendor') unset($conditions['Product.is_pro']);
			if( $product = $this->Product->find('first', array('conditions' => $conditions)) ) {
				$this->Cart->change($product, $quantity);
				if ($this->params['isAjax']) {
					$this->set('cart', $this->Cart->calculate());
					header('Content-Type:application/json; charset=utf-8');
					$this->layout = 'ajax';
					$this->render('ajax');
				} else $this->redirect(array('action' => 'index'));
			} else $this->Session->setFlash(__('No product with this ID', true));
		} else $this->Session->setFlash(__('ID not as expected', true));
		// $this->redirect(array('action' => 'index'));
	}

	// check if this IP or the current user has made more than 5 orders last 24 hours
	function ipMayOrder() {
		$max_orders = 5; // max orders allowed from single email or ip for 24 hours
		$this->loadModel('Order');
		$yesterday = date('Y-m-d H:i:s', time() - 86400);
		
		$this->Order->contain();
		$ip_last_day_orders = $this->Order->find('count', array('conditions' => array('Order.created >' => $yesterday, 'ip_of_order' => $_SERVER['REMOTE_ADDR']) ) );
		// debug($this->Order->getLastQuery()); die();
		if($ip_last_day_orders > $max_orders) return false;
		if($this->Auth->user('id') != null) {
			$email_last_day_orders = $this->Order->find('count', array('conditions' => array('Order.email' => $this->Auth->user('email'), 'Order.created >' => $yesterday, 'ip_of_order' => $_SERVER['REMOTE_ADDR']) ) );
			if($email_last_day_orders > $max_orders) {
				return false;
			}
		}
		return true;
	}
}

?>