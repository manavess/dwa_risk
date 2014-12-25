<div class="users form">
<?php  echo $this->Html->addCrumb("User", '/Users'); ?>
    <?php echo $this->Form->create('User'); ?>
    <fieldset>
        <legend><?php echo __('Add User'); ?></legend>
        <?php $active = array('Y' => 'Yes', 'N' => 'No'); ?>
        <?php
        echo $this->Form->input('username', array('required'=>false));
        echo $this->Form->input('password', array('required'=>false));
        echo $this->Form->input('email', array('required'=>false));
        echo $this->Form->input('group_id', array('empty' => 'Select','options' => $groups));
        echo $this->Form->input('active', array('type' => 'radio', 'class' => 'radio', 'checked' => 'checked', 'options' => $active));
        ?>
    </fieldset>
    <?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
    <h3><?php echo __('Actions'); ?></h3>
    <ul>

        <li><?php echo $this->Html->link(__('List Users'), array('action' => 'index')); ?></li>
    </ul>
</div>
