<h2>Регистрация на потребител</h2>
<?php
	echo $this->Session->flash(); //outputs any flashing messages
	echo $form->create('User', array('class' => 'register-form'));
	//echo $form->error('email', 'Има грешка');
        
	echo '<div class="column1">';
	echo '<div class="form-title">Регистрация на потребител</div>';
	echo $form->input('name', array('label' => 'Име'));
	//echo $form->input('sur_name', array('label' => 'Презиме'));
	//echo $form->input('family_name', array('label' => 'Фамилия'));
	echo $form->input('email', array('label' => 'Електронен адрес<span class="redstar">*</span>'));
	echo $form->input('password', array('label' => 'Парола<span class="redstar">*</span>'));
	echo $form->input('password_confirm', array('label' => 'Парола (проверка)<span class="redstar">*</span>', 'type' => 'password'));
	echo $form->input('address', array('label' => 'Адрес за контакт'));
	echo $form->input('delivery_address', array('label' => 'Адрес за доставки<span class="redstar">*</span>'));
	echo $form->input('phone', array('label' => 'Телефонен номер<span class="redstar">*</span>'));
	echo $this->Form->submit('Регистрация');
    echo "<p style='color: white;'>Моля, въведете кода от картинката.</p>";
	echo $this->Recaptcha->show(); 
	echo $this->Recaptcha->error(); 
	
	echo '</div>';

echo $form->end();
?>