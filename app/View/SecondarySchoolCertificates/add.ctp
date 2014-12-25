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
<div class="secondarySchoolCertificates form">
<?php  echo $this->Html->addCrumb('Secondary School Certificate', '/SecondarySchoolCertificates'); ?>
<?php echo $this->Form->create('SecondarySchoolCertificate'); ?>
	<fieldset>
		<legend><?php echo __('Add Secondary School Certificate'); ?></legend>
	<?php
		echo $this->Form->input('certificate_number', array('required'=>false));
		echo $this->Form->input('certificate_type', array('required'=>false));
		echo $this->Form->input('date_of_birth',array('type'=>'text','id' => 'datepicker'));
		echo $this->Form->input('certificate_date',array('type'=>'text','id' => 'datepicker1'));
		echo $this->Form->input('year',array('type'=>'text','required'=>false));
		
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Secondary School Certificates'), array('action' => 'index')); ?></li>
	</ul>
</div>
