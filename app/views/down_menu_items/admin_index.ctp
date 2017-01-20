<?php echo $this->Session->flash(); ?>
<div id="admin-container">
<div class="admin-actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('New Down Menu Item', true), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Down Menu Items', true), array('controller' => 'down_menu_items', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Parent Down Menu Item', true), array('controller' => 'down_menu_items', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="downMenuItems index">
	<h2><?php __('Down Menu Items');?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('ID', 'id');?></th>
			<th><?php echo $this->Paginator->sort('Име', 'name');?></th>
			<th><?php echo $this->Paginator->sort('link');?></th>
			<th>Подредба</th>
			<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
	$i = 0;
	foreach ($downMenuItems as $downMenuItem):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
	<tr<?php echo $class;?>>
		<td><?php echo $downMenuItem['DownMenuItem']['id']; ?>&nbsp;</td>
		<td><?php echo $downMenuItem['DownMenuItem']['name']; ?>&nbsp;</td>
		<td><?php echo $downMenuItem['DownMenuItem']['link']; ?>&nbsp;</td>
		<td>
			<?php echo $html->link('^', array('action' => 'moveup', $downMenuItem['DownMenuItem']['id'] )); ?>
			<?php echo $html->link('v', array('action' => 'movedown',  $downMenuItem['DownMenuItem']['id'])); ?>
		</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View', true), array('action' => 'view', $downMenuItem['DownMenuItem']['id'])); ?>
			<?php echo $this->Html->link(__('Edit', true), array('action' => 'edit', $downMenuItem['DownMenuItem']['id'])); ?>
			<?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $downMenuItem['DownMenuItem']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $downMenuItem['DownMenuItem']['id'])); ?>
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
