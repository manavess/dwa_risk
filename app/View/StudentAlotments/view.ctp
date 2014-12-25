<div class="studentAlotments view">
<?php  echo $this->Html->addCrumb("Student Alotment", '/StudentAlotments'); ?>
<h2><?php  echo __('Student Alotment'); ?></h2>
	<dl>
		<dt><?php echo __('Student Registration'); ?></dt>
		<dd>
			<?php echo $this->Html->link($studentAlotment['StudentRegistration']['id'], array('controller' => 'student_registrations', 'action' => 'view', $studentAlotment['StudentRegistration']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('College Group Subject'); ?></dt>
		<dd>
			<?php //echo $this->Html->link($studentAlotment['CollegeGroupSubject']['id'], array('controller' => 'college_group_subjects', 'action' => 'view', $studentAlotment['CollegeGroupSubject']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Grade'); ?></dt>
		<dd>
			<?php echo $studentAlotment['StudentAlotment']['grade']; ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Allocation Year'); ?></dt>
		<dd>
			<?php echo $studentAlotment['StudentAlotment']['allocation_year']; ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo date('d-m-Y',strtotime($studentAlotment['StudentAlotment']['created'])); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Student Alotment'), array('action' => 'edit', $studentAlotment['StudentAlotment']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Student Alotment'), array('action' => 'delete', $studentAlotment['StudentAlotment']['id']), null, __('Are you sure you want to delete # %s?', $studentAlotment['StudentAlotment']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Student Alotments'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Student Alotment'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Student Registrations'), array('controller' => 'student_registrations', 'action' => 'index')); ?> </li>
		<li><?php //echo $this->Html->link(__('New Student Registration'), array('controller' => 'student_registrations', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List College Group Subjects'), array('controller' => 'college_group_subjects', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New College Group Subject'), array('controller' => 'college_group_subjects', 'action' => 'add')); ?> </li>
	</ul>
</div>
