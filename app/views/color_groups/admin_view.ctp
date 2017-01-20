<div id="admin-container">
<div class="admin-actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Color Group', true), array('action' => 'edit', $colorGroup['ColorGroup']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('Delete Color Group', true), array('action' => 'delete', $colorGroup['ColorGroup']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $colorGroup['ColorGroup']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Color Groups', true), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Color Group', true), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Colors', true), array('controller' => 'colors', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Color', true), array('controller' => 'colors', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="colorGroups view">
<h2><?php  __('Color Group');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $colorGroup['ColorGroup']['id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Name'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $colorGroup['ColorGroup']['name']; ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
<h3><?php __('Related Colors actions');?></h3>
		<ul>
			<li><?php echo $this->Html->link(__('New Color', true), array('controller' => 'colors', 'action' => 'add'));?> </li>
		</ul>
	</div>
<div class="related">
	<h3><?php __('Related Colors');?></h3>
	
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php __('Id'); ?></th>
		<th><?php __('Name'); ?></th>
		<th><?php __('Color Group Id'); ?></th>
		<th class="actions"><?php __('Actions');?></th>
	</tr>
        <?php if (!empty($colorGroup['Color'])):?>
	<?php
		$i = 0;
		foreach ($colorGroup['Color'] as $color):
			$class = null;
			if ($i++ % 2 == 0) {
				$class = ' class="altrow"';
			}
		?>
		<tr<?php echo $class;?>>
			<td><?php echo $color['id'];?></td>
			<td><?php echo $color['name'];?></td>
			<td><?php echo $color['color_group_id'];?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View', true), array('controller' => 'colors', 'action' => 'view', $color['id'])); ?>
				<?php echo $this->Html->link(__('Edit', true), array('controller' => 'colors', 'action' => 'edit', $color['id'])); ?>
				<?php echo $this->Html->link(__('Delete', true), array('controller' => 'colors', 'action' => 'delete', $color['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $color['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	
<?php endif; ?>
</table>

</div>
</div>
