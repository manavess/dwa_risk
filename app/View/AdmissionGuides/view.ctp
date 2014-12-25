<div class="admissionGuides view">
<?php echo $this->Html->addCrumb('Admission Guide', '/AdmissionGuides');?>
    <h2><?php echo __('Admission Guide'); ?></h2>
    <dl>
        <dt><?php echo __('Admission Guide'); ?></dt>
        <dd>
            <?php echo h($admissionGuide['AdmissionGuide']['admission_guide']); ?>
            &nbsp;
        </dd>
        <dt><?php echo __('Image'); ?></dt>
        <dd>
           
            <img src="data:image/jpeg;base64, <?php echo base64_encode($admissionGuide['AdmissionGuide']['image']);?>" />
            &nbsp;
        </dd>
        <dt><?php echo __('Created'); ?></dt>
        <dd>
            <?php echo h($admissionGuide['AdmissionGuide']['created']); ?>
            &nbsp;
        </dd>
         <dt><?php echo __('Created By'); ?></dt>
                <dd>
                        <?php echo h($createuser); ?>
			&nbsp;
                </dd>
        <dt><?php echo __('Modified'); ?></dt>
        <dd>
            <?php echo h($admissionGuide['AdmissionGuide']['modified']); ?>
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
        <li><?php echo $this->Html->link(__('Edit Admission Guide'), array('action' => 'edit', $admissionGuide['AdmissionGuide']['id'])); ?> </li>
        <li><?php //echo $this->Form->postLink(__('Delete Admission Guide'), array('action' => 'delete', $admissionGuide['AdmissionGuide']['id']), null, __('Are you sure you want to delete # %s?', $admissionGuide['AdmissionGuide']['id'])); ?> </li>
        <li><?php echo $this->Html->link(__('List Admission Guides'), array('action' => 'index')); ?> </li>
        <li><?php //echo $this->Html->link(__('New Admission Guide'), array('action' => 'add')); ?> </li>
    </ul>
</div>
