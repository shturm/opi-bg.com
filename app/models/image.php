<?php
class Image extends AppModel {
	// var $deleteErrors = array();
	var $name = 'Image';
	var $displayField = 'alt';
	//The Associations below have been created with all possible keys, those that are not needed can be removed
	var $validate = array(
		'path' => array(
			'path' => array(
				'rule' => 'isUnique',
				'message' => 'Тази снимка вече съществува в базата данни',
				'allowEmpty' => false,
				'required' => true,
				// 'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			)
		)
	);
	var $hasAndBelongsToMany = array(
		'Group' => array(
			'className' => 'Group',
			'joinTable' => 'images_groups',
			'foreignKey' => 'image_id',
			'associationForeignKey' => 'group_id',
			'unique' => true,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'finderQuery' => '',
			'deleteQuery' => '',
			'insertQuery' => ''
		),
		'Product' => array(
			'className' => 'Product',
			'joinTable' => 'images_products',
			'foreignKey' => 'image_id',
			'associationForeignKey' => 'product_id',
			'unique' => true,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'finderQuery' => '',
			'deleteQuery' => '',
			'insertQuery' => ''
		)
	);
	
    var $hasMany = array(
        'ThumbProducts' => array(
            'className'     => 'Product',
            'foreignKey'    => 'thumb_id',
            // 'conditions'    => array('Comment.status' => '1'),
            // 'order'    => 'Comment.created DESC',
            // 'limit'        => '5',
            'dependent'=> false
        )
    ); 
	
	function beforeDelete() {
		if($products = $this->Product->findAllByThumbId($this->id)) {
			
			foreach($products as $p) {
				//only one
				$p['Product']['thumb_id'] = '0';
				$this->Product->save($p);
			}

		}
		return true;
	}
	
}
