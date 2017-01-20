<?php echo $this->Session->flash(); ?>
<div class="users index">
	<h2><?php __('Users');?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id');?></th>

			<th><?php echo $this->Paginator->sort('email');?></th>
			<th><?php echo $this->Paginator->sort('Име', 'name');?></th>
			<th><?php echo $this->Paginator->sort('Адрес', 'address');?></th>


			<th><?php echo $this->Paginator->sort('Фирма', 'company');?></th>
			<th><?php echo $this->Paginator->sort('Салон', 'salon');?></th>

			<th><?php echo $this->Paginator->sort('Тип', 'role');?></th>


			<th><?php echo $this->Paginator->sort('Активен', 'is_active');?></th>
			<th><?php echo $this->Paginator->sort('Потвърден', 'is_confirmed');?></th>

			<th><?php echo $this->Paginator->sort('Л. код', 'license_code');?></th>
			<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
	$i = 0;
	foreach ($users as $user):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
	<tr<?php echo $class;?>>
		<td><?php echo $user['User']['id']; ?>&nbsp;</td>

		<td><?php echo $user['User']['email']; ?>&nbsp;</td>
		<td><?php echo $user['User']['name']; ?>&nbsp;</td>
		<td><?php echo $user['User']['address']; ?>&nbsp;</td>
		<td><?php echo $user['User']['company']; ?>&nbsp;</td>
		<td><?php echo $user['User']['salon']; ?>&nbsp;</td>
		<td><?php echo $user['User']['role']; ?>&nbsp;</td>

		<td><?php echo $user['User']['is_active']; ?>&nbsp;</td>
		<td><?php echo $user['User']['is_confirmed']; ?>&nbsp;</td>

		<td><?php echo $user['User']['license_code']; ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View', true), array('action' => 'view', $user['User']['id'])); ?>
			<?php echo $this->Html->link(__('Edit', true), array('action' => 'edit', $user['User']['id'])); ?>
			<?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $user['User']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $user['User']['id'])); ?>
			<?php echo $this->Html->link(__('Активирай', true), array('action' => 'confirmAndActivate', $user['User']['id']), null, sprintf(__('Активиране и по потвърждение на потребител %s?', true), $user['User']['email'])); ?>
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

	<div class="paging">
		<?php echo $this->Paginator->prev('<< ' . __('previous', true), array(), null, array('class'=>'disabled'));?>
	 | 	<?php echo $this->Paginator->numbers();?>
 |
		<?php echo $this->Paginator->next(__('next', true) . ' >>', array(), null, array('class' => 'disabled'));?>
	</div>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('New User', true), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Orders', true), array('controller' => 'orders', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Order', true), array('controller' => 'orders', 'action' => 'add')); ?> </li>
	</ul>
</div>