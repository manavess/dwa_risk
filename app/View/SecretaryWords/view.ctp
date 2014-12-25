<div class="secretaryWords view">
<?php  echo $this->Html->addCrumb("Secretary's Word", '/SecretaryWords'); ?>
<h2><?php  echo __('Secretary Words'); ?></h2>
	<dl>
		<dt><?php echo __('Secretary Words'); ?></dt>
		<dd>
			<?php echo h($secretaryWord['SecretaryWord']['secretary_word']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($secretaryWord['SecretaryWord']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created By'); ?></dt>
                <dd>
                        <?php echo h($createuser); ?>
			&nbsp;
                </dd>
                <dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($secretaryWord['SecretaryWord']['modified']); ?>
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
		<li><?php echo $this->Html->link(__('Edit Secretary Words'), array('action' => 'edit', $secretaryWord['SecretaryWord']['id'])); ?> </li>
		<li><?php //echo $this->Form->postLink(__('Delete Secretary Word'), array('action' => 'delete', $secretaryWord['SecretaryWord']['id']), null, __('Are you sure you want to delete # %s?', $secretaryWord['SecretaryWord']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Secretary Words'), array('action' => 'index')); ?> </li>
		<li><?php //echo $this->Html->link(__('New Secretary Word'), array('action' => 'add')); ?> </li>
	</ul>
</div>
