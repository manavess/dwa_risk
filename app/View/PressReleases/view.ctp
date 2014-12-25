<div class="pressReleases view">
<?php  echo $this->Html->addCrumb('Press Release', '/PressReleases'); ?>
<h2><?php  echo __('Press Release'); ?></h2>
	<dl>
		<dt><?php echo __('Press Release'); ?></dt>
		<dd>
			<?php echo h($pressRelease['PressRelease']['press_release']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($pressRelease['PressRelease']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created By'); ?></dt>
                <dd>
                        <?php echo h($createuser); ?>
			&nbsp;
                </dd>
                <dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($pressRelease['PressRelease']['modified']); ?>
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
		<li><?php echo $this->Html->link(__('Edit Press Release'), array('action' => 'edit', $pressRelease['PressRelease']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Press Releases'), array('action' => 'index')); ?> </li>
	</ul>
</div>
