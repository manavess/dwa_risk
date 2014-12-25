<div class="bankReceipts index">
<?php echo $this->Html->addCrumb('Bank Receipt', '/BankReceipts');?>
	<h2><?php echo __('Bank Receipts'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('receipt_no'); ?></th>
			<th><?php echo $this->Paginator->sort('application_number'); ?></th>
			<th><?php echo $this->Paginator->sort('admission_amount'); ?></th>
			<th><?php echo $this->Paginator->sort('receiving_authority'); ?></th>
			<th><?php echo $this->Paginator->sort('bank_receipt_date'); ?></th>
			<th><?php echo $this->Paginator->sort('status'); ?></th>
			
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($bankReceipts as $bankReceipt): ?>
	<tr>
		<td><?php echo h($bankReceipt['BankReceipt']['receipt_no']); ?>&nbsp;</td>
		<td><?php echo $bankReceipt['BankReceipt']['application_number']; ?></td>
		<td><?php echo h($bankReceipt['BankReceipt']['admission_amount']); ?>&nbsp;</td>
		<td><?php echo h($bankReceipt['BankReceipt']['receiving_authority']); ?>&nbsp;</td>
		<td><?php echo h($bankReceipt['BankReceipt']['bank_receipt_date']); ?>&nbsp;</td>
		<?php if(!empty($bankReceipt['BankReceipt']['status']) && $bankReceipt['BankReceipt']['status']=='Y'){ $status = "Yes"; } else if(!empty($bankReceipt['BankReceipt']['status']) && $bankReceipt['BankReceipt']['status']=='N'){ $status = "No"; }else{ $status = ""; } ?>
		<td><?php echo $status; ?>&nbsp;</td>
		
		<td class="">
			<?php echo $this->Html->image('view.png', array('url' => array('action' => 'view', $bankReceipt['BankReceipt']['id']),'title'=>'View')); ?>
			<?php //echo $this->Html->image('edit_button.png', array('url' => array('action' => 'edit', $bankReceipt['BankReceipt']['id']),'title'=>'Edit')); ?>
			 <?php echo $this->Form->postLink($this->Html->image('delete_button.png'), array('action' => 'delete', $bankReceipt['BankReceipt']['id']), array('escape' => false,'title'=>'Delete'), __('Are you sure you want to delete # %s?', $bankReceipt['BankReceipt']['id'])); ?>
			
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
		<li><?php //echo $this->Html->link(__('New Bank Receipt'), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('Upload Bank Receipt'), array('action' => 'uploadbankreceipts')); ?> </li>
		<li><?php echo $this->Html->link(__('List Student Registrations'), array('controller' => 'student_registrations', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Student Registration'), array('controller' => 'student_registrations', 'action' => 'add')); ?> </li>
		
	</ul>
</div>
<script>
