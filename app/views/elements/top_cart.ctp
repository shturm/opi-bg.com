<div class="cart-cont closed"><div style="height:20px;">
<div style="float:left;width:150px;"><a href="/cart">Количка (<? echo $cart['total']==0?0:$cart['total']; ?>) лв.</a></div><div class="cart-button"></div></div>
 <div id="cart-dropdown">
 <? if(!empty($cart['Product'])) foreach($cart['Product'] as $item): ?>

		<div class="cart-item">
			<div style="float:left;"><? echo $item['name']; ?></div> 
			<div style="float:right;">Брой:
				<span><? echo $item['cart_quantity']; ?>x[<? echo $item['price']; ?> лв.]</span>
			</div>
		</div>

 <? endforeach;?> 

 <? if(empty($cart['Product'])): ?>
  <div class="ui-font-smaller"> Няма продукти в количката </div>
 <? endif; ?>
 <div id="summary">Общо: <? echo $cart['total']; ?> лв.</div>  
 <span>*Цените са с включено ДДС</span>  
 <input type="button" name="order-cart-button" value="Поръчай">  
 </div>
</div>