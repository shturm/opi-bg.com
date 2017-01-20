<? echo $this->Session->flash(); ?>
<div id="admin-container">
<div class="admin-actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>

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
	<fieldset class="larger-fieldset">
		<legend><?php __('Admin Add Group'); ?></legend>
	<?php
		echo $this->Form->input('name', array('label' => 'Име'));
		echo $this->Form->input('latin', array('label' => 'Линк'));
		echo $this->Form->input('description', array('cols' => '39', 'label' => 'Описание'));
		echo $this->Form->input('is_active', array('label' => 'Активна'));
		echo $this->Form->input('position', array('label' => 'Позиция'));
		echo $this->Form->input('parent_id', array('label' => 'В група', 'options' => $parentGroups));
		// echo $this->Form->input('lft');
		// echo $this->Form->input('rght');

		// echo $this->Form->input('Image');
  		echo $this->Form->submit(__('Submit', true));
	?>
	</fieldset>
<?php echo $this->Form->end();?>
</div>

</div>