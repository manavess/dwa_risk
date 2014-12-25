<?php $this->TinyMCE->editor(array('theme' => 'advanced', 'mode' => 'textareas'));?>
<div class="ministerWords form">
<?php  echo $this->Html->addCrumb("Minister's Word", '/MinisterWords'); ?>
<?php echo $this->Form->create('MinisterWord'); ?>
	<fieldset>
		<legend><?php echo __('Add Minister Word'); ?></legend>
	<?php
		echo $this->Form->input('minister_word',array('required'=>'false'));
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Minister Words'), array('action' => 'index')); ?></li>
	</ul>
</div>
