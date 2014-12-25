<?php $this->TinyMCE->editor(array('theme' => 'advanced', 'mode' => 'textareas'));?>
<div class="loginPages form">
<?php echo $this->Form->create('LoginPage'); ?>
	<fieldset>
		<legend><?php echo __('Add Login Page'); ?></legend>
	<?php
		echo $this->Form->input('pagetext', array('required'=>false));
		
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Login Pages'), array('action' => 'index')); ?></li>
	</ul>
</div>
