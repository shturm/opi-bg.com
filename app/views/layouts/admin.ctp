<!doctype html>
<html>
 <head>
  <title>Opi</title>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" >
  <?php echo $scripts_for_layout; ?>
  <?php
	echo $html->script('jquery-1.5.2.min');
        echo $html->script('jquery-ui-1.8.14.custom.min');
        echo $html->script('tiny_mce/tiny_mce.js');
	echo $html->script('UI-Core-Menu');
        echo $html->script('UI-Core-Tabs');
        echo $html->script('UI-Core-Cart');
        echo $html->script('Core');
	echo $html->script('scrollbar');
	echo $html->css('/css/admin');
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
    {	
		background-color: gray;
    }
  </style>
 </head>
<body>
<div id="main-container">
  <!-- Navigation -->
   <div id="inner-header">
   <div id="outer-header">
    <div id="logo"></div>
<?php echo $this->element('top_user_menu'); ?>
<?php echo $this->element('top_search_bar'); ?>
<?php if(isset($this->params['prefix']) && $this->params['prefix'] == 'admin') {} else echo $this->element('top_cart', array('cart' => $cart)); ?>
</div>
<?php echo $this->element('admin_top_menu'); ?>
   </div>
   <!-- End Navigation -->
   
   
   
   <!-- Main Content-->
   <div id="content">
     <div id="main-content">
		<?php echo $content_for_layout; ?>
   </div>
     <!-- Side Tabs -->
 <!-- <div id="inner-tabs">
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
</div>
<div class="close"><div>Затвори</div></div> -->
     <!--End of Side Tabs-->
   </div>
   <!-- End of Main Content -->
   
   
   <!-- Lower Menu -->
 <!--   <div id="lower-menu">
    <ul>
    
      <li>
	  <div class="lower-item"></div>
	  <div class="hover-blob">
            <div>Lorem ipsumLorem ipsumLorem ipsum</div>
	  </div>
	 </li>
	 
	  <li>
	  <div class="lower-item"></div>
	  <div class="hover-blob">
             <div>Lorem ipsumLorem ipsumLorem ipsumipsumLorem</div>
	  </div>
	 </li>
	  <li>
	  <div class="lower-item"></div>
	  <div class="hover-blob">
            <div>Lorem ipsumLorem ipsumLorem ipsum</div>
	  </div>
	 </li>
	 
	  <li>
	  <div class="lower-item"></div>
	  <div class="hover-blob">
             <div>Lorem ipsumLorem ipsumLorem ipsumipsumLorem</div>
	  </div>
	 </li>
    </ul>
   </div> -->
   
   <!-- Begin Footer -->
    <div id="nav-id"></div>
   <!-- End Footer -->
 </div>

</body>
</html>