<div class="topMenuItems form">
<div id="admin-container">
<div class="admin-actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $this->Form->value('TopMenuItem.id')), null, sprintf(__('Are you sure you want to delete # %s?', true), $this->Form->value('TopMenuItem.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Top Menu Items', true), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(__('List Top Menu Items', true), array('controller' => 'top_menu_items', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Top Menu Item', true), array('controller' => 'top_menu_items', 'action' => 'add')); ?> </li>
	</ul>
</div>
<?php echo $this->Form->create('TopMenuItem');?>
	<fieldset>
		<legend><?php __('Admin Edit Top Menu Item'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('name');

		echo $this->Form->input('link', array('id' => 'link'));
		echo $this->Form->input('link_picker', array('id' => 'link_picker', 'label' => 'Избор', 'options' => $picks, 'selected' => $picked));
		echo $this->Form->input('parent_id');

               echo $this->Form->submit(__('Submit', true));
	?>
	</fieldset>
<?php echo $this->Form->end();?>
</div>
<script type="text/javascript">
	function updateLink() {
		
	}
</script>
</div>