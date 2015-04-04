<div class="groups view">
<h2><?php echo __('Group'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($group['Group']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Title'); ?></dt>
		<dd>
			<?php echo h($group['Group']['title']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Group'), array('action' => 'edit', $group['Group']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Group'), array('action' => 'delete', $group['Group']['id']), array(), __('Are you sure you want to delete # %s?', $group['Group']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Groups'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Group'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Notebooks'), array('controller' => 'notebooks', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Notebook'), array('controller' => 'notebooks', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php echo __('Related Notebooks'); ?></h3>
	<?php if (!empty($group['Notebook'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Title'); ?></th>
		<th><?php echo __('Color'); ?></th>
		<th><?php echo __('Group Id'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($group['Notebook'] as $notebook): ?>
		<tr>
			<td><?php echo $notebook['id']; ?></td>
			<td><?php echo $notebook['title']; ?></td>
			<td><?php echo $notebook['color']; ?></td>
			<td><?php echo $notebook['group_id']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'notebooks', 'action' => 'view', $notebook['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'notebooks', 'action' => 'edit', $notebook['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'notebooks', 'action' => 'delete', $notebook['id']), array(), __('Are you sure you want to delete # %s?', $notebook['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Notebook'), array('controller' => 'notebooks', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
