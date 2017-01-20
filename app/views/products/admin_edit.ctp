<? echo $this->Session->flash(); ?>
<div id="admin-container">

<div class="products form">
<?php echo $this->Form->create('Product', array('enctype' => 'multipart/form-data'));?>
	<fieldset class="larger-fieldset">
		<legend><?php __('Admin Edit Product'); ?></legend>
	<?php
		echo $this->Form->input('id', array('display' => 'none'));
		echo $this->Form->input('code', array('label' => 'Код') );
		echo $this->Form->input('name', array('label' => 'Име') );
		echo $this->Form->input('latin', array('label' => 'Линк') );
		echo $this->Form->input('description', array('label' => 'Описание', 'cols' => '53'));
		echo $this->Form->input('group_id', array('label' => 'Група') );
		echo $this->Form->input('collection_id', array('label' => 'Колекция') );
		echo $this->Form->input('price', array('label' => 'Цена') );
		echo $this->Form->input('discount', array('label' => 'Отстъпка (% цяло число)') );
		echo $this->Form->input('vendor_price', array('label' => 'Търговска цена (1бр)') );
		echo $this->Form->input('vendor_price_6', array('label' => 'Търговска цена (6+бр)') );
		echo $this->Form->input('vendor_price_12', array('label' => 'Търговска цена (12+бр)') );
		echo $this->Form->input('vendor_price_24', array('label' => 'Търговска цена (24+бр)') );
		echo $this->Form->input('vendor_action_price', array('label' => 'Търговска цена в акция') );
		echo $this->Form->input('shop_action_price', array('label' => 'Магазинерска цена в акция') );
		echo $this->Form->input('action_price', array('label' => 'Цена в акция') );
		//echo $this->Form->input('position', array('label' => 'Позиция') );
		echo $this->Form->input('is_active', array('label' => 'Активен') );
		echo $this->Form->input('is_featured', array('label' => 'Препоръчан') );
		echo $this->Form->input('is_pro', array('label' => 'Само за професионалисти') );
		echo $this->Form->input('in_action', array('label' => 'В акция') );
		echo $this->Form->input('tags', array('label' => 'Тагове') );	
	?>

	<?php
		
		$types['product'] = 'Продукт';
		$types['promotion'] = 'Промоция';
		$types['collection'] = 'Колекция';
		$types['paint'] = 'Боя за коса';
		$types['lacquer'] = 'Лак';
		$types['hologram_lacquer'] = 'Холограмен Лак';
		echo $this->Form->input('type', array('label' => 'Тип', 'options' => $types));
		//echo $this->Form->input('color_id', array('label' => 'Цвят'));
		?>
		<div style="height:130px;"><label>Снимка</label>
		<?php
		echo $html->image('/'.$product['Product']['image_thumb']);
                ?>
                </div>
               <?php
		echo $this->Form->input('new_image', array('label' => 'Смени снимка', 'type' => 'file') );
		// echo $this->Form->input('Image');
	?>
        <?php echo $this->Form->submit(__('Submit', true));?>
	</fieldset>
<?php echo $this->Form->end();?>
</div></div>
