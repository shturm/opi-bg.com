   <? foreach($products as $p): ?>
<tr>
  <td class="product-view-img">
   <? if(!empty($p['Product']['image_thumb'])) 
         echo $html->image('/'.$p['Product']['image_thumb'], array('url' => array('controller' => 'products', 'action' => 'view', $p['Product']['id']) ) );
      else
         echo $html->image('/images/no_image_.png', array('url' => array('controller' => 'products', 'action' => 'view', $p['Product']['id']) ) );
   ?>
  </td>
      <td><? echo $html->link($p['Product']['name'], '/products/view/' . $p['Product']['id']);?>
      <div class="product-desc"><? echo $p['Product']['description']; ?></div>
      </td>		
      <td class="t-center"><? echo $html->link($p['Group']['name'], '/groups/view/' . $p['Group']['id']); ?></td>
      <td class="t-center">
<?php echo $p['Product']['price']; ?> лв.</td><td style="width: 100px;"><input type="text" name="buy-count" size="2" value="1">
      <input type="hidden" name="buy-id" value="<? echo $p['Product']['id'];?>">
      <input type="button" name="buy-button" value="&#1050;&#1091;&#1087;&#1080;"></td>
</tr>
   
   <? endforeach; ?>