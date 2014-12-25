<div class="groupSubjects index">
<?php  echo $this->Html->addCrumb('Group Subject', '/GroupSubjects'); ?>
	<h2><?php echo __('Group Subjects'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('name'); ?></th>
                        <th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php   foreach ($groupSubjects as $groupSubject): ?>
	<tr>
		<td><?php echo h($groupSubject['GroupSubject']['name']); ?>&nbsp;</td>
                <td>
                    <?php echo $this->Html->image('view.png', array('url' => array('action' => 'view', $groupSubject['GroupSubject']['id']),'title'=>'View')); ?>
                    <?php echo $this->Html->image('edit_button.png', array('url' => array('action' => 'edit', $groupSubject['GroupSubject']['id']),'title'=>'Edit')); ?>
                    <?php echo $this->Form->postLink($this->Html->image('delete_button.png'), array('action' => 'delete', $groupSubject['GroupSubject']['id']), array('escape' => false,'title'=>'Delete'), __('Are you sure you want to delete # %s?', $groupSubject['GroupSubject']['id'])); ?>
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
		<li><?php echo $this->Html->link(__('New Group Subject'), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Group Sub Subjects'), array('controller' => 'group_sub_subjects', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('List College Group Subjects'), array('controller' => 'college_group_subjects', 'action' => 'index')); ?> </li>
	</ul>
</div>
