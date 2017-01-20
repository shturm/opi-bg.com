Здравейте,

Вашата поръчка е успешно създадена. Можете да следите нейният актуален статус на линка:
<?php echo $html->link('Следене на статуса на поръчката', array('admin' => false, 'controller' => 'orders', 'action' => 'track', $order['Order']['track_hash'])); ?>

Ако сте направили поръчката с регистриран акаунт можете да видите <?php echo $html->link('пълната информация за поръчката си', array('admin' => false, 'controller' => 'orders', 'action' => 'view', $order['Order']['track_hash'])); ?>, както и да видите <?php echo $html->link('история на всички ваши поръчки, направени от акаунта.', array('admin' => false, 'controller' => 'orders', 'action' => 'view', $order['Order']['track_hash'])); ?>

Поздрави,
opi-bg.com