<?php $this->TinyMCE->editor(array('theme' => 'advanced', 'mode' => 'textareas'));?>
<div class="goals form">
<?php  echo $this->Html->addCrumb('Goal', '/Goals'); ?>
<?php echo $this->Form->create('Goal'); ?>
	<fieldset>
		<legend><?php echo __('Add Goal'); ?></legend>
	<?php
		echo $this->Form->input('goal', array('required'=>false));
		
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Goals'), array('action' => 'index')); ?></li>
	</ul>
</div>
