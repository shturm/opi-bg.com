<?php
class Order extends AppModel {
	var $name = 'Order';
	var $displayField = 'date_created';
	// var $order = 'Order.id desc';
	//The Associations below have been created with all possible keys, those that are not needed can be removed

	var $belongsTo = array(
		'User' => array(
			'className' => 'User',
			'foreignKey' => 'user_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
	
	var $hasMany = array(
		'OrderedProduct' => array(
			'className' => 'OrderedProduct',
			'foreignKey' => 'order_id',
			'joinTable' => 'ordered_products'
		)
	); 
	
	var $validate = array(
		'name' => array(
			'notempty' => array(
				'rule' => 'notEmpty',
				'message' => 'Трябва да посочите получател'
			)
		),
		'email' => array(
			'the email' => array(
				'rule' => 'email',
				'message' => 'Посоченият имейл не е валиден'
			)
		),
		'delivery_address' => array(
			'notempty' => array(
				'rule' => 'notEmpty',
				'message' => 'Трябва да посочите адрес за доставка'
			)
		),
		'phone' => array(
			'notempty' => array(
				'rule' => 'notEmpty',
				'message' => 'Трябва да посочите телефон за потвърждение на поръчката'
			),
			'actualNumber' => array(
				'rule' => array('phone', '/^(\+?)([0-9 ]+)$/'),
				'message' => 'Въведеният телефонен номер не е валиден'
			)
		),
		
	);

}
