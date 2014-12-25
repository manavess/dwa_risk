<div class="groupSubSubjects view">
<h2><?php  echo __('Group Sub Subject'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($groupSubSubject['GroupSubSubject']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Group Subject'); ?></dt>
		<dd>
			<?php echo $this->Html->link($groupSubSubject['GroupSubject']['name'], array('controller' => 'group_subjects', 'action' => 'view', $groupSubSubject['GroupSubject']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Subject'); ?></dt>
		<dd>
			<?php echo $this->Html->link($groupSubSubject['Subject']['name'], array('controller' => 'subjects', 'action' => 'view', $groupSubSubject['Subject']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($groupSubSubject['GroupSubSubject']['created']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Group Sub Subject'), array('action' => 'edit', $groupSubSubject['GroupSubSubject']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Group Sub Subject'), array('action' => 'delete', $groupSubSubject['GroupSubSubject']['id']), null, __('Are you sure you want to delete # %s?', $groupSubSubject['GroupSubSubject']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Group Sub Subjects'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Group Sub Subject'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Group Subjects'), array('controller' => 'group_subjects', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Group Subject'), array('controller' => 'group_subjects', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Subjects'), array('controller' => 'subjects', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Subject'), array('controller' => 'subjects', 'action' => 'add')); ?> </li>
	</ul>
</div>
