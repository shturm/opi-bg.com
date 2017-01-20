<?php echo $this->Session->flash(); ?>
<div id="admin-container">
<div class="admin-actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $this->Form->value('ColorGroup.id')), null, sprintf(__('Are you sure you want to delete # %s?', true), $this->Form->value('ColorGroup.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Color Groups', true), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(__('List Colors', true), array('controller' => 'colors', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Color', true), array('controller' => 'colors', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="colorGroups form">
<?php echo $this->Form->create('ColorGroup');?>
	<fieldset>
		<legend><?php __('Admin Edit Color Group'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('name');
		echo $this->Form->submit(__('Submit', true));
	?>
	</fieldset>
<?php echo $this->Form->end();?>
</div>

</div>