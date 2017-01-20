<?php
echo $this->Session->flash();
echo $form->create('User', array('action' => 'changepassword'));
echo '<div class="form-title">Смяна на паролата</div>';
echo $form->input('old_password', array('type' => 'password', 'label' => 'Настояща парола'));
echo $form->input('new_password', array('type' => 'password', 'label' => 'Нова парола'));
echo $form->input('new_password_confirm', array('type' => 'password', 'label' => 'Нова парола (проверка)'));
echo $form->end("Смени паролата");
?>