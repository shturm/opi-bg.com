<?php
class GroupsController extends AppController {

	var $name = 'Groups';
	// var $background_for_layout = '/img/backgrounds/flowers.png';
	var $background_for_layout = '';
	// var $scaffold = 'admin';
	
	function beforeFilter() {
		parent::beforeFilter();
		$this->helpers[] = 'Opi';
	}
	function admin_recover() {
		$this->Group->recover('parent');
		$this->redirect('/admin');
	}
	
	function index() {
		// $this->Group->recursive = 0;
		$this->set('groups', $this->Group->find('all', array('conditions' => array('Group.is_active' => true) )));
	}

	function view($id = null) {
		// $this->background_for_layout = '/img/backgrounds/allcolors.png';
		if (!$id) {
			$this->Session->setFlash(__('Invalid group', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->Group->recursive = 1;
		if ($group = $this->Group->find('first', array('conditions' => array('Group.is_active' => true, 'Group.id' => $id) )) ) {
			$this->set('group', $group);

				// get popular products
				if($this->Auth->user('role') == 'vendor') $show_pro = true; else $show_pro = false;
				$popular = $this->Group->Product->getPopularFromGroup($group, 11, $show_pro);
				
				// get prodcuts of the group
				$this->paginate = array('order' => 'Product.vendor_price desc', 'limit' => 24); // to bring collections in front 
				
				$all_products_conditions['Product.is_active'] = true;
				$all_products_conditions['Product.group_id'] = $group['Group']['id'];
				$all_products_conditions['Product.is_pro'] = false;
				if($this->Auth->user('role') == 'vendor') unset($all_products_conditions['Product.is_pro']);
				$products = $this->paginate('Group.Product', $all_products_conditions);
				
				$this->set('popular_products', $popular);
				$this->Cart->setCalculatedPrices($products);
				$this->set('all_products', $products);

		} else $this->error();
	}
	// bubble sorts nested array by specified nested content key
	// like array(0 => array('impressions' => 5),  1 => array('impressions' => 7))
	function _psort(&$arr, $key) {
		$ready = true;
		$buffer = array();
		
		foreach($arr as $index => $p) {
			if(isset($arr[$index+1])) {
				if ($arr[$index][$key] < $arr[$index+1][$key]) {
					$buffer = $arr[$index][$key];
					$arr[$index][$key] = $arr[$index+1][$key];
					$arr[$index+1][$key] = $buffer;
					$ready = false;
				}
			}
		}
		if(!$ready)  return $this->_psort($arr, $key); else return true;
	}
	
	function admin_index() {
		$this->Group->recursive = 0;
		$this->paginate();
		$groups = $this->Group->generatetreelist(null, null, null, '____');
		$this->set('groups', $groups);
	}

	function admin_view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid group', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('group', $this->Group->read(null, $id));
	}

	function admin_add() {
		if (!empty($this->data)) {
			unset($this->data['Group']['rght']);
			unset($this->data['Group']['lft']);
			$this->Group->create();
			if ($this->Group->save($this->data)) {

				$this->Session->setFlash(__('The group has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The group could not be saved. Please, try again.', true));
				debug($this->data);
			}
		}
		$parentGroups = array('0' => '-') + $this->Group->generatetreelist(null, null, null, '__');

		$this->set(compact('parentGroups'));
	}
	

	function admin_edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid group', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
	
			if ($this->Group->save($this->data)) {
				$this->Session->setFlash(__('The group has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				debug($this->data);
				$this->Session->setFlash(__('The group could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Group->read(null, $id);
		}
		// $tmp['0'] = '-';
		$parentGroups = array('0' => '-') + $this->Group->generatetreelist();

		$this->set(compact('parentGroups'));
	}

	function admin_delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for group', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Group->delete($id)) {
			$this->Session->setFlash(__('Group deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Group was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}
	
	function admin_orderUp($id) {
		if(!$id) $this->Session->setFlash('Bad #id');
		$this->Group->Behaviors->detach('Tree'); // detach due to a method name conflict with SortableBehaviour
		if ($this->Group->moveUp($id)) {
			$this->Session->setFlash('Ok');
		} else $this->Session->setFlash('Failed to move up');
		$this->redirect(array('action' => 'index'));
	}
	
	function admin_orderDown($id) {
		if(!$id) $this->Session->setFlash('Bad #id');
		$this->Group->Behaviors->detach('Tree'); // detach due to a method name conflict with SortableBehaviour
		if ($this->Group->moveDown($id)) {
			$this->Session->setFlash('Ok');
		} else $this->Session->setFlash('Failed to move down');
		$this->redirect(array('action' => 'index'));
	}
	
}
