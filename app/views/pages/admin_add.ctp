<div id="admin-container">
<div class="admin-actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Pages', true), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(__('List Pages', true), array('controller' => 'pages', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Parent Page', true), array('controller' => 'pages', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="pages form">
<?php echo $this->Form->create('Page', array('enctype' => 'multipart/form-data') );?>
	<fieldset class="editor-fieldset">
		<legend><?php __('Admin Add Page'); ?></legend>
	<?php
		echo $this->Form->input('name');
		echo $this->Form->input('short');
		echo $this->Form->input('latin');
		echo $form->input('body', array('label' => 'Съдържание','div'=>array('style'=>'height:520px;')));
		echo $this->Form->input('position');
		echo $this->Form->input('is_presentation');
		echo $this->Form->input('is_service');
		echo $this->Form->input('is_active');
		echo $this->Form->input('product_id');
		echo $this->Form->file('new_image', array('label' => 'Качи фон', 'type'=>'file') );
		
                 echo $this->Form->submit(__('Submit', true));
	?>
	</fieldset>
<?php echo $this->Form->end();?>
</div>
	<script type="text/javascript">
	tinyMCE.init({
		mode : "textareas",
		theme : "advanced",
                width:"820",
                height:"400",
                theme_advanced_toolbar_location : "top",
   		theme_advanced_toolbar_align : "left"
	});
	</script>
</div>