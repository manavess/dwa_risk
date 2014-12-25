<div class="gradepoints view">
<h2><?php  echo __('Gradepoint'); ?></h2>
	<dl>
		<dt><?php echo __('Gradepoints'); ?></dt>
		<dd>
			<?php echo h($gradepoint['Gradepoint']['gradepoints']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Lowerlimit'); ?></dt>
		<dd>
			<?php echo h($gradepoint['Gradepoint']['lowerlimit']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Higherlimit'); ?></dt>
		<dd>
			<?php echo h($gradepoint['Gradepoint']['higherlimit']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Remarks'); ?></dt>
		<dd>
			<?php echo h($gradepoint['Gradepoint']['remarks']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($gradepoint['Gradepoint']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created By'); ?></dt>
		<dd>
			<?php  echo $this->html->link($gradepoint['User']['username'], array('controller' => 'Users', 'action' => 'view', $gradepoint['Gradepoint']['created_by'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($gradepoint['Gradepoint']['modified']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified By'); ?></dt>
		<dd>
                    <?php  echo $this->html->link($gradepoint['User']['username'], array('controller' => 'Users', 'action' => 'view', $gradepoint['Gradepoint']['modified_by'])); ?>
			
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Gradepoint'), array('action' => 'edit', $gradepoint['Gradepoint']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Gradepoint'), array('action' => 'delete', $gradepoint['Gradepoint']['id']), null, __('Are you sure you want to delete # %s?', $gradepoint['Gradepoint']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Gradepoints'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Gradepoint'), array('action' => 'add')); ?> </li>
	</ul>
</div>
