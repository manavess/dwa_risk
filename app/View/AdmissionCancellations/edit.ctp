<div class="admissionCancellations form">
<?php echo $this->Html->addCrumb('Admission Cancellation', '/AdmissionCancellations');?>
<?php echo $this->Form->create('AdmissionCancellation'); ?>
	<fieldset>
		<legend><?php echo __('Edit Admission Cancellation'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('student_registration_id');
		echo $this->Form->input('remarks');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('AdmissionCancellation.id')), null, __('Are you sure you want to delete # %s?', $this->Form->value('AdmissionCancellation.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Admission Cancellations'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Student Registrations'), array('controller' => 'student_registrations', 'action' => 'index')); ?> </li>
		<li><?php //echo $this->Html->link(__('New Student Registration'), array('controller' => 'student_registrations', 'action' => 'add')); ?> </li>
	</ul>
</div>
