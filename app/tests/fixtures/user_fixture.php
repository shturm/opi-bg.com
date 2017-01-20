<?php
/* User Fixture generated on: 2011-08-10 02:49:05 : 1312933745 */
class UserFixture extends CakeTestFixture {
	var $name = 'User';

	var $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'primary'),
		'username' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 45, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'password' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 64, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'email' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 64, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'first_name' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 45, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'sur_name' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 45, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'family_name' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 45, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'address' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 128, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'delivery_address' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 128, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'phone' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 24, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'company' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 64, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'mol' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 64, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'bulstat' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 64, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'dds' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 64, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'egn' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 64, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'salon' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 64, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'confirmation_key' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 64, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'confirmation_key_sent' => array('type' => 'timestamp', 'null' => true, 'default' => 'CURRENT_TIMESTAMP'),
		'recovery_key' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 64, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'recovery_key_sent' => array('type' => 'datetime', 'null' => true, 'default' => NULL),
		'register_ip' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 16, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'last_ip' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 16, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'last_login_date' => array('type' => 'datetime', 'null' => true, 'default' => NULL),
		'date_registered' => array('type' => 'datetime', 'null' => true, 'default' => NULL),
		'is_active' => array('type' => 'boolean', 'null' => true, 'default' => '0'),
		'is_confirmed' => array('type' => 'boolean', 'null' => true, 'default' => '0'),
		'personal_discount' => array('type' => 'float', 'null' => true, 'default' => '0', 'comment' => 'personal discount - if for some reason the user is VIP
'),
		'vendor_discount' => array('type' => 'float', 'null' => true, 'default' => '0', 'comment' => 'discount which the wholesale vendor uses'),
		'semivendor_discount' => array('type' => 'float', 'null' => true, 'default' => '0', 'comment' => 'discount which the semivendor uses'),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1)),
		'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_general_ci', 'engine' => 'InnoDB')
	);

	var $records = array(
		array(
			'id' => 1,
			'username' => 'Lorem ipsum dolor sit amet',
			'password' => 'Lorem ipsum dolor sit amet',
			'email' => 'Lorem ipsum dolor sit amet',
			'first_name' => 'Lorem ipsum dolor sit amet',
			'sur_name' => 'Lorem ipsum dolor sit amet',
			'family_name' => 'Lorem ipsum dolor sit amet',
			'address' => 'Lorem ipsum dolor sit amet',
			'delivery_address' => 'Lorem ipsum dolor sit amet',
			'phone' => 'Lorem ipsum dolor sit ',
			'company' => 'Lorem ipsum dolor sit amet',
			'mol' => 'Lorem ipsum dolor sit amet',
			'bulstat' => 'Lorem ipsum dolor sit amet',
			'dds' => 'Lorem ipsum dolor sit amet',
			'egn' => 'Lorem ipsum dolor sit amet',
			'salon' => 'Lorem ipsum dolor sit amet',
			'confirmation_key' => 'Lorem ipsum dolor sit amet',
			'confirmation_key_sent' => '1312933745',
			'recovery_key' => 'Lorem ipsum dolor sit amet',
			'recovery_key_sent' => '2011-08-10 02:49:05',
			'register_ip' => 'Lorem ipsum do',
			'last_ip' => 'Lorem ipsum do',
			'last_login_date' => '2011-08-10 02:49:05',
			'date_registered' => '2011-08-10 02:49:05',
			'is_active' => 1,
			'is_confirmed' => 1,
			'personal_discount' => 1,
			'vendor_discount' => 1,
			'semivendor_discount' => 1
		),
	);
}
