<?php echo $this->Session->flash(); ?>
<div class="orders index">
	<h2><?php __('Orders');?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('N', 'id');?></th>
			
			<th><?php echo $this->Paginator->sort('Тип акаунт', 'user_role');?></th>
			<th><?php echo $this->Paginator->sort('email');?></th>
			<th><?php echo $this->Paginator->sort('Име', 'name');?></th>
			
			<th><?php echo $this->Paginator->sort('Адрес за доставка', 'delivery_address');?></th>
			<th><?php echo $this->Paginator->sort('Телефон', 'phone');?></th>
			
			<th><?php echo $this->Paginator->sort('Статус', 'status');?></th>
			
			
			
			
			<th><?php echo $this->Paginator->sort('Сума', 'total_sum');?></th>
			<th><?php echo $this->Paginator->sort('Плащане', 'payment');?></th>
			<th><?php echo $this->Paginator->sort('Създадена', 'created');?></th>

			<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
	$i = 0;
	foreach ($orders as $order):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
	<tr<?php echo $class;?>>
		<td><?php echo $order['Order']['id']; ?>&nbsp;</td>
		<td><?php echo $html->userRole($order['Order']['user_role']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($order['User']['email'], array('controller' => 'users', 'action' => 'view', $order['User']['id'])); ?>
		</td>

		<td><?php echo $order['Order']['name']; ?>&nbsp;</td>
		
		<td>
			<?php 
				if (strlen($order['Order']['delivery_address']) > 8) {
					echo substr($order['Order']['delivery_address'], 0, 7); 
				} else {
					echo $order['Order']['delivery_address'];
				}
			?>
			&nbsp;
		</td>
		<td><?php echo $order['Order']['phone']; ?>&nbsp;</td>
		
		<td><?php echo $html->orderStatus($order['Order']['status']); ?>&nbsp;</td>
		
		
		
		
		<td><?php echo $order['Order']['total_sum']; ?>&nbsp;</td>
		<td><?php echo $html->orderPayment($order['Order']['payment']); ?>&nbsp;</td>
		<td><?php echo $order['Order']['created']; ?>&nbsp;</td>

		<td class="actions">
			<?php echo $this->Html->link(__('View', true), array('action' => 'view', $order['Order']['id'])); ?>
			<?php echo $this->Html->link(__('Edit', true), array('action' => 'edit', $order['Order']['id'])); ?>
		</td>
	</tr>
<?php endforeach; ?>
	</table>
	<p>
	<?php
	echo $this->Paginator->counter(array(
	'format' => __('Page %page% of %pages%, showing %current% records out of %count% total, starting on record %start%, ending on %end%', true)
	));
	?>	</p>

	<div class="paging">
		<?php echo $this->Paginator->prev('<< ' . __('previous', true), array(), null, array('class'=>'disabled'));?>
	 | 	<?php echo $this->Paginator->numbers();?>
 |
		<?php echo $this->Paginator->next(__('next', true) . ' >>', array(), null, array('class' => 'disabled'));?>
	</div>
</div>

<p>
	Легенда на статусите:
</p>
<ol>
	<li><?php echo $html->orderStatus('pending'); ?></li>
	<li><?php echo $html->orderStatus('processing'); ?></li>
	<li><?php echo $html->orderStatus('sent'); ?></li>
	<li><?php echo $html->orderStatus('rejected'); ?></li>
	<li><?php echo $html->orderStatus('canceled'); ?></li>
	<li><?php echo $html->orderStatus('returned'); ?></li>
</ol>