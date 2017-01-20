<div class="selled-products">
 <div class="viewer">
 <div class="content-conveyor ui-helper-clearfix">
	<? if(isset($products) && !empty($products)): ?>
		<? foreach($products as $p): ?>
            <div class="similar-cont">
                <? 
				echo $html->image('/'.$p['Product']['image_thumb'], array('url' => array(						
							'controller' => 'products', 
							'action' => 'view', 
							$p['Product']['id']
						)
						
					) 
				); 
				?>
            </div>
		<? endforeach; ?>
	<? endif; ?>
 </div>
 </div>
 <div id="slider"></div>
</div>