<div class="userSubMenus view">
<h2><?php  echo __('User Sub Menu'); ?></h2>
	<dl>
		<dt><?php echo __('User'); ?></dt>
		<dd>
			<?php echo $this->Html->link($userSubMenu['User']['id'], array('controller' => 'users', 'action' => 'view', $userSubMenu['User']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Sub Menu'); ?></dt>
		<dd>
			<?php echo $this->Html->link($userSubMenu['SubMenu']['name'], array('controller' => 'sub_menus', 'action' => 'view', $userSubMenu['SubMenu']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($userSubMenu['UserSubMenu']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created By'); ?></dt>
                <dd>
                        <?php echo h($createuser); ?>
			&nbsp;
                </dd>
                <dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($userSubMenu['UserSubMenu']['modified']); ?>
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
		<li><?php echo $this->Html->link(__('Edit User Sub Menu'), array('action' => 'edit', $userSubMenu['UserSubMenu']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete User Sub Menu'), array('action' => 'delete', $userSubMenu['UserSubMenu']['id']), null, __('Are you sure you want to delete # %s?', $userSubMenu['UserSubMenu']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List User Sub Menus'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User Sub Menu'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Sub Menus'), array('controller' => 'sub_menus', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Sub Menu'), array('controller' => 'sub_menus', 'action' => 'add')); ?> </li>
	</ul>
</div>
