<div id="admin-container">
<div class="admin-actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Color Groups', true), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(__('List Colors', true), array('controller' => 'colors', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Color', true), array('controller' => 'colors', 'action' => 'add')); ?> </li>
	</ul>
</div>

<div class="colorGroups form">
<?php echo $this->Form->create('ColorGroup');?>
	<fieldset>
		<legend><?php __('Admin Add Color Group'); ?></legend>
	<?php
		echo $this->Form->input('name');
 		echo $this->Form->submit(__('Submit', true));
	?>
	</fieldset>
<?php echo $this->Form->end();?>
</div>

</div>