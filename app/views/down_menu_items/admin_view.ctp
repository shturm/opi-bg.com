<div id="admin-container">
<div class="admin-actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Down Menu Item', true), array('action' => 'edit', $downMenuItem['DownMenuItem']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('Delete Down Menu Item', true), array('action' => 'delete', $downMenuItem['DownMenuItem']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $downMenuItem['DownMenuItem']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Down Menu Items', true), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Down Menu Item', true), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Down Menu Items', true), array('controller' => 'down_menu_items', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Parent Down Menu Item', true), array('controller' => 'down_menu_items', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="downMenuItems view">
<h2><?php  __('Down Menu Item');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $downMenuItem['DownMenuItem']['id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Name'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $downMenuItem['DownMenuItem']['name']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Link'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $downMenuItem['DownMenuItem']['link']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Parent Down Menu Item'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $this->Html->link($downMenuItem['ParentDownMenuItem']['name'], array('controller' => 'down_menu_items', 'action' => 'view', $downMenuItem['ParentDownMenuItem']['id'])); ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Lft'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $downMenuItem['DownMenuItem']['lft']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Rght'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $downMenuItem['DownMenuItem']['rght']; ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
<h3><?php __('Related Down Menu Item actions');?></h3>
		<ul>
			<li><?php echo $this->Html->link(__('New Child Down Menu Item', true), array('controller' => 'down_menu_items', 'action' => 'add'));?> </li>
		</ul>
	</div>
<div class="related">
	<h3><?php __('Related Down Menu Items');?></h3>
	
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
        <?php if (!empty($downMenuItem['ChildDownMenuItem'])):?>
	<?php
		$i = 0;
		foreach ($downMenuItem['ChildDownMenuItem'] as $childDownMenuItem):
			$class = null;
			if ($i++ % 2 == 0) {
				$class = ' class="altrow"';
			}
		?>
		<tr<?php echo $class;?>>
			<td><?php echo $childDownMenuItem['id'];?></td>
			<td><?php echo $childDownMenuItem['name'];?></td>
			<td><?php echo $childDownMenuItem['link'];?></td>
			<td><?php echo $childDownMenuItem['parent_id'];?></td>
			<td><?php echo $childDownMenuItem['lft'];?></td>
			<td><?php echo $childDownMenuItem['rght'];?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View', true), array('controller' => 'down_menu_items', 'action' => 'view', $childDownMenuItem['id'])); ?>
				<?php echo $this->Html->link(__('Edit', true), array('controller' => 'down_menu_items', 'action' => 'edit', $childDownMenuItem['id'])); ?>
				<?php echo $this->Html->link(__('Delete', true), array('controller' => 'down_menu_items', 'action' => 'delete', $childDownMenuItem['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $childDownMenuItem['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	
<?php endif; ?>
</table>

</div>
</div>