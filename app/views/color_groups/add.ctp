<div class="colorGroups form">
<?php echo $this->Form->create('ColorGroup');?>
	<fieldset>
		<legend><?php __('Add Color Group'); ?></legend>
	<?php
		echo $this->Form->input('name');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Color Groups', true), array('action' => 'index'));?></li>
	</ul>
</div>