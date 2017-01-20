<?php echo $this->Session->flash(); ?>
<div id="admin-container">
<div class="admin-actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('New Color', true), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Color Groups', true), array('controller' => 'color_groups', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Color Group', true), array('controller' => 'color_groups', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Products', true), array('controller' => 'products', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Product', true), array('controller' => 'products', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="colors index">
	<h2><?php __('Colors');?></h2>
	<table class="ui-center" cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id');?></th>
			<th><?php echo $this->Paginator->sort('swatch');?></th>
			<th><?php echo $this->Paginator->sort('name');?></th>
			<th><?php echo $this->Paginator->sort('color_group_id');?></th>
			<th><?php echo $this->Paginator->sort('Лак', 'Product.id');?></th>
			<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
	$i = 0;
	foreach ($colors as $color):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
	<tr<?php echo $class;?>>
		<td class="ui-orange"><?php echo $color['Color']['id']; ?>&nbsp;</td>
		<td><?php echo $html->image($color['Color']['swatch']); ?>&nbsp;</td>
		<td><?php echo $color['Color']['name']; ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($color['ColorGroup']['name'], array('controller' => 'color_groups', 'action' => 'view', $color['ColorGroup']['id'])); ?>
		</td>
		<td><?php echo $html->link($color['Product']['name'], array('controller' => 'products', 'action' => 'view', $color['Product']['id']) ); ?></td>
		<td class="actions">
			<?php echo $this->Html->link(__('View', true), array('action' => 'view', $color['Color']['id'])); ?>
			<?php echo $this->Html->link(__('Edit', true), array('action' => 'edit', $color['Color']['id'])); ?>
			<?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $color['Color']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $color['Color']['id'])); ?>
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