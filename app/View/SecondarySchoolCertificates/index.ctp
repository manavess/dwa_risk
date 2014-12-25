<div class="secondarySchoolCertificates index">
<?php  echo $this->Html->addCrumb('Secondary School Certificate', '/SecondarySchoolCertificates'); ?>
    <h2><?php echo __('Secondary School Certificates'); ?></h2>
    <table cellpadding="0" cellspacing="0">
        <tr>
            <th><?php echo $this->Paginator->sort('certificate_number'); ?></th>
            <th><?php echo $this->Paginator->sort('certificate_type'); ?></th>
            <th><?php echo $this->Paginator->sort('date_of_birth'); ?></th>
            <th><?php echo $this->Paginator->sort('certificate_date'); ?></th>
            <th><?php echo $this->Paginator->sort('year'); ?></th>
            <th class="actions"><?php echo __('Actions'); ?></th>
        </tr>
        <?php foreach ($secondarySchoolCertificates as $secondarySchoolCertificate): ?>
            <tr>
                <td><?php echo h($secondarySchoolCertificate['SecondarySchoolCertificate']['certificate_number']); ?>&nbsp;</td>
                <td><?php echo h($secondarySchoolCertificate['SecondarySchoolCertificate']['certificate_type']); ?>&nbsp;</td>
                <td><?php echo h($secondarySchoolCertificate['SecondarySchoolCertificate']['date_of_birth']); ?>&nbsp;</td>
                <td><?php echo h($secondarySchoolCertificate['SecondarySchoolCertificate']['certificate_date']); ?>&nbsp;</td>
                <td><?php echo h($secondarySchoolCertificate['SecondarySchoolCertificate']['year']); ?>&nbsp;</td>

                <td class="">
                    <?php echo $this->Html->image('view.png', array('url' => array('action' => 'view', $secondarySchoolCertificate['SecondarySchoolCertificate']['id']),'title'=>'View')); ?>
                    <?php //echo $this->Html->image('edit_button.png', array('url' => array('action' => 'edit', $secondarySchoolCertificate['SecondarySchoolCertificate']['id']),'title'=>'Edit')); ?>
                    <?php echo $this->Form->postLink($this->Html->image('delete_button.png'), array('action' => 'delete', $secondarySchoolCertificate['SecondarySchoolCertificate']['id']), array('escape' => false,'title'=>'Delete'), __('Are you sure you want to delete # %s?', $secondarySchoolCertificate['SecondarySchoolCertificate']['id'])); ?>
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
        <li><?php echo $this->Html->link(__('Upload Secondary School Certificate'), array('action' => 'uploadsecondarycertificate')); ?></li>
    </ul>
</div>
