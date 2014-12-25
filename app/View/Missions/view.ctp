<div class="missions view">
<?php  echo $this->Html->addCrumb('Mission', '/Missions'); ?>
<h2><?php  echo __('Mission'); ?></h2>
	<dl>
		<dt><?php echo __('Mission'); ?></dt>
		<dd>
			<?php echo h($mission['Mission']['mission']); ?>
			&nbsp;
		</dd>
                <dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($mission['Mission']['created']); ?>
			&nbsp;
		</dd>
                <dt><?php echo __('Created By'); ?></dt>
                <dd>
                        <?php echo h($createuser); ?>
			&nbsp;
                </dd>
                <dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($mission['Mission']['modified']); ?>
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
		<li><?php echo $this->Html->link(__('Edit Mission'), array('action' => 'edit', $mission['Mission']['id'])); ?> </li>
		<li><?php //echo $this->Form->postLink(__('Delete Mission'), array('action' => 'delete', $mission['Mission']['id']), null, __('Are you sure you want to delete # %s?', $mission['Mission']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Missions'), array('action' => 'index')); ?> </li>
		<li><?php //echo $this->Html->link(__('New Mission'), array('action' => 'add')); ?> </li>
	</ul>
</div>
