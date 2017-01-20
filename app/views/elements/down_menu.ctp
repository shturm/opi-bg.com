   <div id="lower-menu">
    <ul>
    
<?php
foreach($down_menu_items as $dmi):
?>
      <li>
	  <div class="lower-item"><?php echo $html->image('/'.$dmi['DownMenuItem']['image'], array('url' => $dmi['DownMenuItem']['link']) );?></div>
	  <div class="hover-blob">
            <div><?php echo $dmi['DownMenuItem']['name']; ?></div>
	  </div>
	 </li>
<?php endforeach; ?>
    </ul>
   </div>