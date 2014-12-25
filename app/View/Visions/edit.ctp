<?php $this->TinyMCE->editor(array('theme' => 'advanced', 'mode' => 'textareas'));?>
<?php  echo $this->Html->addCrumb('Vision', '/Visions'); ?>
<div class="visions form">
<?php echo $this->Form->create('Vision'); ?>
	<fieldset>
		<legend><?php echo __('Edit Vision'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('vision', array('required'=>false));
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php //echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('Vision.id')), null, __('Are you sure you want to delete # %s?', $this->Form->value('Vision.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Visions'), array('action' => 'index')); ?></li>
	</ul>
</div>
