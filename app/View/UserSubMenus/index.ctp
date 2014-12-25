<div class="userSubMenus index">
	<h2><?php echo __('User Sub Menus'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('user_id'); ?></th>
			<th><?php echo $this->Paginator->sort('sub_menu_id'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($userSubMenus as $userSubMenu): ?>
	<tr>
		<td>
			<?php echo $this->Html->link($userSubMenu['User']['id'], array('controller' => 'users', 'action' => 'view', $userSubMenu['User']['id'])); ?>
		</td>
		<td>
			<?php echo $this->Html->link($userSubMenu['SubMenu']['name'], array('controller' => 'sub_menus', 'action' => 'view', $userSubMenu['SubMenu']['id'])); ?>
		</td>
		<td>
                    <?php echo $this->Html->image('view.png', array('url' => array('action' => 'view', $userSubMenu['UserSubMenu']['id']),'title'=>'View')); ?>
                    <?php echo $this->Html->image('edit_button.png', array('url' => array('action' => 'edit', $userSubMenu['UserSubMenu']['id']),'title'=>'Edit')); ?>
                    <?php echo $this->Form->postLink($this->Html->image('delete_button.png'), array('action' => 'delete', $userSubMenu['UserSubMenu']['id']), array('escape' => false,'title'=>'Delete'), __('Are you sure you want to delete # %s?', $userSubMenu['UserSubMenu']['id'])); ?>
                </td>
	</tr>
<?php endforeach; ?>
	</table>
	<p>
	<?php
	echo $this->Paginator->counter(array(
	'format' => __('Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}')
	));
	?>	</p>
	<div class="paging">
	<?php
		echo $this->Paginator->prev('< ' . __('previous'), array(), null, array('class' => 'prev disabled'));
		echo $this->Paginator->numbers(array('separator' => ''));
		echo $this->Paginator->next(__('next') . ' >', array(), null, array('class' => 'next disabled'));
	?>
	</div>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('New User Sub Menu'), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Sub Menus'), array('controller' => 'sub_menus', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Sub Menu'), array('controller' => 'sub_menus', 'action' => 'add')); ?> </li>
	</ul>
</div>
