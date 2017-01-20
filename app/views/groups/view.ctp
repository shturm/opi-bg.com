
<div class="ui-dark-transparent rounded ui-white indented ui-font fixed-cont"><h2 style="margin-left:20px;"><? echo $group['Group']['name']?></h2></div>
<?php if(!empty($group['Group']['description'])): ?>
		<pre class="transparent" style="color:white;float:left;width:100%;"> 
			<? echo $group['Group']['description']; ?>
		</pre>
<?php endif; ?>
<? if(!empty($group['ChildGroup'])): ?>
<h2 style="margin-left:20px;">Подкатегории</h2>
<? endif; ?>
<ul class="black ui-transparent ui-white-link rounded fix" >
	<? foreach($group['ChildGroup'] as $cg): ?>
		<? if ($cg['is_active']): ?>
		<li><? echo $html->link($cg['name'], array('action' => 'view', $cg['id'])); ?></li>
		<? endif; ?>
	<? endforeach; ?>
</ul>
<? if (isset($popular_products) && !empty($popular_products)) echo $this->element('featured_products_horizontal', 
						array('products' => $popular_products, 
								'headline' => 'Популярни продукти от тази категория')); ?>
<? if (isset($popular_products) && !empty($popular_products)): ?>
<?php echo $this->element('breadcrumbs'); ?>
<div id="product-list-cont">
	<div id='paging'>
	<!-- Shows the page numbers -->
	
	<!-- Shows the next and previous links -->
	<?php echo $this->Paginator->prev('« Назад ', null, null, array('class' => 'disabled')); ?>
        <?php echo $this->Paginator->numbers(); ?>
	<?php echo $this->Paginator->next(' Напред »', null, null, array('class' => 'disabled')); ?> 
	<!-- prints X of Y, where X is current page and Y is number of pages -->
	<?php //echo $this->Paginator->counter(); ?>
</div>
	<div id="paging">
<?php 	echo $this->Paginator->counter(array(
		'format' => __('Страница %page% от общо %pages% страници, показани %current% продукта от общо %count%. Продукти от %start% до %end%', true)
		)); ?>
	</div>
<? echo $this->element('product_index', array('products'=> $all_products)); ?>
	<div id='paging'>
	<!-- Shows the page numbers -->
	
	<!-- Shows the next and previous links -->
	<?php echo $this->Paginator->prev('« Назад ', null, null, array('class' => 'disabled')); ?>
        <?php echo $this->Paginator->numbers(); ?>
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
<? endif; ?>