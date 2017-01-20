<? echo $this->Session->flash(); ?>
<div id="admin-container">
<div class="admin-actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $this->Form->value('Group.id')), null, sprintf(__('Are you sure you want to delete # %s?', true), $this->Form->value('Group.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Groups', true), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(__('List Groups', true), array('controller' => 'groups', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Parent Group', true), array('controller' => 'groups', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Products', true), array('controller' => 'products', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Product', true), array('controller' => 'products', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Images', true), array('controller' => 'images', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Image', true), array('controller' => 'images', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="groups form">
<?php echo $this->Form->create('Group');?>
	<fieldset>
		<legend><?php __('Admin Edit Group'); ?></legend>
	<?php
		echo $this->Form->input('id', array('display' => 'none') );
		echo $this->Form->input('name', array('label' => 'Име') );
		echo $this->Form->input('latin', array('label' => 'Линк'));
		echo $this->Form->input('description', array('label' => 'Описание'));
		echo $this->Form->input('is_active', array('label' => 'Активен'));
		// echo $this->Form->input('lft', array('display' => 'none'));
		// echo $this->Form->input('rght', array('display' => 'none'));
		echo $this->Form->input('parent_id', array('label' => 'Родител', 'options' => $parentGroups) );
		// debug($parentGroups);
		// echo $this->Form->input('Image');
		echo $this->Form->submit(__('Submit', true));
	?>
	</fieldset>
<?php echo $this->Form->end();?>
</div>

</div>