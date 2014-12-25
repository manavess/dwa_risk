<div class="pressReleases index">
<?php  echo $this->Html->addCrumb('Press Release', '/PressReleases'); ?>
	<h2><?php echo __('Press Release'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('press_release'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($pressReleases as $pressRelease): ?>
	<tr>
		<td><?php echo h(strip_tags($pressRelease['PressRelease']['press_release'])); ?>&nbsp;</td>
		<td>
                    <?php echo $this->Html->image('view.png', array('url' => array('action' => 'view', $pressRelease['PressRelease']['id']),'title'=>'View')); ?>
                    <?php echo $this->Html->image('edit_button.png', array('url' => array('action' => 'edit', $pressRelease['PressRelease']['id']),'title'=>'Edit')); ?>
                    <?php //echo $this->Form->postLink($this->Html->image('delete_button.png'), array('action' => 'delete', $pressRelease['PressRelease']['id']), array('escape' => false,'title'=>'Delete'), __('Are you sure you want to delete # %s?', $pressRelease['PressRelease']['id'])); ?>
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
		<li><?php //echo $this->Html->link(__('New Press Release'), array('action' => 'add')); ?></li>
	</ul>
</div>-->
