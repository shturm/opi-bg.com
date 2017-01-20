<?php 
	if(isset($user)) {
		$role = $user['User']['role'];
	} else $role = 'unregistered';
?>
<?php 
	foreach($products as $p): 
	//debug($p);
	
?>
<? if (isset($caller) && $caller == 'group') {
	$p['Product']['name'] = $p['name'];
	$p['Product']['id'] = $p['id'];
	$p['Product']['price'] = $p['price'];
        $p['Product']['is_pro'] = $p['is_pro'];
        $p['Product']['image_thumb'] = $p['image_thumb'];
}
//if($role != 'admin' && $role != 'vendor' && $p['Product']['is_pro'] == true) continue;
?>
 <div class="product-list-item">
	<? if(!empty($p['Product']['image_thumb'])) 
             echo $html->image('/'.$p['Product']['image_thumb'], array('url' => array('controller' => 'products', 'action' => 'view', $p['Product']['id']) ) );
           else
             echo $html->image('/images/no_image_.png', array('url' => array('controller' => 'products', 'action' => 'view', $p['Product']['id']) ) );
        ?>
  <div class="product-list-title" style="font-weight: bold;"><? echo $html->link($p['Product']['name'], '/products/view/' . $p['Product']['id']); ?></div>
  <div><span>Група:</span> <? echo $html->link($p['Group']['name'], '/groups/view/' . $p['Group']['id']); ?></div>
  <div><span>Код:</span> <? echo $p['Product']['code']; ?></div>

  <div><span>Цена:</span> 
   <?php echo $p['Product']['price']; ?> 
  лв.</div>
  <div><label>Брой</label>
  <input type="hidden" name="buy-id" value="<? echo $p['Product']['id'];?>">
  <input type="text" name="buy-count" size="3" value="1">
  <input type="button" name="buy-button" value="Купи"></div>
 </div>
 <? endforeach; ?>
