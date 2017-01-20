<?php
/**
 * Application level View Helper
 *
 * This file is application-wide helper file. You can put all
 * application-wide helper-related methods here.
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
 * @subpackage    cake.cake
 * @since         CakePHP(tm) v 0.2.9
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */
App::import('Helper', 'Helper', false);

/**
 * This is a placeholder class.
 * Create the same file in app/app_helper.php
 *
 * Add your application-wide methods in the class below, your helpers
 * will inherit them.
 *
 * @package       cake
 * @subpackage    cake.cake
 */
class AppHelper extends Helper {
	function orderStatus($status, $style = true) {
		switch ($status) {
			case 'pending':
				$color = 'red';
				$status =  'Изчакване';
				break;
			case 'processing':
				$color = 'yellow';
				$status =  'Обработва се';
				break;
			case 'sent':
				$color = 'green';
				$status =  'Изпратена';
				break;
			case 'rejected':
				$color = 'cyan';
				$status =  'Отказана от админ';
				break;
			case 'canceled':
				$color = 'blue';
				$status =  'Анулирана от поръчител';
				break;
			case 'returned':
				$color = 'orange';
				$status =  'Върната';
				break;
			default:
				$color = 'red';
				$status = 'UNKNOWN';
				break;
		}
		if($style)
			return '<span style="color: '. $color .';">'. $status .'</span>';
		else return $status;
	}
	
	function orderPayment($payment = 'onsite') {
		switch ($payment) {
			case 'onsite':
				return 'Наложен платеж';
				break;
			default:
				return 'ERROR';
				break;
		}
	}
	
	function productType($type = 'product') {
		switch ($type) {
			case 'product':
				return 'Продукт';
				break;
			case 'promotion':
				return 'Промоция';
				break;
			case 'lacquer':
				return 'Лак';
				break;
			case 'collection':
				return 'Колекция';
				break;
			default:
				return 'UNKNOWN';
				break;
		}
	}
	
	function userRole($role = 'unregistered') {
		switch ($role) {
			case 'user':
				return 'Потребител';
				break;
			case 'vendor':
				return 'Търговец/професионалист';
				break;
			case 'shop':
				return 'Магазин';
				break;
			case 'unregistered':
				return 'Без регистрация';
				break;
			default:
				return 'UNKNOWN';
				break;
		}
	}
}
