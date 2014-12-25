<div class="universities index">
<?php  echo $this->Html->addCrumb("University", '/Universities'); ?>
    <h2><?php echo __('Universities'); ?></h2>
    <table cellpadding="0" cellspacing="0">
        <tr>
            <th><?php echo $this->Paginator->sort('name'); ?></th>
            <th><?php echo $this->Paginator->sort('city'); ?></th>
            <th><?php echo $this->Paginator->sort('state'); ?></th>
            <th><?php echo $this->Paginator->sort('contact_person'); ?></th>
            <th class="actions"><?php echo __('Actions'); ?></th>
        </tr>
        <?php foreach ($universities as $university): ?>
            <tr>
                <td><?php echo h($university['University']['name']); ?>&nbsp;</td>
                <td><?php echo h($university['City']['name']); ?>&nbsp;</td>
                <td><?php echo h($university['State']['name']); ?>&nbsp;</td>
                <td><?php echo h($university['University']['contact_person']); ?>&nbsp;</td>
                <td>
                    <?php echo $this->Html->image('view.png', array('url' => array('action' => 'view', $university['University']['id']),'title'=>'View')); ?>
                    <?php echo $this->Html->image('edit_button.png', array('url' => array('action' => 'edit', $university['University']['id']),'title'=>'Edit')); ?>
                    <?php echo $this->Form->postLink($this->Html->image('delete_button.png'), array('action' => 'delete', $university['University']['id']), array('escape' => false,'title'=>'Delete'), __('Are you sure you want to delete # %s?', $university['University']['id'])); ?>
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
        <li><?php echo $this->Html->link(__('New University'), array('action' => 'add')); ?></li>
        <li><?php echo $this->Html->link(__('List Cities'), array('controller' => 'cities', 'action' => 'index')); ?> </li>
        <li><?php echo $this->Html->link(__('New City'), array('controller' => 'cities', 'action' => 'add')); ?> </li>
        <li><?php echo $this->Html->link(__('List States'), array('controller' => 'states', 'action' => 'index')); ?> </li>
        <li><?php echo $this->Html->link(__('New State'), array('controller' => 'states', 'action' => 'add')); ?> </li>
        <li><?php echo $this->Html->link(__('List Colleges'), array('controller' => 'colleges', 'action' => 'index')); ?> </li>
        <li><?php echo $this->Html->link(__('New College'), array('controller' => 'colleges', 'action' => 'add')); ?> </li>
    </ul>
</div>
