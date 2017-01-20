<?php
class Product extends AppModel {
	var $name = 'Product';
	var $displayField = 'name';
	var $actsAs = 'Containable';
	// var $order = 'Product.id desc'; // makes error when retrieving assoc data
	//The Associations below have been created with all possible keys, those that are not needed can be removed
	var $validate = array(
		'latin' => array(
			'unique' => array(
				'rule' => 'isUnique',
				'message' => 'Този линк вече съществува. Стойността трябва да е уникална'
			)
		)
   
	);

	var $belongsTo = array(
		'Group' => array(
			'className' => 'Group',
			'foreignKey' => 'group_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Collection' => array(
			'className' => 'Product',
			'foreignKey' => 'collection_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
	);
 

	var $hasMany = array(
		'CollectionProduct' => array(
			'className' => 'Product',
			'foreignKey' => 'collection_id',
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
	

	function get($arg, $allow_pro = false) {
		if ($arg) {
			if (!$allow_pro) $conditions['Product.is_pro'] = false;
			
			if (is_numeric($arg)) {
				$conditions['Product.id'] = $arg;
				return $this->find('first', array('conditions' => $conditions));
			} else {
				$conditions['Product.latin'] = $arg;
				return $this->find('first', array('conditions' => $conditions));
			}
		} else return false;
	}
	/*
	* @return array of all featured products
	*/
	function getFeatured($type = '%') {
		$this->contain();
		return $this->find('all', array(
				'conditions' => array(
					'Product.is_active' => true,
					
					'Product.is_featured' => true,
					'Product.type LIKE' => $type,
					'not' => array(
						'Product.image_thumb' => 'null',
						'Product.is_pro' => true,
					)
				),
				'order' => 'Product.id desc'
			)		
		);
		// debug($this->getLastQuery()); die();
	}
	/* 
	*
	* @return array of featured products. It might return less then requested in $count if the featured products are less.
	*/
	function getRandomFeatured($type = '%', $count = 8) {
		$records = $this->getFeatured($type);
		if(count($records) < $count) return $records;
		$offset= count($records)-1;
		$featured_products=array();
		$i=0;
		while (count($featured_products) < $count) {   
			$rand_no=rand(0,$offset);
			 if (!in_array($records[$rand_no],$featured_products))
			 $featured_products[$i]=$records[$rand_no];
			 $i++;
			 if($i > 4*$count) break;
        }
		return $featured_products;
		
	}
	
	/*
	* @return products similar to this one based on tags and with images
	* @param array $product
	* @param int $count - count of the similar products. Default is 8
	* @param bool $pro - if pro products can be included in the similarities. Default is false
	*/
	function getSimilar($product, $count = 8, $pro = false) {
		if(empty($product)) return array();
		if(!is_array($product)) return array();
		if(!isset($product['Product']['tags'])) return array();
		
		$tag_chunks = explode(',',trim($product['Product']['tags']));
		foreach($tag_chunks as $key => $value) $tag_chunks[$key] = trim($tag_chunks[$key]);
		$tags_search = '';
		foreach($tag_chunks as $t) {
			$tags_search .= $t . '|';
		}
		$tags_search = substr($tags_search, 0, count($tags_search)-2); // erase last | symbol
		$conditions = array(
				'Product.is_active' => true,
				'not' => array(
					'Product.image_thumb' => 'null',
					'Product.is_pro' => true
				)
		);
		if ($pro) unset($conditions['not']['Product.is_pro']);
		if (!empty($tags_search)) $conditions['Product.tags regexp'] = $tags_search;
		$this->contain();
		$records = $this->find('all', array(
			'conditions' => $conditions,
			'order' => 'Product.id desc'
		) );
		// debug($records);
		
		// get random similar products
		if(count($records) < $count) return $records;
		$offset= count($records)-1;
		$similar_products=array();
		$i=0;
		while (count($similar_products) < $count) {   
			$rand_no=rand(0,$offset);
			 if (!in_array($records[$rand_no],$similar_products))
			 $similar_products[$i]=$records[$rand_no];
			 $i++;
			 if($i > 4*$count) break;
        }
		// debug($similar_products);
		return $similar_products;
		
		
	}

	/*
	* @return popular products with images
	*/
	function getPopular($type = '%') {
		$this->contain();
		return $this->find('all', array(
				'conditions' => array(
					'Product.is_active' => true,
					'Product.is_pro' => false,
					'Product.impressions >' => 1,
					'Product.type LIKE' => $type,
					'not' => array('Product.image_thumb' => 'null')
				),
				'order' => 'Product.impressions desc',
				'limit' => 50
			)		
		);
	}
	
	/*
	* @return $count popular products from $group
	* @param $show_pro - decides if product should be shown if is pro
	*/
	function getPopularFromGroup(&$group, $count = 11, $show_pro = false) {
		if (isset($group['Group'])) {
			$group_id = $group['Group']['id'];
		} else {
			$group_id = $group['id'];
		}
		
		$this->contain();
		$conditions['Product.group_id'] = $group_id;
		$conditions['Product.is_active'] = true;
		if (!$show_pro) $conditions['Product.is_pro'] = false;
		
		$records = $this->find('all', array(
			'conditions' => $conditions,
			'limit' => 50,
			'order' => 'Product.impressions desc'
		));
		
		if(count($records) < $count) return $records;
		$offset= count($records)-1;
		$popular_products=array();
		$i=0;
		while (count($popular_products) < $count) {   
			$rand_no=rand(0,$offset);
			 if (!in_array($records[$rand_no],$popular_products))
			 $popular_products[$i]=$records[$rand_no];
			 $i++;
			 if($i > 4*$count) break;
        }
		return $popular_products;
		
	}
	
	/*
	* @return $count random popular products
	*/
	function getRandomPopular($count = 8) {
		$records = $this->getPopular();
		if(count($records) < $count) return $records;
		$offset= count($records)-1;
		$popular_products=array();
		$i=0;
		while (count($popular_products) < $count) {   
			$rand_no=rand(0,$offset);
			 if (!in_array($records[$rand_no],$popular_products))
			 $popular_products[$i]=$records[$rand_no];
			 $i++;
			 if($i > 4*$count) break;
        }
		return $popular_products;
	}
	
	/*
	* @return last 8 products with images
	*/
	function getLatest($count = 8) {
		return $this->find('all', array(
			'conditions' => array(
				'Product.is_active' => true,
				'Product.is_pro' => false,
				'not' => array('Product.image_thumb' => 'null'),
			),
			'limit' => $count,
			'order' => 'Product.id desc'
		));
	}

	/*
	* @return $count random products
	*/
	function getRandom($type = '%', $count = 8) {
		$this->contain();
		$records = $this->find('all', array(
			'conditions' => array(
				'Product.is_active' => true,
				'Product.is_pro' => false,
				'Product.type LIKE' => $type,
				'not' => array('Product.image_thumb' => null),
			)
		));
		
		if(count($records) < $count) return false;
		$offset= count($records)-1;
		$random_products=array();
		$i=0;
		while (count($random_products) < $count) {   
			$rand_no=rand(0,$offset);
			 if (!in_array($records[$rand_no],$random_products))
			 $random_products[$i]=$records[$rand_no];
			 $i++;
			 if($i > 4*$count) break;
        }
		// debug($random_products); die();
		return $random_products;
		
	}
	
	
	
	
}
