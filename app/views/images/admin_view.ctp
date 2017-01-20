<div id="admin-container">
<div class="admin-actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Image', true), array('action' => 'edit', $image['Image']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('Delete Image', true), array('action' => 'delete', $image['Image']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $image['Image']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Images', true), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Image', true), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Groups', true), array('controller' => 'groups', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Group', true), array('controller' => 'groups', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Products', true), array('controller' => 'products', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Product', true), array('controller' => 'products', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="images view">
<h2><?php  __('Image');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $image['Image']['id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Alt'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $image['Image']['alt']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Path'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $image['Image']['path']; ?>
			&nbsp;
		</dd>
                <dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Image'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $html->image('/'.$image['Image']['path'], array()); ?>
			&nbsp;
		</dd>
	</dl>

</div>

<div id="actions"><h3><?php __('Related Groups Actions');?></h3>
		<ul>
			<li><?php echo $this->Html->link(__('New Group', true), array('controller' => 'groups', 'action' => 'add'));?> </li>
		</ul>
</div> 
<div class="related">
	<h3><?php __('Related Groups');?></h3>

	<table cellpadding = "0" cellspacing = "0">
        
	<tr>
		<th><?php __('Id'); ?></th>
		<th><?php __('Name'); ?></th>
		<th><?php __('Latin'); ?></th>
		<th><?php __('Description'); ?></th>
		<th><?php __('Is Active'); ?></th>
		<th><?php __('Position'); ?></th>
		<th><?php __('Parent Id'); ?></th>
		<th><?php __('Lft'); ?></th>
		<th><?php __('Rght'); ?></th>
		<th><?php __('Discount'); ?></th>
		<th><?php __('Discount Price'); ?></th>
		<th><?php __('Discount Vendor Price'); ?></th>
		<th class="actions"><?php __('Actions');?></th>
	</tr>
        <?php if (!empty($image['Group'])):?>
	<?php
		$i = 0;
		foreach ($image['Group'] as $group):
			$class = null;
			if ($i++ % 2 == 0) {
				$class = ' class="altrow"';
			}
		?>
		<tr<?php echo $class;?>>
			<td><?php echo $group['id'];?></td>
			<td><?php echo $group['name'];?></td>
			<td><?php echo $group['latin'];?></td>
			<td><?php echo $group['description'];?></td>
			<td><?php echo $group['is_active'];?></td>
			<td><?php echo $group['position'];?></td>
			<td><?php echo $group['parent_id'];?></td>
			<td><?php echo $group['lft'];?></td>
			<td><?php echo $group['rght'];?></td>
			<td><?php echo $group['discount'];?></td>
			<td><?php echo $group['discount_price'];?></td>
			<td><?php echo $group['discount_vendor_price'];?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View', true), array('controller' => 'groups', 'action' => 'view', $group['id'])); ?>
				<?php echo $this->Html->link(__('Edit', true), array('controller' => 'groups', 'action' => 'edit', $group['id'])); ?>
				<?php echo $this->Html->link(__('Delete', true), array('controller' => 'groups', 'action' => 'delete', $group['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $group['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>

<?php endif; ?>
</table>

</div>
<div id="actions"><h3><?php __('Related Products Actions');?></h3>
 <ul>
	<li><?php echo $this->Html->link(__('New Product', true), array('controller' => 'products', 'action' => 'add'));?> </li>
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
	<!-- 	<th><?php __('Thumb Id'); ?></th> -->
		<th><?php __('Date Created'); ?></th>
		<th><?php __('Date Published'); ?></th>
		<th><?php __('Impressions'); ?></th>
		<th><?php __('Type'); ?></th>
		<th><?php __('Color Id'); ?></th>
		<th><?php __('Action Price'); ?></th>
		<th class="actions"><?php __('Actions');?></th>
	</tr>
 <?php if (!empty($image['Product'])):?>
	<?php
		$i = 0;
		foreach ($image['Product'] as $product):
			$class = null;
			if ($i++ % 2 == 0) {
				$class = ' class="altrow"';
			}
		?>
		<tr<?php echo $class;?>>
			<td><?php echo $product['id'];?></td>
			<td><?php echo $product['name'];?></td>
			<td><?php echo $product['latin'];?></td>
			<td><?php echo $product['description'];?></td>
			<td><?php echo $product['group_id'];?></td>
			<td><?php echo $product['collection_id'];?></td>
			<td><?php echo $product['price'];?></td>
			<td><?php echo $product['discount'];?></td>
			<td><?php echo $product['vendor_price'];?></td>
			<td><?php echo $product['vendor_price_6'];?></td>
			<td><?php echo $product['vendor_price_12'];?></td>
			<td><?php echo $product['code'];?></td>
			<td><?php echo $product['position'];?></td>
			<td><?php echo $product['is_active'];?></td>
			<td><?php echo $product['is_pro'];?></td>
			<td><?php echo $product['in_action'];?></td>
			<td><?php echo $product['thumb_id']; ?></td> 
			<td><?php echo $product['date_created'];?></td>
			<td><?php echo $product['date_published'];?></td>
			<td><?php echo $product['impressions'];?></td>
			<td><?php echo $product['type'];?></td>
			<td><?php echo $product['color_id'];?></td>
			<td><?php echo $product['action_price'];?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View', true), array('controller' => 'products', 'action' => 'view', $product['id'])); ?>
				<?php echo $this->Html->link(__('Edit', true), array('controller' => 'products', 'action' => 'edit', $product['id'])); ?>
				<?php echo $this->Html->link(__('Delete', true), array('controller' => 'products', 'action' => 'delete', $product['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $product['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	
<?php endif;?> 
</table>
	
</div>
</div>
