<?php echo $this->element('breadcrumbs', array('view_selector' => true) ); ?>
<div id="product-list-cont">
<table class="product-view-table" >
   <tr>
     <th></th>
     <th>Продукт</th>
     <th>Група</th>
     <th>Цена (лв.)</th>
     <th></th>
   </tr>
   <? echo $this->element('product_index_list_tiles', array('products' => $products)); ?>
</table>
<div id='paging'>
<?php echo $this->Paginator->prev('« Назад ', null, null, array('class' => 'disabled')); ?>
<!-- Shows the page numbers -->
<?php echo $this->Paginator->numbers(); ?>
<!-- Shows the next and previous links -->
<?php echo $this->Paginator->next(' Напред »', null, null, array('class' => 'disabled')); ?> 
<!-- prints X of Y, where X is current page and Y is number of pages -->
<?php echo $this->Paginator->counter(); ?>
</div>
</div>