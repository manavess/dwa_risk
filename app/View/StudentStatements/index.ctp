<?php echo $this->Html->script('jquery.js'); ?>
<?php  echo $this->Html->addCrumb("Student Statement", '/StudentStatements'); ?>
<div class="studentRegistrations form col4">
<h2><?php echo __('Student Admission Statement'); ?></h2>
</div>

<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('Student admission statement'), array('controller'=>'StudentStatements','action' => 'student_admisson_statement')); ?></li>
	</ul>
</div>
