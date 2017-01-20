<?php echo $this->Session->flash(); ?>
<div class="center-container">
<h2>Количка</h2>
<div id="action-cart-bar">
  <div class="arrow_tr"></div><div class="steps" ><div>Продукти</div></div><div class="arrow"></div><div class="arrow3"></div>
  <div class="steps"  style="background-color:orange;background-image:none;"><div>Информация за доставката</div></div><div class="arrow2"></div>
  <div class="arrow_tr"></div><div class="steps"><div>Потвърждение</div></div><div class="arrow"></div>
</div>
<?php
	if(isset($user)) {
		$email = $user['User']['email'];
		$name = $user['User']['name'];
		$phone = $user['User']['phone'];
		$address = $user['User']['address'];
		$company = $user['User']['company'];
		$bulstat = $user['User']['bulstat'];
		$mol = $user['User']['mol'];
		$dds = $user['User']['dds'];
		$delivery_address = $user['User']['delivery_address'];
	} else {
		$email = '';
		$name = '';
		$phone = '';
		$address = '';
		$company = '';
		$bulstat = '';
		$mol = '';
		$dds = '';
		$delivery_address = '';
	}
?>
  <div id="cart-cont-inner">
  <?php echo $form->create('Order', array('url' => '/cart/step3'));  ?>
  <fieldset class="larger-fieldset">
  <p>Полетата със звездичка (*) са задължителни</p>
  <h4>Информация за поръчка</h4>
	<?php 
		
		echo $form->input('email', array('label' => 'Email*:', 'default' => $email));
		echo $form->input('name', array('label' => 'Име*:', 'default' => $name));
		echo $form->input('phone', array('label' => 'Телефон*:', 'default' => $phone));
		echo $form->input('address', array('label' => 'Адрес за контакт:', 'default' => $address));
		echo $form->input('invoice_required', array('label' => 'Желаете ли фактура:', 'options' => array(0 => 'Не', 1 => 'Да'), 'default' => 0));
		
	?>
	  <!-- <div id="invoice-info"> --><h4>Информация за фактура:</h4>
	     <?php echo $form->input('company', array('label' => 'Име на фирма', 'default' => $company)); ?>
	     <?php echo $form->input('bulstat', array('label' => 'Булстат', 'default' => $bulstat)); ?>
	     <?php echo $form->input('mol', array('label' => 'МОЛ', 'default' => $mol)); ?>
	     <?php echo $form->input('dds', array('label' => 'ДДС номер', 'default' => $dds)); ?>
     <!-- </div> -->

	 <h4>Информация на доставка:</h4>
	 <?
		echo $form->input('delivery_address', array('label' => 'Адрес за доставка*', 'default' => $delivery_address));
		echo $form->input('user_info', array('label' => 'Допълнителни указания', 'cols' => 60));
		$payment['onsite'] = 'Наложен платеж';
		
	 ?>

	 <div><?php echo $form->input('payment', array('label' => 'Метод на плащане', 'options' => $payment)); ?></div>

         
<div style="width: 100%;">
 <input type="button" onclick="window.location = '/cart/'" value="Назад" style="float: left; ">
 <?php echo $form->submit('Потвърждение',array('div' => array("style"=>"float:right;"))); ?>
</div>
  </fieldset>
<?php echo $form->end(); ?>
</div>

</div>