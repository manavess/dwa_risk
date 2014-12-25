<div class="contactDetails view">
<?php echo $this->Html->addCrumb('Contact Details', '/ContactDetails');?>
<h2><?php  echo __('Contact Detail'); ?></h2>
	<dl>
		<dt><?php echo __('Page Text'); ?></dt>
		<dd>
			<?php echo h($contactDetail['ContactDetail']['pagetext']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($contactDetail['ContactDetail']['created']); ?>
			&nbsp;
		</dd>
                <dt><?php echo __('Created By'); ?></dt>
                <dd>
                        <?php echo h($createuser); ?>
			&nbsp;
                </dd>
                <dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($contactDetail['ContactDetail']['modified']); ?>
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
		<li><?php echo $this->Html->link(__('Edit Contact Detail'), array('action' => 'edit', $contactDetail['ContactDetail']['id'])); ?> </li>
		<li><?php //echo $this->Form->postLink(__('Delete Contact Detail'), array('action' => 'delete', $contactDetail['ContactDetail']['id']), null, __('Are you sure you want to delete # %s?', $contactDetail['ContactDetail']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Contact Details'), array('action' => 'index')); ?> </li>
		<li><?php //echo $this->Html->link(__('New Contact Detail'), array('action' => 'add')); ?> </li>
	</ul>
</div>
