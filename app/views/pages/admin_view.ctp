<div id="admin-container">
<div class="admin-actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Page', true), array('action' => 'edit', $page['Page']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('Delete Page', true), array('action' => 'delete', $page['Page']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $page['Page']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Pages', true), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Page', true), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Pages', true), array('controller' => 'pages', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Parent Page', true), array('controller' => 'pages', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="pages view">
<h2><?php  __('Page');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $page['Page']['id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Name'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $page['Page']['name']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Short'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $page['Page']['short']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Latin'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $page['Page']['latin']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Body'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $page['Page']['body']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Position'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $page['Page']['position']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Is Presentation'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $page['Page']['is_presentation']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Is Service'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $page['Page']['is_service']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Is Active'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $page['Page']['is_active']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Parent Page'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $this->Html->link($page['ParentPage']['name'], array('controller' => 'pages', 'action' => 'view', $page['ParentPage']['id'])); ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Lft'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $page['Page']['lft']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Rght'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $page['Page']['rght']; ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="admin-actions">
                <h3><?php __('Related Pages actions');?></h3>
		<ul>
			<li><?php echo $this->Html->link(__('New Child Page', true), array('controller' => 'pages', 'action' => 'add'));?> </li>
		</ul>
	</div>
<div class="related">
	<h3><?php __('Related Pages');?></h3>
	
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php __('Id'); ?></th>
		<th><?php __('Name'); ?></th>
		<th><?php __('Short'); ?></th>
		<th><?php __('Latin'); ?></th>
		<th><?php __('Body'); ?></th>
		<th><?php __('Position'); ?></th>
		<th><?php __('Is Presentation'); ?></th>
		<th><?php __('Is Service'); ?></th>
		<th><?php __('Is Active'); ?></th>
		<th><?php __('Parent Id'); ?></th>
		<th><?php __('Lft'); ?></th>
		<th><?php __('Rght'); ?></th>
		<th class="actions"><?php __('Actions');?></th>
	</tr>
        <?php if (!empty($page['ChildPage'])):?>
	<?php
		$i = 0;
		foreach ($page['ChildPage'] as $childPage):
			$class = null;
			if ($i++ % 2 == 0) {
				$class = ' class="altrow"';
			}
		?>
		<tr<?php echo $class;?>>
			<td><?php echo $childPage['id'];?></td>
			<td><?php echo $childPage['name'];?></td>
			<td><?php echo $childPage['short'];?></td>
			<td><?php echo $childPage['latin'];?></td>
			<td><?php echo $childPage['body'];?></td>
			<td><?php echo $childPage['position'];?></td>
			<td><?php echo $childPage['is_presentation'];?></td>
			<td><?php echo $childPage['is_service'];?></td>
			<td><?php echo $childPage['is_active'];?></td>
			<td><?php echo $childPage['parent_id'];?></td>
			<td><?php echo $childPage['lft'];?></td>
			<td><?php echo $childPage['rght'];?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View', true), array('controller' => 'pages', 'action' => 'view', $childPage['id'])); ?>
				<?php echo $this->Html->link(__('Edit', true), array('controller' => 'pages', 'action' => 'edit', $childPage['id'])); ?>
				<?php echo $this->Html->link(__('Delete', true), array('controller' => 'pages', 'action' => 'delete', $childPage['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $childPage['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>

<?php endif; ?>
	</table>

</div>
</div>