<div class="collegeGroupSubjects view">
<h2><?php  echo __('College Group Subject'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($collegeGroupSubject['CollegeGroupSubject']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('College'); ?></dt>
		<dd>
			<?php echo $this->Html->link($collegeGroupSubject['College']['name'], array('controller' => 'colleges', 'action' => 'view', $collegeGroupSubject['College']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Group Subjects'); ?></dt>
		<dd>
			<?php echo $this->Html->link($collegeGroupSubject['GroupSubjects']['name'], array('controller' => 'group_subjects', 'action' => 'view', $collegeGroupSubject['GroupSubjects']['id'])); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit College Group Subject'), array('action' => 'edit', $collegeGroupSubject['CollegeGroupSubject']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete College Group Subject'), array('action' => 'delete', $collegeGroupSubject['CollegeGroupSubject']['id']), null, __('Are you sure you want to delete # %s?', $collegeGroupSubject['CollegeGroupSubject']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List College Group Subjects'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New College Group Subject'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Colleges'), array('controller' => 'colleges', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New College'), array('controller' => 'colleges', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Group Subjects'), array('controller' => 'group_subjects', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Group Subjects'), array('controller' => 'group_subjects', 'action' => 'add')); ?> </li>
	</ul>
</div>
