<div class="menuActions form">
<?php echo $this->Form->create('MenuAction'); ?>
	<fieldset>
		<legend><?php echo __('Edit Menu Action'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('name', array('required'=>false));
		echo $this->Form->input('action', array('required'=>false));
		echo $this->Form->input('sub_menu_id', array('empty' => 'Select','required'=>false));
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('MenuAction.id')), null, __('Are you sure you want to delete # %s?', $this->Form->value('MenuAction.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Menu Actions'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Sub Menus'), array('controller' => 'sub_menus', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Sub Menu'), array('controller' => 'sub_menus', 'action' => 'add')); ?> </li>
	</ul>
</div>
