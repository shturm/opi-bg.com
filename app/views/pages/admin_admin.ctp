<div id="admin-menu">
<?php
	//debug($users);
	//debug($orders);
?>
<h4>Последни необслужени поръчки</h4>
<table class="index">
	<?php 
		echo $html->tableHeaders(array('ID', 'Email', 'Дата', 'Сума')); 
		foreach($orders as $o):
	?>
	<tr>
		<td><?php echo $o['Order']['id']; ?></td> 
		<td><?php echo $o['Order']['email']; ?></td> 
		<td><?php echo $o['Order']['date_created']; ?></td>
		<td><?php echo $o['Order']['total_sum']; ?></td>
		<td><?php echo $html->link('Преглед', array('controller' => 'orders','action' => 'view', $o['Order']['id']) ); ?></td>
		<td><?php echo $html->link('Редактирай', array('controller' => 'orders','action' => 'edit', $o['Order']['id']) ); ?></td>
	</tr>
	<?php endforeach; ?>
</table>
<h4>Последни неактивирани фирмени акаунти</h4>
<table class="index">
	<?php 
		echo $html->tableHeaders(array('ID', 'Име', 'Email', 'Тип', 'Фирма', 'Салон')); 
		foreach($users as $u):
	?>
	<tr>
		<td><?php echo $u['User']['id']; ?></td> 
		<td><?php echo $u['User']['name']; ?></td> 
		<td><?php echo $html->link($u['User']['email'], array('controller' => 'users', 'action' => 'view', $u['User']['id']) ); ?></td> 
		<td><?php echo $u['User']['role']; ?></td>
		<td><?php echo $u['User']['company']; ?></td>
		<td><?php echo $u['User']['salon']; ?></td>
		<td><?php echo $this->Html->link(__('Активирай', true), array('controller' => 'users', 'action' => 'confirmAndActivate', $u['User']['id']), null, sprintf(__('Активиране и по потвърждение на потребител %s?', true), $u['User']['email'])); ?></td>
	</tr>
	<?php endforeach; ?>
</table>
</div>