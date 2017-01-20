<?php
class TopMenuItem extends AppModel {
	var $name = 'TopMenuItem';
	var $actsAs = array('Tree', 'Containable');
	var $order = 'TopMenuItem.lft desc';
	//The Associations below have been created with all possible keys, those that are not needed can be removed

	var $belongsTo = array(
		'ParentTopMenuItem' => array(
			'className' => 'TopMenuItem',
			'foreignKey' => 'parent_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);

	var $hasMany = array(
		'ChildTopMenuItem' => array(
			'className' => 'TopMenuItem',
			'foreignKey' => 'parent_id',
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
