<div class="notes form">
<?php echo $this->Form->create('Note'); ?>
	<fieldset>
		<legend><?php echo __('Add Note'); ?></legend>
	<?php
		echo $this->Form->input('title');
		echo $this->Form->input('body');
		echo $this->Form->input('notebook_id');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Notes'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Notebooks'), array('controller' => 'notebooks', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Notebook'), array('controller' => 'notebooks', 'action' => 'add')); ?> </li>
	</ul>
</div>
