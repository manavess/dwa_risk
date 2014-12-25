<div class="groupSubSubjects form">
<?php echo $this->Form->create('GroupSubSubject'); ?>
	<fieldset>
		<legend><?php echo __('Edit Group Sub Subject'); ?></legend>
	<?php
	$sub = array();
	foreach( (array) $selected as $value){
		
		array_push($sub,(int)$value);
			
	}
		echo $this->Form->input('id');
		echo $this->Form->input('group_subject_id');
		echo $this->Form->input('subject_id',array('type' => 'select','multiple' => 'checkbox','options' => $subjects,'selected'=>$sub));
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('GroupSubSubject.id')), null, __('Are you sure you want to delete # %s?', $this->Form->value('GroupSubSubject.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Group Sub Subjects'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Group Subjects'), array('controller' => 'group_subjects', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Group Subject'), array('controller' => 'group_subjects', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Subjects'), array('controller' => 'subjects', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Subject'), array('controller' => 'subjects', 'action' => 'add')); ?> </li>
	</ul>
</div>
