<div class="goals index">
<?php  echo $this->Html->addCrumb('Goal', '/Goals'); ?>
	<h2><?php echo __('Goals'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('goal'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($goals as $goal): ?>
	<tr>
		<td><?php echo h(strip_tags($goal['Goal']['goal'])); ?>&nbsp;</td>
		<td width="8%">
                    <?php echo $this->Html->image('view.png', array('url' => array('action' => 'view', $goal['Goal']['id']),'title'=>'View')); ?>
                    <?php echo $this->Html->image('edit_button.png', array('url' => array('action' => 'edit', $goal['Goal']['id']),'title'=>'Edit')); ?>
                    <?php //echo $this->Form->postLink($this->Html->image('delete_button.png'), array('action' => 'delete', $goal['Goal']['id']), array('escape' => false,'title'=>'Delete'), __('Are you sure you want to delete # %s?', $goal['Goal']['id'])); ?>
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
<!--<div class="actions">
	<h3><?php //echo __('Actions'); ?></h3>
	<ul>
		<li><?php //echo $this->Html->link(__('New Goal'), array('action' => 'add')); ?></li>
	</ul>
</div>-->