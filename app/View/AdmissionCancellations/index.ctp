<div class="admissionCancellations index">
<?php echo $this->Html->addCrumb('Admission Cancellation', '/AdmissionCancellations');?>
	<h2><?php echo __('Admission Cancellations'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('applicant_name'); ?></th>
			<th><?php echo $this->Paginator->sort('remarks'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($admissionCancellations as $admissionCancellation): ?>
	<tr>
		<td>
			<?php echo $this->Html->link($admissionCancellation['StudentRegistration']['applicant_name'], array('controller' => 'student_registrations', 'action' => 'view', $admissionCancellation['StudentRegistration']['id'])); ?>
		</td>
		<td><?php echo h($admissionCancellation['AdmissionCancellation']['remarks']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->image('view.png', array('url' => array('controller'=>'StudentRegistrations','action' => 'view', $admissionCancellation['StudentRegistration']['id']),'title'=>'View')); ?>
			<?php //echo $this->Html->image('edit_button.png', array('url' => array('action' => 'edit', $admissionCancellation['AdmissionCancellation']['id']),'title'=>'Edit')); ?>
			<?php echo $this->Form->postLink($this->Html->image('delete_button.png'), array('action' => 'delete', $admissionCancellation['AdmissionCancellation']['id']), array('escape' => false,'title'=>'Delete'), __('Are you sure you want to delete # %s?', $admissionCancellation['AdmissionCancellation']['id'])); ?>
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
		<li><?php //echo $this->Html->link(__('New Admission Cancellation'), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Alotted Students'), array('controller' => 'StudentAlotments', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('Cancel Student Admission'), array('controller' => 'AdmissionCancellations', 'action' => 'cancel_admission')); ?> </li>
		<li><?php echo $this->Html->link(__('Cancellation Report'), array('controller' => 'AdmissionCancellations', 'action' => 'download_cacellationreport')); ?> </li>
	</ul>
</div>
