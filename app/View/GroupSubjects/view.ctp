<div class="groupSubjects view">
<?php  echo $this->Html->addCrumb('Group Subject', '/GroupSubjects'); ?>
<h2><?php  echo __('Group Subject'); ?></h2>
	<dl>
		
		<dt><?php echo __('Name'); ?></dt>
		<dd>
			<?php echo h($groupSubject['GroupSubject']['name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Subjects'); ?></dt>
                <dd>
                        <?php echo h($subjectName); ?>
			&nbsp;
                </dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($groupSubject['GroupSubject']['created']); ?>
			&nbsp;
		</dd>
                <dt><?php echo __('Created By'); ?></dt>
                <dd>
                        <?php echo h($createuser); ?>
			&nbsp;
                </dd>
                <dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($groupSubject['GroupSubject']['modified']); ?>
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
		<li><?php echo $this->Html->link(__('Edit Group Subject'), array('action' => 'edit', $groupSubject['GroupSubject']['id'])); ?> </li>
		<li><?php //echo $this->Form->postLink(__('Delete Group Subject'), array('action' => 'delete', $groupSubject['GroupSubject']['id']), null, __('Are you sure you want to delete # %s?', $groupSubject['GroupSubject']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Group Subjects'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Group Subject'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Group Sub Subjects'), array('controller' => 'group_sub_subjects', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('List College Group Subjects'), array('controller' => 'college_group_subjects', 'action' => 'index')); ?> </li>
	</ul>
</div>
