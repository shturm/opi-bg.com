<div id="admin-container">
<div class="admin-actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Colors', true), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(__('List Color Groups', true), array('controller' => 'color_groups', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Color Group', true), array('controller' => 'color_groups', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Products', true), array('controller' => 'products', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Product', true), array('controller' => 'products', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="colors form">
<?php echo $this->Form->create('Color', array('enctype' => 'multipart/form-data') );?>
	<fieldset>
		<legend><?php __('Admin Add Color'); ?></legend>
	<?php
		echo $this->Form->input('name');
		echo $this->Form->input('color_group_id');

		echo $this->Form->input('new_swatch', array('type' => 'file', 'label' => 'Нова картинка') );
                echo $this->Form->submit(__('Submit', true));
	?>
	</fieldset>
<?php echo $this->Form->end();?>
</div>
</div>