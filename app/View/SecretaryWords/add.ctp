<?php $this->TinyMCE->editor(array('theme' => 'advanced', 'mode' => 'textareas'));?>
<div class="secretaryWords form">
<?php  echo $this->Html->addCrumb("Secretary's Word", '/SecretaryWords'); ?>
<?php echo $this->Form->create('SecretaryWord'); ?>
	<fieldset>
		<legend><?php echo __('Add Secretary Word'); ?></legend>
	<?php
		echo $this->Form->input('secretary_word',array('required'=>'false'));
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Secretary Words'), array('action' => 'index')); ?></li>
	</ul>
</div>
