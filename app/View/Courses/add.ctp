<div class="courses form">
<?php echo $this->Html->addCrumb('Course', '/Courses');?>
<?php echo $this->Form->create('Course'); ?>
	<fieldset>
		<legend><?php echo __('Add Course'); ?></legend>
	<?php 
		
		
		echo $this->Form->input('name', array('required'=>true));

		echo $this->Form->input('no_of_subject', array('required'=>true));?>
                <div class="subject-multi">
		<?php echo $this->Form->input('compulsary_subject',array('type' => 'select','multiple' => 'checkbox','options' => $subjects,'id'=>'subjectID'));?>
</div>

	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Courses'), array('action' => 'index')); ?></li>
	</ul>
</div>
