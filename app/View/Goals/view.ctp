<div class="goals view">
<?php  echo $this->Html->addCrumb('Goal', '/Goals'); ?>
<h2><?php  echo __('Goal'); ?></h2>
	<dl>
		
		<dt><?php echo __('Goal'); ?></dt>
		<dd>
			<?php echo h($goal['Goal']['goal']); ?>
			&nbsp;
		</dd>
                <dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($goal['Goal']['created']); ?>
			&nbsp;
		</dd>
                <dt><?php echo __('Created By'); ?></dt>
                <dd>
                        <?php echo h($createuser); ?>
			&nbsp;
                </dd>
                <dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($goal['Goal']['modified']); ?>
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
		<li><?php echo $this->Html->link(__('Edit Goal'), array('action' => 'edit', $goal['Goal']['id'])); ?> </li>
		<li><?php //echo $this->Form->postLink(__('Delete Goal'), array('action' => 'delete', $goal['Goal']['id']), null, __('Are you sure you want to delete # %s?', $goal['Goal']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Goals'), array('action' => 'index')); ?> </li>
		<li><?php //echo $this->Html->link(__('New Goal'), array('action' => 'add')); ?> </li>
	</ul>
</div>
