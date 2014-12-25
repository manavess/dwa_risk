<div class="courses form">
<?php echo $this->Html->addCrumb('Course', '/Courses');?>
<?php echo $this->Form->create('Course'); ?>
	<fieldset>
		<legend><?php echo __('Edit Course'); ?></legend>
	<?php  
	$sub = array();
	foreach( (array) explode(",",$selected[0]) as $value){
		
		array_push($sub,(int)$value);
			
	}
	echo $this->Form->input('id');
	echo $this->Form->input('name', array('required'=>false));
	echo $this->Form->input('no_of_subject', array('required'=>false));
	?>
     <div class="subject-multi">
    <?php
	echo $this->Form->input('compulsary_subject',array('type' => 'select','multiple' => 'checkbox','options' => $subjects,'selected'=>$sub));
	?>
    </div>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php //echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('Course.id')), null, __('Are you sure you want to delete # %s?', $this->Form->value('Course.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Courses'), array('action' => 'index')); ?></li>
	</ul>
</div>
