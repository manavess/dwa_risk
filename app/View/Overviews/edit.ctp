<?php $this->TinyMCE->editor(array('theme' => 'advanced', 'mode' => 'textareas'));?>
<div class="overviews form">
<?php  echo $this->Html->addCrumb('Overview', '/Overviews'); ?>
<?php echo $this->Form->create('Overview'); ?>
	<fieldset>
		<legend><?php echo __('Edit Overview'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('overview', array('required'=>false));
		
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php //echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('Overview.id')), null, __('Are you sure you want to delete # %s?', $this->Form->value('Overview.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Overviews'), array('action' => 'index')); ?></li>
	</ul>
</div>
