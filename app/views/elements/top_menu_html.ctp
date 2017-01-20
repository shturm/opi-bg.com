<div id="menu">
<ul>
	 <li class="level-0 closed"><? echo $html->link('Начало','/');?>
			<ul class="dropdown-menu" style="display: none; ">
				<li><? echo $html->link('Groups index','/groups');?></li>
				<li><? echo $html->link('Group view','/groups/view/1');?></li>
				<li><? echo $html->link('Cart index','/cart/index');?></li>
				<li><? echo $html->link('Products index','/products');?></li>
				<li><? echo $html->link('Products index_list','/products/index/view:list');?></li>
				<li><? echo $html->link('Products index_list_tiles','/products/index/view:list_tiles');?></li>
				<li><? echo $html->link('Product view','/products/view/5');?></li>
				<li><? echo $html->link('User login','/users/login');?></li>
				<li><? echo $html->link('User register','/users/register');?></li>
				<li><? echo $html->link('User register/shop','/users/register/shop');?></li>
				<li><? echo $html->link('User register/vendor','/users/register/vendor');?></li>
				<li><? echo $html->link('User index(profile)','/users/');?></li>
				<li><? echo $html->link('Order view','/orders/view/a87ff679a2f3e71d9181a67b7542122c');?></li>
				<li><? echo $html->link('Order track','/orders/track/a87ff679a2f3e71d9181a67b7542122c');?></li>
			</ul>
	 </li>
	 
	 <li class="level-0 closed">
		<? echo $html->link('Продукти', '/products');?>
			<ul class="dropdown-menu" style="display: none; ">
				<li><? echo $html->link('Всички','/products');?></li>
				<li><? echo $html->link('Лакове','/products/lacquers');?></li>
				<li><? echo $html->link('Колекции','/products/collections');?></li>
				<li><? echo $html->link('Промоции','/products/promotions');?></li>
				<li><? echo $html->link('Категории','/groups');?></li>
				<li><? echo $html->link('Категория 1','/groups/view/1');?></li>
				<li><? echo $html->link('Категория 2','/groups/view/2');?></li>
				<li><? echo $html->link('Категория 3','/groups/view/3');?></li>
				<li><? echo $html->link('Категория 4','/groups/view/5');?></li>
				<li><? echo $html->link('Категория 6','/groups/view/6');?></li>
			</ul>
	 </li>
	  <li class="level-0 closed">
		<? echo $html->link('Цветове', '/');?>
			<ul class="dropdown-menu" style="display: none; ">
				<li><? echo $html->link('Всички цветове','/colors');?></li>
				<li><? echo $html->link('Тексас','/');?></li>
				<li><? echo $html->link('Суис','/');?></li>
				<li><? echo $html->link('Хонг Конг','/');?></li>
				<li><? echo $html->link('Кати пери','/');?></li>
				<li><? echo $html->link('Серена Уилямс','/');?></li>
				<li><? echo $html->link('Femme De Cirgque','/');?></li>
				<li><? echo $html->link('Леки сенки','/');?></li>
				<li><? echo $html->link('Светли','/');?></li>
				<li><? echo $html->link('Дизайнерски серии','/');?></li>
			</ul>
	 </li>
	 
	 <li class="level-0 closed"><? echo $html->link('Опитай този цвят','/');?></li>
	<li class="level-0 closed"><? echo $html->link('Грижа за нокти','/');?>
		<ul class="dropdown-menu" style="display: none; ">
			<li><? echo $html->link('Класически основи','/');?>
				<ul class="dropdown-menu level-1" style="display: none; ">
					<li>Основи</li>
					<li>Основи</li>
					<li>Основи</li>
					<li>Основи</li>
					<li>Основи</li>
					<li>Основи</li>
					<li>Основи</li>
				</ul>
			</li>
			<li><? echo $html->link('Лакочистители','/');?></li>
			<li><? echo $html->link('Линия за нокти \'Завист\'','/');?></li>
			<li><? echo $html->link('Цялостни комплекти','/');?>
				<ul class="dropdown-menu level-1" style="display: none; ">
					<li>Комплект</li>
					<li>Комплект</li>
					<li>Комплект</li>
					<li>Комплект</li>
					<li>Комплект</li>
					<li>Комплект</li>
					<li>Комплект</li>
				</ul>		
			</li>
			<li><? echo $html->link('Бързо изсъхващи процедури','/');?>
				<ul class="dropdown-menu level-1" style="display: none; ">
					<li>Прецедура</li>
					<li>Прецедура</li>
					<li>Прецедура</li>
					<li>Прецедура</li>
					<li>Прецедура</li>
					<li>Прецедура</li>
					<li>Прецедура</li>
				</ul>
		
			</li>
		</ul>
	 </li>
	 <li class="level-0 closed"><? echo $html->link('Ръце/Крака','/');?>
		<ul class="dropdown-menu" style="display: none; ">
			<li>Avojuice крем</li>
			<li>Avojuice крем за тяло</li>
			<li>Колекция Авоплекс</li>
			<li>Маникюр от Опи</li>
			<li>Педикюр от Опи</li>
			<li>Маникюр/Педикюр</li>
			<li>Колекция за крака</li>
			<li>Сенки Аксиум</li>
		</ul>
	 </li>
	 <li class="level-0 closed"><? echo $html->link('Полезни практики','/');?>
		<ul class="dropdown-menu" style="display: none; ">
			<li>За нокти крем</li>
			<li>Модна прогноза</li>
		</ul>	
	 </li>
	 
	 <li class="level-0 closed"><? echo $html->link('За нас','/');?>
		<ul class="dropdown-menu" style="display: none; ">
			<li>За нас</li>
			<li>За компанията</li>
			<li>Интересуваме се</li>
			<li>Връщаме обратно</li>
			<li>Отклонение</li>
			<li>Кариери</li>
		</ul>
	 </li>
	 <li class="level-0 closed"><? echo $html->link('За професионалисти','/');?></li>
	<!--  <li class="level-0">
		<a href="/products/">Продукти</a>
		<div class="dropdown-menu" style="display: none; ">
		<ul>
			<li><a href="/products/view/1">Продукт 1</a></li>
			<li><a href="/products/view/2">Продукт 2</a></li>
			<li><a href="/products/view/3">Продукт 3</a></li>
		</ul>
                </div>
	 </li> -->

    </ul>

</div>