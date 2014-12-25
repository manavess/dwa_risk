<?php echo $this->Html->css('jquery-ui.css'); ?>
<?php echo $this->Html->script('jquery.js'); ?>
<?php echo $this->Html->script('jquery-ui.js'); ?>
<script>
    $(function() {
        $("#datepicker").datepicker({dateFormat: 'dd-mm-yy'});
        $("#datepicker1").datepicker({dateFormat: 'dd-mm-yy'});
       // $("#datepicker2").datepicker({dateFormat: 'dd-mm-yy'});
        //$("#datepicker3").datepicker({dateFormat: 'dd-mm-yy'});
        //$("#datepicker4").datepicker({dateFormat: 'dd-mm-yy'});
    });
</script>
<div class="bankReceipts form">
<?php echo $this->Html->addCrumb('Bank Receipt', '/BankReceipts');?>
<?php echo $this->Form->create('BankReceipt'); ?>
	<fieldset>
		<legend><?php echo __('Edit Bank Receipt'); ?></legend>
	<?php
	 $status = array('N' => 'No','Y' => 'Yes');
		echo $this->Form->input('id');
		echo $this->Form->input('receipt_no', array('required'=>false));
		echo $this->Form->input('application_number',array('type'=>'text','required'=>false));
		echo $this->Form->input('admission_amount', array('required'=>false));
		echo $this->Form->input('receiving_authority', array('required'=>false));
		echo $this->Form->input('bank_receipt_date',array('type'=>'text','id'=>'datepicker'));
		if($this->data['BankReceipt']['status']=='Y'){
		echo $this->Form->input('status',array('type' => 'radio', 'class' => 'radio', 'options' => $status,'selected'=>$this->data['BankReceipt']['status']));}else{
		echo $this->Form->input('status',array('type' => 'radio', 'class' => 'radio', 'options' => $status));
		}
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('BankReceipt.id')), null, __('Are you sure you want to delete # %s?', $this->Form->value('BankReceipt.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Bank Receipts'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Student Registrations'), array('controller' => 'student_registrations', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Student Registration'), array('controller' => 'student_registrations', 'action' => 'add')); ?> </li>
	</ul>
</div>
