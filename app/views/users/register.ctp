<?
	switch($type) {
		case 'user':
			echo $this->element('register_user_form');
			break;
		case 'shop':
			echo $this->element('register_shop_form');
			break;
		case 'vendor':
			echo $this->element('register_vendor_form');
			break;
		case 'pro':
			echo $this->element('register_pro_form');
			break;
		default:
			echo $this->element('register_user_form');
			break;
	}
?>
<div style="clear: both;"></div>
<?
	echo $this->element('register_form_types');
	// DEBUGGING ONLY - REMOVE ON DEPLOYMENT !!
	//debug($users);
	/* if(isset($users)) {
		echo '<table style="clear: both;">';
		//wecho $html->tag('h2','DEBUG ONLY');
		foreach($users as $u) {
			echo $html->tableCells($u['User']);
		}
		echo '</table>';
	} */
?>