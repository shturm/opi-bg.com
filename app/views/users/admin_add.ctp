<div class="users form">
<?php echo $this->Form->create('User');?>
	<fieldset>
		<legend><?php __('Admin Add User'); ?></legend>
	<?php
		echo $this->Form->input('password');
		echo $this->Form->input('email');
		echo $this->Form->input('name');
		echo $this->Form->input('address');
		echo $this->Form->input('delivery_address');
		echo $this->Form->input('phone');
		echo $this->Form->input('company');
		echo $this->Form->input('mol');
		echo $this->Form->input('bulstat');
		echo $this->Form->input('dds');
		echo $this->Form->input('egn');
		echo $this->Form->input('salon');
		echo $this->Form->input('confirmation_key');
		echo $this->Form->input('confirmation_key_sent');
		echo $this->Form->input('recovery_key');
		echo $this->Form->input('recovery_key_sent');
		echo $this->Form->input('role');
		echo $this->Form->input('register_ip');
		echo $this->Form->input('last_ip');
		echo $this->Form->input('last_login_date');
		echo $this->Form->input('date_registered');
		echo $this->Form->input('is_active');
		echo $this->Form->input('is_confirmed');
		echo $this->Form->input('personal_discount');
		echo $this->Form->input('shop_discount');
		echo $this->Form->input('license_code');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Users', true), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(__('List Orders', true), array('controller' => 'orders', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Order', true), array('controller' => 'orders', 'action' => 'add')); ?> </li>
	</ul>
</div>