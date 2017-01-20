<h2>Възстановяване на загубена парола</h2>
<!-- <img src='http://images.memegenerator.net/instances/500x/9414347.jpg'/> -->
<?	echo $this->Session->flash(); ?>
<p>Въведете имейла с който сте регистриран </p>
<?
	echo $form->create('User');
	echo $form->input('Email', array('label' => 'Email') );
	echo $form->end('Възстанови парола');
	//TODO: implement security - these actions should  be logged
?>