<?
echo $this->Session->flash();
switch($type) {
	case 'user':
		echo 'Можете да влезете - ' . $html->link('вход', '/users/login');
		break;
	case 'shop':
	case 'vendor':
		echo 'Акаунта ви обаче ще бъде ръчно активиран след като бъде проверен лицензния Ви номер. Слев като това стане ще получите допълнителен имейл и ще можете да влезете - ' . $html->link('вход', '/users/login');
		break;
	default:
		// u should reach this point!
		break;
}

?>