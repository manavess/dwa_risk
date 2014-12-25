<?php $this->TinyMCE->editor(array('theme' => 'advanced', 'mode' => 'textareas'));?>
<div class="missions form">
<?php  echo $this->Html->addCrumb('Mission', '/Missions'); ?>
<?php echo $this->Form->create('Mission'); ?>
	<fieldset>
		<legend><?php echo __('Edit Mission'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('mission', array('required'=>false));
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php //echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('Mission.id')), null, __('Are you sure you want to delete # %s?', $this->Form->value('Mission.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Missions'), array('action' => 'index')); ?></li>
	</ul>
</div>
