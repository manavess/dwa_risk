<div class="studentRegistrations form">
    <?php echo $this->Form->create('UpgradedStudent'); ?>
    <fieldset>
        <div class='heading'><span><?php echo __('UPGRADATING ADMISSION'); ?></span><br><?php echo __('ACADEMIC YEAR 2012/2013'); ?></div>

        <div class="form-area">
            <div class="left-area">
                <?php
                echo $this->Form->input('application_number', array('type' => 'text'));
                echo $this->Form->input('student_registration_id', array('label' => 'Applicant Name', 'type' => 'text', 'id' => 'stdname'));
                ?>
            </div>
            <div class="right-area">    
                <?php
                echo $this->Form->input('from_course_id', array('label' => 'Current Course'));
                echo $this->Form->input('to_course_id', array('label' => 'Upgrade To Course'));
                ?>
            </div>

            <span style=""><?php echo $this->Form->input('remarks'); ?></span>
        </div>
    </fieldset>
    <?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
    <h3><?php echo __('Actions'); ?></h3>
    <ul>

        <li><?php echo $this->Html->link(__('List Upgraded Students'), array('action' => 'index')); ?></li>
    </ul>
</div>