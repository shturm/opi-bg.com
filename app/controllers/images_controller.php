<?php
class ImagesController extends AppController {

	var $name = 'Images';

	 function admin_reindex() {
		$dir = scandir('img/products');
		$this->Image->Product->contain();// to return less data - no associations
		$products = $this->Image->Product->find('all');
		// clear old data
		$this->Image->Product->query("update products set image_full = NULL, image_thumb = NULL");

		// SET THE COOL PICS
		$good_counter = 0; //counts product/good-image pairs
		$bad_counter = 0; //counts product/bad-image pairs
		// set the good images
		foreach($products as $key => $p) {
			$img = strtoupper($p['Product']['code']) . '_opi.jpg';
			$imgThumb = strtoupper($p['Product']['code']) . '_opi_thumb.jpg';
			
			if(in_array($img, $dir)) {
				
				$products[$key]['Product']['image_full'] = 'img/products/' . $img;
				$products[$key]['Product']['image_thumb'] = 'img/products/thumbs/' . $imgThumb;
				if(!file_exists('img/products/thumbs/' . $imgThumb)) {
					$this->_create_thumbnail($img, 'img/products', '_thumb', 72, 72, 100);
				}
				
				$good_counter++;
			}
		}
		$imgThumb = '';
		$img = '';
		
		// save good images
		$this->Image->Product->saveAll($products, array('validate' => false) );
		
		// SET THE BAD PICS 
		$conditions['Product.image_full'] = null;
		$this->Image->Product->contain(); // to return less data - no associations
		$products = $this->Image->Product->find('all', array('conditions' => $conditions, 'fields' => array('Product.id', 'Product.code', 'Product.image_full', 'Product.image_thumb') ) );
		
		foreach($products as $key => $p) {
			$code = $p['Product']['code'];
			if(empty($code) || strlen($code) < 4) {

				continue;
			}
			foreach($dir as $file) {
				if(strlen($file) > 4) {
					if(strstr(strtoupper($file), strtoupper($code))) {
						$img = $file;
						$chunks = explode('.', $file);
						$imgThumb = $chunks[0] . '_thumb.' . $chunks[1];
						$products[$key]['Product']['image_full'] = 'img/products/' .$img;
						$products[$key]['Product']['image_thumb'] = 'img/products/thumbs/' . $imgThumb;
						if(!file_exists('img/products/thumbs/' . $imgThumb)) {
							$this->_create_thumbnail($img, 'img/products', '_thumb', 72, 72, 100);
						}	
						$bad_counter++;
					}
				}
			}

		}
		// save bad images
		// debug($products);
		$this->Image->Product->saveAll($products, array('validate' => false) );
		
		// fix no-dot thumbs
		$conditions = array();
		$conditions['Product.image_thumb NOT LIKE'] = '%.%';
		$this->Image->Product->contain(); // to return less data - no associations
		$products = $this->Image->Product->find('all', array('conditions' => $conditions, 'fields' => array('Product.id', 'Product.code', 'Product.image_full', 'Product.image_thumb') ) );
		foreach($products as $key => $p) {
			$products[$key]['Product']['image_thumb'] = str_replace('jpg', '.jpg', $products[$key]['Product']['image_thumb']);
		}
		$this->Image->Product->saveAll($products, array('validate' => false) );
		
		$this->render('/pages/admin_admin');
	} 
	
	//makes all img/products to thumbs in img/products/thumbs
	function admin_thumbanize() {
		$dir = scandir('img/products');
		foreach($dir as $file) {
			if(strstr($file, '.png') || strstr($file, '.jpeg') || strstr($file, '.jpg')) {
				$this->_create_thumbnail($file,'img\products\\',"_thumb",72,72,90);
				
			}
		}
	}
	
	function admin_index() {
		$this->Image->recursive = 0;
		$this->Image->order = 'Image.id desc';
		$this->set('images', $this->paginate());
	}

	function admin_view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid image', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('image', $this->Image->read(null, $id));
		// debug($this->Image->read(null, $id));
	}

	function admin_add() {
		if (!empty($this->data)) {
			$this->Image->create();
			if ($this->Image->save($this->data)) {
				$this->Session->setFlash(__('The image has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The image could not be saved. Please, try again.', true));
			}
		}
		$groups = $this->Image->Group->find('list');
		$products = $this->Image->Product->find('list');
		$this->set(compact('groups', 'products'));
	}

	function admin_edit($id = null) {
		// debug($this->Image->read(null, $id));
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid image', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->Image->save($this->data)) {
				$this->Session->setFlash(__('The image has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The image could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Image->read(null, $id);
		}
		$groups = $this->Image->Group->find('list');
		$products = $this->Image->Product->find('list');
		$this->set(compact('groups', 'products'));
	}

	function admin_delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for image', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Image->delete($id)) {
			$this->Session->setFlash(__('Image deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		debug($this->Image->deleteErrors);
		$this->Session->setFlash(__('Image was not deleted', true));
		$this->redirect(array('action' => 'index'));
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
