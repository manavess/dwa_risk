<div class="collegeGroupSubjects index">
	<h2><?php echo __('College Group Subjects'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('college_id'); ?></th>
			<th><?php echo $this->Paginator->sort('group_subjects_id'); ?></th>
	</tr>
	<?php foreach ($collegeGroupSubjects as $collegeGroupSubject): ?>
	<tr>
		<td>
			<?php echo $this->Html->link($collegeGroupSubject['College']['name'], array('controller' => 'colleges', 'action' => 'view', $collegeGroupSubject['College']['id'])); ?>
		</td>
		<td>
			<?php echo $this->Html->link($collegeGroupSubject['GroupSubjects']['name'], array('controller' => 'group_subjects', 'action' => 'view', $collegeGroupSubject['GroupSubjects']['id'])); ?>
		</td>
	</tr>
<?php endforeach; ?>
	</table>
	<p>
	<?php
	echo $this->Paginator->counter(array(
	'format' => __('Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}')
	));
	?>	</p>
	<div class="paging">
	<?php
		echo $this->Paginator->prev('< ' . __('previous'), array(), null, array('class' => 'prev disabled'));
		echo $this->Paginator->numbers(array('separator' => ''));
		echo $this->Paginator->next(__('next') . ' >', array(), null, array('class' => 'next disabled'));
	?>
	</div>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('List Colleges'), array('controller' => 'colleges', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New College'), array('controller' => 'colleges', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Group Subjects'), array('controller' => 'group_subjects', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Group Subjects'), array('controller' => 'group_subjects', 'action' => 'add')); ?> </li>
	</ul>
</div>
