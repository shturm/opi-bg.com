<?php
class OpiMailerComponent extends Object {

	var $components = array('Email');
	
	/*
	* Notify user about a change about his order
	*/
	function notifyEditedOrder($order) {
		// debug($order); die();
		$this->Email->to = $order['Order']['email'];
		// $this->Email->bcc = array('secret@example.com');  
		$this->Email->subject = 'Обновен статус на поръчка в Opi-bg.com';
		$this->Email->replyTo = 'support@opi-bg.com';
		$this->Email->from = 'No Reply <no-reply@opi-bg.com>';
		$this->Email->template = 'user_notify_edited_order'; // note no '.ctp'
		//Send as 'html', 'text' or 'both' (default is 'text')
		$this->Email->sendAs = 'both'; // because we like to send pretty mail
		//Set view variables as normal
		$this->controller->set('order', $order);
		//Do not pass any args to send()
		$this->Email->send();
	}
	
	/*
	* Notify user that his order is created and waiting for admin attention
	*/
	function notifyNewOrder($order) {
		$this->Email->to = $order['Order']['email'];
		// $this->Email->bcc = array('secret@example.com');  
		$this->Email->subject = 'Нова поръчка в Opi-bg.com';
		$this->Email->replyTo = 'support@opi-bg.com';
		$this->Email->from = 'No Reply <no-reply@opi-bg.com>';
		$this->Email->template = 'user_notify_new_order'; // note no '.ctp'
		//Send as 'html', 'text' or 'both' (default is 'text')
		$this->Email->sendAs = 'both'; // because we like to send pretty mail
		//Set view variables as normal
		$this->controller->set('order', $order);
		//Do not pass any args to send()
		$this->Email->send();
	}
	/*
	* Notify user that his account is activated (by admin).
	*/
	function notifyActivatedAccount($user) {
		$this->Email->to = $user['User']['email'];
		// $this->Email->bcc = array('secret@example.com');  
		$this->Email->subject = 'Активиран акаунт в Opi-bg.com';
		$this->Email->replyTo = 'opi@opi-bg.com';
		$this->Email->from = 'No Reply <no-reply@opi-bg.com>';
		$this->Email->template = 'user_activated'; // note no '.ctp'
		//Send as 'html', 'text' or 'both' (default is 'text')
		$this->Email->sendAs = 'both'; // because we like to send pretty mail
		//Set view variables as normal
		$this->controller->set('user', $user);
		$this->controller->set('recovery_key', $user['User']['recovery_key']);
		//Do not pass any args to send()
		$this->Email->send();
	}
	
	/*
	* Notify the admin that a new order as been issued.
	*/
	function notifyAdminForOrder($order) {
		$this->Email->to = 'opi@opi-bg.com';
		$this->Email->bcc = array('shturm@urghh.net');  
		$this->Email->subject = 'НОВА ПОРЪЧКА Opi-bg.com';
		$this->Email->replyTo = 'opi@opi-bg.com';
		$this->Email->from = 'No Reply <no-reply@opi-bg.com>';
		$this->Email->template = 'new_order'; // note no '.ctp'
		//Send as 'html', 'text' or 'both' (default is 'text')
		$this->Email->sendAs = 'both'; // because we like to send pretty mail
		//Set view variables as normal
		$this->controller->set('order', $order);

		//Do not pass any args to send()
		$this->Email->send();
	}
	
	/*
	* Send user a password recovery email containing instructions on how to recover his password
	*/
	function recoverPassword($user) {
		$this->Email->to = $user['User']['email'];
		// $this->Email->bcc = array('secret@example.com');  
		$this->Email->subject = 'Изгубена парола за Opi-bg.com';
		$this->Email->replyTo = 'support@opi-bg.com';
		$this->Email->from = 'No Reply <no-reply@opi-bg.com>';
		$this->Email->template = 'user_recover'; // note no '.ctp'
		//Send as 'html', 'text' or 'both' (default is 'text')
		$this->Email->sendAs = 'both'; // because we like to send pretty mail
		//Set view variables as normal
		$this->controller->set('user', $user);
		$this->controller->set('recovery_key', $user['User']['recovery_key']);
		//Do not pass any args to send()
		$this->Email->send();
	}
	
	/* 
	* Send user email with confirmation link which will confirm (and activate if not enterprise) his account
	*/
	function confirmation($user) {
		$this->Email->to = $user['User']['email'];
		// $this->Email->bcc = array('secret@example.com');  
		$this->Email->subject = 'Регистрация Opi-bg.com';
		$this->Email->replyTo = 'support@opi-bg.com';
		$this->Email->from = 'No Reply <no-reply@opi-bg.com>';
		$this->Email->template = 'user_register'; // note no '.ctp'
		//Send as 'html', 'text' or 'both' (default is 'text')
		$this->Email->sendAs = 'both'; // because we like to send pretty mail
		//Set view variables as normal
		$this->controller->set('user', $user);
		$this->controller->set('confirmation_key', $user['User']['confirmation_key']);
		//Do not pass any args to send()
		$this->Email->send();
	}
	
	## CALLBACKS ##
	//called before Controller::beforeFilter()
	function initialize(&$controller, $settings = array()) {
		// saving the controller reference for later use
		$this->controller =& $controller;
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
	## END OF CALLBACKS ##
}
?>