<div class="states view">
<?php  echo $this->Html->addCrumb("State", '/States'); ?>
<h2><?php  echo __('State'); ?></h2>
	<dl>
		
		<dt><?php echo __('Name'); ?></dt>
		<dd>
			<?php echo h($state['State']['name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Country'); ?></dt>
		<dd>
			<?php echo $this->Html->link($state['Country']['name'], array('controller' => 'countries', 'action' => 'view', $state['Country']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
                    <?php echo h($state['State']['created']); ?>
			&nbsp;
		</dd>
                <dt><?php echo __('Created By'); ?></dt>
                <dd>
                    <?php echo h($createuser); ?>
			&nbsp;
                </dd>
                <dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($state['State']['modified']); ?>
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
		<li><?php echo $this->Html->link(__('Edit State'), array('action' => 'edit', $state['State']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete State'), array('action' => 'delete', $state['State']['id']), null, __('Are you sure you want to delete # %s?', $state['State']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List States'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New State'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Countries'), array('controller' => 'countries', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Country'), array('controller' => 'countries', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Cities'), array('controller' => 'cities', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New City'), array('controller' => 'cities', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Colleges'), array('controller' => 'colleges', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New College'), array('controller' => 'colleges', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Universities'), array('controller' => 'universities', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New University'), array('controller' => 'universities', 'action' => 'add')); ?> </li>
	</ul>
</div>
