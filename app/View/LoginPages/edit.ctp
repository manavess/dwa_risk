<?php $this->TinyMCE->editor(array('theme' => 'advanced', 'mode' => 'textareas'));?>
<div class="loginPages form">
<?php echo $this->Form->create('LoginPage'); ?>
	<fieldset>
		<legend><?php echo __('Edit Login Page'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('pagetext', array('required'=>false));
		
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php //echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('LoginPage.id')), null, __('Are you sure you want to delete # %s?', $this->Form->value('LoginPage.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Login Pages'), array('action' => 'index')); ?></li>
	</ul>
</div>
