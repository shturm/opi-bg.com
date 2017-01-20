<div id="menu">
<ul>
	 <li class="level-0"><? echo $html->link('Начало','/admin');?>
			<ul class="dropdown-menu" style="display: none; ">
				<li><? echo $html->link('Продукти', array('admin' => true, 'controller' => 'products', 'action' => 'index') );?></li>
				<li><? echo $html->link('Групи', array('admin' => true, 'controller' => 'groups', 'action' => 'index') );?></li>
				<li><? echo $html->link('Страници', array('admin' => true, 'controller' => 'pages', 'action' => 'index') );?></li>
				<li><? echo $html->link('Поръчки', array('admin' => true, 'controller' => 'orders', 'action' => 'index') );?></li>
				<li><? echo $html->link('Потребители', array('admin' => true, 'controller' => 'users', 'action' => 'index') );?></li>
				<li><? echo $html->link('Цветова', array('admin' => true, 'controller' => 'colors', 'action' => 'index') );?></li>
			</ul>
	 </li>
	 <li class="level-0"><? echo $html->link('Страници','/admin/pages');?>
			<ul class="dropdown-menu" style="display: none; ">
				<li><? echo $html->link('Всички', array('admin' => true, 'controller' => 'pages', 'action' => 'index') );?></li>
				<li><? echo $html->link('Начална страница', array('admin' => true, 'controller' => 'pages', 'action' => 'front_page') );?></li>
				<li><? echo $html->link('Добави нова', array('admin' => true, 'controller' => 'pages', 'action' => 'add') );?></li>
			</ul>
	 </li>
	 
	 <li class="level-0">
		<? echo $html->link('Продукти', '/admin/products');?>
			<ul class="dropdown-menu" style="display: none; ">
				<li><? echo $html->link('Всички', array('admin' => true, 'controller' => 'products', 'action' => 'index'));?></li>
				<li><? echo $html->link('Добави нов', array('admin' => true, 'controller' => 'products', 'action' => 'add'));?></li>
				<li><? echo $html->link('Лакове',array('admin' => true, 'controller' => 'products', 'action' => 'index', 'lacquer'));?></li>
				<li><? echo $html->link('Колекции',array('admin' => true, 'controller' => 'products', 'action' => 'index', 'collection'));?></li>
				<li><? echo $html->link('Промоции',array('admin' => true, 'controller' => 'products', 'action' => 'index', 'promotion'));?></li>
				<li><? echo $html->link('Групи',array('admin' => true, 'controller' => 'groups', 'action' => 'index'));?></li>
				<li><? echo $html->link('Добави група',array('admin' => true, 'controller' => 'groups', 'action' => 'add'));?></li>
			</ul>
	 </li>
	  <li class="level-0">
		<? echo $html->link('Топ меню', '/admin/top_menu_items');?>
			<ul class="dropdown-menu" style="display: none; ">
				<li><? echo $html->link('Всички',array('admin' => true, 'controller' => 'top_menu_items', 'action' => 'index'));?></li>
				<li><? echo $html->link('Добави нов',array('admin' => true, 'controller' => 'top_menu_items', 'action' => 'add'));?></li>
			</ul>
	 </li>
	  <li class="level-0">
		<? echo $html->link('Долно меню', '/admin/down_menu_items');?>
			<ul class="dropdown-menu" style="display: none; ">
				<li><? echo $html->link('Всички',array('admin' => true, 'controller' => 'down_menu_items', 'action' => 'index'));?></li>
				<li><? echo $html->link('Добави нов',array('admin' => true, 'controller' => 'down_menu_items', 'action' => 'add'));?></li>
			</ul>
	 </li>		  
	 <li class="level-0">
		<? echo $html->link('Потребители', '/admin/users');?>
			<ul class="dropdown-menu" style="display: none; ">
				<li><? echo $html->link('Всички',array('admin' => true, 'controller' => 'users', 'action' => 'index'));?></li>
				
				<li><? echo $html->link('Обикновени',array('admin' => true, 'controller' => 'users', 'action' => 'index', 'user'));?></li>
				<li><? echo $html->link('Магазини',array('admin' => true, 'controller' => 'users', 'action' => 'index', 'shop'));?></li>
				<li><? echo $html->link('Търговци/професионалисти',array('admin' => true, 'controller' => 'users', 'action' => 'index', 'vendor'));?></li>
				<li><? echo $html->link('Неактивни',array('admin' => true, 'controller' => 'users', 'action' => 'notactive'));?></li>
				<li><? echo $html->link('Непотвърдени',array('admin' => true, 'controller' => 'users', 'action' => 'notconfirmed'));?></li>

			</ul>
	 </li>	 
	 <li class="level-0">
		<? echo $html->link('Поръчки', '/admin/orders');?>
			<ul class="dropdown-menu" style="display: none; ">
				<li><?php echo $html->link('Всички',array('admin' => true, 'controller' => 'orders', 'action' => 'index'));?></li>
				<li><?php echo $html->link('Изчакващи',array('admin' => true, 'controller' => 'orders', 'action' => 'pending'));?></li>
				<li><?php echo $html->link('В обработка',array('admin' => true, 'controller' => 'orders', 'action' => 'processing'));?></li>
				<li><?php echo $html->link('Изпратени',array('admin' => true, 'controller' => 'orders', 'action' => 'sent'));?></li>
				<li><?php echo $html->link('Отказани (от админ)',array('admin' => true, 'controller' => 'orders', 'action' => 'rejected'));?></li>
				<li><?php echo $html->link('Анулирани (от поръчителя)',array('admin' => true, 'controller' => 'orders', 'action' => 'canceled'));?></li>
				<li><?php echo $html->link('Върнати (от поръчителя)',array('admin' => true, 'controller' => 'orders', 'action' => 'returned'));?></li>
			</ul>
	 </li>	 
	 
	<!--  <li class="level-0"><? //echo $html->link('','/');?></li> -->
	 

</ul>
</div>