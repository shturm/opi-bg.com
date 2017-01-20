<!doctype html>
<html>
 <head>
  <title>Opi</title>
  <?php
	// meta stuff
	if(!isset($keywords_for_layout) || empty($keywords_for_layout)) $keywords_for_layout = 'Опи, Opi, лак, лак за нокти, лакове за нокти, козметика, колекции лакове';
  ?>
  <meta name="description" content="ОПИ лакове България, уеб магазин, последни колекции лакове и козметика" />
  <meta name="keywords" content="<?php echo $keywords_for_layout; ?>" />
  <meta name="author" content="Hege Refsnes" />
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" >
  <?php echo $scripts_for_layout; ?>
  <?php
	 //      echo $html->script('jquery-1.5.2.min');
  //       echo $html->script('jquery-ui-1.8.14.custom.min');
  //       echo $html->script('tiny_mce/tiny_mce.js');
	 //      echo $html->script('UI-Core-Menu');
  //       echo $html->script('UI-Core-Tabs');
  //       echo $html->script('UI-Core-Cart');
  //       echo $html->script('Core');
  //       echo $html->script('scrollbar');
      	echo $html->script('app.min');
      	echo $html->css('/css/global');
  ?>
   <!--[if IE 7]>
      <?php echo $html->css('/css/global-ie7','stylesheet', array('inline' => true ));?>
   <![endif]-->
   <!--[if IE 8]>
   <?php echo $html->css('/css/global-ie8','stylesheet', array('inline' => true ));?>
    </style>
     <![endif]-->

    
   <style type="text/css" >
    #main-container
    {	<? if(!empty($background_for_layout)): ?>
		background-image:url('<?php echo $background_for_layout; ?>');
		<? endif; ?>
		background-color: white;
    }
  </style>
 </head>
<body>
<div id="main-container">
  <!-- Navigation -->
   <div id="inner-header">
   <div id="outer-header">
    <a href="/"><div id="logo"></div></a>
<?php echo $this->element('top_user_menu'); ?>
<?php echo $this->element('top_search_bar'); ?>
<?php echo $this->element('top_cart', array('cart' => $cart)); ?>
</div>
<?php echo $this->element('top_menu', array('items' => $top_menu) ); ?>
   </div>
   <!-- End Navigation -->
   
    
   
   <!-- Main Content-->
   <div id="content">
     <div id="main-content">
		<?php echo $content_for_layout; ?>
		<?php //echo phpinfo(); ?>
		
   </div>
     <!-- Side Tabs -->
<!--    <div id="inner-tabs">
   	<ul>
   	 <li>
   	   <div class="tab-text">LABEL</div>
   	  	 <div class="tab-content">
   	  	  <div class="circle-close"></div>
   	  	  CONTENT
   	  	 </div>
   	  </li>
	  
	    	 <li>
   	   <div class="tab-text">LABEL</div>
   	  	 <div class="tab-content">
   	  	  <div class="circle-close"></div>
   	  	  CONTENT
   	  	 </div>
   	  </li>
	  
	    	 <li>
   	   <div class="tab-text">LABEL</div>
   	  	 <div class="tab-content">
   	  	  <div class="circle-close"></div>
   	  	  CONTENT
   	  	 </div>
   	  </li>
   	 </ul>
</div> -->
<div class="close"><div>Затвори</div></div>
     <!--End of Side Tabs-->
   </div>
   <!-- End of Main Content -->
   
   
   <!-- Lower Menu -->
<?php echo $this->element('down_menu', array('down_menu_items' => $down_menu)); ?>
   
   <!-- Begin Footer -->
    <div id="nav-id"></div>
   <!-- End Footer -->
 </div>
<?php //echo $this->element('sql_dump'); ?>
</body>
</html>