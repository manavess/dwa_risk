<div class="employees index">
<?php echo $this->Html->addCrumb('Employee', '/Employees');?>
    <h2><?php echo __('Employees'); ?></h2>
    <table cellpadding="0" cellspacing="0">
        <tr>
            <th><?php echo $this->Paginator->sort('code'); ?></th>
            <th><?php echo $this->Paginator->sort('name'); ?></th>
            <th><?php echo $this->Paginator->sort('date_of_confirm_joining'); ?></th>
            <th><?php echo $this->Paginator->sort('experiance'); ?></th>
            <th><?php echo $this->Paginator->sort('date_of_resignation'); ?></th>
            <th class="actions"><?php echo __('Actions'); ?></th>
        </tr>
        <?php foreach ($employees as $employee): ?>
            <tr>
                <td><?php echo h($employee['Employee']['code']); ?>&nbsp;</td>
                <td><?php echo h($employee['Employee']['name']); ?>&nbsp;</td>
                <td><?php $confirmationddate = date("d-m-Y", strtotime($employee['Employee']['date_of_confirm_joining'])); ?><?php echo h($confirmationddate); ?>&nbsp;</td>
                <td><?php echo h($employee['Employee']['experiance']); ?>&nbsp;</td>
                <td><?php $regisionddate = date("d-m-Y", strtotime($employee['Employee']['date_of_resignation'])); ?><?php echo h($regisionddate); ?>&nbsp;</td>
                <td>
                    <?php echo $this->Html->image('view.png', array('url' => array('action' => 'view', $employee['Employee']['id']),'title'=>'View')); ?>
                    <?php echo $this->Html->image('edit_button.png', array('url' => array('action' => 'edit', $employee['Employee']['id']),'title'=>'Edit')); ?>
                    <?php echo $this->Form->postLink($this->Html->image('delete_button.png'), array('action' => 'delete', $employee['Employee']['id']), array('escape' => false,'title'=>'Delete'), __('Are you sure you want to delete # %s?', $employee['Employee']['id'])); ?>
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
        <li><?php echo $this->Html->link(__('New Employee'), array('action' => 'add')); ?></li>
    </ul>
</div>
