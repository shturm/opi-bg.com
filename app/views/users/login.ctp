<?php
echo $this->Session->flash('auth');
echo $this->Session->flash();
//echo $this->flash();
echo $form->create('User');
echo '<div class="form-title">Вход</div>';
echo $form->input('email', array('label' => 'Email:'));
echo $form->input('password',array('label' => 'Парола:'));

echo "<div class=\"form-text\">Забравена парола? <a href=\"/users/recover\">Възтановяване</a></div>";
echo "<div class=\"form-text\">Нямате Акаунт? <a href=\"/users/register\">Регистрация</a></div>";
echo $form->end('Влез');
//debug($this->Session->read());



?>