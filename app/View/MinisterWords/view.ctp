<div class="ministerWords view">
<?php  echo $this->Html->addCrumb("Minister's Word", '/MinisterWords'); ?>
<h2><?php  echo __('Minister Words'); ?></h2>
	<dl>
		<dt><?php echo __('Minister Words'); ?></dt>
		<dd>
			<?php echo h($ministerWord['MinisterWord']['minister_word']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($ministerWord['MinisterWord']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created By'); ?></dt>
                <dd>
                        <?php echo h($createuser); ?>
			&nbsp;
                </dd>
                <dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($ministerWord['MinisterWord']['modified']); ?>
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
		<li><?php echo $this->Html->link(__('Edit Minister Words'), array('action' => 'edit', $ministerWord['MinisterWord']['id'])); ?> </li>
		<li><?php //echo $this->Form->postLink(__('Delete Minister Word'), array('action' => 'delete', $ministerWord['MinisterWord']['id']), null, __('Are you sure you want to delete # %s?', $ministerWord['MinisterWord']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Minister Words'), array('action' => 'index')); ?> </li>
		<li><?php //echo $this->Html->link(__('New Minister Word'), array('action' => 'add')); ?> </li>
	</ul>
</div>
