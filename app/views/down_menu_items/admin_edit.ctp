<?php echo $this->Session->flash(); ?>
<div id="admin-container">
<div class="admin-actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $this->Form->value('DownMenuItem.id')), null, sprintf(__('Are you sure you want to delete # %s?', true), $this->Form->value('DownMenuItem.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Down Menu Items', true), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(__('List Down Menu Items', true), array('controller' => 'down_menu_items', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Parent Down Menu Item', true), array('controller' => 'down_menu_items', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="downMenuItems form">
<?php echo $this->Form->create('DownMenuItem', array('enctype' => 'multipart/form-data') );?>
	<fieldset>
		<legend><?php __('Admin Edit Down Menu Item'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('name');
		echo $this->Form->input('link', array('id' => 'link', /* 'style' => 'display: none' */));
		echo $this->Form->input('link_picker', array('id' => 'link_picker', 'label' => 'Избор', 'options' => $picks, 'selected' => $picked));
		echo $this->Form->input('new_image', array('type' => 'file', 'label' => 'Нова снимка'));
 		echo $this->Form->submit(__('Submit', true));
	?>
	<div id="image" style="margin-top: 15px; margin-bottom: 70px;">
	<?php if(!empty($dmi['DownMenuItem']['image'])) echo $html->image('/'.$dmi['DownMenuItem']['image'], array('width' => '72px', 'height' => '72px') ); ?>
	</div>
	<?php
	?>
	</fieldset>
<?php echo $this->Form->end();?>
</div>
</div>