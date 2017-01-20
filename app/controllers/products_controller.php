<?php
class ProductsController extends AppController {

	var $name = 'Products';
	var $components = array('Cart', 'RequestHandler');
	// var $background_for_layout = '/img/backgrounds/allcolors.png';
	var $background_for_layout = '';
	
	function beforeFilter() {
		parent::beforeFilter();
		$this->helpers[] = 'Opi';
	}
	
	function index() {
		// $last_id = $this->Product->id;
		// $this->Session->setFlash($last_id);
		$conditions['Product.is_active'] = true;
		$conditions['Product.is_pro'] = false;
		if($this->Auth->user('role') == 'vendor') {
			unset($conditions['Product.is_pro']);
		}
		$this->paginate = array('conditions' => $conditions, 'limit' => 24);
		$data = $this->paginate('Product');
		$this->Cart->setCalculatedPrices($data);
		$this->set('products', $data);
		if(!empty($this->params['named']) && isset($this->params['named']['view']) ) {
			switch($this->params['named']['view']) {
				case 'list':
					$this->render('index_list');
					break;
				case 'list_tiles':
					$this->render('index_list_tiles');
					break;
				default:
					$this->render('index');
					break;
				
			}
		} else $this->render('index');
	}
	
	function view($arg = null) {
		$this->background_for_layout = '';
		// if(!$arg) $this->error();
		// if($this->Auth->user('role') == 'vendor') $allow_pro = true; else $allow_pro = false; // vendor/collection view logic
		$allow_pro = true;
		$p = $this->Product->get($arg, $allow_pro);
		if($p) {
			$p['Product']['impressions']++;
			$this->Product->save($p, false);
			$p['Product']['price'] = $this->Cart->productSinglePrice($p);
			
			$similar = $this->Product->getSimilar($p, 10); //get similar products
			
			$this->set('similar', $similar);
			$this->set('product',$p);
			$this->set('keywords_for_layout', $p['Product']['tags']);
		
			// for regular users viewing a whole collection - redirect to the ::collection()
			if ($p['Product']['type'] == 'collection' || $p['Product']['is_pro'] == true) {
					if($this->Auth->user('role') != 'vendor') $vendor = false; else $vendor = true;
					$this->set('vendor',$vendor);
					$this->render('collection');
				}
		} else $this->error();
	}

	function lacquers() {
		$conditions['Product.is_active'] = true;
		$conditions['Product.type'] = 'lacquer';
		$conditions['Product.is_pro'] = false;
		if($this->Auth->user('role') == 'vendor') {
			unset($conditions['Product.is_pro']);
		}
		$this->paginate = array('conditions' => $conditions, 'limit' => 24);
		$data = $this->paginate('Product');
		$this->Cart->setCalculatedPrices($data);
		// debug($data);
		$this->set('products', $data);
		if(!empty($this->params['named']) && isset($this->params['named']['view']) ) {
			switch($this->params['named']['view']) {
				case 'list':
					$this->render('index_list');
					break;
				case 'list_tiles':
					$this->render('index_list_tiles');
					break;
				default:
					$this->render('index');
					break;
				
			}
		} else $this->render('index');
	}
	
	function collections() {
		$conditions['Product.is_active'] = true;
		$conditions['Product.type'] = 'collection';
		$conditions['Product.is_pro'] = false;
		if($this->Auth->user('role') == 'vendor') {
			unset($conditions['Product.is_pro']);
		}
		$this->paginate = array('conditions' => $conditions, 'limit' => 24);
		$data = $this->paginate('Product');
		$this->Cart->setCalculatedPrices($data);
		$this->set('products', $data);
		if(!empty($this->params['named']) && isset($this->params['named']['view']) ) {
			switch($this->params['named']['view']) {
				case 'list':
					$this->render('index_list');
					break;
				case 'list_tiles':
					$this->render('index_list_tiles');
					break;
				default:
					$this->render('index');
					break;
				
			}
		} else $this->render('index');	
	}
	
