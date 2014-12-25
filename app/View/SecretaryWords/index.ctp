<div class="secretaryWords index">
<?php  echo $this->Html->addCrumb("Secretary's Word", '/SecretaryWords'); ?>
	<h2><?php echo __('Secretary Words'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('secretary_word'); ?></th>
                        <th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($secretaryWords as $secretaryWord): ?>
	<tr>
		<td><?php echo h(strip_tags($secretaryWord['SecretaryWord']['secretary_word'])); ?>&nbsp;</td>
	<td width="8%">
                    <?php echo $this->Html->image('view.png', array('url' => array('action' => 'view', $secretaryWord['SecretaryWord']['id']),'title'=>'View')); ?>
                    <?php echo $this->Html->image('edit_button.png', array('url' => array('action' => 'edit', $secretaryWord['SecretaryWord']['id']),'title'=>'Edit')); ?>
                    <?php //echo $this->Form->postLink($this->Html->image('delete_button.png'), array('action' => 'delete', $secretaryWord['SecretaryWord']['id']), array('escape' => false,'title'=>'Delete'), __('Are you sure you want to delete # %s?', $secretaryWord['SecretaryWord']['id'])); ?>
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
		<li><?php //echo $this->Html->link(__('New Secretary Word'), array('action' => 'add')); ?></li>
	</ul>
</div>-->
