<? echo $this->Session->flash(); ?>
<div id="general-cont">
<? if (isset($order)): ?>



<div class="ui-transparent rounded ui-white indented fixed-cont ui-white-link"><h3>Информация за поръчка</h3></div>
<table class="ui-white ui-white-link" style="width:500px;">
	<tr>
		<td class="ui-orange">Код</td>
		<td><? echo $order['Order']['track_hash']; ?></td>
	</tr>
	<tr>
		<td class="ui-orange">Номер</td>
		<td><? echo $order['Order']['id']; ?></td>
	</tr>	
	<tr>
		<td class="ui-orange">Адрес за доставка</td>
		<td><? echo $order['Order']['delivery_address']; ?></td>
	</tr>
	<tr>
		<td class="ui-orange">Адрес за кореспонденция</td>
		<td><? echo $order['Order']['address']; ?></td>
	</tr>
	<tr>
		<td class="ui-orange">Лице за контакт</td>
		<td><? echo $order['Order']['name']; ?></td>
	</tr>
	<tr>
		<td class="ui-orange">Телефон</td>
		<td><? echo $order['Order']['phone']; ?></td>
	</tr>
	<tr>
		<td class="ui-orange">Създадена</td>
		<td><? echo $order['Order']['date_created']; ?></td>
	</tr>
	<tr>
		<td class="ui-orange">Статус</td>
		<td><? echo $html->orderStatus($order['Order']['status']); ?></td>
	</tr>
	<tr>
		<td class="ui-orange">Допълнителни указания</td>
		<td><? echo $order['Order']['user_info']; ?></td>
	</tr>
	<tr>
		<td class="ui-orange">Допълнителна информация от Опи</td>
		<td><? echo $order['Order']['track_info']; ?></td>
	</tr>
	<tr>
		<td class="ui-orange">Сума (общо)</td>
		<td><? echo $order['Order']['total_sum']; ?> лв.</td>
	</tr>
	
</table>
<div class="ui-dark-transparent rounded ui-white  indented fixed-cont"><h3>Съдържание</h3></div>
<table class="ui-white ui-white-link" style="width:500px;">
	<th class="ui-orange">Продукт</th>
	<th class="ui-orange">Ед. Цена</th>
	<th class="ui-orange">Отстъпка</th>
	<th class="ui-orange">Брой</th>
	<th class="ui-orange">Общо</th>
	<!-- <th>Цена (общо)</th> -->
	
<?
	foreach($order['OrderedProduct'] as $p) {
		echo '<tr>';
			echo '<td>' . $html->link($p['name'], array('controller' => 'products', 'action' => 'view', $p['product_id']) ) . '</td>';
			echo '<td>' . $p['price'] . ' лв.</td>';
			echo '<td>' . $p['discount_text'] . '</td>';
			echo '<td>' . $p['cart_quantity'] . '</td>';
			echo '<td>' . $p['subtotal'] . ' лв.</td>';
			//echo '<td>' . $p['OrdersProduct']['total_price'] . ' </td>';
		echo '</tr>';
	}
	//debug($order);
?>
</table>
<?php 
	$cancel_impossible = array('canceled', 'rejected', 'sent');
	if(!in_array($order['Order']['status'], $cancel_impossible)) {
		echo $html->link('Анулирай поръчката', array('controller' => 'orders', 'action' => 'cancel', $order['Order']['track_hash']), array('class' => 'buttonlike'), 'Отказване на поръчката ?');
	}
?>

<? endif; ?>
</div>