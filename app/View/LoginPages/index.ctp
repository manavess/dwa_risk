<div class="loginPages index">
	<h2><?php echo __('Login Pages'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('pagetext'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($loginPages as $loginPage): ?>
	<tr>
		<td><?php echo h($loginPage['LoginPage']['pagetext']); ?>&nbsp;</td>
		<td>
                    <?php echo $this->Html->image('view.png', array('url' => array('action' => 'view', $loginPage['LoginPage']['id']),'title'=>'View')); ?>
                    <?php echo $this->Html->image('edit_button.png', array('url' => array('action' => 'edit', $loginPage['LoginPage']['id']),'title'=>'Edit')); ?>
                    <?php //echo $this->Form->postLink($this->Html->image('delete_button.png'), array('action' => 'delete', $loginPage['LoginPage']['id']), array('escape' => false,'title'=>'Delete'), __('Are you sure you want to delete # %s?', $loginPage['LoginPage']['id'])); ?>
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
		<li><?php //echo $this->Html->link(__('New Login Page'), array('action' => 'add')); ?></li>
	</ul>
</div>-->
