<div id="admin-container">
<div class="admin-actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Group', true), array('action' => 'edit', $group['Group']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('Delete Group', true), array('action' => 'delete', $group['Group']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $group['Group']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Groups', true), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Group', true), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Groups', true), array('controller' => 'groups', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Parent Group', true), array('controller' => 'groups', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Products', true), array('controller' => 'products', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Product', true), array('controller' => 'products', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Images', true), array('controller' => 'images', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Image', true), array('controller' => 'images', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="groups view">
<h2><?php  __('Group');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $group['Group']['id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Name'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $group['Group']['name']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Latin'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $group['Group']['latin']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Description'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $group['Group']['description']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Is Active'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $group['Group']['is_active']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Позиция'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $group['Group']['order']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Parent Group'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $this->Html->link($group['ParentGroup']['name'], array('controller' => 'groups', 'action' => 'view', $group['ParentGroup']['id'])); ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Lft'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $group['Group']['lft']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Rght'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $group['Group']['rght']; ?>
			&nbsp;
		</dd>

	</dl>
</div>

<div class="related">
	<h3><?php __('Под-групи');?></h3>
	
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php __('Id'); ?></th>
		<th><?php __('Name'); ?></th>
		<th><?php __('Latin'); ?></th>
		<th><?php __('Description'); ?></th>
		<th><?php __('Is Active'); ?></th>
		<th><?php __('Позиция'); ?></th>


		<th class="actions"><?php __('Actions');?></th>
	</tr>
        <?php if (!empty($group['ChildGroup'])):?>
	<?php
		$i = 0;
		foreach ($group['ChildGroup'] as $childGroup):
			$class = null;
			if ($i++ % 2 == 0) {
				$class = ' class="altrow"';
			}
		?>
		<tr<?php echo $class;?>>
			<td><?php echo $childGroup['id'];?></td>
			<td><?php echo $childGroup['name'];?></td>
			<td><?php echo $childGroup['latin'];?></td>
			<td><?php echo $childGroup['description'];?></td>
			<td><?php echo $childGroup['is_active'];?></td>
			<td><?php echo $childGroup['order'];?></td>


			<td class="actions">
				<?php echo $this->Html->link(__('View', true), array('controller' => 'groups', 'action' => 'view', $childGroup['id'])); ?>
				<?php echo $this->Html->link(__('Edit', true), array('controller' => 'groups', 'action' => 'edit', $childGroup['id'])); ?>
				<?php echo $this->Html->link(__('Delete', true), array('controller' => 'groups', 'action' => 'delete', $childGroup['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $childGroup['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	
<?php endif; ?>
</table>

</div>


<div class="related">
	<h3><?php __('Продукти в тази група');?></h3>
	
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php __('Id'); ?></th>
		<th><?php __('Name'); ?></th>
		<th><?php __('Latin'); ?></th>
		<th><?php __('Description'); ?></th>
		<th><?php __('Group Id'); ?></th>
		<th><?php __('Collection Id'); ?></th>

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
        <?php if (!empty($group['Product'])):?>
	<?php
		$i = 0;
		foreach ($group['Product'] as $product):
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
	
			<td><?php echo $product['code'];?></td>
			<td><?php echo $product['position'];?></td>
			<td><?php echo $product['is_active'];?></td>
			<td><?php echo $product['is_pro'];?></td>
			<td><?php echo $product['in_action'];?></td>
			<td><?php echo $product['thumb_id'];?></td>
			<td><?php echo $product['date_created'];?></td>
			<td><?php echo $product['date_published'];?></td>
			<td><?php echo $product['impressions'];?></td>
			<td><?php echo $product['type'];?></td>
			<td><?php echo $product['color_id'];?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View', true), array('controller' => 'products', 'action' => 'view', $product['id'])); ?>
				<?php echo $this->Html->link(__('Edit', true), array('controller' => 'products', 'action' => 'edit', $product['id'])); ?>
				<?php echo $this->Html->link(__('Delete', true), array('controller' => 'products', 'action' => 'delete', $product['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $product['id'])); ?>
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
	<?php if (!empty($group['Image'])):?>
	<?php
		$i = 0;
		foreach ($group['Image'] as $image):
			$class = null;
			if ($i++ % 2 == 0) {
				$class = ' class="altrow"';
			}
		?>
		<tr<?php echo $class;?>>
			<td><?php echo $image['id'];?></td>
			<td><?php echo $image['alt'];?></td>
			<td><?php echo $image['is_thumb'];?></td>
			<td><?php echo $image['path'];?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View', true), array('controller' => 'images', 'action' => 'view', $image['id'])); ?>
				<?php echo $this->Html->link(__('Edit', true), array('controller' => 'images', 'action' => 'edit', $image['id'])); ?>
				<?php echo $this->Html->link(__('Delete', true), array('controller' => 'images', 'action' => 'delete', $image['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $image['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	
<?php endif; ?>
</table>

</div>
</div>