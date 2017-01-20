<? echo $this->Session->flash(); ?>
<?php echo $this->element('breadcrumbs', array('view_selector' => true) ); ?>
<div id="product-list-cont">
	<? echo $this->element('product_index', array('products'=> $products)); ?>

	<div id='paging'>
	<!-- Shows the page numbers -->
	<?php echo $this->Paginator->numbers(); ?>
	<!-- Shows the next and previous links -->
	<?php echo $this->Paginator->prev('« Назад ', null, null, array('class' => 'disabled')); ?>
	<?php echo $this->Paginator->next(' Напред »', null, null, array('class' => 'disabled')); ?> 
	<!-- prints X of Y, where X is current page and Y is number of pages -->
	<?php //echo $this->Paginator->counter(); ?>

	</div>
	<div id="paging">
	<?php 	echo $this->Paginator->counter(array(
		'format' => __('Страница %page% от общо %pages% страници, показани %current% продукта от общо %count%. Продукти от %start% до %end%', true)
		)); ?>
	</div>
</div>