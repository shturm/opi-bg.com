<?php
/* Color Fixture generated on: 2011-08-24 03:49:47 : 1314146987 */
class ColorFixture extends CakeTestFixture {
	var $name = 'Color';

	var $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'primary'),
		'name' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 45, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'color_group_id' => array('type' => 'integer', 'null' => true, 'default' => '0'),
		'colorscol' => array('type' => 'string', 'null' => true, 'default' => '0', 'length' => 45, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1)),
		'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_general_ci', 'engine' => 'InnoDB')
	);

	var $records = array(
		array(
			'id' => 1,
			'name' => 'Lorem ipsum dolor sit amet',
			'color_group_id' => 1,
			'colorscol' => 'Lorem ipsum dolor sit amet'
		),
	);
}
