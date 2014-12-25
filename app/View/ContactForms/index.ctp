<div class="contactForms index">
<?php echo $this->Html->addCrumb('Contact Form', '/ContactForms');?>
	<h2><?php echo __('Contact Form'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('name'); ?></th>
			<th><?php echo $this->Paginator->sort('email'); ?></th>
			<th><?php echo $this->Paginator->sort('phone'); ?></th>
			<th><?php echo $this->Paginator->sort('subject'); ?></th>
			<th><?php echo $this->Paginator->sort('comment'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($contactForms as $contactForm): ?>
	<tr>
		<td><?php echo h($contactForm['ContactForm']['name']); ?>&nbsp;</td>
		<td><?php echo h($contactForm['ContactForm']['email']); ?>&nbsp;</td>
		<td><?php echo h($contactForm['ContactForm']['phone']); ?>&nbsp;</td>
		<td><?php echo h($contactForm['ContactForm']['subject']); ?>&nbsp;</td>
		<td><?php echo h($contactForm['ContactForm']['comment']); ?>&nbsp;</td>
		<td>
                    <?php echo $this->Html->image('view.png', array('url' => array('action' => 'view', $contactForm['ContactForm']['id']),'title'=>'View')); ?>
                    <?php echo $this->Form->postLink($this->Html->image('delete_button.png'), array('action' => 'delete', $contactForm['ContactForm']['id']), array('escape' => false,'title'=>'Delete'), __('Are you sure you want to delete # %s?', $contactForm['ContactForm']['id'])); ?>
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
		<li><?php echo $this->Html->link(__('New ContactForm'), array('action' => 'add')); ?></li>
	</ul>
</div>
