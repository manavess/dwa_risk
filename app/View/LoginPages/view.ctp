<div class="loginPages view">
<h2><?php  echo __('Login Page'); ?></h2>
	<dl>
		<dt><?php echo __('Pagetext'); ?></dt>
		<dd>
			<?php echo h($loginPage['LoginPage']['pagetext']); ?>
			&nbsp;
		</dd>
                <dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($loginPage['LoginPage']['created']); ?>
			&nbsp;
		</dd>
                <dt><?php echo __('Created By'); ?></dt>
                <dd>
                        <?php echo h($createuser); ?>
			&nbsp;
                </dd>
                <dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($loginPage['LoginPage']['modified']); ?>
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
		<li><?php echo $this->Html->link(__('Edit Login Page'), array('action' => 'edit', $loginPage['LoginPage']['id'])); ?> </li>
		<li><?php //echo $this->Form->postLink(__('Delete Login Page'), array('action' => 'delete', $loginPage['LoginPage']['id']), null, __('Are you sure you want to delete # %s?', $loginPage['LoginPage']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Login Pages'), array('action' => 'index')); ?> </li>
		<li><?php //echo $this->Html->link(__('New Login Page'), array('action' => 'add')); ?> </li>
	</ul>
</div>
