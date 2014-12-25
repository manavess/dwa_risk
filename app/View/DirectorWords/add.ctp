<?php $this->TinyMCE->editor(array('theme' => 'advanced', 'mode' => 'textareas'));?>
<?php echo $this->Html->addCrumb("Director's Word", '/DirectorWords');?>
<div class="directorWords form">
<?php echo $this->Form->create('DirectorWord'); ?>
	<fieldset>
		<legend><?php echo __('Add Director Word'); ?></legend>
	<?php
		echo $this->Form->input('director_word',array('required'=>'false'));
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Director Words'), array('action' => 'index')); ?></li>
	</ul>
</div>
