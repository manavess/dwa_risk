<div class="adminPreferences view">
<?php echo $this->Html->addCrumb('Admin Preference', '/AdminPreferences');?>
<h2><?php  echo __('Admin Preference'); ?></h2>

	<dl>
		
		<dt><?php echo __('Cut Off Date'); ?></dt>
		<dd>
			<?php echo h(date('d-m-Y',strtotime($adminPreference['AdminPreference']['cut_off_date']))); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('No Of College'); ?></dt>
		<dd>
			<?php echo h($adminPreference['AdminPreference']['no_of_college']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Domestic Application Fee'); ?></dt>
		<dd>
			<?php echo h($adminPreference['AdminPreference']['domestic_application_fee']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('International Application Fee'); ?></dt>
		<dd>
			<?php echo h($adminPreference['AdminPreference']['international_application_fee']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Year'); ?></dt>
		<dd>
			<?php echo h($adminPreference['AdminPreference']['year']); ?>
			&nbsp;
		</dd>
                <dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($adminPreference['AdminPreference']['created']); ?>
			&nbsp;
		</dd>
                <dt><?php echo __('Created By'); ?></dt>
                <dd>
                        <?php echo h($createuser); ?>
			&nbsp;
                </dd>
                <dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($adminPreference['AdminPreference']['modified']); ?>
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
		<li><?php echo $this->Html->link(__('Edit Admin Preference'), array('action' => 'edit', $adminPreference['AdminPreference']['id'])); ?> </li>
		<li><?php //echo $this->Form->postLink(__('Delete Admin Preference'), array('action' => 'delete', $adminPreference['AdminPreference']['id']), null, __('Are you sure you want to delete # %s?', $adminPreference['AdminPreference']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Admin Preferences'), array('action' => 'index')); ?> </li>
		<li><?php //echo $this->Html->link(__('New Admin Preference'), array('action' => 'add')); ?> </li>
	</ul>
</div>
