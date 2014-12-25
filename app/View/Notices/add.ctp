<?php $this->TinyMCE->editor(array('theme' => 'advanced', 'mode' => 'textareas'));?>
<div class="notices form">
<?php  echo $this->Html->addCrumb('Notice', '/Notices'); ?>
<?php echo $this->Form->create('Notice'); ?>
	<fieldset>
		<legend><?php echo __('Add Notice'); ?></legend>
	<?php
		echo $this->Form->input('notice', array('required'=>false));
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Notices'), array('action' => 'index')); ?></li>
	</ul>
</div>
