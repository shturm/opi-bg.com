<?php
class User extends AppModel {
	var $name = 'User';
	var $displayField = 'email';
	var $validate = array(
		'email' => array(
			'email' => array(
				'rule' => array('email'),
				'message' => 'Валиден имейл адрес е необходим за да довършите регистрацията',
				'allowEmpty' => false,
				'required' => true,
				// 'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
			'unique' => array(
				'rule' => 'isUnique',
				'message' => 'Този адрес вече е зает'
			)
		),
		'password' => array(
			'min' => array(
				'rule' => array('minLength', 4),
				'message' => 'Паролата трябва да е поне 4 символа',
				// 'allowEmpty' => false,
				// 'required' => true,	
			),
			'notempty' => array(
				'rule' => 'notEmpty',
				'message' => 'Трябва да въведете парола'
			)
		),
		'password_confirm' => array(
			'notempty' => array(
				'rule' => 'notEmpty',
				'message' => 'Ползването на парола е задължително'
			)
		),
		'license_code' => array(
			'unique' => array(
				'rule' => 'isUnique',
				'message' => 'Този лицензен код е вече зает',
				'on' => 'create'
			),
			'notempty' => array(
				'rule' => 'notEmpty',
				'message' => 'Лицензният код е задължителен за попълване за да се гарантира истинноста на вашият фирмен акаунт',
				'on' => 'create'
			)
		),
		'name' => array(
			'present' => array(
				'rule' => 'notEmpty',
				'allowEmpty' => true,		
				'required' => true,	
				'message' => 'Задължително е да посочите лице за контакт',
				'on' => 'create'
			)
		),
		'address' => array(
			'present' => array(
				'rule' => 'notEmpty',
				'allowEmpty' => true,		
				'required' => false,	
				'message' => 'Това поле е задължително за изпълнение на доставка',
				'on' => 'create'
			)
		),
		'delivery_address' => array(
			'present' => array(
				'rule' => 'notEmpty',
				'allowEmpty' => false,		
				'required' => true,	
				'message' => 'Това поле е задължително за изпълнение на доставка',
				'on' => 'create'
			)
		),		
		'phone' => array(
			'present' => array(
				'rule' => 'notEmpty',
				'allowEmpty' => true,		
				'required' => true,	
				'message' => 'Телефонът е задължителен за да може да се потвърди поръчка',
				'on' => 'create'
			)
		),
		// Vendor/Shop data validation goes here
		'company' => array(
			'unique' => array(
				'rule' => 'isUnique',
				'message' => 'Това име на фирма вече е заето. Ако вие представлявате фирмата, но не сте правили регистрацията - свържете се с нас.'			
			)
		),
		'bulstat' => array(
			'unique' => array(
				'rule' => 'isUnique',
				'message' => 'Този булстат вече е зает. Ако вие представлявате фирмата, но не сте правили регистрацията - свържете се с нас.'
			)
		),
	);
	//The Associations below have been created with all possible keys, those that are not needed can be removed

	var $hasMany = array(
		'Order' => array(
			'className' => 'Order',
			'foreignKey' => 'user_id',
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

    /* function hashPasswords($data) {
        if (isset($data['User']['password'])) {
            $data['User']['password'] = md5($data['User']['password']);
            return $data;
        }
        return $data;
    }	
	
	function onBeforeSave($data) {
		$data['User']['passowrd'] = md5(
	} */
}
