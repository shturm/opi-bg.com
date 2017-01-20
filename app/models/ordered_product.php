<?php
class OrderedProduct extends AppModel {
	var $name = 'Order';
	var $displayField = 'name';
	var $useTable = 'ordered_products';
	

	var $belongsTo = array(
		'Order' => array(
			'className' => 'Order',
			'foreignKey' => 'order_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);

}
