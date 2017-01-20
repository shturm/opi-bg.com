<!-- <div class="ui-dark-transparent ui-white-link ui-white ui-center-text">
<?php //echo $page['Page']['body']; ?>
</div>
<div class="ui-dark-transparent ui-white  ui-white-link ui-center-text">
<?php 
	//if(isset($page['Product']['id']))
	//echo $html->link('Към продукта', array('controller' => 'products', 'action' => 'view', $page['Product']['id']) ); 
	echo $this->Session->flash();
?>
</div> -->
<a style="display:block; width: 100%; height: 100%" href="http://opi-bg.com/products/view/<?php echo $page['Product']['id'];?>"><div style="display:block; width: 100%; height: 634px"></div></a>
