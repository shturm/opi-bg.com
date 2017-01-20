<?php
class Color extends AppModel {
	var $name = 'Color';
	//The Associations below have been created with all possible keys, those that are not needed can be removed

	var $belongsTo = array(
		'ColorGroup' => array(
			'className' => 'ColorGroup',
			'foreignKey' => 'color_group_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);

	var $hasOne = array(
		'Product' => array(
			'className' => 'Product',
			'foreignKey' => 'color_id',
	/* 		'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => '' */
		)
	);

}
