<div id="image-select" style="margin-left: 100px;">
 <div class="img-viewer">
 <div class="content-sl ui-helper-clearfix">
	<? if(isset($images)): ?>
		<? foreach($images as $i): ?>
            <div class="item-image">
                <? echo $html->image('/' . $i['path'], array('id' => $i['id'], 'width' => '64px', 'height' => '64px')); ?>
            </div>
		<? endforeach; ?>
	<? endif; ?>
 </div>
 </div>
 <div id="image-slider"></div>
</div>