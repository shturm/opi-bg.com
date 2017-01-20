<? //debug($this->params);
	?>
<div id="bread">

<? if(isset($view_selector)): ?>
     <div id="view-selector">
 	<label class="ui-font-arial" style="font-weight: bold;font-size: 10px;">Покажи като:</label>
        <select onChange="window.location= this.options[this.selectedIndex].value;">
        <? $view_type = $this->params['named']['view']; 
           $sort = $this->params['named']['sort'];
           $direction = $this->params['named']['direction'];
           $page = $this->Paginator->current();
           $link_param = "/page:$page";
          /*if(!empty($view_type))
           $link_param .= "/view:$view_type";*/
          if(!empty($sort)) 
           $link_param .= "/sort:$sort";
          if(!empty($direction))
           $link_param .= "/direction:$direction";
        ?>
  	<option>(Избери)</option> 
  	<option value="/products/<? echo $this->params['action']?><? echo $link_param ?>">Tiles</option>
	<option value="/products/<? echo $this->params['action']?><? echo $link_param ?>/view:list">Детайлно</option>
  	<option value="/products/<? echo $this->params['action']?><? echo $link_param ?>/view:list_tiles">Детайлно(с картинки)</option>
	</select>
	
     </div>
<? endif; ?>
     <div id="sort-selector">
 	<label class="ui-font-arial" style="font-weight: bold;font-size: 10px;">Сортирай по:</label>
      <select onChange="window.location= this.options[this.selectedIndex].value;">
  	<option>(Избери)</option> 
        <? 
           $view_type = $this->params['named']['view'];
           $controller = $this->params['controller'];
           if(isset($this->params['pass'][0]))
           	  $id = "/".$this->params['pass'][0];
           else 
           	  $id = "";
        ?>
  	<option value="/<? echo $controller; ?>/<? echo $this->params['action'].$id;?>/page:<?php echo $this->Paginator->current(); ?>/view:<? echo $view_type; ?>/sort:name/direction:asc">Име(възходящ)</option>
	<option value="/<? echo $controller; ?>/<? echo $this->params['action'].$id;?>/page:<?php echo $this->Paginator->current(); ?>/view:<? echo $view_type; ?>/sort:name/direction:desc">Име(низходящ)</option>
  	<option value="/<? echo $controller; ?>/<? echo $this->params['action'].$id;?>/page:<?php echo $this->Paginator->current(); ?>/view:<? echo $view_type; ?>/sort:price/direction:asc">Цена(възходящ)</option>
 	<option value="/<? echo $controller; ?>/<? echo $this->params['action'].$id;?>/page:<?php echo $this->Paginator->current(); ?>/view:<? echo $view_type; ?>/sort:price/direction:desc">Цена(низходящ)</option>
	<option value="/<? echo $controller; ?>/<? echo $this->params['action'].$id;?>/page:<?php echo $this->Paginator->current(); ?>/view:<? echo $view_type; ?>/sort:impressions/direction:asc">Брой Посещения(възходящ)</option>
        <option value="/<? echo $controller; ?>/<? echo $this->params['action'].$id;?>/page:<?php echo $this->Paginator->current(); ?>/view:<? echo $view_type; ?>/sort:impressions/direction:desc">Брой Посещения(низходящ)</option>
        <option value="/<? echo $controller; ?>/<? echo $this->params['action'].$id;?>/page:<?php echo $this->Paginator->current(); ?>/view:<? echo $view_type; ?>/sort:date_created/direction:asc">Дата(възходящ)</option>
        <option value="/<? echo $controller; ?>/<? echo $this->params['action'].$id;?>/page:<?php echo $this->Paginator->current(); ?>/view:<? echo $view_type; ?>/sort:date_created/direction:desc">Дата(низходящ)</option>
      </select>
	
     </div>
</div>