<div class="upgradedStudents index">
<?php  echo $this->Html->addCrumb("UpgradedStudent", '/UpgradedStudents'); ?>
	<h2><?php echo __('Upgraded Students');
	 ?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('applicant_name'); ?></th>
			<th><?php echo $this->Paginator->sort('from_Course'); ?></th>
			<th><?php echo $this->Paginator->sort('to_course_id'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php  foreach ($upgradedStudents as $upgradedStudent): ?>
	<tr>
		<td><?php echo $this->Html->link($upgradedStudent['StudentRegistration']['applicant_name'],array('action'=>'view',$upgradedStudent['UpgradedStudent']['student_registration_id'])); ?>&nbsp;</td>
		<td><?php echo $this->Html->link($upgradedStudent['fromCourse']['name'],array('action'=>'view',$upgradedStudent['UpgradedStudent']['from_course_id'])); ?>&nbsp;</td>
		<td><?php echo h($upgradedStudent['toCourse']['name']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->image('view.png', array('url' => array('action' => 'view', $upgradedStudent['UpgradedStudent']['id']),'title'=>'View')); ?>
			<?php //echo $this->Html->image('edit_button.png', array('url' => array('action' => 'edit', $upgradedStudent['UpgradedStudent']['id']),'title'=>'Edit')); ?>
			<?php echo $this->Form->postLink($this->Html->image('delete_button.png'), array('action' => 'delete', $upgradedStudent['UpgradedStudent']['id']), array('escape' => false,'title'=>'Delete'), __('Are you sure you want to delete # %s?', $upgradedStudent['UpgradedStudent']['id'])); ?>
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
		<li><?php echo $this->Html->link(__('New Upgraded Student'), array('action' => 'upgrade_student')); ?></li>
		<li><?php echo $this->Html->link(__('Download Upgraded Student list'), array('action' => 'download_list')); ?></li>
	</ul>
</div>
