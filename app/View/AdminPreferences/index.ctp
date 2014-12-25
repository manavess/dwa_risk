<div class="adminPreferences index">
<?php echo $this->Html->addCrumb('Admin Preference', '/AdminPreferences');?>
    <h2><?php echo __('Admin Preferences'); ?></h2>
    
    <table cellpadding="0" cellspacing="0">
        <tr>
            <th><?php echo $this->Paginator->sort('no_of_college'); ?></th>
            <th><?php echo $this->Paginator->sort('domestic_application_fee'); ?></th>
            <th><?php echo $this->Paginator->sort('international_application_fee'); ?></th>
            <th><?php echo $this->Paginator->sort('year'); ?></th>
            <th><?php echo $this->Paginator->sort('cut_off_date'); ?></th>
            <th class="actions"><?php echo __('Actions'); ?></th>
        </tr>
        <?php foreach ($adminPreferences as $adminPreference): ?>
            <tr>
                <td><?php echo h($adminPreference['AdminPreference']['no_of_college']); ?>&nbsp;</td>
                <td><?php echo h($adminPreference['AdminPreference']['domestic_application_fee']); ?>&nbsp;</td>
                <td><?php echo h($adminPreference['AdminPreference']['international_application_fee']); ?>&nbsp;</td>
                <td><?php echo h($adminPreference['AdminPreference']['year']); ?>&nbsp;</td>
                <td><?php echo h($adminPreference['AdminPreference']['cut_off_date']); ?>&nbsp;</td>
                <td>
                    <?php echo $this->Html->image('view.png', array('url' => array('action' => 'view', $adminPreference['AdminPreference']['id']),'title'=>'View')); ?>
                    <?php echo $this->Html->image('edit_button.png', array('url' => array('action' => 'edit', $adminPreference['AdminPreference']['id']),'title'=>'Edit')); ?>
                    <?php //echo $this->Form->postLink($this->Html->image('delete_button.png'), array('action' => 'delete', $adminPreference['AdminPreference']['id']), array('escape' => false,'title'=>'Delete'), __('Are you sure you want to delete # %s?', $adminPreference['AdminPreference']['id'])); ?>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
    <p>
        <?php
        echo $this->Paginator->counter(array(
            'format' => __('Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}')
        ));
        ?>	</p>
    <div class="paging">
        <?php
        echo $this->Paginator->prev('< ' . __('previous'), array(), null, array('class' => 'prev disabled'));
        echo $this->Paginator->numbers(array('separator' => ''));
        echo $this->Paginator->next(__('next') . ' >', array(), null, array('class' => 'next disabled'));
        ?>
    </div>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('New Admin Preferences'), array('action' => 'add')); ?></li>
	</ul>
</div>	
