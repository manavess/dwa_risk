<?php $this->TinyMCE->editor(array('theme' => 'advanced', 'mode' => 'textareas'));?>
<?php echo $this->Html->addCrumb('Applicant info', '/Applicantinfos');?>
<div class="applicantinfos form">
<?php echo $this->Form->create('Applicantinfo'); ?>
	<fieldset>
		<legend><?php echo __('Add Applicantinfo'); ?></legend>
	<?php
		echo $this->Form->input('pagetext', array('required'=>false));
		
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Applicantinfos'), array('action' => 'index')); ?></li>
	</ul>
</div>
