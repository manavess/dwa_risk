<?php $this->TinyMCE->editor(array('theme' => 'advanced', 'mode' => 'textareas'));?>
<div class="directorWords form">
<?php echo $this->Html->addCrumb("Director's Word", '/DirectorWords');?>
<?php echo $this->Form->create('DirectorWord'); ?>
	<fieldset>
		<legend><?php echo __('Edit Director Words'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('director_word',array('required'=>'false'));
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php //echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('DirectorWord.id')), null, __('Are you sure you want to delete # %s?', $this->Form->value('DirectorWord.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Director Words'), array('action' => 'index')); ?></li>
	</ul>
</div>
