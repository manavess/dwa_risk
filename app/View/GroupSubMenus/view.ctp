<div class="groupSubMenus view">
<?php  echo $this->Html->addCrumb('Group Sub Menu', '/GroupSubMenus'); ?>
<h2><?php  echo __('Group Sub Menu'); ?></h2>
	<dl>
		<dt><?php echo __('Group'); ?></dt>
		<dd>
			<?php echo $this->Html->link($groupSubMenu['Group']['name'], array('controller' => 'groups', 'action' => 'view', $groupSubMenu['Group']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Sub Menu'); ?></dt>
		<dd>
			<?php echo $this->Html->link($groupSubMenu['SubMenu']['name'], array('controller' => 'sub_menus', 'action' => 'view', $groupSubMenu['SubMenu']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($groupSubMenu['GroupSubMenu']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created By'); ?></dt>
                <dd>
                        <?php echo h($createuser); ?>
			&nbsp;
                </dd>
                <dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($groupSubMenu['GroupSubMenu']['modified']); ?>
			&nbsp;
		</dd>
                <dt><?php echo __('Modified By'); ?></dt>
                <dd>
                        <?php echo h($modifyuser); ?>
			&nbsp;
                </dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Group Sub Menu'), array('action' => 'edit', $groupSubMenu['GroupSubMenu']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Group Sub Menu'), array('action' => 'delete', $groupSubMenu['GroupSubMenu']['id']), null, __('Are you sure you want to delete # %s?', $groupSubMenu['GroupSubMenu']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Group Sub Menus'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Group Sub Menu'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Groups'), array('controller' => 'groups', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Group'), array('controller' => 'groups', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Sub Menus'), array('controller' => 'sub_menus', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Sub Menu'), array('controller' => 'sub_menus', 'action' => 'add')); ?> </li>
	</ul>
</div>
