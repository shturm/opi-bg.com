	<? foreach($products as $p): ?>
	
	<tr>
		<td><? echo $html->link($p['Product']['name'],'/products/view/' . $p['Product']['id']); ?>
		<div class="product-desc-small">
			<? echo $p['Product']['description'];?>
		</div></td>
		<td class="t-center"><? echo $html->link($p['Group']['name'],'/groups/view/' . $p['Group']['id']); ?></td>
		<td class="t-center">
<?php echo $p['Product']['price']; ?>  лв.</td><td style="width: 100px;"><input type="text" name="buy-count" size="2" value="1">
  <input type="hidden" name="buy-id" value="<? echo $p['Product']['id'];?>">
  <input type="button" name="buy-button" value="Купи"></td>
	</tr>
	
	<? endforeach;?>