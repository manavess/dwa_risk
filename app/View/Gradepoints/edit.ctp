<div class="gradepoints form">
<?php echo $this->Form->create('Gradepoint'); ?>
	<fieldset>
		<legend><?php echo __('Edit Gradepoint'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('gradepoints');
		echo $this->Form->input('lowerlimit');
		echo $this->Form->input('higherlimit');
		echo $this->Form->input('remarks');
                echo $this->Form->input('markingtype',array('type'=>'select','options'=>array('grades'=>'grades','points'=>'points'),'default'=>$this->data['Gradepoint']['markingtype']));
		echo $this->Form->input('year',array('type'=>'select','options'=>array(date('Y')-1=>date('Y')-1,date('Y')=>date('Y'),date('Y')+1=>date('Y')+1),'default'=>$this->data['Gradepoint']['year']));
	
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('Gradepoint.id')), null, __('Are you sure you want to delete # %s?', $this->Form->value('Gradepoint.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Gradepoints'), array('action' => 'index')); ?></li>
	</ul>
</div>
