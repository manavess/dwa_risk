<div class="applicantinfos view">
<?php echo $this->Html->addCrumb('Applicant info', '/Applicantinfos');?>
<h2><?php  echo __('Applicantinfo'); ?></h2>
	<dl>
		
		<dt><?php echo __('Pagetext'); ?></dt>
		<dd>
			<?php echo h($applicantinfo['Applicantinfo']['pagetext']); ?>
			&nbsp;
		</dd>
                <dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($applicantinfo['Applicantinfo']['created']); ?>
			&nbsp;
		</dd>
                <dt><?php echo __('Created By'); ?></dt>
                <dd>
                        <?php echo h($createuser); ?>
			&nbsp;
                </dd>
                <dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($applicantinfo['Applicantinfo']['modified']); ?>
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
		<li><?php echo $this->Html->link(__('Edit Applicantinfo'), array('action' => 'edit', $applicantinfo['Applicantinfo']['id'])); ?> </li>
		<li><?php //echo $this->Form->postLink(__('Delete Applicantinfo'), array('action' => 'delete', $applicantinfo['Applicantinfo']['id']), null, __('Are you sure you want to delete # %s?', $applicantinfo['Applicantinfo']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Applicantinfos'), array('action' => 'index')); ?> </li>
		<li><?php //echo $this->Html->link(__('New Applicantinfo'), array('action' => 'add')); ?> </li>
	</ul>
</div>
