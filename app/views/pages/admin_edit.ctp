<div id="admin-container">
<div class="admin-actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $this->Form->value('Page.id')), null, sprintf(__('Are you sure you want to delete # %s?', true), $this->Form->value('Page.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Pages', true), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(__('List Pages', true), array('controller' => 'pages', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Parent Page', true), array('controller' => 'pages', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="pages form">
<?php echo $this->Form->create('Page', array('enctype' => 'multipart/form-data') );?>
	<fieldset class="editor-fieldset">
		<legend><?php __('Admin Edit Page'); ?></legend>
	<?php
		echo $this->Form->input('id', array('display' => 'none'));
		echo $this->Form->input('name', array('label' => 'Име'));
		echo $this->Form->input('short', array('label' => 'Кратко Име'));
		echo $this->Form->input('latin', array('label' => 'Линк'));
		echo $form->input('body', array('label' => 'Съдържание','div'=>array('style'=>'height:520px;')));

		echo $this->Form->input('is_front', array('label' => 'Първа страница'));
		echo $this->Form->input('is_presentation', array('label' => 'Презентация'));
		echo $this->Form->input('is_service', array('label' => 'Сервизна'));
		echo $this->Form->input('is_active', array('label' => 'Активна'));
		echo $this->Form->file('new_image', array('label' => 'Смени фона', 'type'=>'file') );
		echo $this->Form->input('product_id', array() );
		$this->Js->link('/js/tiny_mce/tiny_mce.js', false); 
                echo $this->Form->submit(__('Submit', true));
	?>
	<div class="design-image-thumb">
		<?php if(isset($page['Page']['image_background'])): ?>
		<img width="160px" height="120px" src="<?php echo $page['Page']['image_background']; ?>"/>
		<?php endif; ?>
	</div>

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