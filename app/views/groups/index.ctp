<? foreach($groups as $g): ?>
	<? if($g['Group']['parent_id'] == 0): ?>
<div class="cat-list-view">
 <h2 class="ui-transparent ui-font ui-center-text ui-white-link"><? echo $html->link($g['Group']['name'], '/groups/view/' .$g['Group']['id'] );?></h2>
 <ul>
	<? if (count($g['ChildGroup']) > 0): foreach($g['ChildGroup'] as $cg): ?>
	<? if ($cg['is_active'] == true): ?>
		<li><? echo $html->link($cg['name'], '/groups/view/' .$cg['id'] );?></li>
	<? endif; ?>
   <? endforeach; endif;?> 
 </ul>
</div>
<? endif; endforeach; ?>

<? // debug($groups); ?>