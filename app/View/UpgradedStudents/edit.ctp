<div class="upgradedStudents form">
<?php echo $this->Form->create('UpgradedStudent'); ?>
	<fieldset>
		<legend><?php echo __('Edit Upgraded Student'); ?></legend>
	<?php
                echo $this->Form->input('id');
                echo $this->Form->input('application_number', array('type' => 'text', 'id' => 'application_num'));
		echo $this->Form->input('student_registration_id', array('label' => 'Applicant Name'));
		echo $this->Form->input('from_course_id', array('label' => 'Upgrade from Course'));
		echo $this->Form->input('to_course_id', array('label' => 'Upgrade to Course'));
		echo $this->Form->input('remarks');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php //echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('UpgradedStudent.id')), null, __('Are you sure you want to delete # %s?', $this->Form->value('UpgradedStudent.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Upgraded Students'), array('action' => 'index')); ?></li>
	</ul>
</div>
