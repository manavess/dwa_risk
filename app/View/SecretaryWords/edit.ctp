<?php $this->TinyMCE->editor(array('theme' => 'advanced', 'mode' => 'textareas'));?>
<div class="secretaryWords form">
<?php  echo $this->Html->addCrumb("Secretary's Word", '/SecretaryWords'); ?>
<?php echo $this->Form->create('SecretaryWord'); ?>
	<fieldset>
		<legend><?php echo __('Edit Secretary Words'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('secretary_word',array('required'=>'false'));
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php //echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('SecretaryWord.id')), null, __('Are you sure you want to delete # %s?', $this->Form->value('SecretaryWord.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Secretary Words'), array('action' => 'index')); ?></li>
	</ul>
</div>
