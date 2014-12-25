<?php $this->TinyMCE->editor(array('theme' => 'advanced', 'mode' => 'textareas'));?>
<div class="pressReleases form">
<?php  echo $this->Html->addCrumb('Press Release', '/PressReleases'); ?>
<?php echo $this->Form->create('PressRelease'); ?>
	<fieldset>
		<legend><?php echo __('Edit Press Release'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('press_release', array('required'=>false));
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Press Releases'), array('action' => 'index')); ?></li>
	</ul>
</div>
