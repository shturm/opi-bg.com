<?php
class UsersController extends AppController {

	var $name = 'Users';
	var $components = array('Email', 'RecaptchaPlugin.Recaptcha');
	var $helpers = array('RecaptchaPlugin.Recaptcha');
	var $background_for_layout = '/img/backgrounds/flowers.png';
	
	function beforeFilter() {
		parent::beforeFilter();
		$this->Auth->deny('index', 'myorders');
		// $this->Auth->authenticate = ClassRegistry::init('User');
	}
	
	function index() {
		if($this->Auth->user()) {
			$user = $this->User->findById($this->Auth->user('id'));
			// reverse the orders array since we can't put generic order of associations
			$user['Order'] = array_reverse($user['Order']);
			$this->set('user',$user);
			if($user['User']['role'] == 'admin') $this->redirect(array('admin' => true, 'controller' => 'pages', 'action' => 'admin'));
		} else {
			$this->Session->setFlash('Трябва да влезете за да видите профила си');
			$this->redirect('/users/login');
		}
	}
	
	function login() {
		if($this->Auth->user('role') == 'admin')
		$this->redirect(array('admin' => true, 'controller' => 'pages', 'action' => 'admin'));
		
	}
	
	function logout() {
		$this->Session->write('Auth');
		$this->redirect($this->Auth->logout());
	}
	
	function _ipCanRegister() {
		$max_registrations = 3; // max registrations the user is allowed to have from single IP
		// if(!$ip) return false;
		$yesterday = date('Y-m-d H:i:s', time() - 86400);
		$count_ip = $this->User->find('count', array(
			'conditions' => array(
				'User.register_ip' => $_SERVER['REMOTE_ADDR'],
				'User.created >' => $yesterday
			)
		));
		/* debug($count_ip);
		debug($this->User->getLastQuery()); die(); */
		if($count_ip > $max_registrations) return false;
		return true;
	}
	
	function register($type = 'user') {
				// debug($this->data);
		
		if (!empty($this->data)) {
			//check if user had more than 3 registrations for the last day
			if(!$this->_ipCanRegister()) {
				$this->Session->setFlash('Известно време няма да можете правите повече регистрации. За повече информация се свържете с нас.');
				$this->redirect($this->referer());
			}
		
			if ($this->data['User']['password'] == $this->Auth->password($this->data['User']['password_confirm'])) {
				$user = $this->data;
				$user['User']['register_ip'] = $_SERVER['REMOTE_ADDR'];
				$user['User']['confirmation_key'] = md5($user['User']['email'] . date(time()) );
				
				//ensure no form forgery
				$user['User']['discount'] = null;
				switch($type) {
					case 'user':
						$user['User']['role'] = 'user';
						break;
					case 'shop':
						$user['User']['role'] = 'shop';
						$user['User']['discount'] = 40;
						break;
					case 'vendor':
						$user['User']['role'] = 'vendor';
						break;
					case 'pro':
						$user['User']['role'] = 'vendor';
						break;
					default:
						$user['User']['role'] = 'user';
						break;
				}
				if(isset($user['User']['id'])) unset($user['User']['id']);
				
				
				if ($this->User->save($user)) {
					// user is registered
					$this->_sendNewUserMail($user);
					if($user['User']['role'] != 'user') {
					$this->Session->setflash('Успешна регистрация. Инструкции за потвърждението са изпратени на посочения мейл. Тъй като акаунта Ви е фирмен той подлежи на ръчно одобрение преди да можете да влезете с него.');
					} else $this->Session->setFlash('Успешна регистрация. Инструкции за потвърждение на акаунта са изпратени на посочения имейл.');
					$this->redirect('/users/login');
				} else {
					$this->data['User']['password'] = '';
					$this->data['User']['password_confirm'] = '';
				}
			} else  {
				$this->Session->setFlash('Паролите не съвпадат');
			}
			// $this->data['User']['password'] = '';
		}
		// $this->data['User']['password'] = '';
		// $this->data['User']['password_confirm'] = '';

		// registration type - handled by the view logic
		$this->set('type', $type);
		
		// DEBUGGING ONLY - REMOVE ON DEPLOYMENT !!
		// $this->User->recursive = 0;
		// $users = $this->User->find('all');
		// $this->set(compact('users'));
		
	}
	
