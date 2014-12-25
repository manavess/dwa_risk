<div class="states index">
<?php  echo $this->Html->addCrumb("State", '/States'); ?>
	<h2><?php echo __('States'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('name'); ?></th>
			<th><?php echo $this->Paginator->sort('country_id'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($states as $state): ?>
	<tr>
		<td><?php echo h($state['State']['name']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($state['Country']['name'], array('controller' => 'countries', 'action' => 'view', $state['Country']['id'])); ?>
		</td>
		<td>
                    <?php echo $this->Html->image('view.png', array('url' => array('action' => 'view', $state['State']['id']),'title'=>'View')); ?>
                    <?php echo $this->Html->image('edit_button.png', array('url' => array('action' => 'edit', $state['State']['id']),'title'=>'Edit')); ?>
                    <?php echo $this->Form->postLink($this->Html->image('delete_button.png'), array('action' => 'delete', $state['State']['id']), array('escape' => false,'title'=>'Delete'), __('Are you sure you want to delete # %s?', $state['State']['id'])); ?>
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
		<li><?php echo $this->Html->link(__('New State'), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Countries'), array('controller' => 'countries', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Country'), array('controller' => 'countries', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Cities'), array('controller' => 'cities', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New City'), array('controller' => 'cities', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Colleges'), array('controller' => 'colleges', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New College'), array('controller' => 'colleges', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Universities'), array('controller' => 'universities', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New University'), array('controller' => 'universities', 'action' => 'add')); ?> </li>
	</ul>
</div>
