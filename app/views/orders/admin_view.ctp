<div class="orders view">
<h2><?php  __('Order');?></h2>
<p style="size: 24px;">
<?php echo $html->link('РЕДАКЦИЯ', array('action' => 'edit', 'controller' => 'orders', $order['Order']['id'])); ?>
	</p>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $order['Order']['id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Потребител'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $this->Html->link($order['User']['email'], array('controller' => 'users', 'action' => 'view', $order['User']['id'])); ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Тип потребител'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $html->userRole($order['Order']['user_role']); ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Email'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $order['Order']['email']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Издаване на фактура'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php if($order['Order']['invoice_required'] == 1) echo 'Да'; else echo 'Не'; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Лице за контакт'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $order['Order']['name']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Адрес за контакт'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $order['Order']['address']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Адрес за доставка'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $order['Order']['delivery_address']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Телефон'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $order['Order']['phone']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Ip на поръчка'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $order['Order']['ip_of_order']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Статус'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $html->orderStatus($order['Order']['status']); ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Допълнителна ифнормация(от потребителя)'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $order['Order']['user_info']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Допълнителна информация(от администратор)'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $order['Order']['track_info']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Код'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $order['Order']['track_hash']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Обща сума за плащане'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $order['Order']['total_sum']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Тип плащане'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $html->orderPayment($order['Order']['payment']); ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Създадена'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $order['Order']['created']; ?>
			&nbsp;
		</dd>
	</dl>
</div>

<div class="related">
	<h3><?php __('В тази поръчка: ');?></h3>
	<?php if (!empty($order['OrderedProduct'])):?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>



		<th><?php __('Иконка'); ?></th>

		<th><?php __('Име'); ?></th>
		<th><?php __('Ед. Цена'); ?></th>
		<th><?php __('Брой'); ?></th>
		<th><?php __('Тип'); ?></th>
		<!-- <th><?php// __('Отстъпка (%)'); ?></th> -->
		<th><?php __('Приложена отстъпка'); ?></th>
		<th><?php __('Общо'); ?></th>

	</tr>
	<?php echo $html->link('РЕДАКЦИЯ', array('action' => 'edit', 'controller' => 'orders', $order['Order']['id'])); ?>
	<?php
		$i = 0;
		foreach ($order['OrderedProduct'] as $orderedProduct):
			$class = null;
			if ($i++ % 2 == 0) {
				$class = ' class="altrow"';
			}
		?>
		<tr<?php echo $class;?>>
			<?php //debug($orderedProduct); ?>
			<td><?php echo $html->image('/'.$orderedProduct['image_thumb'], array('url' => array('admin' => true, 'controller' => 'products', 'action' => 'view', $orderedProduct['product_id'])) );?></td>

			<td><?php echo $html->link($orderedProduct['name'], array('admin' => true, 'controller' => 'products', 'action' => 'view', $orderedProduct['product_id']) );?></td>
			<td><?php echo $orderedProduct['price'];?></td>
			<td><?php echo $orderedProduct['cart_quantity'];?></td>
			<td><?php echo $html->productType($orderedProduct['type']);?></td>
	<!-- 		<td><?php //echo $orderedProduct['discount'];?></td> -->
			<td><?php echo $orderedProduct['discount_text'];?></td>
			<td><?php echo $orderedProduct['subtotal'] . ' лв';?></td>
	

		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

<?php echo $html->link('РЕДАКЦИЯ', array('action' => 'edit', 'controller' => 'orders', $order['Order']['id'])); ?>
</div>
