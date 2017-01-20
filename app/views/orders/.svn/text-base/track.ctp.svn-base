<? echo $this->Session->flash(); ?>
<?
	echo $form->create('Order');
	echo $form->input('track_hash', array('label' => 'Код на поръчка') );
	echo $form->end('Проследи');
?>
<? if (isset($order)): ?>
<?
			switch($order['Order']['status']) {
				case 'pending':
					$order['Order']['status'] = 'Изчакване';
					break;
				case 'sent':
					$order['Order']['status'] = 'Изпратена';
					break;
				case 'rejected':
					$order['Order']['status'] = 'Отказана';
					break;
				case 'canceled':
					$order['Order']['status'] = 'Анулирана';
					break;
				case 'returned':
					$order['Order']['status'] = 'Върната';
					break;
				default:
					break;
			}
?>
<h3>Проследяване на поръчка</h3>
<table>
	<tr>
		<td>Код</td>
		<td><? echo $order['Order']['track_hash']; ?></td>
	</tr>
	<tr>
		<td>Номер</td>
		<td><? echo $order['Order']['id']; ?></td>
	</tr>	

	<tr>
		<td>Статус</td>
		<td><? echo $order['Order']['status']; ?></td>
	</tr>
	<tr>
		<td>Допълнителна информация от Опи</td>
		<td><? echo $order['Order']['track_info']; ?></td>
	</tr>
	
</table>

<? endif; ?>