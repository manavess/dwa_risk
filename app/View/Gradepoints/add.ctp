<div class="gradepoints form">
<?php echo $this->Form->create('Gradepoint'); ?>
	<fieldset>
		<legend><?php echo __('Add Gradepoint'); ?></legend>
	<?php
		echo $this->Form->input('gradepoints');
		echo $this->Form->input('lowerlimit');
		echo $this->Form->input('higherlimit');
		echo $this->Form->input('remarks');
                echo $this->Form->input('markingtype',array('type'=>'select','options'=>array('grades'=>'grades','points'=>'points')));
		echo $this->Form->input('year',array('type'=>'select','options'=>array(date('Y')-1=>date('Y')-1,date('Y')=>date('Y'),date('Y')+1=>date('Y')+1)));
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Gradepoints'), array('action' => 'index')); ?></li>
	</ul>
</div>
