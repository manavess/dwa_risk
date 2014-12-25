<div class="cities form">
<?php echo $this->Html->addCrumb('City', '/Cities');?>
    <?php echo $this->Form->create('City'); ?>

    <fieldset>
        <legend><?php echo __('Add City'); ?></legend>
        <?php
        $options = array(
            'Y' => 'Yes',
            'N' => 'No'
        );
         echo $this->Form->input('name', array('required'=>false));
         echo $this->Form->input('state_id', array('empty' => 'Select', 'id' => 'state'));
        ?>
        <div> <label>Status: </label><?php
        echo $this->Form->input('status', array(
            'type' => 'radio',
            'legend' => false,
            'options' => $options,
            'default'=>'Y'
        ));
       
        ?>
        </div>
    </fieldset>
    <?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
    <h3><?php echo __('Actions'); ?></h3>
    <ul>

        <li><?php echo $this->Html->link(__('List Cities'), array('action' => 'index')); ?></li>
        <li><?php echo $this->Html->link(__('List States'), array('controller' => 'states', 'action' => 'index')); ?> </li>
        <li><?php echo $this->Html->link(__('New State'), array('controller' => 'states', 'action' => 'add')); ?> </li>
        <li><?php echo $this->Html->link(__('List Colleges'), array('controller' => 'colleges', 'action' => 'index')); ?> </li>
        <li><?php echo $this->Html->link(__('New College'), array('controller' => 'colleges', 'action' => 'add')); ?> </li>
        <li><?php echo $this->Html->link(__('List Universities'), array('controller' => 'universities', 'action' => 'index')); ?> </li>
        <li><?php echo $this->Html->link(__('New University'), array('controller' => 'universities', 'action' => 'add')); ?> </li>
    </ul>
</div>
