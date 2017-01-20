<div id="product-information" class="rounded">
   <div id="image-column">
        <div id="full-image">
         <? 
          if (!empty($product['Product']['image_full']))
	  {
           list($width_orig, $height_orig, $type, $attr) = getimagesize($product['Product']['image_full']);
           $center = (365 - $width_orig)/2;
	   if($center<0) $center = 0;
           echo $html->image('/'.$product['Product']['image_full'],array("style"=>"margin-left:".$center."px")); 
          }else 
             { 
              echo $html->image('/images/no_image_full.png',array("style"=>"margin-left:75px")); 
             }
        ?>
        </div>
   </div>
<div id="information-column" style="color:black;">        
<h2 class="ui-palatino" style="color:black;"><? echo $product['Product']['name']?></h2>
<? echo $product['Product']['description']; ?>
<table style="background:none;margin-top:20px" class="no-border-table" >
	<tr>
		<td class="bottom-border">Код: </td>
		<td style="font-weight:bold;"><? echo $product['Product']['code']; ?></td>
	</tr>
	<tr>
		<td class="bottom-border">Група: </td>
		<td style="font-weight:bold;"><? echo $html->link($product['Group']['name'], '/groups/view/' .$product['Group']['id']) ; ?></td>
	</tr>
	<tr>
		<td class="bottom-border">Цена: </td>
		<td style="font-weight:bold;"><? echo $product['Product']['price']; ?> лв.</td>
		<td><ins></ins></td>
	</tr>
</table>
<div id="buy-information">
 <div>
  Брой: <input type="text" name="buy-count" size="2" value="1">
  <input type="hidden" name="buy-id" value="<? echo $product['Product']['id']?>">
  <input type="button" name="buy-button" value="Купи">
 </div>
</div>
	<?php //echo $this->element('featured_products_h_scroll', array('products' => $similar) ); ?>
	<?php echo $this->element('featured_products_horizontal', 
						array('products' => $similar, 
								'headline' => 'Подобни продукти')); ?>

</div>
</div>
<? //debug($user); ?>