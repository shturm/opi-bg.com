<?php
class SearchController extends AppController {
	var $uses = array('Products');
	var $helpers = array('Opi');
	var $background_for_layout = '/img/backgrounds/allcolors.png';
	//search for given string in products
	function search() {
		if(empty($this->data['key'])) return;
		if(strlen($this->data['key']) < 3) return;
		$search_string = trim($this->data['key']);
		$search_regexp = '';

		$word_chunks = explode(' ', $search_string);
		// debug($word_chunks);
		if(count($word_chunks) > 1) $search_regexp .=  $search_string . '|';
		foreach ($word_chunks as $word) {
			$search_regexp .= $word . '|';
		}
		$search_regexp = substr($search_regexp, 0, count($search_regexp)-2); // erase last | symbol
		// debug($search_string);
		// debug($search_regexp);
		
		// debug($this->params['pass'][0]); exit;
		if($this->Auth->user('role') != 'vendor') $conditions['Product.is_pro'] = false;
		$conditions['or']['Product.tags regexp'] = $search_regexp;
		$conditions['or']['Product.code regexp'] = $search_regexp;
		$conditions['or']['Product.name regexp'] = $search_regexp;
		$conditions['or']['Product.description regexp'] = $search_regexp;
		
		$this->Product->contain('Group');
		$products = $this->Product->find('all', array(
			'conditions' => $conditions,
			'fields' => array(
				'Product.id',
				'Product.name',
				'Product.description',
				'Product.group_id',
				'Product.image_thumb',
				'Product.tags',
				'Product.price',
				'Product.discount',
				'Product.in_action',
				'Product.action_price',
				'Product.code',
				'Group.name',
			),
			'limit' => 36,
			// 'order' => 'Product.created desc',
		));
		$this->set(compact('products','search_string','search_regexp'));
		// debug($this->Product->getLastQuery());
		// debug($products);
	}
}
?>