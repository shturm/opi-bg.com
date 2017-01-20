<?php if(!empty($products)): ?>
	<h2 class="ui-dark-transparent rounded ui-white indented ui-font fixed-cont">Намерени резултати за "<?php echo $search_string; ?>"</h2>
	<?php echo $this->element('product_index', array('products'=> $products)); ?>
<?php endif; ?>