<h2>Регистрация на търговец</h2>
<p>Фирмените регистрации подлежат на ръчно одобрение и проверка и не се активират автоматично. Когато това стане ще получите имейл за това.</p>
<?php
	echo $this->Session->flash(); //outputs any flashing messages
	echo $form->create('User', array('action' => 'register/' . $type, 'class' => 'register-form'));
	//echo $form->error('email', 'Има грешка');
        echo '<div class="column1">';
	echo '<div class="form-title">Данни за акаунта</div>';
	echo $form->input('name', array('label' => 'Лице за контакт'));
	//echo $form->input('sur_name', array('label' => 'Презиме'));
	//echo $form->input('family_name', array('label' => 'Фамилия'));
	echo $form->input('email', array('label' => 'Електронен адрес<span class="redstar">*</span>'));
	echo $form->input('password', array('label' => 'Парола<span class="redstar">*</span>'));
	echo $form->input('password_confirm', array('label' => 'Парола (проверка)<span class="redstar">*</span>', 'type' => 'password'));
	//echo $form->input('address', array('label' => 'Адрес за контакт'));
	//echo $form->input('delivery_address', array('label' => 'Адрес за доставки'));
	echo $form->input('phone', array('label' => 'Телефон за контакт<span class="redstar">*</span>'));
        echo '</div>';
	echo '<div class="column2">';
	echo '<div class="form-title">Данни за фирмата</div>';
	echo $form->input('company', array('label' => 'Име на фирмата<span class="redstar">*</span>'));
	echo $form->input('salon', array('label' => 'Име на магазина/салона'));
	echo $form->input('address', array('label' => 'Адрес за контакт'));
	echo $form->input('delivery_address', array('label' => 'Адрес за доставка<span class="redstar">*</span>'));
	echo $form->input('bulstat', array('label' => 'Булстат<span class="redstar">*</span>'));
	echo $form->input('dds', array('label' => 'ДДС'));
	echo $form->input('mol', array('label' => 'МОЛ<span class="redstar">*</span>'));
	// echo $form->input('egn', array('label' => 'ЕГН')); //professionals only
	echo $form->input('license_code', array('label' => 'РЗИ Код<span class="redstar">*</span>'));
    echo "<p style='color: white;'>Моля, въведете кода от картинката.</p>";
	echo $this->Recaptcha->show(); 
	echo $this->Recaptcha->error(); 	
	echo $form->end('Регистрация');
        echo '</div>';
?>