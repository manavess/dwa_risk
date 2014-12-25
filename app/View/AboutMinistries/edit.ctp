<?php $this->TinyMCE->editor(array('theme' => 'advanced', 'mode' => 'textareas'));?>
<?php echo $this->Html->addCrumb('About Ministries', '/AboutMinistries');?>
<div class="aboutMinistries form">
    <form action="" enctype="multipart/form-data" method="post">
<?php echo $this->Form->create('AboutMinistry'); ?>
	<fieldset>
		<legend><?php echo __('Edit About Ministry'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('about_us',array('required'=>'false'));
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
        </form>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
                <li><?php //echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('AboutMinistry.id')), null, __('Are you sure you want to delete # %s?', $this->Form->value('AboutMinistry.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List About Ministries'), array('action' => 'index')); ?></li>
	</ul>
</div>
