<div class="contactDetails index">
<?php echo $this->Html->addCrumb('Contact Details', '/ContactDetails');?>
    <h2><?php echo __('Contact Detail'); ?></h2>
    <table cellpadding="0" cellspacing="0">
        <tr>
            <th><?php echo $this->Paginator->sort('pagetext'); ?></th>
             <th class="actions"><?php echo __('Actions'); ?></th>
        </tr>
        <?php foreach ($contactDetails as $contactDetail): ?>
            <tr>
                <td><?php echo h(strip_tags($contactDetail['ContactDetail']['pagetext'])); ?>&nbsp;</td>
                 <td>
                    <?php echo $this->Html->image('view.png', array('url' => array('action' => 'view', $contactDetail['ContactDetail']['id']),'title'=>'View')); ?>
                    <?php echo $this->Html->image('edit_button.png', array('url' => array('action' => 'edit', $contactDetail['ContactDetail']['id']),'title'=>'Edit')); ?>
                    <?php //echo $this->Form->postLink($this->Html->image('delete_button.png'), array('action' => 'delete', $contactDetail['ContactDetail']['id']), array('escape' => false,'title'=>'Delete'), __('Are you sure you want to delete # %s?', $contactDetail['ContactDetail']['id'])); ?>
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
<!--<div class="actions">
    <h3><?php //echo __('Actions'); ?></h3>
    <ul>
        <li><?php //echo $this->Html->link(__('New ContactDetail'), array('action' => 'add')); ?></li>
    </ul>
</div>-->
