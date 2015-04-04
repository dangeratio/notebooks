<div class="groups form">
<?php echo $this->Form->create('Group'); ?>
	<fieldset>
		<legend><?php echo __('Add Group'); ?></legend>
	<?php
		echo $this->Form->input('title');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Groups'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Notebooks'), array('controller' => 'notebooks', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Notebook'), array('controller' => 'notebooks', 'action' => 'add')); ?> </li>
	</ul>
</div>
