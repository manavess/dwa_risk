<div class="contactForms form">
<?php echo $this->Form->create('ContactForm'); ?>
	<fieldset>
		<legend><?php echo __('Add ContactForm'); ?></legend>
	<?php
		echo $this->Form->input('name');
		echo $this->Form->input('email_id', array('type'=>'text'));
		echo $this->Form->input('contact_no');
		echo $this->Form->input('subject');
		echo $this->Form->input('comments');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
<?php echo $this->Form->end(__('Reset')); ?>
</div>