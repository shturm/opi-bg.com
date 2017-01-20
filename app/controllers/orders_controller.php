<?php
class OrdersController extends AppController {

	var $name = 'Orders';
	var $components = array('OpiMailer');
	
	var $paginate = array('order' => 'Order.created desc');
	
	function index() {
		// debug($this->Order->find('all'));
	}
	
	function view($trackHash = false) {
		if ($trackHash) {
			if ($uid = $this->Auth->user('id')) {
				if($o = $this->Order->findByTrackHash($trackHash)) {
					if ($uid != $o['User']['id'] && $o['User']['id'] != 0) {
						$this->Session->setFlash('Тази поръчка принадлежи на друг потребител.');
					} else {
						$this->set('order',$o);
					}
				} else $this->Session->setFlash('Няма такава поръчка');
			} else {
				$this->Session->setFlash('За да видите тази поръчка трябва да влезете.');
			}
			// debug($o);
		} else {
			$this->Session->setFlash('Грешен код на поръчка');
			// TODO: Log this action as it could be data mine attemp
		}
	}
	
	function track($trackHash = false) {
		if(!empty($this->data)) $trackHash = $this->data['Order']['track_hash'];
		if ($trackHash) {
			if ($uid = $this->Auth->user('id')) {
				if($o = $this->Order->findByTrackHash($trackHash)) {
					if ($uid != $o['User']['id'] && $o['User']['id'] != 0) {
						$this->Session->setFlash('Тази поръчка принадлежи на друг потребител.');
					} else {
						$this->set('order',$o);
					}
				} else $this->Session->setFlash('Няма такава поръчка');
			} else {
				if($o = $this->Order->findByTrackHash($trackHash)) {
					if ($o['User']['id'] != 0) {
						//u can't view user-orders unlogged
						$this->Session->setFlash('За да видите тази поръчка трябва да влезете.');
					} else {
						$this->set('order',$o);			
					}
				} else $this->Session->setFlash('Няма такава поръчка');
			}
			// debug($o);
		} else {
			$this->Session->setFlash('Грешен код на поръчка');
			// TODO: Log this action as it could be data mine attemp
		}	
	}
	
		// cancel order
	function cancel($trackHash = false) {
		if (!$trackHash)  {
			$this->Session->setFlash('Няма такава поръчка');
			$this->redirect(array('controller' => 'users', 'action' => 'index'));
		}
		$conditions['not'] = array('Order.status' => array('canceled', 'sent', 'rejected', 'processing'));
		$conditions['Order.track_hash'] = $trackHash;
		$conditions['Order.user_id'] = $this->Auth->user('id');
		
		if ($order = $this->Order->find('first', array('conditions' => $conditions) )) {
			$order['Order']['status'] = 'canceled';
			if($this->Order->save($order,false)) {
				$this->Session->setFlash('Поръчката е отказана');
				$this->redirect(array('controller' => 'users', 'action' => 'index'));
			} else {
				$this->Session->setFlash('Грешка. Поръчката не е отказана');
				$this->redirect(array('controller' => 'users', 'action' => 'index'));
			}
		} else {
			$this->Session->setFlash('Грешка. Няма такава поръчка или поръчката вече е изпратена');
			$this->redirect(array('controller' => 'users', 'action' => 'index'));
		}
	}
	
	function admin_index() {
		$this->paginate = array(
			'limit' => 50
		);
		$this->set('orders', $this->paginate());
	}
	
	function admin_edit($id = null) {
		if(!$id) { $this->Session->setFlash('Bad ID'); $this->redirect($this->referer()); }
		
		if(!empty($this->data)) {
			// update order
			$order = $this->Order->findById($id);
			$this->data['Order']['id'] = $id;
			$this->data['Order']['email'] = $order['Order']['email'];
			if($this->Order->save($this->data, false)) {
				$this->Session->setFlash('Успешна редакция на поръчка');
				$this->OpiMailer->notifyEditedOrder($this->data);
				$this->redirect(array('action'=>'index'));
			} else {
				$this->Session->setFlash('Неуспешна редакция на поръчка');
				$this->redirect(array('action'=>'index'));
			}
		} else {
			$this->data = $this->Order->read(null, $id);
			$statuses = array(
				'pending' => 'Изчакване',
				'processing' => 'Обработва се',
				'sent' => 'Изпратена',
				'rejected' => 'Отказана (от админ)',
				'canceled' => 'Анулирана (от поръчител)',
				'returned' => 'Върната (от поръчител)',
			);
			$this->set('status', $this->data['Order']['status']);
			$this->set('statuses', $statuses);
		}
	}
	
	function admin_pending() {
		$this->paginate = array(
			'conditions' => array(
				'status' => 'pending'
			)
		);
		$this->set('orders', $this->paginate());
		$this->render('admin_index');
	}
	
	
	function admin_processing() {
		$this->paginate = array(
			'conditions' => array(
				'status' => 'processing'
			)
		);
		$this->set('orders', $this->paginate());
		$this->render('admin_index');
	}
	
	function admin_sent() {
		$this->paginate = array(
			'conditions' => array(
				'status' => 'sent'
			)
		);
		$this->set('orders', $this->paginate());
		$this->render('admin_index');
	}
	
	function admin_rejected() {
		$this->paginate = array(
			'conditions' => array(
				'status' => 'rejected'
			)
		);
		$this->set('orders', $this->paginate());
		$this->render('admin_index');
	}
	
	function admin_canceled() {
		$this->paginate = array(
			'conditions' => array(
				'status' => 'canceled'
			)
		);
		$this->set('orders', $this->paginate());
		$this->render('admin_index');
	}
	
	function admin_returned() {
		$this->paginate = array(
			'conditions' => array(
				'status' => 'returned'
			)
		);
		$this->set('orders', $this->paginate());
		$this->render('admin_index');
	}
	
	
	function admin_view($id = null) {
		$this->set('order', $this->Order->read(null, $id));
	}
	
}
