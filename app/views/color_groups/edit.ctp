<div class="colorGroups form">
<?php echo $this->Form->create('ColorGroup');?>
	<fieldset>
		<legend><?php __('Edit Color Group'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('name');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $this->Form->value('ColorGroup.id')), null, sprintf(__('Are you sure you want to delete # %s?', true), $this->Form->value('ColorGroup.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Color Groups', true), array('action' => 'index'));?></li>
	</ul>
</div>