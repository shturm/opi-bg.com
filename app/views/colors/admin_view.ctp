<div id="admin-container">
<div class="admin-actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Color', true), array('action' => 'edit', $color['Color']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('Delete Color', true), array('action' => 'delete', $color['Color']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $color['Color']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Colors', true), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Color', true), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Color Groups', true), array('controller' => 'color_groups', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Color Group', true), array('controller' => 'color_groups', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Products', true), array('controller' => 'products', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Product', true), array('controller' => 'products', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="colors view">
<h2><?php  __('Color');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $color['Color']['id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Име'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $color['Color']['name']; ?>
			&nbsp;
		</dd>
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Картинка'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $html->image($color['Color']['swatch'], array('width' => '72px', 'height' => '72px') ); ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Цветова група'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $this->Html->link($color['ColorGroup']['name'], array('controller' => 'color_groups', 'action' => 'view', $color['ColorGroup']['id'])); ?>
			&nbsp;
		</dd>
	</dl>
</div>

<div class="related">
	<h3><?php __('Продукт с този цвят');?></h3>
        <table>
		<?php if (!empty($color['Product']['id'])):?>
			<tr>
				<td><?php echo $html->image('/'.$color['Product']['image_thumb'], array( 'url' => array('controller' => 'products', 'action' => 'view', $color['Product']['id'])) ); ?></td>
				<td><?php echo $html->link($color['Product']['name'], array('controller' => 'products', 'action' => 'view', $color['Product']['id']) ); ?></td>
			</tr>
		<?php endif;?>
		</table>
</table>
	
</div>
