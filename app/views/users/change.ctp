<?php echo $this->Session->flash(); ?>
<fieldset class="ui-center" style="width:320px;margin-top:20px;">
<h2>Промяна на профила</h2>
<?php
	// set conditions for different user
	echo $form->create('User');
	echo $form->input('name', array('label' => 'Име') );
	echo $form->input('email', array('label' => 'Еmail') );
	echo $form->input('address', array('label' => 'Адрес за контакт') );
	echo $form->input('delivery_address', array('label' => 'Адрес за доставки') );
	echo $form->input('phone', array('label' => 'Телефон') );
	// enterprise
	if ($user['User']['role'] != 'user') {
		echo $form->input('company', array('label' => 'Фирма') );
		echo $form->input('mol', array('label' => 'МОЛ') );
		echo $form->input('bulstat', array('label' => 'Булстат') );
		echo $form->input('dds', array('label' => 'ДДС №') );
		echo $form->input('egn', array('label' => 'ЕГН') );
		echo $form->input('salon', array('label' => 'Салон') );
		}

	echo $form->submit('Промени');
?>
</fieldset>