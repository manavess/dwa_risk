<div class="collegeGroupSubjects form">
<?php echo $this->Form->create('CollegeGroupSubject'); ?>
	<fieldset>
		<legend><?php echo __('Add College Group Subject'); ?></legend>
	<?php
		echo $this->Form->input('college_id');
		echo $this->Form->input('group_subjects_id');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List College Group Subjects'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Colleges'), array('controller' => 'colleges', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New College'), array('controller' => 'colleges', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Group Subjects'), array('controller' => 'group_subjects', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Group Subjects'), array('controller' => 'group_subjects', 'action' => 'add')); ?> </li>
	</ul>
</div>
