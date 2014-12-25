<div class="subMenus index">
<?php  echo $this->Html->addCrumb("Sub Menu", '/SubMenus'); ?>
	<h2><?php echo __('Sub Menus'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('name'); ?></th>
			<th><?php echo $this->Paginator->sort('menu_id'); ?></th>
			<th><?php echo $this->Paginator->sort('url'); ?></th>
			<th><?php echo $this->Paginator->sort('status'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($subMenus as $subMenu): ?>
	<tr>
		<td><?php echo h($subMenu['SubMenu']['name']); ?>&nbsp;</td>
		<td>
		    <?php echo $this->Html->link($subMenu['Menu']['name'], array('controller' => 'menus', 'action' => 'view', $subMenu['Menu']['id'])); ?>
		</td>
		<td><?php echo h($subMenu['SubMenu']['url']); ?>&nbsp;</td>
		<?php if(!empty($subMenu['SubMenu']['status']) && $subMenu['SubMenu']['status']=='Y'){ $status = "Yes"; } else if(!empty($subMenu['SubMenu']['status']) && $subMenu['SubMenu']['status']=='N'){ $status = "No"; }else{ $status = ""; } ?>
		<td><?php echo $status; ?>&nbsp;</td>
		<td>
                    <?php echo $this->Html->image('view.png', array('url' => array('action' => 'view', $subMenu['SubMenu']['id']),'title'=>'View')); ?>
                    <?php echo $this->Html->image('edit_button.png', array('url' => array('action' => 'edit', $subMenu['SubMenu']['id']),'title'=>'Edit')); ?>
                    <?php echo $this->Form->postLink($this->Html->image('delete_button.png'), array('action' => 'delete', $subMenu['SubMenu']['id']), array('escape' => false,'title'=>'Delete'), __('Are you sure you want to delete # %s?', $subMenu['SubMenu']['id'])); ?>
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
		<li><?php echo $this->Html->link(__('New Sub Menu'), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Menus'), array('controller' => 'menus', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Menu'), array('controller' => 'menus', 'action' => 'add')); ?> </li>
	</ul>
</div>
