<div class="directorWords view">
<?php echo $this->Html->addCrumb("Director's Word", '/DirectorWords');?>
<h2><?php  echo __('Director Words'); ?></h2>
	<dl>
		<dt><?php echo __('Director Words'); ?></dt>
		<dd>
			<?php echo h($directorWord['DirectorWord']['director_word']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($directorWord['DirectorWord']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created By'); ?></dt>
                <dd>
                        <?php echo h($createuser); ?>
			&nbsp;
                </dd>
                <dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($directorWord['DirectorWord']['modified']); ?>
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
		<li><?php echo $this->Html->link(__('Edit Director Words'), array('action' => 'edit', $directorWord['DirectorWord']['id'])); ?> </li>
		<li><?php //echo $this->Form->postLink(__('Delete Director Word'), array('action' => 'delete', $directorWord['DirectorWord']['id']), null, __('Are you sure you want to delete # %s?', $directorWord['DirectorWord']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Director Words'), array('action' => 'index')); ?> </li>
		<li><?php //echo $this->Html->link(__('New Director Word'), array('action' => 'add')); ?> </li>
	</ul>
</div>
