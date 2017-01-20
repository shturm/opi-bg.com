<div class="colorGroups view">
<h2><?php  __('Color Group');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $colorGroup['ColorGroup']['id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Name'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $colorGroup['ColorGroup']['name']; ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Color Group', true), array('action' => 'edit', $colorGroup['ColorGroup']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('Delete Color Group', true), array('action' => 'delete', $colorGroup['ColorGroup']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $colorGroup['ColorGroup']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Color Groups', true), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Color Group', true), array('action' => 'add')); ?> </li>
	</ul>
</div>