	function promotions() {
		$conditions['Product.is_active'] = true;
		$conditions['Product.type'] = 'promotion';
		$conditions['Product.is_pro'] = false;
		if($this->Auth->user('role') == 'vendor') {
			unset($conditions['Product.is_pro']);
		}
		$this->paginate = array('conditions' => $conditions, 'limit' => 24);
		$data = $this->paginate('Product');
		$this->Cart->setCalculatedPrices($data);
		$this->set('products', $data);
		if(!empty($this->params['named']) && isset($this->params['named']['view']) ) {
			switch($this->params['named']['view']) {
				case 'list':
					$this->render('index_list');
					break;
				case 'list_tiles':
					$this->render('index_list_tiles');
					break;
				default:
					$this->render('index');
					break;
				
			}
		} else $this->render('index');		
	}
	
	function actions() {
		$conditions['Product.is_active'] = true;
		$conditions['Product.in_action'] = true;
		$conditions['Product.is_pro'] = false;
		if($this->Auth->user('role') == 'vendor') {
			unset($conditions['Product.is_pro']);
		}
		$this->paginate = array('conditions' => $conditions, 'limit' => 24);
		$data = $this->paginate('Product');
		$this->Cart->setCalculatedPrices($data);
		$this->set('products', $data);
		if(!empty($this->params['named']) && isset($this->params['named']['view']) ) {
			switch($this->params['named']['view']) {
				case 'list':
					$this->render('index_list');
					break;
				case 'list_tiles':
					$this->render('index_list_tiles');
					break;
				default:
					$this->render('index');
					break;
				
			}
		} else $this->render('index');		
	}
	
	function admin_index($type = false) {
		if(!empty($this->data)) {
			$conditions = array();
			$empty_search = true;
			foreach($this->data['Product'] as $key => $value) {
				if (!empty($value)) {
					$conditions['Product.' . $key . ' LIKE'] = '%' . $value . '%';
					$empty_search = false;
				}
			}
			// debug($conditions);
			if($empty_search) {
				$this->paginate = array('limit' => '2000');
			} else {
				$this->paginate = array('conditions' => $conditions, 'limit' => '1000');
			}
			$products = $this->paginate('Product');
			$this->set('products',$products);
		} else {
			if($type) $this->paginate = array('conditions' => array('Product.type' => $type), 'order' => array('Product.id' => 'desc'));
			else $this->Product->order = 'Product.id desc';
			$products = $this->paginate('Product');
			$this->set('products',$products);
		}
	}

