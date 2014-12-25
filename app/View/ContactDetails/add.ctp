<?php $this->TinyMCE->editor(array('theme' => 'advanced', 'mode' => 'textareas')); ?>
<?php echo $this->Html->addCrumb('Contact Details', '/ContactDetails');?>
<div class="contactDetails form">
    <?php echo $this->Form->create('ContactDetail'); ?>
    <fieldset>
        <legend><?php echo __('Add Contact Detail'); ?></legend>
        <?php
              echo $this->Form->input('pagetext', array('required'=>false));
        ?>
    </fieldset>
    <?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
    <h3><?php echo __('Actions'); ?></h3>
    <ul>

        <li><?php echo $this->Html->link(__('List Contact Details'), array('action' => 'index')); ?></li>
    </ul>
</div>
