<div class="BankReceipt form">
<?php echo $this->Html->addCrumb('Bank Receipt', '/BankReceipts');?>
<?php echo $this->Form->create('BankReceipt', array('url' => '','enctype'=>"multipart/form-data",'name' => 'uploadBankReceipt', 'id' => 'Bankreceipt')); ?>
    <fieldset>
        <legend><?php echo __('Upload Bank Receipt data'); ?></legend>
	<?php
		//echo $this->Form->input('certificatecontent',array('label' => false, 'type' => 'file','name'=>"data['SecondarySchoolCertificate']['excel']"));
		
	?><input type="file" name="data[BankReceipt][excel]" id="FileImage" /> 

        <div id="rightbody">
            <div class="submit" title="Download Bank Receipt Template" style="float:left; margin-top:-20px;"><a href="download_bankreceipt_template" target="_blank"><h1>Download Bank Receipt Template</h1></a>&nbsp;
            </div>
        </div>

    </fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
    <h3><?php echo __('Actions'); ?></h3>
    <ul>

        <li><?php //echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('BankReceipt.id')), null, __('Are you sure you want to delete # %s?', $this->Form->value('BankReceipt.id'))); ?></li>
        <li><?php echo $this->Html->link(__('List BankReceipt data'), array('action' => 'index')); ?></li>
    </ul>
</div>