	function admin_view($id = null) {
		// debug($this->params);
		if (!$id) {
			$this->Session->setFlash(__('Invalid product', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('product', $this->Product->read(null, $id));
			// debug($this->Product->read(null, $id));		
	}

	function admin_add() {
		if (!empty($this->data)) {
			$this->Product->create();
			//image stuff
			if(!empty($this->data['Product']['new_image']['name'])) {
				$img_name = $this->data['Product']['new_image']['name'];
				$img_ext = strstr($img_name, '.');
				$thumb_name = str_replace($img_ext, '', $img_name) . '_thumb' . $img_ext;
				$path = 'img/products/' .$img_name;	
			
				if(!file_exists($path))	 move_uploaded_file($this->data['Product']['new_image']['tmp_name'], $path);
				$this->_create_thumbnail($this->data['Product']['new_image']['name'],'img/products/',"_thumb",72,72,90);
				$this->data['Product']['image_full'] = $path;
				$this->data['Product']['image_thumb'] = 'img/products/thumbs/' . $thumb_name;
			}
			
			if ($this->Product->save($this->data)) {
				$this->Session->setFlash(__('The product has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The product could not be saved. Please, try again.', true));
			}
		}
		$groups = array('0' => '-') + $this->Product->Group->generatetreelist();
		$collections = array('0' => '-') + $this->Product->find('list', array('conditions' => array('Product.type' => 'collection') ) );
		
			
		$this->set(compact('groups', 'collections','colors'));
	}

	function admin_copy($id = null) {
		if($this->Product->read()) {
		
		}
	}

	function admin_edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid product', true));
			$this->redirect(array('action' => 'index'));
		}


	
		if(!empty($this->data)) {
			$damage_report = 'NOT SET';
			if(!empty($this->data['Product']['new_image']['name'])) {
				$img_name = $this->data['Product']['new_image']['name'];
				$img_ext = strstr($img_name, '.');
				$thumb_name = str_replace($img_ext, '', $img_name) . '_thumb' . $img_ext;
				$path = 'img/products/' .$img_name;	
			
				if(!file_exists($path))	 move_uploaded_file($this->data['Product']['new_image']['tmp_name'], $path);
				$this->_create_thumbnail($this->data['Product']['new_image']['name'],'img/products/',"_thumb",72,72,90);
				$this->data['Product']['image_full'] = $path;
				$this->data['Product']['image_thumb'] = 'img/products/thumbs/' . $thumb_name;
			}

				$this->data['Product']['discount'] = abs($this->data['Product']['discount']);
				
			if ($this->Product->save($this->data)) {
				$this->Session->setFlash(__('The product has been saved', true));
				// $this->redirect(array('action' => 'index'));
			} else {
				// debug($this->Product->validationErrors);
				if(!empty($this->Product->validationErrors)) {
					$errors = '';
					foreach($this->Product->validationErrors as $key => $value) {
						$errors .= $value . '<br/>';
					}
					$this->Session->setFlash($errors, true);
				} else $this->Session->setFlash(__('The product could not be saved. Please, try again.', true));
			}
		}
		
		if (empty($this->data)) {
			$this->data = $this->Product->read(null, $id);
		}


		$product = $this->Product->read(null, $id);
		$this->set('product', $product);
		$groups = array('0' => '-') + $this->Product->Group->generatetreelist();
		$collections = array('0' => '-') + $this->Product->Collection->find('list', array('conditions' => array('Collection.type' => 'collection')) );

		$this->set(compact('groups', 'collections', 'colors'));
	}

	function admin_delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for product', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Product->delete($id)) {
			$this->Session->setFlash(__('Product deleted', true));
			$this->redirect($this->referer());
		}
		$this->Session->setFlash(__('Product was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}
	
	function admin_feature($pid = null) {
	
	}
	
	function admin_unfeature($pid = null) {
	
	}
	
	function admin_activate($pid = null) {
	
	}
	
	function admin_deactivate($pid = null) {
	
	}
	
	function admin_toggleActive($id = null) {
		$this->layout = 'ajax';
		if($p = $this->Product->findById($id)) {
			if($this->params['isAjax']) {
				if($p['Product']['is_active']) $p['Product']['is_active'] = 0; 
				else $p['Product']['is_active'] = 1;
				$err = $this->Product->save($p, false);
				if($err) $status = 1; else $status = 0;
				$this->set('data', json_encode(array('status'=>$status)));
			} else $this->set('data', json_encode(array('status'=>'0')));
		} else $this->set('data', json_encode(array('status'=>'0')));
		
		header('Content-Type:application/json; charset=utf-8');
		$this->render('ajax');
	}
	
	function admin_togglePro($id = null) {
		$this->layout = 'ajax';
		if($p = $this->Product->findById($id)) {
			if($this->params['isAjax']) {
				if($p['Product']['is_pro']) $p['Product']['is_pro'] = false; 
				else $p['Product']['is_pro'] = true;
				if($this->Product->save($p, false)) $status = 1; else $status = 0;
				$this->set('data', json_encode(array('status'=>$status)));
				
			} else $this->set('data', json_encode(array('status'=>'0')));
		} else $this->set('data', json_encode(array('status'=>'0')));
		
		header('Content-Type:application/json; charset=utf-8');
		$this->render('ajax');
	}
	
	function admin_toggleAction($id = null) {
		$this->layout = 'ajax';
		if($p = $this->Product->findById($id)) {
			if($this->params['isAjax']) {
				if($p['Product']['in_action']) $p['Product']['in_action'] = false; 
				else $p['Product']['in_action'] = true;
				if($this->Product->save($p, false)) $status = 1; else $status = 0;
				$this->set('data', json_encode(array('status'=>$status)));
				
			} else $this->set('data', json_encode(array('status'=>'0')));
		} else $this->set('data', json_encode(array('status'=>'0')));
		
		header('Content-Type:application/json; charset=utf-8');
		$this->render('ajax');
	}
	
	function admin_toggleFeatured($id = null) {
		$this->layout = 'ajax';
		if($p = $this->Product->findById($id)) {
			if($this->params['isAjax']) {
				if($p['Product']['is_featured']) $p['Product']['is_featured'] = false; 
				else $p['Product']['is_featured'] = true;
				if($this->Product->save($p, false)) $status = 1; else $status = 0;
				$this->set('data', json_encode(array('status'=>$status)));
				
			} else $this->set('data', json_encode(array('status'=>'0')));
		} else $this->set('data', json_encode(array('status'=>'0')));
		
		header('Content-Type:application/json; charset=utf-8');
		$this->render('ajax');
	}
	
function _create_thumbnail($img, $imgPath, $suffix, $newWidth, $newHeight, $quality)
	{
	 
	 //Get Extension
	 $ext=explode(".",$img);
	 $ext = strtolower($ext[count($ext)-1]);
	 
	 $damage_report = array();
	 
	 if($ext=="jpeg"||$ext=="jpg")
	    if(!($original = imagecreatefromjpeg("$imgPath/$img")));
	 if($ext=="png")
	   if(!( $original = imagecreatefrompng("$imgPath/$img")));
	 
	 // Open the original image.
	 list($width_orig, $height_orig, $type, $attr) = getimagesize("$imgPath/$img");
	 // Resample the image.
	 if(!($tempImg = imagecreatetruecolor($newWidth, $newHeight)));
	 //imagealphablending($tempImg, false);
	 //imagesavealpha($tempImg,true);
	 $white = imagecolorallocate($tempImg, 255, 255, 255);
     //imagecolortransparent($tempImg, $black);
     imagefill($tempImg,0,0,$white);
	 //imagecopyresized($tempImg, $original, 0, 0, 0, 0, $newWidth, $newHeight, $width, $height);
	 $ratio_orig = $width_orig/$height_orig;
     //$thumbsize = $newWidth;
     
     $adjw = $newWidth;
     $adjh = $newWidth;
	 if ($newWidth/$newHeight > $ratio_orig) 
	 {
	   $newWidth = $newHeight*$ratio_orig;
	   $size = $newWidth;
	 }else 
	 {
	   $newHeight = $newWidth/$ratio_orig;
	   $size = $newHeight;
	 }
	 //Cropped Image Positioning *fixed division by zero
	 if($adjw!=$newWidth) $adjX = ($adjw-$newWidth)/2; else $adjX =0;
	 if($adjh!=$newHeight) $adjY = ($adjh-$newHeight)/2; else $adjY =0; 
	 //if(!(imagecopyresampled($tempImg, $original,-($newWidth/2) + ($thumbsize/2), -($newHeight/2) + ($thumbsize/2), 0, 0, $newWidth, $newHeight, $width_orig, $height_orig)));
	 if(!(imagecopyresampled($tempImg, $original,$adjX,$adjY, 0, 0, $newWidth, $newHeight, $width_orig, $height_orig)));
	 // Create the new file name.
	 $newName =  substr($img,0,strlen($img)-strlen($ext)-1). $suffix .'.'. $ext;
	 
	 // Save the image.
	 if($ext=="jpeg"||$ext=="jpg")
	  if(!(imagejpeg($tempImg, "$imgPath/thumbs/$newName", $quality)));
	 if($ext=="png")
	  if(!(imagepng($tempImg, "$imgPath/thumbs/$newName", $quality/10)));
	 // Clean up.
	 imagedestroy($original);
	 imagedestroy($tempImg);
	 return $damage_report;
	}
}
