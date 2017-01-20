Здравейте,

Уведомяваме ви, че статуса на поръчката ви е обновен. За да видите статуса на поръчката си посетете следния линк:
<?php echo $html->link('Данни за поръчка', array('admin' => false, 'controller' => 'orders', 'action' => 'track', $order['Order']['track_hash'])); ?>

Ако имате регистриран акаунт в opi-bg.com можете да видите <?php echo $html->link('пълните данни за вашата поръчка', array('admin' => false, 'controller' => 'orders', 'action' => 'view', $order['Order']['track_hash']));?>, както и <?php echo $html->link('списък със всички ваши текущи и отминали поръчки', array('admin' => false, 'controller' => 'users', 'myorders' => 'view', $order['Order']['track_hash']));?>

Приятен ден,
opi-bg.com
