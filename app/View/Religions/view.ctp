<div class="religions view">
<?php  echo $this->Html->addCrumb('Religion', '/Religions'); ?>
<h2><?php  echo __('Religion'); ?></h2>
	<dl>
		
		<dt><?php echo __('Name'); ?></dt>
		<dd>
			<?php echo h($religion['Religion']['name']); ?>
			&nbsp;
		</dd>
                <dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($religion['Religion']['created']); ?>
			&nbsp;
		</dd>
                <dt><?php echo __('Created By'); ?></dt>
                <dd>
                        <?php echo h($createuser); ?>
			&nbsp;
                </dd>
                <dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($religion['Religion']['modified']); ?>
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
		<li><?php echo $this->Html->link(__('Edit Religion'), array('action' => 'edit', $religion['Religion']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Religion'), array('action' => 'delete', $religion['Religion']['id']), null, __('Are you sure you want to delete # %s?', $religion['Religion']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Religions'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Religion'), array('action' => 'add')); ?> </li>
	</ul>
</div>
