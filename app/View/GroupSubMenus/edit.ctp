<div class="groupSubMenus form">
<?php  echo $this->Html->addCrumb('Group Sub Menu', '/GroupSubMenus'); ?>
<?php echo $this->Form->create('GroupSubMenu'); ?>
	<fieldset>
		<legend><?php echo __('Edit Group Sub Menu'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('group_id');
		echo $this->Form->input('sub_menu_id');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('GroupSubMenu.id')), null, __('Are you sure you want to delete # %s?', $this->Form->value('GroupSubMenu.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Group Sub Menus'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Groups'), array('controller' => 'groups', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Group'), array('controller' => 'groups', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Sub Menus'), array('controller' => 'sub_menus', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Sub Menu'), array('controller' => 'sub_menus', 'action' => 'add')); ?> </li>
	</ul>
</div>
