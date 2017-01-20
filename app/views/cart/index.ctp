<?php
echo $this->Session->flash();
$subtotal = 0; //used to get the total price of product with applied discounts and quantity
$total =0;
?>


<div class="center-container">
<h2>Количка</h2>
<div id="action-cart-bar">
  <div class="arrow3"></div><div class="steps" style="background-color:orange;background-image:none;"><div>Продукти</div></div><div class="arrow2"></div>
  <div class="arrow_tr"></div><div class="steps"><div>Информация за доставка</div></div><div class="arrow"></div>
  <div class="arrow_tr"></div><div class="steps"><div>Потвърждение</div></div><div class="arrow"></div>
</div>

<form id="cart-form" method="POST" action="/cart/step2/">
<table id="cart-view">
    <tr>
		<th></th>
		<th>Продукт</th>
		<th>Ед. Цена</th>
		<th>Брой</th>
		<th>Отстъпки</th>
		<th>Общо</th>
	</tr>
	<?php if(!empty($cart['Product'])): ?>
		<?php foreach($cart['Product'] as $key => $item): ?>

		<tr>
			<td style="width:18px;"><div class="remove-item"><input type="hidden" value="<? echo $item['id'] ?>"></div></td>
			
			<td><?php echo $html->link('[' . $item['code'] . '] '.$item['name'], '/products/view/' . $item['id']); ?></td>
			<td class="t-center">
	                      <input type="hidden" name="product-type" value="<? echo $item['type']; ?>">
	                      <input type="hidden" name="product-discount" value="<? echo $item['discount']; ?>">
                          <input type="hidden" name="single-value" value="<? echo $item['price_1']; ?>">
                          <input type="hidden" name="mult-value-6" value="<? echo $item['price_6']; ?>">
                          <input type="hidden" name="mult-value-12" value="<? echo $item['price_12']; ?>">
                          <input type="hidden" name="mult-value-24" value="<? echo $item['price_24']; ?>">
						  <?php // the line below should get changed by JS upon quantity change if user is vendor and product is lacquer?>
						  <?php // the value below is alredy calculated from the CartComponent?>
                          <span><?php echo $item['price']; ?></span> лв.
                        </td>
			<td style="width:50px;"><input type="text" name="buy-count" size="4" value="<? echo $item['cart_quantity']; ?>"></td>
			<td><?php echo $item['discount_text']; ?></td>
			<td class="cart-final-price  t-center" style="width: 81px;"><span><? echo $item['subtotal']; ?></span> лв.</td>
		</tr>
		<?php endforeach; ?>
	<?php endif; ?>
</table>
<input name="clear-cart" type="button" value="Изчисти Количката">
<div class="sep"><div id="cart-price">Общо: <span><? echo $cart['total']; ?></span>&nbspлв.</div></div>

<?php if(isset($user['User']))
      if($user['User']['role'] == 'shop'||$user['User']['role'] == 'vendor') 
      echo "<div style=\"width:400px;font-style:italic;\">*Показаните цени са съобразени с бройката и типа на всеки продукт, както и с типа на вашия акаунт.</div>"; 
?>
<input name="next" type="submit" value="Продължи">
</form>
</div>