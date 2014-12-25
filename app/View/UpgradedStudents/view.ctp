<div class="upgradedStudents view">
<?php  echo $this->Html->addCrumb("UpgradedStudent", '/UpgradedStudents'); ?>
<h2><?php  echo __('Upgraded Student'); ?></h2>
	<dl>
		<dt><?php echo __('Student Application number'); ?></dt>
		<dd>
			<?php echo h($upgradedStudent['StudentRegistration']['application_number']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Applicant Name'); ?></dt>
		<dd>
			<?php echo $upgradedStudent['StudentRegistration']['applicant_name'];?>
			&nbsp;
		</dd>
		<dt><?php echo __('From Course'); ?></dt>
		<dd>
			<?php echo h($upgradedStudent['fromCourse']['name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('To Course'); ?></dt>
		<dd>
			<?php echo h($upgradedStudent['toCourse']['name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Remarks'); ?></dt>
		<dd>
			<?php echo h($upgradedStudent['UpgradedStudent']['remarks']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($upgradedStudent['UpgradedStudent']['created']); ?>
			&nbsp;
		</dd>
                <dt><?php echo __('Created By'); ?></dt>
                <dd>
                        <?php echo h($createuser); ?>
			&nbsp;
                </dd>
                <dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($upgradedStudent['UpgradedStudent']['modified']); ?>
			&nbsp;
		</dd>
                <dt><?php echo __('Modified By'); ?></dt>
                <dd>
                        <?php echo h($modifyuser); ?>
			&nbsp;
                </dd>
	</dl>
	<div><h3>Subjects and Marks</h3>
	<table width="20%">
	<?php foreach($upgradedStudent['UpgradedStudentMark'] as $value){ ?>
	<tr>
	
	<td><?php echo $subjects[$value['subject_id']];?></td>
	<td><?php echo $value['marks'];?></td>
	</tr>
	<?php } ?>
	</table>
	</div>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php //echo $this->Html->link(__('Edit Upgraded Student'), array('action' => 'edit', $upgradedStudent['UpgradedStudent']['id'])); ?> </li>
		<li><?php //echo $this->Form->postLink(__('Delete Upgraded Student'), array('action' => 'delete', $upgradedStudent['UpgradedStudent']['id']), null, __('Are you sure you want to delete # %s?', $upgradedStudent['UpgradedStudent']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Upgraded Students'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Upgraded Student'), array('action' => 'add')); ?> </li>
	</ul>
</div>
