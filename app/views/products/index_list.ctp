<?php 
  //$page = $this->Paginator->current();     
  echo $this->element('breadcrumbs', array('view_selector' => true) );
?>
<div id="product-list-cont">
<table class="product-view-table">
       <tr>
	   <th><? echo $this->Paginator->sort('Име','name'); ?></th>
	   <th>Група</th>
	   <th><? echo $this->Paginator->sort('Цена (в лв.)','price'); ?></th>
	   <th></th>
	</tr>
	
	<? echo $this->element('product_index_list', array('products' => $products) ); ?>
	
</table>
<div id='paging'>
<!-- Shows the page numbers -->
<?php echo $this->Paginator->numbers(); ?>
<!-- Shows the next and previous links -->
<?php echo $this->Paginator->prev('« Назад ', null, null, array('class' => 'disabled')); ?>
<?php echo $this->Paginator->next(' Напред »', null, null, array('class' => 'disabled')); ?> 
<!-- prints X of Y, where X is current page and Y is number of pages -->
<?php echo $this->Paginator->counter(); ?>
</div>
</div>