	function recover($recovery_key = false) {
		// debug($this->data);
		if (!empty($this->data)) {
			// user requests password email
			$user = $this->User->findByEmail($this->data['User']['Email']);
			if(is_array($user)) {
				$user['User']['recovery_key'] = md5($user['User']['email'] . date(time()));
				$user['User']['recovery_key_sent'] = date('Y-m-d H:i:s', time());
				if($this->User->save($user, false)) {
					$this->_sendRecoverUserMail($user);
					$this->Session->setFlash('На имейла ви е изпратено писмо с инструкции за възстановяване на паролата');
				} else {
					$this->Session->setFlash('Имаше проблем и паролата не е изпратена. Моля, свържете се с нас за съдействие на support@opi-bg.com');
				}
			} else {
				$this->Session->setFlash('Няма потребител с този имейл адрес');
			}
		} else if ($recovery_key) {
			// user requests passowrd change due to provided recovery key
			if ($user = $this->User->findByRecoveryKey($recovery_key)) {
				$new_pass = substr(md5($user['User']['email'] . date(time())) , 0, 5);
				$user['User']['password'] = $this->Auth->password($new_pass);
				$user['User']['recovery_key'] ='';
				$user['User']['recovery_key_sent'] = '';
				if($this->User->save($user, false)) {
					$this->Session->setFlash('Новата ви парола е <b>'.$new_pass.'</b>. Можете да я смените след като влезете.');
					$this->redirect('/users/login');
				} else {
					$this->Session->setFlash('Имаше проблем и паролата не е сменена. Моля, свържете се с нас за съдействие на support@opi-bg.com');
				}
			} else {
				$this->Session->setFlash('Грешен код');
				//TODO: Log this event as it might be offensive
			}
		} else {
			// user neither provided recovery key to reset password nor is he requesting email
			// $this->redirect('/users/');
		}
	}

	function changepassword() {
			//debug($this->Auth->user());
			//debug($this->data);
			//user is logged?
			if ($user = $this->Auth->user()) {
				$user = $this->User->findById($user['User']['id']); //need this since Auth component doesn't provide the pass hash
				//is this a post ?
				if(!empty($this->data)) {
					//do the new password fields match ?
					if ($this->data['User']['new_password'] == $this->data['User']['new_password_confirm']) {
						//does the user remember his old password ?
						if ($user['User']['password'] == $this->Auth->password($this->data['User']['old_password'])) {
							//change the password and store it
							$user['User']['password'] = $this->Auth->password($this->data['User']['new_password']);
							$this->User->save($user);
							$this->Session->setFlash('Паролата ви е успешно сменена.');
							$this->redirect('/users/');
						} else $this->Session->setFlash('Това не е старата ви парола');
					} else $this->Session->setFlash('Полетата с новите пароли не съвпадат');
				}
			} else $this->Session->setFlash('Трябва да влезете за да смените паролата си. ');
		}

	function confirm($ckey) {
		if ($user = $this->User->findByConfirmationKey($ckey)) {
			//TODO: isnt this confirmation key too old ?
			$user['User']['is_confirmed'] = true;
			if ($user['User']['role'] == 'user') $user['User']['is_active'] = true;
			$user['User']['date_registered'] = date('Y-m-d H:i:s', time());
			$user['User']['confirmation_key'] = '';
			if ($this->User->save($user, false)) { //save without validation.
				$this->Session->setFlash('Успешно потвърдихте регистрацията на акаунта си.');
				$this->redirect('/users/login');
			} else {
				$this->Session->setFlash('Грешка при потвърждаването на потребителя.');
				debug($this->User->validationErrors);
			}
			$this->set('type', $user['User']['role']);
			// $this->redirect('/users/login');
		} else {
			$this->Session->setFlash('Няма такъв ключ.');
			//TODO: log this action as it might be offensive
		}
	}
	
