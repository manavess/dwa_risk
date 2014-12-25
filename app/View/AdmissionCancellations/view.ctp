<div class="admissionCancellations view">
<?php echo $this->Html->addCrumb('Admission Cancellation', '/AdmissionCancellations');?>
<h2><?php  echo __('Admission Cancellation'); ?></h2>
	<dl>
		<dt><?php echo __('Student Registration'); ?></dt>
		<dd>
			<?php echo $this->Html->link($admissionCancellation['StudentRegistration']['id'], array('controller' => 'student_registrations', 'action' => 'view', $admissionCancellation['StudentRegistration']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Remarks'); ?></dt>
		<dd>
			<?php echo h($admissionCancellation['AdmissionCancellation']['remarks']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($admissionCancellation['AdmissionCancellation']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created By'); ?></dt>
                <dd>
                        <?php echo h($createuser); ?>
			&nbsp;
                </dd>
        <dt><?php echo __('Modified'); ?></dt>
        <dd>
            <?php echo h($admissionCancellation['AdmissionCancellation']['modified']); ?>
            &nbsp;
        </dd>
        <dt><?php echo __('Modified By'); ?></dt>
                <dd>
                        <?php echo h($modifyuser); ?>
			&nbsp;
                </dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Admission Cancellation'), array('action' => 'edit', $admissionCancellation['AdmissionCancellation']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Admission Cancellation'), array('action' => 'delete', $admissionCancellation['AdmissionCancellation']['id']), null, __('Are you sure you want to delete # %s?', $admissionCancellation['AdmissionCancellation']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Admission Cancellations'), array('action' => 'index')); ?> </li>
		<li><?php //echo $this->Html->link(__('New Admission Cancellation'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Student Registrations'), array('controller' => 'student_registrations', 'action' => 'index')); ?> </li>
		<li><?php //echo $this->Html->link(__('New Student Registration'), array('controller' => 'student_registrations', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('Cancellation Report'), array('controller' => 'AdmissionCancellations', 'action' => 'download_cacellationreport')); ?> </li>
	</ul>
</div>
