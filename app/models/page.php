<?php
class Page extends AppModel {
	var $name = 'Page';
	var $displayField = 'name';
	//The Associations below have been created with all possible keys, those that are not needed can be removed

	var $belongsTo = array(
		'ParentPage' => array(
			'className' => 'Page',
			'foreignKey' => 'parent_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Product' => array(
			'className' => 'Product',
			'foreignKey' => 'product_id',
			'conditions' => array('Page.is_presentation' => true),
			'fields' => '',
			'order' => ''
		)
	);

	var $hasMany = array(
		'ChildPage' => array(
			'className' => 'Page',
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

	function get($arg = null) {
		if ($arg) {
			if (is_numeric($arg)) {
				return $this->findById($arg);
			} else {
				return $this->findByLatin($arg);
			}
		} else return false;
	}
	
	function getPresentation($arg = null) {
		if($arg) {
			if(is_numeric($arg)) {
				return $this->find('first', array(
					'conditions' => array(
						'Page.is_presentation' => true,
						'Page.id' => $arg
					)
				) );
			} else {
				return $this->find('first', array(
					'conditions' => array(
						'Page.is_presentation' => true,
						'Page.latin' => $arg
					)
				) );
			}
		}
	}

}
