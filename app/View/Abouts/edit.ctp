<?php $this->TinyMCE->editor(array('theme' => 'advanced', 'mode' => 'textareas'));?>
<?php echo $this->Html->addCrumb('About us', '/Abouts');?>
<div class="abouts form">
<?php echo $this->Form->create('About'); ?>
	<fieldset>
		<legend><?php echo __('Edit About Us'); ?></legend>
	<?php
		echo $this->Form->input('pagetext',array('required'=>'false'));
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php //echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('About.id')), null, __('Are you sure you want to delete # %s?', $this->Form->value('About.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Abouts'), array('action' => 'index')); ?></li>
	</ul>
</div>
