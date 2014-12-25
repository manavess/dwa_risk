<div class="admissionGuides index">
<?php echo $this->Html->addCrumb('Admission Guide', '/AdmissionGuides');?>
    <h2><?php echo __('Admission Guides'); ?></h2>
    <table cellpadding="0" cellspacing="0">
        <tr>
            <th><?php echo $this->Paginator->sort('admission_guide'); ?></th>
            <th class="actions"><?php echo __('Actions'); ?></th>
        </tr>
        <?php foreach ($admissionGuides as $admissionGuide): ?>
            <tr>
                <td><?php echo h(strip_tags($admissionGuide['AdmissionGuide']['admission_guide'])); ?>&nbsp;</td>
                <td width="8%">
                    <?php echo $this->Html->image('view.png', array('url' => array('action' => 'view', $admissionGuide['AdmissionGuide']['id']),'title'=>'View')); ?>
                    <?php echo $this->Html->image('edit_button.png', array('url' => array('action' => 'edit', $admissionGuide['AdmissionGuide']['id']),'title'=>'Edit')); ?>
                    <?php //echo $this->Form->postLink($this->Html->image('delete_button.png'), array('action' => 'delete', $admissionGuide['AdmissionGuide']['id']), array('escape' => false,'title'=>'Delete'), __('Are you sure you want to delete # %s?', $admissionGuide['AdmissionGuide']['id'])); ?>
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
