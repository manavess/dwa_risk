<?php $this->TinyMCE->editor(array('theme' => 'advanced', 'mode' => 'textareas'));?>
<div class="visions form">
<?php echo $this->Form->create('Vision'); ?>
	<fieldset>
		<legend><?php echo __('Add Vision'); ?></legend>
	<?php
		echo $this->Form->input('vision', array('required'=>false));
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
            <li><?php echo $this->Html->link(__('List Visions'), array('action' => 'index')); ?></li>
	</ul>
</div>