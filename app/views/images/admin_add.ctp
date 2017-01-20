<div id="admin-container">
<div class="admin-actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Images', true), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(__('List Groups', true), array('controller' => 'groups', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Group', true), array('controller' => 'groups', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Products', true), array('controller' => 'products', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Product', true), array('controller' => 'products', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="images form">
<?php echo $this->Form->create('Image');?>
	<fieldset>
		<legend><?php __('Admin Add Image'); ?></legend>
	<?php
		echo $this->Form->input('alt');
		echo $this->Form->input('path');
		echo $this->Form->input('Group',array('div'=>array('style'=>'height:220px;'),'style'=>'float:right'));
		echo $this->Form->input('Product',array('style'=>'width: 719px;'));
                echo $this->Form->submit(__('Submit', true),array('div'=>array('style'=>'width:620px;')));
	?>
	</fieldset>
<?php echo $this->Form->end();?>
</div>

</div>