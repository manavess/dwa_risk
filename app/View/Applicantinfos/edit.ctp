<?php $this->TinyMCE->editor(array('theme' => 'advanced', 'mode' => 'textareas'));?>
<div class="applicantinfos form">
<?php echo $this->Html->addCrumb('Applicant info', '/Applicantinfos');?>
<?php echo $this->Form->create('Applicantinfo'); ?>
	<fieldset>
		<legend><?php echo __('Edit Applicantinfo'); ?></legend>
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

		<li><?php //echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('Applicantinfo.id')), null, __('Are you sure you want to delete # %s?', $this->Form->value('Applicantinfo.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Applicantinfos'), array('action' => 'index')); ?></li>
	</ul>
</div>
