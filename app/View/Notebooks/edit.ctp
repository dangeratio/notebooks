<div class="notebooks form">
<?php echo $this->Form->create('Notebook'); ?>
	<fieldset>
		<legend><?php echo __('Edit Notebook'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('title');
		echo $this->Form->input('color');
		echo $this->Form->input('group_id');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Cancel'), array('controller' => 'notebooks', 'action' => 'dashboard')); ?> </li>
	</ul>
</div>
