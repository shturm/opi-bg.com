<?php
class DownMenuItem extends AppModel {
	var $name = 'DownMenuItem';
	var $actsAs = array(
		'Sortable' => array(
			'field' => 'order'
		),
		// 'Tree'
	);
	//The Associations below have been created with all possible keys, those that are not needed can be removed

}
