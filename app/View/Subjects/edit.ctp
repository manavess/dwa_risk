<div class="subjects form">
<?php  echo $this->Html->addCrumb("Subject", '/Subjects'); ?>
<?php echo $this->Form->create('Subject'); ?>
	<fieldset>
		<legend><?php echo __('Edit Subject'); ?></legend>
	<?php
$options = array('Y'=>'Yes','N'=>'No');
		echo $this->Form->input('id');
		echo $this->Form->input('subject_code', array('required'=>false,'maxlength'=>'5'));
		echo $this->Form->input('name', array('required'=>false,'maxlength'=>'100'));
		?>
        <div>
        <label>Status</label>
        <?php
		echo $this->Form->input('status',array('type'=>'radio', 'legend'=>false,'class'=>'radio','options'=>$options,'value'=>  $this->data['Subject']['status']));
	?>
    </div>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php //echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('Subject.id')), null, __('Are you sure you want to delete # %s?', $this->Form->value('Subject.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Subjects'), array('action' => 'index')); ?></li>
	</ul>
</div>
