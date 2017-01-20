<?php
class ColorGroup extends AppModel {
	var $name = 'ColorGroup';
	//The Associations below have been created with all possible keys, those that are not needed can be removed

	var $hasMany = array(
		'Color' => array(
			'className' => 'Color',
			'foreignKey' => 'color_group_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		)
	);

}
