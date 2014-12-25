<div class="menuActions view">
<h2><?php  echo __('Menu Action'); ?></h2>
	<dl>
		<dt><?php echo __('Name'); ?></dt>
		<dd>
			<?php echo h($menuAction['MenuAction']['name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Action'); ?></dt>
		<dd>
			<?php echo h($menuAction['MenuAction']['action']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Sub Menu'); ?></dt>
		<dd>
			<?php echo $this->Html->link($menuAction['SubMenu']['name'], array('controller' => 'sub_menus', 'action' => 'view', $menuAction['SubMenu']['id'])); ?>
			&nbsp;
		</dd>
                <dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($menuAction['MenuAction']['created']); ?>
			&nbsp;
		</dd>
                <dt><?php echo __('Created By'); ?></dt>
                <dd>
                        <?php echo h($createuser); ?>
			&nbsp;
                </dd>
                <dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($menuAction['MenuAction']['modified']); ?>
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
		<li><?php echo $this->Html->link(__('Edit Menu Action'), array('action' => 'edit', $menuAction['MenuAction']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Menu Action'), array('action' => 'delete', $menuAction['MenuAction']['id']), null, __('Are you sure you want to delete # %s?', $menuAction['MenuAction']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Menu Actions'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Menu Action'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Sub Menus'), array('controller' => 'sub_menus', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Sub Menu'), array('controller' => 'sub_menus', 'action' => 'add')); ?> </li>
	</ul>
</div>