	function myorders() {
		if($this->Auth->user()) {
			$user = $this->User->findById($this->Auth->user('id'));
			// debug($user['Order']);
			$orders = $this->User->Order->findAllByUserId($user['User']['id']);
			$this->set('user',$user);
			$this->set('orders',$user['Order']);
			
		} else {
			$this->Session->setFlash('Трябва да влезете за да видите профила си');
			$this->redirect('/users/login');
		}
	}
	
	function change() {
				$this->Security->validatePost = false;
				
				
		if($this->Auth->user()) {
			if(empty($this->data)) {
				$this->data = $user = $this->User->findById($this->Auth->user('id'));
			} else {
				//ensure no form forgery
				$this->data['User']['id'] = $this->Auth->user('id');
				$this->data['User']['confirmation_key'] = $this->Auth->user('confirmation_key');
				$this->data['User']['confirmation_key_sent'] = $this->Auth->user('confirmation_key_sent');
				$this->data['User']['recovery_key'] = $this->Auth->user('recovery_key');
				$this->data['User']['recovery_key_sent'] = $this->Auth->user('recovery_key_sent');
				$this->data['User']['role'] = $this->Auth->user('role');
				$this->data['User']['is_active'] = $this->Auth->user('is_active');
				$this->data['User']['register_ip'] = $this->Auth->user('register_ip');
				$this->data['User']['last_ip'] = $this->Auth->user('is_active');
				$this->data['User']['last_login_date'] = $this->Auth->user('last_login_date');
				$this->data['User']['date_registered'] = $this->Auth->user('date_registered');
				$this->data['User']['is_confirmed'] = $this->Auth->user('is_confirmed');
				$this->data['User']['personal_discount'] = $this->Auth->user('personal_discount');
				$this->data['User']['shop_discount'] = $this->Auth->user('shop_discount');
				$this->data['User']['license_code'] = $this->Auth->user('license_code');
				
				
				if($this->User->save($this->data, false)) {
					$this->Session->setFlash('Успешно променихте профила си');
					$this->redirect(array('action' => 'index'));
				} else {
					$this->Session->setFlash('Промените не са успешни');
					// $this->redirect(array('action' => 'index'));
				}
			}

			$orders = $this->User->Order->findAllByUserId($user['User']['id']);
			$this->set('user',$user);
		} else {
			$this->Session->setFlash('Трябва да влезете за да видите профила си');
			$this->redirect('/users/login');
		}
	}
	
	function _sendNewUserMail($user) {
		$this->Email->to = $user['User']['email'];
		// $this->Email->bcc = array('secret@example.com');  
		$this->Email->subject = 'Регистрация Opi-bg.com';
		$this->Email->replyTo = 'support@opi-bg.com';
		$this->Email->from = 'No Reply <no-reply@opi-bg.com>';
		$this->Email->template = 'user_register'; // note no '.ctp'
		//Send as 'html', 'text' or 'both' (default is 'text')
		$this->Email->sendAs = 'html'; // because we like to send pretty mail
		//Set view variables as normal
		$this->set('user', $user);
		$this->set('confirmation_key', $user['User']['confirmation_key']);
		//Do not pass any args to send()
		$this->Email->send();
	}

	function _sendRecoverUserMail($user) {

		$this->Email->to = $user['User']['email'];
		// $this->Email->bcc = array('secret@example.com');  
		$this->Email->subject = 'Изгубена парола за Opi-bg.com';
		$this->Email->replyTo = 'support@opi-bg.com';
		$this->Email->from = 'No Reply <no-reply@opi-bg.com>';
		$this->Email->template = 'user_recover'; // note no '.ctp'
		//Send as 'html', 'text' or 'both' (default is 'text')
		$this->Email->sendAs = 'html'; // because we like to send pretty mail
		//Set view variables as normal
		$this->set('user', $user);
		$this->set('recovery_key', $user['User']['recovery_key']);
		//Do not pass any args to send()
		$this->Email->send();
	}
	
