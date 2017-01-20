<?php echo $this->Session->flash(); ?>
<div class="users form">
<?php echo $this->Form->create('User');?>
	<fieldset>
		<legend><?php __('Admin Edit User'); ?></legend>
	<?php
		$roles['user'] = 'Обикновен потребител';
		$roles['shop'] = 'Магазин';
		$roles['vendor'] = 'Търговец/професионалист';

	
		// echo $this->Form->input('id');
		// echo $this->Form->input('password');
		echo $this->Form->input('email', array('label' => 'Email') );
		echo $this->Form->input('name', array('label' => 'Име') );
		echo $this->Form->input('address', array('label' => 'Адрес за контакт') );
		echo $this->Form->input('admin_comment', array('label' => 'Админ коментар') );
		echo $this->Form->input('delivery_address', array('label' => 'Адрес за доставка') );
		echo $this->Form->input('phone', array('label' => 'Телефон') );
		echo $this->Form->input('company', array('label' => 'Фирма') );
		echo $this->Form->input('mol', array('label' => 'МОЛ') );
		echo $this->Form->input('bulstat', array('label' => 'Булстат') );
		echo $this->Form->input('dds', array('label' => 'ДДС №') );
		echo $this->Form->input('egn', array('label' => 'ЕГН') );
		echo $this->Form->input('salon', array('label' => 'Салон') );
		// echo $this->Form->input('confirmation_key');
		// echo $this->Form->input('confirmation_key_sent');
		// echo $this->Form->input('recovery_key');
		// echo $this->Form->input('recovery_key_sent');
		echo $this->Form->input('role', array('label' => 'Тип', 'options' => $roles, 'selected' => $this->data['User']['role']));
		// echo $this->Form->input('register_ip');
		// echo $this->Form->input('last_ip');
		// echo $this->Form->input('last_login_date');
		// echo $this->Form->input('date_registered');
		echo $this->Form->input('is_active', array('label' => 'Активен') );
		echo $this->Form->input('is_confirmed', array('label' => 'Потвърден') );
		echo $this->Form->input('discount', array('label' => 'Отстъпка (%)') );
		echo $this->Form->input('license_code', array('label' => 'Лицензен код') );
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $this->Form->value('User.id')), null, sprintf(__('Are you sure you want to delete # %s?', true), $this->Form->value('User.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Users', true), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(__('List Orders', true), array('controller' => 'orders', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Order', true), array('controller' => 'orders', 'action' => 'add')); ?> </li>
	</ul>
</div>