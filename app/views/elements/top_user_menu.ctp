<? if(isset($user)) $user['User']['name'] = $user['User']['email']; else  $user['User']['name'] = 'Гост'; ?>
<div id="user-bar">
        <div id="user-title"><? echo $html->link('Добре Дошъл ' . $user['User']['name'], '/users/'); ?></div>
	<div id="user-button"></div>
	<div id="user-dropdown">
	
		<? if(!$this->Session->read('Auth.User')): ?>
		<div><? echo $html->link('Влез', '/users/login'); ?></div>
		<? endif; ?>
		<? if(!$this->Session->read('Auth.User')): ?>
		<div><? echo $html->link('Регистрирай се', '/users/register'); ?></div>
		<? endif; ?>
		<? if(!$this->Session->read('Auth.User')): ?>
		<div><? echo $html->link('Забравена парола', '/users/recover'); ?></div>
		<? endif; ?>
		<? if(!$this->Session->read('Auth.User')): ?>
		<div><? echo $html->link('Проследи поръчка', '/orders/track'); ?></div>
		<? endif; ?>
		
		<? if($this->Session->read('Auth.User')): ?>
		<div><? echo $html->link('Профил', '/users/index'); ?></div>
		<? endif; ?>
		<? if($this->Session->read('Auth.User')): ?>
		<div><? echo $html->link('Смяна на парола', '/users/changepassword'); ?></div>
		<? endif; ?>
		<? if($this->Session->read('Auth.User')): ?>
		<div><? echo $html->link('Моите поръчки', '/users/myorders'); ?></div>
		<? endif; ?>
		<? if($this->Session->read('Auth.User')): ?>
		<div><? echo $html->link('Настройки', '/users/index'); ?></div>
		<? endif; ?>
		<? if($this->Session->read('Auth.User')): ?>
		<div><? echo $html->link('Изход', '/users/logout'); ?></div>
		<? endif; ?>
		
	</div>
</div>