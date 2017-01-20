<?php
class HackController extends AppController {

	var $name = 'Hack';

	var $uses = array();
	// var $components = array('HttpSocket');
	
	// vars for leaching out opi.com of images. Runs really slow
	var $saveLarge = 'img/hack/';
	var $saveSmall = 'img/hack/thumbs/';
	var $opiLarge = "http://opi.com/_images/productFinder/lg/";
	var $opiSmall = "http://opi.com/_images/productFinder/sm/";
	
	
	function admin_createSmallImages() {
		$this->_create_thumbnail('AL204_opi.jpg', 'img/products', '_thumb', 150, 150, 90);
		$this->render('index');
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
			 $thumbsize = 72;
			if ($newWidth/$newHeight > $ratio_orig) {
			   $newWidth = $newHeight*$ratio_orig;
			} else {
			   $newHeight = $newWidth/$ratio_orig;
			}
			 if(!(imagecopyresampled($tempImg, $original,-($newWidth/2) + ($thumbsize/2), -($newHeight/2) + ($thumbsize/2), 0, 0, $newWidth, $newHeight, $width_orig, $height_orig)));
			 // Create the new file name.
			 $newName =  substr($img,0,strlen($img)-strlen($ext)-1). $suffix .'.'. $ext;
			 $suffix = str_replace('_', '', $suffix );
			 // Save the image.
			 if($ext=="jpeg"||$ext=="jpg")
			  if(!(imagejpeg($tempImg, "$imgPath/" . $suffix . "s/$newName", $quality)));
			 if($ext=="png")
			  if(!(imagepng($tempImg, "$imgPath/" . $suffix . "s/$newName", $quality/10)));
			 // Clean up.
			 imagedestroy($original);
			 imagedestroy($tempImg);
			 
			 return $damage_report;
			 
		}
	/* function admin_save_images() {
		$report = array();
	
		$this->loadModel('Product');
		$this->loadModel('Image');
		$this->Product->recursive = 0;
		$conditions[''] = '';
		$all_products = $this->Product->find('all', array('fields' => array('Product.id', 'Product.code', 'Thumb.id') ) );
		foreach($all_products as $p) {
			if(strlen($p['Product']['code']) == 5) {
				$rep = $this->admin_save_image($p['Product']['code']);
				
				// report data
				$report['Large']['Link'] += $rep['Large']['Link'];
				$report['Large']['Link'] += $rep['Large']['Link'];
				$report['Small']['Save'] += $rep['Small']['Save'];
				$report['Small']['Save'] += $rep['Small']['Save'];
				$report['Checked']++;
				if($rep['Large']['Link']) $report['Succeded']['Large']['Link']++;
				if($rep['Large']['Save']) $report['Succeded']['Large']['Save']++;
				if($rep['Small']['Link']) $report['Succeded']['Small']['Link']++;
				if($rep['Small']['Save']) $report['Succeded']['Small']['Save']++;
				
				// Record if we didn't have this image before
				if($rep['Large']['Save'] > 0 && empty($p['Thumb']['id']) ) {
					$report['EfficiencyCounter']++;
				}
			}
		}
		debug($report);
		
	}
	
	// gets image from opi.com by product code and stores it
	function admin_save_image($code) {
		$original_code = $code;
		$code = $this->_codeForOpi($code);
		$linkLarge = $this->opiLarge . $code . '.jpg';
		$linkSmall = $this->opiSmall . $code . '.jpg';
		
		if($imgBig = imagecreatefromjpeg($linkLarge)) {
			$report['Large']['Link'] = true;
			if(imagejpeg($imgBig, $this->saveLarge . $original_code . '_opi.jpg')) {
				
				$report['Large']['Save'] = true;
			} else {
				$report['Large']['Save'] = false;
			}
		} else {
			$report['Large']['Link'] = false;
			$report['Large']['Save'] = false;
		}
		
		if($imgSmall = imagecreatefromjpeg($linkSmall)) {
			$report['Small']['Link'] = true;
			if(imagejpeg($imgSmall, $this->saveSmall . $original_code . '_opi_thumb.jpg')) {
				
				$report['Small']['Save'] = true;
			} else {
				$report['Small']['Save'] = false;
			}
		} else {
			$report['Small']['Link'] = false;
			$report['Small']['Save'] = false;
		}
		
		// debug($report);
		return $report;
	} */

	function _codeForOpi($code) {
		$code = trim(strtoupper($code));
		if(strlen($code) == 5) {
			$first = substr($code, 0, 2);
			$second = substr($code, 2, strlen($code)-1);
			return $first . '_' . $second;
		} else return false;
	}
}
?>