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
		<legend><?php echo __('Edit Admin Preference'); ?></legend>
	<?php if(!empty($this->data['AdminPreference']['markslimit'])){ $markslimit = $this->data['AdminPreference']['markslimit']; }else{
	$markslimit = '';
	} 
		echo $this->Form->input('id');
		
$date = date('d-m-Y',strtotime($this->data['AdminPreference']['cut_off_date']));
		echo $this->Form->input('cut_off_date',array('type' => 'text', 'id' => 'datepicker','value'=>$date,'required'=>false,'readonly'));

		echo $this->Form->input('no_of_college', array('required'=>false));
		echo $this->Form->input('domestic_application_fee', array('required'=>false,'maxlength'=>6));
		echo $this->Form->input('international_application_fee', array('required'=>false,'maxlength'=>6));
		echo $this->Form->input('year',array('type'=>'text','required'=>false));
		echo $this->Form->input('markslimit',array('maxLength'=>'2','type'=>'text','required'=>false,'value'=>$markslimit));
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php //echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('AdminPreference.id')), null, __('Are you sure you want to delete # %s?', $this->Form->value('AdminPreference.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Admin Preferences'), array('action' => 'index')); ?></li>
	</ul>
</div>
