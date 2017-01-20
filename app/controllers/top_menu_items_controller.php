<?php
class TopMenuItemsController extends AppController {

	var $name = 'TopMenuItems';
	var $components = array('RequestHandler');
	var $helpers = array('Js');

	
	function admin_recover() {
		$this->TopMenuItem->recover();
		$this->redirect(array('action' => 'index'));
	}
	
	function admin_index() {
		$topMenuItems = array_reverse($this->TopMenuItem->generatetreelist(null,null,null,'__'), true);
		$this->set('topMenuItems', $topMenuItems);
	}

	function admin_view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid top menu item', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('topMenuItem', $this->TopMenuItem->read(null, $id));
	}

	function admin_add() {
		if (!empty($this->data)) {
			$this->TopMenuItem->create();
			if ($this->TopMenuItem->save($this->data)) {
				$this->Session->setFlash(__('The top menu item has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The top menu item could not be saved. Please, try again.', true));
			}
		}
		
		$picks = $this->_linkData();
		$parents = array('' => '-') + $this->TopMenuItem->generatetreelist(null, null, null, '__');
		$this->set(compact('parents', 'picks'));
	}

	function admin_edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid top menu item', true));
			$this->redirect(array('action' => 'index'));
		}
		
		if (!empty($this->data)) {
			if ($this->TopMenuItem->save($this->data)) {
				$this->Session->setFlash(__('The top menu item has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The top menu item could not be saved. Please, try again.', true));
			}
		}
		
		if (empty($this->data)) {
			$this->data = $this->TopMenuItem->read(null, $id);
			$this->set('picked', $this->data['TopMenuItem']['link']);
		}
		
		$picks = $this->_linkData();
		
		$parents = array('0' => '-') + $this->TopMenuItem->generatetreelist(null, null, null, '__');
		$this->set(compact('parents', 'picks'));
	}

	function admin_delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for top menu item', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->TopMenuItem->delete($id)) {
			$this->Session->setFlash(__('Top menu item deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Top menu item was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}
	
	function _linkData() {
		$Product = ClassRegistry::init('Product');
		$Group = ClassRegistry::init('Group');
		$Page = ClassRegistry::init('Page');
		
		$products = $Product->find('list');
		$groups = $Group->find('list');
		$pages = $Page->find('list');
		
		foreach($products as $key => $val) {
			$keyNew = '/products/view/' . $key;
			$products[$keyNew] = $val;
			unset($products[$key]);			
		}
		foreach($groups as $key => $val) {
			$keyNew = '/groups/view/' . $key;
			$groups[$keyNew] = $val;
			unset($groups[$key]);
		}
		foreach($pages as $key => $val) {
			$keyNew = '/pages/view/' . $key;
			$pages[$keyNew] = $val;
			unset($pages[$key]);
		}
		
		$products = array('/products' => '[ПРОДУКТИ - ВСИЧКИ]') + $products;
		$groups = array('/groups' => '[ГРУПИ - ВСИЧКИ]') + $groups;
		
		
		$pages = array('/' => '[НАЧАЛНА СТРАНИЦА') + array('/pages/colors' => '[ПРЕГЛЕД НА ЛАК]') + $pages;
		
		$picks = array(
			'НИКЪДЕ' => array('#' => '[НИКЪДЕ]'),
			'Продуктови групи' => $groups, 
			'Страници' => $pages,
			'Продукти' => $products);
		return $picks;

	}
	
	function admin_moveUp($id) {
		
		if($this->TopMenuItem->movedown($id)) {
			$this->Session->setFlash(__('Ok', true));
		} else {
			$this->Session->setFlash(__('Failed to move node', true));
		}
		$this->redirect(array('action' => 'index'));
	}
	
	function admin_moveDown($id) {
		
		if($this->TopMenuItem->moveup($id)) {
			$this->Session->setFlash(__('Ok', true));
		} else {
			$this->Session->setFlash(__('Failed to move node', true));
		}
		$this->redirect(array('action' => 'index'));
	}
}
