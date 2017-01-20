<?
// if (isset($user)) debug($user);
//debug($this->Session->read());
// debug($this->Session->read('Auth'));
echo $this->Session->flash();
echo $this->Session->flash('auth');
?>


<div id="user-profile-container" class="center-container">
 <div id="big-nav"> 
  <div><div id="user-profile" class="ui-transparent rounded">
    <h3>Моят Профил</h3>
  </div>
  
  <div id="user-actions" class="ui-transparent rounded">
  <div><?php echo $html->link('Моите поръчки', array('admin' => false, 'controller' => 'users', 'action' => 'myorders') ); ?></div>
  <div><?php echo $html->link('Настройки на профила', array('admin' => false, 'controller' => 'users', 'action' => 'change') ); ?></div>
  <div><?php echo $html->link('Смяна на парола', array('admin' => false, 'controller' => 'users', 'action' => 'changepassword') ); ?></div>
  <div><?php echo $html->link('Изход', array('admin' => false, 'controller' => 'users', 'action' => 'logout') ); ?></div>
  </div>
  </div>
 
 </div>
 
 <div class="ui-dark-transparent rounded ui-white indented fixed-cont"><h3>Последни поръчки</h3></div>
 <? if(!empty($user['Order'])) echo $this->element('user_order_list', array('orders' => $user['Order'], 'limit' => 5)); ?>

 
</div>
