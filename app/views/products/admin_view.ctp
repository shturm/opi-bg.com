<div id="admin-container">
<div class="admin-actions">
	<h3><?php __('Product Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Product', true), array('action' => 'edit', $product['Product']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('Delete Product', true), array('action' => 'delete', $product['Product']['id']), null, sprintf(__('Изтриване на продукт %s?', true), $product['Product']['name'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Products', true), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Product', true), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Groups', true), array('controller' => 'groups', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Group', true), array('controller' => 'groups', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Products', true), array('controller' => 'products', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Collection', true), array('controller' => 'products', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Images', true), array('controller' => 'images', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Thumb', true), array('controller' => 'images', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Orders', true), array('controller' => 'orders', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Order', true), array('controller' => 'orders', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="products view">
<h2><?php  __('Product');?></h2>
<table>
	
	<tr>
		<th>ID</th>
		<td><?php echo $product['Product']['id']; ?></td>
		<th>Име</th>
		<td><?php echo $product['Product']['name']; ?></td>
	</tr>
	<tr>
		<th>Линк</th>
		<td><?php echo $product['Product']['latin']; ?></td>
		<th>Описание</th>
		<td><?php echo $product['Product']['description']; ?></td>
	</tr>
	<tr>
		<th>Цена</th>
		<td><?php echo $product['Product']['price']; ?></td>
		<th>Група</th>
		<td><?php echo $product['Group']['name']; ?></td>
	</tr>
	<tr>
		<th>Търговска цена</th>
		<td><?php echo $product['Product']['vendor_price']; ?></td>
		<th>Отстъпка</th>
		<td><?php echo $product['Product']['discount']; ?></td>
	</tr>
	<tr>
		<th>Търговска цена 6+</th>
		<td><?php echo $product['Product']['vendor_price_6']; ?></td>
		<th>Цена в акция</th>
		<td><?php echo $product['Product']['action_price']; ?></td>
	</tr>
	<tr>
		<th>Търговска цена 12+</th>
		<td><?php echo $product['Product']['vendor_price_12']; ?></td>
		<th>Код</th>
		<td><?php echo $product['Product']['code']; ?></td>
	</tr>
	<tr>
		<th>Търговска цена 24+</th>
		<td><?php echo $product['Product']['vendor_price_24']; ?></td>
		<th>Активен</th>
		<td><?php echo $product['Product']['is_active']; ?></td>
	</tr>
	<tr>
		<th>Про</th>
		<td><?php echo $product['Product']['is_pro']; ?></td>
		<th>В акция</th>
		<td><?php echo $product['Product']['in_action']; ?></td>
	</tr>
	<tr>
		<th>Иконка</th>
		<td>
                <? if(!empty($product['Product']['image_thumb'])) 
                     echo $html->image('/'.$product['Product']['image_thumb']);
                   else
                     echo $html->image('/images/no_image_.png');
                ?>
                
                </td>
		<th>Добавен</th>
		<td><?php echo $product['Product']['date_created']; ?></td>
	</tr>
	<tr>
		<th>Видян</th>
		<td><?php echo $product['Product']['impressions']; ?></td>
		
	</tr>
	
</table>
	
</div>

<div class="admin-actions">
<h3><?php __('Related Products Actions');?></h3>
	<ul>
	     <li><?php echo $this->Html->link(__('New Collection Product', true), array('controller' => 'products', 'action' => 'add'));?> </li>
	</ul>
</div>

<div class="related">
	<h3><?php __('Related Products');?></h3>
	
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php __('Id'); ?></th>
		<th><?php __('Name'); ?></th>
		<th><?php __('Latin'); ?></th>
		<th><?php __('Description'); ?></th>
		<th><?php __('Group Id'); ?></th>
		<th><?php __('Collection Id'); ?></th>
		<th><?php __('Price'); ?></th>
		<th><?php __('Discount'); ?></th>
		<th><?php __('Vendor Price'); ?></th>
		<th><?php __('Vendor Price 6'); ?></th>
		<th><?php __('Vendor Price 12'); ?></th>
		<th><?php __('Code'); ?></th>
		<th><?php __('Position'); ?></th>
		<th><?php __('Is Active'); ?></th>
		<th><?php __('Is Pro'); ?></th>
		<th><?php __('In Action'); ?></th>
		<th><?php __('Thumb Id'); ?></th>
		<th><?php __('Date Created'); ?></th>
		<th><?php __('Date Published'); ?></th>
		<th><?php __('Impressions'); ?></th>
		<th><?php __('Type'); ?></th>
		<th><?php __('Color Id'); ?></th>
		<th class="actions"><?php __('Actions');?></th>
	</tr>
        <?php if (!empty($product['CollectionProduct'])):?>
	<?php
		$i = 0;
		foreach ($product['CollectionProduct'] as $collectionProduct):
			$class = null;
			if ($i++ % 2 == 0) {
				$class = ' class="altrow"';
			}
		?>
		<tr<?php echo $class;?>>
			<td><?php echo $collectionProduct['id'];?></td>
			<td><?php echo $collectionProduct['name'];?></td>
			<td><?php echo $collectionProduct['latin'];?></td>
			<td><?php echo $collectionProduct['description'];?></td>
			<td><?php echo $collectionProduct['group_id'];?></td>
			<td><?php echo $collectionProduct['collection_id'];?></td>
			<td><?php echo $collectionProduct['price'];?></td>
			<td><?php echo $collectionProduct['discount'];?></td>
			<td><?php echo $collectionProduct['vendor_price'];?></td>
			<td><?php echo $collectionProduct['vendor_price_6'];?></td>
			<td><?php echo $collectionProduct['vendor_price_12'];?></td>
			<td><?php echo $collectionProduct['code'];?></td>
			<td><?php echo $collectionProduct['position'];?></td>
			<td><?php echo $collectionProduct['is_active'];?></td>
			<td><?php echo $collectionProduct['is_pro'];?></td>
			<td><?php echo $collectionProduct['in_action'];?></td>
			<td><?php echo $collectionProduct['thumb_id'];?></td>
			<td><?php echo $collectionProduct['date_created'];?></td>
			<td><?php echo $collectionProduct['date_published'];?></td>
			<td><?php echo $collectionProduct['impressions'];?></td>
			<td><?php echo $collectionProduct['type'];?></td>
			<td><?php echo $collectionProduct['color_id'];?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View', true), array('controller' => 'products', 'action' => 'view', $collectionProduct['id'])); ?>
				<?php echo $this->Html->link(__('Edit', true), array('controller' => 'products', 'action' => 'edit', $collectionProduct['id'])); ?>
				<?php echo $this->Html->link(__('Delete', true), array('controller' => 'products', 'action' => 'delete', $collectionProduct['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $collectionProduct['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	
<?php endif; ?>
</table>
	
</div>

<div class="admin-actions">
<h3><?php __('Related Images Actions');?></h3>
  <ul>
    <li><?php echo $this->Html->link(__('New Image', true), array('controller' => 'images', 'action' => 'add'));?> </li>
  </ul>	
</div>
<div class="related">
	<h3><?php __('Related Images');?></h3>
	
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php __('Id'); ?></th>
		<th><?php __('Alt'); ?></th>
		<th><?php __('Is Thumb'); ?></th>
		<th><?php __('Path'); ?></th>
		<th class="actions"><?php __('Actions');?></th>
	</tr>
        <?php if (!empty($product['Image'])):?>
	<?php
		$i = 0;
		foreach ($product['Image'] as $image):
			$class = null;
			if ($i++ % 2 == 0) {
				$class = ' class="altrow"';
			}
		?>
		<tr<?php echo $class;?>>
			<td><?php echo $image['id'];?></td>
			<td><?php echo $image['alt'];?></td>
			<td></td>
			<td><?php echo $image['path'];?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View', true), array('controller' => 'images', 'action' => 'view', $image['id'])); ?>
				<?php echo $this->Html->link(__('Edit', true), array('controller' => 'images', 'action' => 'edit', $image['id'])); ?>
				<?php 
                                  //echo $this->Html->link(__('Delete', true), array('controller' => 'images', 'action' => 'delete', $image['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $image['id'])); 
				?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>


</div>

<div class="admin-actions">
<h3><?php __('Related Orders Actions');?></h3>
		<ul>
			<li><?php echo $this->Html->link(__('New Order', true), array('controller' => 'orders', 'action' => 'add'));?> </li>
		</ul>
	</div>
<div class="related">
	<h3><?php __('Related Orders');?></h3>
	
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php __('Id'); ?></th>
		<th><?php __('User Id'); ?></th>
		<th><?php __('User Role'); ?></th>
		<th><?php __('Email'); ?></th>
		<th><?php __('Name'); ?></th>
		<th><?php __('Address'); ?></th>
		<th><?php __('Delivery Address'); ?></th>
		<th><?php __('Phone'); ?></th>
		<th><?php __('Ip Of Order'); ?></th>
		<th><?php __('Status'); ?></th>
		<th><?php __('Date Created'); ?></th>
		<th><?php __('User Info'); ?></th>
		<th><?php __('Track Info'); ?></th>
		<th><?php __('Track Hash'); ?></th>
		<th><?php __('Total Sum'); ?></th>
		<th><?php __('Payment'); ?></th>
		<th class="actions"><?php __('Actions');?></th>
	</tr>
        <?php if (!empty($product['Order'])):?>
	<?php
		$i = 0;
		foreach ($product['Order'] as $order):
			$class = null;
			if ($i++ % 2 == 0) {
				$class = ' class="altrow"';
			}
		?>
		<tr <?php echo $class;?> >
			<td><?php echo $order['id'];?></td>
			<td><?php echo $order['user_id'];?></td>
			<td><?php echo $order['user_role'];?></td>
			<td><?php echo $order['email'];?></td>
			<td><?php echo $order['name'];?></td>
			<td><?php echo $order['address'];?></td>
			<td><?php echo $order['delivery_address'];?></td>
			<td><?php echo $order['phone'];?></td>
			<td><?php echo $order['ip_of_order'];?></td>
			<td><?php echo $order['status'];?></td>
			<td><?php echo $order['date_created'];?></td>
			<td><?php echo $order['user_info'];?></td>
			<td><?php echo $order['track_info'];?></td>
			<td><?php echo $order['track_hash'];?></td>
			<td><?php echo $order['total_sum'];?></td>
			<td><?php echo $order['payment'];?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View', true), array('controller' => 'orders', 'action' => 'view', $order['id'])); ?>
				<?php echo $this->Html->link(__('Edit', true), array('controller' => 'orders', 'action' => 'edit', $order['id'])); ?>
				<?php echo $this->Html->link(__('Delete', true), array('controller' => 'orders', 'action' => 'delete', $order['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $order['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	
<?php endif; ?>
</table>
	
</div>
</div>