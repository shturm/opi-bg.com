<?php
/**
 * Application level Controller
 *
 * This file is application-wide controller file. You can put all
 * application-wide controller-related methods here.
 *
 * PHP versions 4 and 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright 2005-2010, Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright 2005-2010, Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       cake
 * @subpackage    cake.app
 * @since         CakePHP(tm) v 0.2.9
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @package       cake
 * @subpackage    cake.app
 */
class AppController extends Controller {
	var $components = array('Security' => array('validatePost' => false), 'Session', 'Cart', 'Auth');
	var $uses = array('PageLoad', 'Product');
	var $background_for_layout = '';
	// logs the page load
	
	function beforeFilter() {
	// debug($this->Session->read('Cart'));
  
		
		// check layout/menus
		if(isset($this->params['prefix']) && $this->Auth->user('role') == 'admin') $this->layout = 'admin';
		
		// ensure admin access
		if(isset($this->params['prefix']) && $this->Auth->user('role') != 'admin') 
		$this->redirect(array('admin' => false, 'controller' => 'pages', 'action' => 'index'));
		
		// set auth stuff
		$this->Auth->allow('*');
		$this->Auth->fields = array(
			'username' => 'email',
			'password' => 'password'
		);
		$this->Auth->loginError = "Грешно потребителско име или парола";    
		$this->Auth->authError = "За достъп до този ресурс трябва да имате <b><a href='/users/login'>влезете</a></b> или да се <b><a href='/users/register'> регистрирате</a></b>";	
		$this->Auth->userScope = array('User.is_active' => true, 'User.is_confirmed' => true);
		if ($user = $this->Auth->user())  {
			$this->set('user', $this->Auth->user()); 
		} else {
			// $this->Session->write('Auth.User.name', 'Гост');
			// $this->set('user', $this->Auth->user()); 
		}
		$this->Auth->loginRedirect = array('controller' => 'users', 'action' => 'index');
		
		//set menu
		$tmi = ClassRegistry::init('TopMenuItem');
		$tmi->contain();
		$top_menu_items = $tmi->find('threaded');
		// debug($top_menu_items);
		$this->set('top_menu', $top_menu_items);
		
		$dmi = ClassRegistry::init('DownMenuItem');
		$down_menu_items = $dmi->find('all', array('order' => 'order asc') );
		$this->set('down_menu', $down_menu_items);
		
		// set cart
		$this->set('cart', $this->Cart->calculate());
		// logs the impresion
		// fix this shit: 
		// Notice (8): Undefined index: is_collection [APP\app_controller.php, line 55]
		// Notice (8): Undefined index: is_promotion [APP\app_controller.php, line 57]
		// Warning (2): Cannot modify header information - headers already sent by (output started at C:\xampp\htdocs\opi\cake\libs\debugger.php:673) [CORE\cake\libs\controller\controller.php, line 742]
		// $this->_log_impresion();
	/* 	
		$this->Auth->loginError = "Грешно потребителско име или парола";    
		$this->Auth->authError = "За достъп до този ресурс трябва да имате <b><a href='/users/login'>влезете</a></b> или да се <b><a href='/users/register'> регистрирате</a></b>";
		$this->Auth->allow("register", "display"); */
	}
	
	function beforeRender() {
		$this->set('background_for_layout', $this->background_for_layout);
	}

	function error() {
		$this->render('/errors/error404');
	}
}
