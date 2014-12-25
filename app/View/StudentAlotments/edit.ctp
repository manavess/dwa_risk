<div class="studentAlotments form">
<?php  echo $this->Html->addCrumb("Student Alotment", '/StudentAlotments'); ?>
<?php echo $this->Form->create('StudentAlotment'); ?>
	<fieldset>
		<legend><?php echo __('Edit Student Alotment'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('student_registration_id');
		echo $this->Form->input('college_group_subject_id');
		echo $this->Form->input('grade');
		echo $this->Form->input('allocation_year');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('StudentAlotment.id')), null, __('Are you sure you want to delete # %s?', $this->Form->value('StudentAlotment.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Student Alotments'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Student Registrations'), array('controller' => 'student_registrations', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Student Registration'), array('controller' => 'student_registrations', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List College Group Subjects'), array('controller' => 'college_group_subjects', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New College Group Subject'), array('controller' => 'college_group_subjects', 'action' => 'add')); ?> </li>
	</ul>
</div>
