<?php echo $this->Session->flash(); ?>
<div id="admin-container">
<div class="admin-actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Down Menu Items', true), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(__('List Down Menu Items', true), array('controller' => 'down_menu_items', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Parent Down Menu Item', true), array('controller' => 'down_menu_items', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="downMenuItems form">
<?php echo $this->Form->create('DownMenuItem', array('enctype' => 'multipart/form-data') );?>
	<fieldset>
		<legend><?php __('Admin Add Down Menu Item'); ?></legend>
	<?php
		echo $this->Form->input('name');
		echo $this->Form->input('link', array('id' => 'link', /* 'style' => 'display: none' */));
		echo $this->Form->input('link_picker', array('id' => 'link_picker', 'label' => 'Избор', 'options' => $picks, 'selected' => '#'));
		echo $this->Form->input('new_image', array('type' => 'file', 'label' => 'Нова снимка'));
		echo $this->Form->submit(__('Submit', true));
	?>
	</fieldset>
<?php echo $this->Form->end();?>
</div>

</div>