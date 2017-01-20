<?php
class PagesController extends AppController {

	var $name = 'Pages';
	var $helpers = array('Form','Session','Tinymce');
	// var $background_for_layout = '/img/backgrounds/allcolors.png';
	var $background_for_layout = '';

	// changes the front page
	function admin_front_page() {
		
	}
	
	function front_page() {
		$front_page = $this->Page->findByIsFront(true);
		$this->redirect('view/' . $front_page['Page']['id']);
	}
	
	//deprecated - shows product summary
	function home() {
		$this->loadModel('Product');
		$latest = $this->Product->getLatest(11);
		$featured = $this->Product->getRandomFeatured('%', 11);
		$popular = $this->Product->getRandomPopular(11);
		$random = $this->Product->getRandom('%', 11);
		// debug($random);	debug($this->Product->getLastQuery());	die();
		$this->set(compact('latest','featured', 'popular', 'random'));
	}
	
	function colors() {
		$this->render('colors');
	}
	
	function index() {
		$this->redirect(array('action' => 'home'));
	}

	function view($arg = null) {

		$this->set('params',$this->params);
		if ($arg) {
			if($page = $this->Page->get($arg)) {
				if($page['Page']['is_presentation']) {
					$this->redirect(array('action' => 'present', $arg));
				} else {
					$this->set('page', $page);
					// debug($page);
				}
			}
		} else $this->redirect(array('action' => 'index'));

	}
	
	function present($arg) {
		$page = $this->Page->getPresentation($arg);
		if(!empty($page)) {
			$this->set('page', $page);
			$this->background_for_layout = $page['Page']['image_background'];
		}
	}
	
	function admin_index() {
		if ($this->Auth->user('role') != 'admin') $this->redirect('/');
		$this->Page->recursive = 0;
		$this->set('pages', $this->paginate());			
	}
	
	function admin_admin() {
		// enterprise users which are not activated
		$this->loadModel('User');
		$this->User->contain();
		$users = $this->User->find('all', array('conditions' => array('User.is_active' => false, 'User.role <>' => 'user'), 
			'order' => 'User.id desc', 
			'fields' => array('User.id', 'User.name', 'User.email', 'User.role', 'User.company', 'User.salon'),
			'limit' => 12) );
		// latest orders with state 'pending'
		$this->loadModel('Order');
		$this->Order->contain();
		$orders = $this->Order->find('all', array(
			'conditions' => array('Order.status' => 'pending'),
			'order' => 'Order.id desc',
			'fields' => array('Order.id', 'Order.email', 'Order.date_created', 'Order.total_sum'),
			'limit' => 12
		) );
		$this->set(compact('users', 'orders'));
	}

	function admin_view($id = null) {
		if ($this->Auth->user('role') != 'admin') $this->redirect('/');
		if (!$id) {
			$this->Session->setFlash(__('Invalid page', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('page', $this->Page->read(null, $id));
	}

	function admin_add() {
		if ($this->Auth->user('role') != 'admin') $this->redirect('/');
		if (!empty($this->data)) {
			$this->Page->create();
			if (!empty($this->data['Page']['new_image']['name'])) {
				$path = 'img/backgrounds/' . $this->data['Page']['new_image']['name'];
				if(!file_exists($path)) {
					move_uploaded_file($this->data['Page']['new_image']['tmp_name'], $path);
				}
				$this->data['Page']['image_background'] = '/' .$path;
			}	
			if ($this->Page->save($this->data)) {
				$this->Session->setFlash(__('The page has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The page could not be saved. Please, try again.', true));
			}
		}
		$products = $this->_getProducts();
		$parentPages = $this->Page->ParentPage->find('list');
		$this->set(compact('parentPages', 'products'));
	}

	function admin_edit($id = null) {
		if ($this->Auth->user('role') != 'admin') $this->redirect('/');
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid page', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if (!empty($this->data['Page']['new_image']['name'])) {
				$path = 'img/backgrounds/' . $this->data['Page']['new_image']['name'];
				if(!file_exists($path)) {
					move_uploaded_file($this->data['Page']['new_image']['tmp_name'], $path);
				}
				$this->data['Page']['image_background'] = '/' .$path;
				
			}
			if($this->data['Page']['is_front']) {
				$this->Page->updateAll(array('Page.is_front' => 0));
			}
			
			if ($this->Page->save($this->data)) {
				$this->Session->setFlash(__('The page has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The page could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $page = $this->Page->read(null, $id);
			$products = $this->_getProducts();
			$this->set('page', $page);
		}
		$parentPages = $this->Page->ParentPage->find('list');
		$this->set(compact('parentPages', 'products'));
	}

	function admin_delete($id = null) {
		if ($this->Auth->user('role') != 'admin') $this->redirect('/');
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for page', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Page->delete($id)) {
			$this->Session->setFlash(__('Page deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Page was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}
	
	function _getProducts() {
		return array('' => '-') + $this->Page->Product->find('list');
	}
}
