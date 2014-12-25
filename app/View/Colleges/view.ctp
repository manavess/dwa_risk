<div class="colleges view">
<?php echo $this->Html->addCrumb('College', '/Colleges');?>
    <h2><?php echo __('College'); ?></h2>
    <div class="left-side">
        <dl>
            <dt><?php echo __('College Code'); ?></dt>
            <dd>
                <?php echo h($college['College']['college_code']); ?>
                &nbsp;
            </dd>
            <dt><?php echo __('Name'); ?></dt>
            <dd>
                <?php echo h($college['College']['name']); ?>
                &nbsp;
            </dd>
            <dt><?php echo __('Address1'); ?></dt>
            <dd>
                <?php echo h($college['College']['address1']); ?>
                &nbsp;
            </dd>
            <dt><?php echo __('Address2'); ?></dt>
            <dd>
                <?php echo h($college['College']['address2']); ?>
                &nbsp;
            </dd>
            <dt><?php echo __('Address3'); ?></dt>
            <dd>
                <?php echo h($college['College']['address3']); ?>
                &nbsp;
            </dd>
            <dt><?php echo __('City'); ?></dt>
            <dd>
                <?php echo $this->Html->link($college['City']['name'], array('controller' => 'cities', 'action' => 'view', $college['City']['id'])); ?>
                &nbsp;
            </dd>
            <dt><?php echo __('Pincode'); ?></dt>
            <dd>
                <?php echo h($college['College']['pincode']); ?>
                &nbsp;
            </dd>
            <dt><?php echo __('State'); ?></dt>
            <dd>
                <?php echo $this->Html->link($college['State']['name'], array('controller' => 'states', 'action' => 'view', $college['State']['id'])); ?>
                &nbsp;
            </dd>
            <dt><?php echo __('University'); ?></dt>
            <dd>
                <?php echo $this->Html->link($college['University']['name'], array('controller' => 'universities', 'action' => 'view', $college['University']['id'])); ?>
                &nbsp;
            </dd>
            <dt><?php echo __('Contact Person'); ?></dt>
            <dd>
                <?php echo h($college['College']['contact_person']); ?>
                &nbsp;
            </dd>
            <dt><?php echo __('Email'); ?></dt>
            <dd>
                <?php echo h($college['College']['email']); ?>
                &nbsp;
            </dd>
        </dl>
    </div>
    <div class="right-side"> <dl>
            <dt><?php echo __('Website'); ?></dt>
            <dd>
                <?php echo h($college['College']['website']); ?>
                &nbsp;
            </dd>
            <dt><?php echo __('Phone No'); ?></dt>
            <dd>
                <?php echo h($college['College']['phone_no']); ?>
                &nbsp;
            </dd>
            <dt><?php echo __('Mobile No'); ?></dt>
            <dd>
                <?php echo h($college['College']['mobile_no']); ?>
                &nbsp;
            </dd>
            <dt><?php echo __('No of Seats'); ?></dt>
            <dd>
                <?php echo h($college['College']['no_of_seats']); ?>
                &nbsp;
            </dd>
            <dt><?php echo __('Seats in different Group Subjects'); ?></dt>
            <dd>
                <?php foreach ($GroupSubjects_seats as $data): ?>
                    <?php //echo __('Group Subject Name'); ?><?php echo $this->Html->link($data['GroupSubjects']['name'],array('controller'=>'GroupSubjects','action'=>'view',$data['GroupSubjects']['id'])); ?>&nbsp;:<?php //echo __('No of Seats'); ?>&nbsp;<?php echo h($data['CollegeGroupSubject']['no_of_seat']); ?> </br>


                <?php endforeach; ?>

                &nbsp;
            </dd>
            <dt><?php echo __('Affilated From'); ?></dt>
            <dd>
                <?php $createdddate = date("d-m-Y", strtotime($college['College']['affilated_from'])); ?>
                <?php echo h($createdddate); ?>
                &nbsp;
            </dd>
            <dt><?php echo __('Affilated To'); ?></dt>
            <dd>
                <?php $affilateddate = date("d-m-Y", strtotime($college['College']['affilated_to'])); ?>
                <?php echo h($affilateddate); ?>
                &nbsp;
            </dd>
            <dt><?php echo __('Created'); ?></dt>
            <dd>
                <?php echo h($college['College']['created']); ?>
                &nbsp;
            </dd>
            <dt><?php echo __('Created By'); ?></dt>
            <dd>
                <?php echo h($createuser); ?>
                &nbsp;
            </dd>
            <dt><?php echo __('Modified'); ?></dt>
            <dd>
                <?php echo h($college['College']['modified']); ?>
                &nbsp;
            </dd>
            <dt><?php echo __('Modified By'); ?></dt>
            <dd>
                <?php echo h($modifyuser); ?>
                &nbsp;
            </dd>
        </dl></div>

</div>
<div class="actions">
    <h3><?php echo __('Actions'); ?></h3>
    <ul>
        <li><?php echo $this->Html->link(__('Edit College'), array('action' => 'edit', $college['College']['id'])); ?> </li>
        <li><?php //echo $this->Form->postLink(__('Delete College'), array('action' => 'delete', $college['College']['id']), null, __('Are you sure you want to delete # %s?', $college['College']['id'])); ?> </li>
        <li><?php echo $this->Html->link(__('List Colleges'), array('action' => 'index')); ?> </li>
        <li><?php echo $this->Html->link(__('New College'), array('action' => 'add')); ?> </li>
        <li><?php echo $this->Html->link(__('List Cities'), array('controller' => 'cities', 'action' => 'index')); ?> </li>
        <li><?php echo $this->Html->link(__('New City'), array('controller' => 'cities', 'action' => 'add')); ?> </li>
        <li><?php echo $this->Html->link(__('List States'), array('controller' => 'states', 'action' => 'index')); ?> </li>
        <li><?php echo $this->Html->link(__('New State'), array('controller' => 'states', 'action' => 'add')); ?> </li>
        <li><?php echo $this->Html->link(__('List Universities'), array('controller' => 'universities', 'action' => 'index')); ?> </li>
        <li><?php echo $this->Html->link(__('New University'), array('controller' => 'universities', 'action' => 'add')); ?> </li>
        <li><?php echo $this->Html->link(__('List College Group Subjects'), array('controller' => 'college_group_subjects', 'action' => 'index')); ?> </li>
    </ul>
</div>
