<?php echo $this->Html->addCrumb('About Ministries', '/AboutMinistries');?>
<div class="aboutMinistries view">
<h2><?php  echo __('About Ministry'); ?></h2>
	<dl>
		<dt><?php echo __('About Us'); ?></dt>
		<dd>
			<?php echo h($aboutMinistry['AboutMinistry']['about_us']); ?>
			&nbsp;
		</dd>
                <dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($aboutMinistry['AboutMinistry']['created']); ?>
			&nbsp;
		</dd>
                <dt><?php echo __('Created By'); ?></dt>
                <dd>
                        <?php echo h($createuser); ?>
			&nbsp;
                </dd>
                <dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($aboutMinistry['AboutMinistry']['modified']); ?>
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
		<li><?php echo $this->Html->link(__('Edit About Ministry'), array('action' => 'edit', $aboutMinistry['AboutMinistry']['id'])); ?> </li>
		<li><?php //echo $this->Form->postLink(__('Delete About Ministry'), array('action' => 'delete', $aboutMinistry['AboutMinistry']['id']), null, __('Are you sure you want to delete # %s?', $aboutMinistry['AboutMinistry']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List About Ministries'), array('action' => 'index')); ?> </li>
		<li><?php //echo $this->Html->link(__('New About Ministry'), array('action' => 'add')); ?> </li>
	</ul>
</div>
