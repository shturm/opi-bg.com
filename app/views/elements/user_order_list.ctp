 <div id="user-profile-content">
  <table id="p-table">
		<tr class="tr-th">
			<th>Номер</th>
			<th>Статус</th>
			<th>Сума</th>
			<th>Дата на поръчката</th>
		</tr>
<?php $counter = 0; ?>
<?	if(isset($orders) && !empty($orders)): foreach($orders as $o): ?>
		<? 	
			$counter++;
		?>
		<tr class="tr-bg">
			<td><? echo $html->link($o['id'], '/orders/view/' . $o['track_hash']); ?></td>
			<td><? echo $html->link($html->orderStatus($o['status'], false), '/orders/view/' . $o['track_hash'], null, null, false); ?></td>
			<td><? echo $html->link($o['total_sum'], '/orders/view/' . $o['track_hash']); ?></td>
			<td><? echo $html->link($o['date_created'], '/orders/view/' . $o['track_hash']); ?></td>
		</tr>
		
	<?php if(isset($limit) && $counter > $limit) break; endforeach; ?> 
<?php endif; ?>
	</table>
</div>