<div class="orders form">
<?php echo $this->Form->create('Order');?>
	<fieldset>
		<legend><?php __('Admin Edit Order'); ?></legend>
		<p>Внимание ! При редакция на поръчка, поръчителя ще получи известие за редакцията по имейл. Редакцията трябва да е винаги уместна и да не се прави много пъти в кратки срокове (освен ако не се сменя статус), защото поръчителя ще бъде задръстен с имейли.</p>
	<?php
		echo $this->Form->input('status', array('options' => $statuses, 'selected' => $this->data['Order']['status']) );
		echo $this->Form->input('track_info', array('cols' => 59) );
	?>
	</fieldset>
<?php echo $this->Form->end(__('Запазване', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $this->Form->value('Order.id')), null, sprintf(__('Are you sure you want to delete # %s?', true), $this->Form->value('Order.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Orders', true), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(__('List Users', true), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User', true), array('controller' => 'users', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Ordered Products', true), array('controller' => 'ordered_products', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Ordered Product', true), array('controller' => 'ordered_products', 'action' => 'add')); ?> </li>
	</ul>
</div>