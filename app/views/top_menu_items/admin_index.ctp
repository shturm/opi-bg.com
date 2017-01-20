<?php echo $this->Session->flash(); ?>
<div id="admin-container">
<div class="admin-actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('New Top Menu Item', true), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Top Menu Items', true), array('controller' => 'top_menu_items', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Parent Top Menu Item', true), array('controller' => 'top_menu_items', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="topMenuItems index">
	<h2><?php __('Top Menu Items');?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo 'ID';?></th>
			<th><?php echo 'Име';?></th>
			<th><?php echo 'Ред';?></th>

			<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
	$i = 0;
	foreach ($topMenuItems as $id => $topMenuItem):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
	<tr<?php echo $class;?>>
		<td class="ui-orange"><?php echo $id; ?>&nbsp;</td>
		<td><?php echo $topMenuItem; ?>&nbsp;</td>
		<td>
			<?php echo $html->link('^', array('action' => 'moveUp', $id)); ?>&nbsp;
			<?php echo $html->link('v', array('action' => 'moveDown', $id)); ?>&nbsp;
		</td>
		

		<td class="actions">
			<?php echo $this->Html->link(__('View', true), array('action' => 'view', $id)); ?>
			<?php echo $this->Html->link(__('Edit', true), array('action' => 'edit', $id)); ?>
			<?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $id), null, sprintf(__('Are you sure you want to delete # %s?', true), $id)); ?>
		</td>
	</tr>
<?php endforeach; ?>
	</table>


</div>

</div>