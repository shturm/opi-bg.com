<?php 
	echo $this->Session->flash(); 
	echo $this->element('featured_products_horizontal', 
						array('products' => $featured, 
								'headline' => 'OPI препоръчва'));
								
	echo $this->element('featured_products_horizontal', 
						array('products' => $latest, 
								'headline' => 'Последни продукти'));
	echo $this->element('featured_products_horizontal', 
						array('products' => $popular, 
								'headline' => 'Популярни продукти'));
	echo $this->element('featured_products_horizontal', 
						array('products' => $random, 
								'headline' => 'Случайни продукти'));
?>
