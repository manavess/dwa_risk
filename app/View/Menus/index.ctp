<div class="menus index">
<?php echo $this->Html->addCrumb("Menu", '/Menus'); ?>
	<h2><?php echo __('Menus'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('name'); ?></th>
			<th><?php echo $this->Paginator->sort('status'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($menus as $menu): ?>
	<tr>
	<?php if(!empty($menu['Menu']['status']) && $menu['Menu']['status']=='Y'){ $status = "Yes"; } else if(!empty($menu['Menu']['status']) && $menu['Menu']['status']=='N'){ $status = "No"; }else{ $status = ""; } ?>
		<td><?php echo $menu['Menu']['name']; ?>&nbsp;</td>
		<td><?php echo $status; ?>&nbsp;</td>
		<td>
                    <?php echo $this->Html->image('view.png', array('url' => array('action' => 'view', $menu['Menu']['id']),'title'=>'View')); ?>
                    <?php echo $this->Html->image('edit_button.png', array('url' => array('action' => 'edit', $menu['Menu']['id']),'title'=>'Edit')); ?>
                    <?php echo $this->Form->postLink($this->Html->image('delete_button.png'), array('action' => 'delete', $menu['Menu']['id']), array('escape' => false,'title'=>'Delete'), __('Are you sure you want to delete # %s?', $menu['Menu']['id'])); ?>
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
		<li><?php echo $this->Html->link(__('New Menu'), array('action' => 'add')); ?></li>
	</ul>
</div>
