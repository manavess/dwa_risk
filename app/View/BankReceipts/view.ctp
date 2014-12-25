<div class="bankReceipts view">
<?php echo $this->Html->addCrumb('Bank Receipt', '/BankReceipts');?>
<h2><?php  echo __('Bank Receipt'); ?></h2>
	<dl>
		<dt><?php echo __('Receipt No'); ?></dt>
		<dd>
			<?php echo h($bankReceipt['BankReceipt']['receipt_no']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Admission Application No'); ?></dt>

		<dd>
			<?php //echo $this->Html->link($bankReceipt['StudentRegistration']['id'], array('controller' => 'student_registrations', 'action' => 'view', $bankReceipt['StudentRegistration']['id'])); ?>
			<?php echo $bankReceipt['BankReceipt']['application_number']; ?>
			&nbsp;
			
		</dd>
		<dt><?php echo __('Admission Amount'); ?></dt>
		<dd>
			<?php echo h($bankReceipt['BankReceipt']['admission_amount']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Bank Name'); ?></dt>
		<dd>
			<?php echo h($bankReceipt['BankReceipt']['receiving_authority']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Bank Receipt Date'); ?></dt>
		<dd>
			<?php echo h($bankReceipt['BankReceipt']['bank_receipt_date']); ?>
			&nbsp;
		</dd>
		<dt>
		
		<?php echo __('Status'); ?></dt>
		<dd>
		<?php if(!empty($bankReceipt['BankReceipt']['status']) && $bankReceipt['BankReceipt']['status']=='Y'){ $status = "Yes"; } else if(!empty($bankReceipt['BankReceipt']['status']) && $bankReceipt['BankReceipt']['status']=='N'){ $status = "No"; }else{ $status = ""; } ?>
			<?php echo $status; ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($bankReceipt['BankReceipt']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created By'); ?></dt>
		<dd>
			<?php  if(!empty($createdby[0]['User']['username'])){ echo h($createdby[0]['User']['username']); } ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php  if(!empty($BankReceipt['BankReceipt']['modified'])){echo h($BankReceipt['BankReceipt']['modified']);}  ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified By'); ?></dt>
		<dd>
			<?php if(!empty($modifiedby[0]['User']['username'])){ echo h($modifiedby[0]['User']['username']); } ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php //echo $this->Html->link(__('Edit Bank Receipt'), array('action' => 'edit', $bankReceipt['BankReceipt']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Bank Receipt'), array('action' => 'delete', $bankReceipt['BankReceipt']['id']), null, __('Are you sure you want to delete # %s?', $bankReceipt['BankReceipt']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Bank Receipts'), array('action' => 'index')); ?> </li>
		<li><?php //echo $this->Html->link(__('New Bank Receipt'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Student Registrations'), array('controller' => 'student_registrations', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Student Registration'), array('controller' => 'student_registrations', 'action' => 'add')); ?> </li>
	</ul>
</div>
