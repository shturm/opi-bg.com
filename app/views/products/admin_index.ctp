<? echo $this->Session->flash(); ?>
<div id="admin-container">
<div class="admin-actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Списък продукти', true), array('controller' => 'products', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('Нов продукт', true), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('Списък групи', true), array('controller' => 'groups', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('Нова група', true), array('controller' => 'groups', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('Нова малка снимка', true), array('controller' => 'images', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('Списък поръчки', true), array('controller' => 'orders', 'action' => 'index')); ?> </li>
	</ul>
</div>
<div class="products index">
	<h2><?php __('Products');?></h2>
	<div id="paging">
		<?php echo $this->Paginator->prev('<< ' . __('previous', true), array(), null, array('class'=>'disabled'));?>
	 | 	<?php echo $this->Paginator->numbers();?>
 |
		<?php echo $this->Paginator->next(__('next', true) . ' >>', array(), null, array('class' => 'disabled'));?>
	</div>
	<table cellpadding="0" cellspacing="0" class="admin-index small-row" style="margin-left:40px;">
	<tr class="small-row" valign="middle">
		<? echo $form->create('Product'); 
			$types[''] = 'Всички';
			$types['product'] = 'Продукт';
			$types['promotion'] = 'Промоция';
			$types['collection'] = 'Колекция';
			$types['lacquer'] = 'Лак';
		?>
		<td></td>
		<td align="center"><? echo $form->input('code', array('style' => 'width: 50px;', 'label' => false, 'div' => false)); ?></td>
		<td align="center"><? echo $form->input('name', array('style' => 'width: 200px;','label' => false, 'div' => false)); ?></td>
		<td></td>
		<td></td>
		<td align="center"><? echo $form->input('price', array('style' => 'width: 50px;', 'label' => false, 'div' => false)); ?></td>
		<td align="center"><? echo $form->input('discount', array('style' => 'width: 68px;', 'label' => false, 'div' => false)); ?></td>
		<td ><? //echo $form->input('is_active', array('label' => false, 'div' => false)); ?></td>
		<td><? //echo $form->input('is_pro', array('label' => false, 'div' => false)); ?></td>
		<td><? //echo $form->input('in_action', array('label' => false, 'div' => false)); ?></td>
		<td></td>
		<td></td>
		<td><? //echo $form->input('impressions', array('label' => false, 'div' => false)); ?></td>
		<td align="center"><? echo $form->input('type', array('options' => $types, 'default' => '', 'label' => false, 'div' => false)); ?></td>
		
		<td align="center"><? echo $form->submit('Търси'); ?></td>
        <? echo $form->end(); ?>
	</tr>
	<tr>	
			<th><?php echo $this->Paginator->sort('N', 'id');?></th>
			<th><?php echo $this->Paginator->sort('Код', 'code');?></th>
			<th><?php echo $this->Paginator->sort('Име', 'name');?></th>


			<th><?php echo $this->Paginator->sort('Група', 'group_id');?></th>
			<th><?php echo $this->Paginator->sort('Колекция', 'collection_id');?></th>
			<th><?php echo $this->Paginator->sort('Цена', 'price');?></th>
			<th><?php echo $this->Paginator->sort('Отстъпка', 'discount');?></th>
	
			
			<th><?php echo $this->Paginator->sort('А', 'is_active');?></th>
			<th><?php echo $this->Paginator->sort('Про', 'is_pro');?></th>
			<th><?php echo $this->Paginator->sort('Акция', 'in_action');?></th>
			<th><?php echo $this->Paginator->sort('Пр.', 'is_featured');?></th>
			<th><?php echo $this->Paginator->sort('Икона','thumb_id');?></th>

			<th><?php echo $this->Paginator->sort('Видян','impressions');?></th>
			<th><?php echo $this->Paginator->sort('Тип','type');?></th>
			
			<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
	$i = 0;
	foreach ($products as $product):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
	<tr<?php echo $class;?>>
		<td><? echo $product['Product']['id']; ?></td>
		<td style="color:orange;"><?php echo $product['Product']['code']; ?>&nbsp;</td>
		<td><?php echo $html->link($product['Product']['name'], '/admin/products/view/' . $product['Product']['id']); ?>&nbsp;</td>


		<td>
			<?php echo $this->Html->link($product['Group']['name'], array('controller' => 'groups', 'action' => 'view', $product['Group']['id'])); ?>
		</td>
		<td>
			<?php echo $this->Html->link($product['Collection']['name'], array('controller' => 'products', 'action' => 'view', $product['Collection']['id'])); ?>
		</td>
		<td>
			<?php echo $this->Opi->productPrice($product, true); ?>
        </td>
		<td><?php echo $product['Product']['discount']; ?>&nbsp;</td>


		<td><?php if($product['Product']['is_active']==1) echo '<div class="ui-active"></div>'; else echo '<div class="ui-inactive"></div>'; ?></td>
		<td><?php if($product['Product']['is_pro']==1) echo '<div class="ui-pro"></div>'; else echo '<div class="ui-no-pro"></div>'; ?></td>
		<td><?php if($product['Product']['in_action']==1)  echo '<div class="ui-action"></div>'; else echo '<div class="ui-no-action"></div>'; ?></td>
		<td><?php if($product['Product']['is_featured']==1)  echo '<div class="ui-featured"></div>'; else echo '<div class="ui-no-featured"></div>'; ?></td>
		<td align="center">
		<?php 
                  if(!empty($product['Product']['image_thumb']))
                     echo $this->Html->image('/'.$product['Product']['image_thumb'], array('width' => '35px', 'height' => '35px', 'url' => array('controller' => 'products', 'action' => 'view', $product['Product']['id']))); 
                  else 
                     echo $this->Html->image('/images/no_image_.png', array('width' => '35px', 'height' => '35px', 'url' => array('controller' => 'products', 'action' => 'view', $product['Product']['id']))); 
		?>
		</td>


		<td><?php echo $product['Product']['impressions']; ?>&nbsp;</td>
		<td><?php echo $product['Product']['type']; ?>&nbsp;</td>
		
		<td class="actions" style="width: 96px;">
			<?php echo $this->Html->link(__('', true), array('action' => 'view', $product['Product']['id']),array('class'=>'ui-view')); ?>
			<?php echo $this->Html->link(__('', true), array('action' => 'edit', $product['Product']['id']),array('class'=>'ui-edit')); ?>
			<?php echo $this->Html->link(__('', true), array('action' => 'delete', $product['Product']['id']),array('class'=>'ui-delete'), sprintf(__('Are you sure you want to delete # %s?', true), $product['Product']['id'])); ?>
		</td>
	</tr>
<?php endforeach; ?>
	</table>
	<p>
	<?php
	echo $this->Paginator->counter(array(
	'format' => __('Page %page% of %pages%, showing %current% records out of %count% total, starting on record %start%, ending on %end%', true)
	));
	?>	</p>

	<div id="paging">
		<?php echo $this->Paginator->prev('<< ' . __('previous', true), array(), null, array('class'=>'disabled'));?>
	 | 	<?php echo $this->Paginator->numbers();?>
 |
		<?php echo $this->Paginator->next(__('next', true) . ' >>', array(), null, array('class' => 'disabled'));?>
	</div>
</div>
</div>