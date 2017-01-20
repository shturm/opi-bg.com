<div id="search-bar">
<?php 
	echo $form->create(false, array('url' => array('controller' => 'search', 'action' => 'search'), 'method' => 'post') );
	echo $form->input(null, array('div' => false,'label' => false));
	echo $form->end('Търси');
?>
<!-- <form method="POST" action="/search/search">
 <input name="search" type="text">
 <input type="submit" value="Търси">
</form> -->
</div>