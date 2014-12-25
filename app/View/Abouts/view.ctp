<?php echo $this->Html->addCrumb('About us', '/Abouts');?>
<div class="abouts view">
<h2><?php  echo __('About Us'); ?></h2>
	<dl>
		<dt><?php echo __('Pagetext'); ?></dt>
		<dd>
			<?php echo h($about['About']['pagetext']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($about['About']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created By'); ?></dt>
                <dd>
                        <?php echo h($createuser); ?>
			&nbsp;
                </dd>
                <dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($about['About']['modified']); ?>
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
		<li><?php echo $this->Html->link(__('Edit About'), array('action' => 'edit', $about['About']['id'])); ?> </li>
		<li><?php //echo $this->Form->postLink(__('Delete About'), array('action' => 'delete', $about['About']['id']), null, __('Are you sure you want to delete # %s?', $about['About']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Abouts'), array('action' => 'index')); ?> </li>
		<li><?php //echo $this->Html->link(__('New About'), array('action' => 'add')); ?> </li>
	</ul>
</div>
