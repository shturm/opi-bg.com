<div id="admin-container">
<div class="admin-actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Top Menu Item', true), array('action' => 'edit', $topMenuItem['TopMenuItem']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('Delete Top Menu Item', true), array('action' => 'delete', $topMenuItem['TopMenuItem']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $topMenuItem['TopMenuItem']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Top Menu Items', true), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Top Menu Item', true), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Top Menu Items', true), array('controller' => 'top_menu_items', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Parent Top Menu Item', true), array('controller' => 'top_menu_items', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="topMenuItems view">
<h2><?php  __('Top Menu Item');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $topMenuItem['TopMenuItem']['id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Name'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $topMenuItem['TopMenuItem']['name']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Link'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $topMenuItem['TopMenuItem']['link']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Parent Top Menu Item'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $this->Html->link($topMenuItem['ParentTopMenuItem']['name'], array('controller' => 'top_menu_items', 'action' => 'view', $topMenuItem['ParentTopMenuItem']['id'])); ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Lft'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $topMenuItem['TopMenuItem']['lft']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Rght'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $topMenuItem['TopMenuItem']['rght']; ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="admin-actions">
<h3><?php __('Related Top Menu Items actions');?></h3>
		<ul>
			<li><?php echo $this->Html->link(__('New Child Top Menu Item', true), array('controller' => 'top_menu_items', 'action' => 'add'));?> </li>
		</ul>
	</div>
<div class="related">
	<h3><?php __('Related Top Menu Items');?></h3>
	
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php __('Id'); ?></th>
		<th><?php __('Name'); ?></th>
		<th><?php __('Link'); ?></th>
		<th><?php __('Parent Id'); ?></th>
		<th><?php __('Lft'); ?></th>
		<th><?php __('Rght'); ?></th>
		<th class="actions"><?php __('Actions');?></th>
	</tr>
        <?php if (!empty($topMenuItem['ChildTopMenuItem'])):?>
	<?php
		$i = 0;
		foreach ($topMenuItem['ChildTopMenuItem'] as $childTopMenuItem):
			$class = null;
			if ($i++ % 2 == 0) {
				$class = ' class="altrow"';
			}
		?>
		<tr<?php echo $class;?>>
			<td><?php echo $childTopMenuItem['id'];?></td>
			<td><?php echo $childTopMenuItem['name'];?></td>
			<td><?php echo $childTopMenuItem['link'];?></td>
			<td><?php echo $childTopMenuItem['parent_id'];?></td>
			<td><?php echo $childTopMenuItem['lft'];?></td>
			<td><?php echo $childTopMenuItem['rght'];?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View', true), array('controller' => 'top_menu_items', 'action' => 'view', $childTopMenuItem['id'])); ?>
				<?php echo $this->Html->link(__('Edit', true), array('controller' => 'top_menu_items', 'action' => 'edit', $childTopMenuItem['id'])); ?>
				<?php echo $this->Html->link(__('Delete', true), array('controller' => 'top_menu_items', 'action' => 'delete', $childTopMenuItem['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $childTopMenuItem['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	
<?php endif; ?>
</table>

</div>
</div>