	// admin has activated $user's account
	function _sendActivatedUserMail($user) {
		$this->Email->to = $user['User']['email'];
		// $this->Email->bcc = array('secret@example.com');  
		$this->Email->subject = 'Активиран акаунт в Opi-bg.com';
		$this->Email->replyTo = 'support@opi-bg.com';
		$this->Email->from = 'No Reply <no-reply@opi-bg.com>';
		$this->Email->template = 'user_activated'; // note no '.ctp'
		//Send as 'html', 'text' or 'both' (default is 'text')
		$this->Email->sendAs = 'both'; // because we like to send pretty mail
		//Set view variables as normal
		$this->set('user', $user);
		$this->set('recovery_key', $user['User']['recovery_key']);
		//Do not pass any args to send()
		$this->Email->send();
	}
	
	function admin_index($type = 'all') {
		$this->User->recursive = 0;
		$this->User->contain();
		switch($type) {
			case 'user':
				$conditions['User.role'] = 'user';
				break;
			case 'vendor':
				$conditions['User.role'] = 'vendor';
				break;
			case 'shop':
				$conditions['User.role'] = 'shop';
				break;
			default:
				$conditions = array();
				break;
			
		}
		$this->paginate = array('conditions' => $conditions);
		$this->set('users', $this->paginate());
	}

	function admin_view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid user', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('user', $this->User->read(null, $id));
	}

	function admin_add() {
		if (!empty($this->data)) {
			$this->User->create();
			if ($this->User->save($this->data)) {
				$this->Session->setFlash(__('The user has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The user could not be saved. Please, try again.', true));
			}
		}
	}

	function admin_edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid user', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->User->save($this->data)) {
				$this->Session->setFlash(__('The user has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The user could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->User->read(null, $id);
		}
	}

	function admin_delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for user', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->User->delete($id)) {
			$this->Session->setFlash(__('User deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('User was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}

	function admin_notconfirmed() {
		$this->paginate = array('conditions' => array('User.is_confirmed' => false) );
		$this->set('users', $this->paginate());
		$this->render('admin_index');
	}
	
	function admin_notactive() {
		$this->paginate = array('conditions' => array('User.is_active' => false) );
		$this->set('users', $this->paginate());
		$this->render('admin_index');
	}
	
	function admin_activate($id = null) {
		if(!$id) {
			$this->Session->setFlash('Bad id');
			$this->redirect(array('action' => 'index'));
		}
		if($user = $this->User->read(null, $id)) {
			$user['User']['is_active'] = true;
			if($this->User->save($user)) {
				$this->Session->setFlash('Потребител ' . $user['User']['email'] . ' е активиран');
				$this->redirect(array('action' => 'index'));
			}
		}
	}
	
	function admin_confirm($id = null) {
		if(!$id) {
			$this->Session->setFlash('Bad id');
			$this->redirect(array('action' => 'index'));
		}
		if($user = $this->User->read(null, $id)) {
			$user['User']['is_confirmed'] = true;
			if($this->User->save($user)) {
				$this->Session->setFlash('Потребител ' . $user['User']['email'] . ' е потвърден');
				$this->redirect(array('action' => 'index'));
			}
		}
	}
	
	function admin_confirmAndActivate($id = null) {
		if(!$id) {
			$this->Session->setFlash('Bad id');
			$this->redirect(array('action' => 'index'));
		}
		if($user = $this->User->read(null, $id)) {
			$user['User']['is_active'] = true;
			$user['User']['is_confirmed'] = true;
			if($this->User->save($user, false)) {
				$this->_sendActivatedUserMail($user);
				$this->Session->setFlash('Потребител ' . $user['User']['email'] . ' е активиран и потвърден. Потребителя е известен за събитието.');
				$this->redirect(array('action' => 'index'));
			} else die("couldnt save");
		}
	}
}
