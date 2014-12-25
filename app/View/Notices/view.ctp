<div class="notices view">
<?php  echo $this->Html->addCrumb('Notice', '/Notices'); ?>
<h2><?php  echo __('Notice'); ?></h2>
	<dl>
		<dt><?php echo __('Notice'); ?></dt>
		<dd>
			<?php echo h($notice['Notice']['notice']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($notice['Notice']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created By'); ?></dt>
                <dd>
                        <?php echo h($createuser); ?>
			&nbsp;
                </dd>
                <dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($notice['Notice']['modified']); ?>
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
		<li><?php echo $this->Html->link(__('Edit Notice'), array('action' => 'edit', $notice['Notice']['id'])); ?> </li>
		<li><?php //echo $this->Form->postLink(__('Delete Notice'), array('action' => 'delete', $notice['Notice']['id']), null, __('Are you sure you want to delete # %s?', $notice['Notice']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Notices'), array('action' => 'index')); ?> </li>
		<li><?php //echo $this->Html->link(__('New Notice'), array('action' => 'add')); ?> </li>
	</ul>
</div>
