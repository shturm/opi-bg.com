<? echo $this->Session->flash(); ?>
<?	// humanize payment string
	switch($order['Order']['payment']) {
		case "onsite":
			$order['Order']['payment'] = 'наложен платеж';
			break;
		default:
			$order['Order']['payment'] = 'наложен платеж';
			break;
	}
	$total = 0;
	$subtotal = 0; // total sum to be payed for each (type of) product in cart
?>
<div class="center-container">
<h2>Кошница</h2>
<div id="action-cart-bar">
  <div class="arrow_tr"></div><div class="steps" ><div>Продукти</div></div><div class="arrow"></div>
  <div class="arrow_tr"></div><div class="steps"  ><div>Информация за доставката</div></div><div class="arrow"></div>
  <div class="arrow3"></div>
  <div class="steps"  style="background-color:orange;background-image:none;"><div>Потвърждение</div></div><div class="arrow2"></div>
</div>

<div id="FinalCartForm">
<div style="width: 840px;min-height:100%;"> <div style="width: 320px; float: left;">
  <h4>Информация за поръчка:</h4>
 <div>Име: <span><? echo $order['Order']['name']; ?></span></div>
 <div>Email: <span><? echo $order['Order']['email']; ?></span></div>
 <div>Телефон: <span><? echo $order['Order']['phone']; ?></span></div>
 <div>Адрес за контакт: <span><? echo $order['Order']['address']; ?></span></div>
 <div>Допълнителни указания: <span><? echo $order['Order']['user_info']; ?></span></div>
 <div>Тип плащане: <span><? echo $order['Order']['payment']; ?></span></div>
 <div>Издаване на фактура: <span><? if($order['Order']['invoice_required'] == 1) echo 'Да'; else echo 'Не'; ?></span></div>
 <div></div>
 <h4>Информация за доставка:</h4>
 <div>Адрес: <span><? echo $order['Order']['delivery_address']; ?></span></div>

 </div>
 <div style="float: left; width: 410px;">
 <h4>Поръчка:</h4>
 <table>
	<th>Продукт</th>
	<th>Ед. цена</th>
	<th>Брой</th>
	<th>Отстъпка</th>
	<th>Общо</th>
	<?php
		
		foreach($cart['Product'] as $item): 
	?>
	<tr>
		<td><? echo $item['name']; ?></td>
		<td><? echo $item['price']; ?></td>
		<td><? echo $item['cart_quantity']; ?></td>
		<td><? echo $item['discount_text']; ?></td>
		<td><? echo $item['subtotal']; ?></td>
	</tr>
	<? endforeach; ?>
	<? if ($cart['total'] < 130):?>
		<tr>
			<td>Доставка</td>
			<td>4</td>
			<td>1</td>
			<td></td>
			<td>4</td>
		</tr>
	<? endif; ?>
 </table>
 <?php //0888 01 2892 ?>
 <?php
 	 if ($cart['total'] <130) {
 	 	$cart['total'] +=4;
 	 }
  ?>
 <div>Обща сума: <? echo $cart['total']; ?> лв.</div>
</div></div>
<div style="width:60%;margin-top:15px;float:left;">
<p>ВНИМАНИЕ: При поръчки под 130 лева доставката е за сметка на поръчителя с фирма RAPIDO и на стойност 4 /четири/ лева. За поръчки над 130 лева доставката е безплатна</a></p>
 <div class="cart-nav"><input style="float:right;" onclick="window.location = '/cart/step4'" type="button" value="Поръчка">
 <input type="button" onClick="window.location = '/cart/step2'" value="Назад"></div>
</div>
</div>
