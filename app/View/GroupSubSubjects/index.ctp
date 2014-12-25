<div class="groupSubSubjects index">
<?php  echo $this->Html->addCrumb('Group Sub-subjects', '/GroupSubSubjects'); ?>
	<h2><?php echo __('Group Sub Subjects'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('group_subject_id'); ?></th>
			<th><?php echo $this->Paginator->sort('subject_id'); ?></th>
	</tr>
	<?php foreach ($groupSubSubjects as $groupSubSubject): ?>
	<tr>
		<td>
			<?php echo $this->Html->link($groupSubSubject['GroupSubject']['name'], array('controller' => 'group_subjects', 'action' => 'view', $groupSubSubject['GroupSubject']['id'])); ?>
		</td>
		<td>
			<?php echo $this->Html->link($groupSubSubject['Subject']['name'], array('controller' => 'subjects', 'action' => 'view', $groupSubSubject['Subject']['id'])); ?>
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
		<li><?php echo $this->Html->link(__('List Group Subjects'), array('controller' => 'group_subjects', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Group Subject'), array('controller' => 'group_subjects', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Subjects'), array('controller' => 'subjects', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Subject'), array('controller' => 'subjects', 'action' => 'add')); ?> </li>
	</ul>
</div>
