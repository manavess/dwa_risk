<?php echo $this->Html->css('jquery-ui.css'); ?>
<?php echo $this->Html->script('jquery.js'); ?>
<?php echo $this->Html->script('jquery-ui.js'); ?>
<script>
    $(function() {
        $("#datepicker").datepicker({dateFormat: 'yy-mm-dd'});
        $("#datepicker1").datepicker({dateFormat: 'yy-mm-dd'});
    });
</script>
<?php echo $this->Html->addCrumb('Admin Preference', '/AdminPreferences');?>
<div class="adminPreferences form">
<?php echo $this->Form->create('AdminPreference'); ?>
	<fieldset>
		<legend><?php echo __('Add Admin Preference'); ?></legend>
	<?php
        
		echo $this->Form->input('cut_off_date', array('type' => 'text', 'id' => 'datepicker','default'=>'','required'=>false,'readonly'));
		echo $this->Form->input('no_of_college', array('required'=>false));
		echo $this->Form->input('domestic_application_fee', array('required'=>false));
		echo $this->Form->input('markslimit', array('required'=>false,'maxLength'=>'2'));
		echo $this->Form->input('international_application_fee', array('required'=>false));
		echo $this->Form->input('year',array('type'=>'text','required'=>false));
		
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Admin Preferences'), array('action' => 'index')); ?></li>
	</ul>
</div>

