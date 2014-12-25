<div class="subjects form">
<?php  echo $this->Html->addCrumb("Subject", '/Subjects'); ?>
<?php echo $this->Form->create('Subject'); ?>
	<fieldset>
		<legend><?php echo __('Add Subject'); ?></legend>
	<?php
$options = array('Y'=>'Yes','N'=>'No');
		echo $this->Form->input('subject_code', array('required'=>false,'maxlength'=>'5'));
		echo $this->Form->input('name', array('required'=>false,'maxlength'=>'100'));
		echo $this->Form->input('status',array('type'=>'radio','class'=>'radio','options'=>$options,'checked'=>'checked'));
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Subjects'), array('action' => 'index')); ?></li>
	</ul>
</div>
