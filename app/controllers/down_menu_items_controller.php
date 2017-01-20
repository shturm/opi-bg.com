<?php
class DownMenuItemsController extends AppController {

	var $name = 'DownMenuItems';
	

	function admin_index() {
		$this->DownMenuItem->recursive = 0;
		$this->paginate = array('order' => 'DownMenuItem.order' );
		$this->set('downMenuItems', $this->paginate());
	}

	function admin_view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid down menu item', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('downMenuItem', $this->DownMenuItem->read(null, $id));
	}

	function admin_add() {
		if (!empty($this->data)) {
			$this->DownMenuItem->create();
			
			if(!empty($this->data['DownMenuItem']['new_image'])) {
				$img = $this->data['DownMenuItem']['new_image']['name'];
				$path = 'img/downmenu/' . $img;
				debug($this->data['DownMenuItem']['new_image']['name']);
				if(!file_exists($path))	{
					move_uploaded_file($this->data['DownMenuItem']['new_image']['tmp_name'], $path );
					$this->_create_thumbnail($img, 'img/downmenu', '', 72, 72, 90);
				}
				$this->data['DownMenuItem']['image'] = $path;
			}
			if ($this->DownMenuItem->save($this->data)) {
				$this->Session->setFlash(__('The down menu item has been saved', true));
				// $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The down menu item could not be saved. Please, try again.', true));
			}
		}
		// $parentDownMenuItems = $this->DownMenuItem->ParentDownMenuItem->find('list');
		$picks = $this->_linkData();
		$this->set(compact('picks'));
	}

	function admin_edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid down menu item', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if(!empty($this->data['DownMenuItem']['new_image']['name'])) {
				$img = $this->data['DownMenuItem']['new_image']['name'];
				$path = 'img/downmenu/' . $img;
				if(!file_exists($path))	{
					move_uploaded_file($this->data['DownMenuItem']['new_image']['tmp_name'], $path );
					$this->_create_thumbnail($img, 'img/downmenu', '', 72, 72, 90);
				}
				$this->data['DownMenuItem']['image'] = $path;
			}
			if ($this->DownMenuItem->save($this->data)) {
				$this->Session->setFlash(__('The down menu item has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The down menu item could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $dmi = $this->DownMenuItem->read(null, $id);
			$picked = $this->data['DownMenuItem']['link'];
		}
		$picks = $this->_linkData();
		// $parentDownMenuItems = $this->DownMenuItem->ParentDownMenuItem->find('list');
		$this->set(compact('picks', 'picked', 'dmi'));
	}

	function admin_delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for down menu item', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->DownMenuItem->delete($id)) {
			$this->Session->setFlash(__('Down menu item deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Down menu item was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}
	
	function admin_moveup($id){
          if ($this->DownMenuItem->moveUp($id))
            $this->Session->setFlash('Преместено'); 

        $this->redirect(array('action' => 'index'), null, true);
    
    }
	
	function admin_movedown($id) {
		 if ($this->DownMenuItem->moveDown($id))
            $this->Session->setFlash('Преместено'); 
		$this->redirect(array('action'=>'index'));
	}

	function _linkData() {
		$Product = ClassRegistry::init('Product');
		$Group = ClassRegistry::init('Group');
		$Page = ClassRegistry::init('Page');
		
		$products = $Product->find('list');
		$groups = $Group->find('list');
		$pages = $Page->find('list');
		
		foreach($products as $key => $val) {
			$keyNew = '/products/view/' . $key;
			$products[$keyNew] = $val;
			unset($products[$key]);			
		}
		foreach($groups as $key => $val) {
			$keyNew = '/groups/view/' . $key;
			$groups[$keyNew] = $val;
			unset($groups[$key]);
		}
		foreach($pages as $key => $val) {
			$keyNew = '/pages/view/' . $key;
			$pages[$keyNew] = $val;
			unset($pages[$key]);
		}
		
		$products = array('/products' => '[ПРОДУКТИ - ВСИЧКИ]') + $products;
		$groups = array('/groups' => '[ГРУПИ - ВСИЧКИ]') + $groups;
		
		
		$pages = array('/' => '[НАЧАЛНА СТРАНИЦА') + array('/pages/colors' => '[ПРЕГЛЕД НА ЛАК]') + $pages;
		
		$picks = array(
			'НИКЪДЕ' => array('#' => '[НИКЪДЕ]'),
			'Продуктови групи' => $groups, 
			'Страници' => $pages,
			'Продукти' => $products);
		return $picks;

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
	 
	 // Save the image.
	 if($ext=="jpeg"||$ext=="jpg")
	  if(!(imagejpeg($tempImg, "$imgPath/$img", $quality)));
	 if($ext=="png")
	  if(!(imagepng($tempImg, "$imgPath/$img", $quality/10)));
	 // Clean up.
	 imagedestroy($original);
	 imagedestroy($tempImg);
	 return $damage_report;
	}	
}
