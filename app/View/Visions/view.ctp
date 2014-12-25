<div class="visions view">
<?php  echo $this->Html->addCrumb('Vision', '/Visions'); ?>
<h2><?php  echo __('Vision'); ?></h2>
	<dl>
		<dt><?php echo __('Vision'); ?></dt>
		<dd>
			<?php echo h($vision['Vision']['vision']); ?>
			&nbsp;
		</dd>
                <dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($vision['Vision']['created']); ?>
			&nbsp;
		</dd>
                <dt><?php echo __('Created By'); ?></dt>
                <dd>
                        <?php echo h($createuser); ?>
			&nbsp;
                </dd>
                <dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($vision['Vision']['modified']); ?>
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
		<li><?php echo $this->Html->link(__('Edit Vision'), array('action' => 'edit', $vision['Vision']['id'])); ?> </li>
		<li><?php //echo $this->Form->postLink(__('Delete Vision'), array('action' => 'delete', $vision['Vision']['id']), null, __('Are you sure you want to delete # %s?', $vision['Vision']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Visions'), array('action' => 'index')); ?> </li>
		<li><?php //echo $this->Html->link(__('New Vision'), array('action' => 'add')); ?> </li>
	</ul>
</div>
