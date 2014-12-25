<div class="overviews view">
<?php  echo $this->Html->addCrumb('Overview', '/Overviews'); ?>
<h2><?php  echo __('Overview'); ?></h2>
	<dl>
		<dt><?php echo __('Overview'); ?></dt>
		<dd>
			<?php echo h($overview['Overview']['overview']); ?>
			&nbsp;
		</dd>
                <dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($overview['Overview']['created']); ?>
			&nbsp;
		</dd>
                <dt><?php echo __('Created By'); ?></dt>
                <dd>
                        <?php echo h($createuser); ?>
			&nbsp;
                </dd>
                <dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($overview['Overview']['modified']); ?>
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
		<li><?php echo $this->Html->link(__('Edit Overview'), array('action' => 'edit', $overview['Overview']['id'])); ?> </li>
		<li><?php //echo $this->Form->postLink(__('Delete Overview'), array('action' => 'delete', $overview['Overview']['id']), null, __('Are you sure you want to delete # %s?', $overview['Overview']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Overviews'), array('action' => 'index')); ?> </li>
		<li><?php //echo $this->Html->link(__('New Overview'), array('action' => 'add')); ?> </li>
	</ul>
</div>
