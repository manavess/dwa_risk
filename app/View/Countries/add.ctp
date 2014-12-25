<div class="countries form">
<?php echo $this->Html->addCrumb('Country', '/Countries');?>
    <?php echo $this->Form->create('Country'); ?>
    <fieldset>
        <legend><?php echo __('Add Country'); ?></legend>
        <?php
        $options = array(
            'Y' => 'Yes',
            'N' => 'No'
        );

        echo $this->Form->input('name', array('required'=>false));
        ?>
        <div> 
            <label>Status: </label><?php
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

        <li><?php echo $this->Html->link(__('List Countries'), array('action' => 'index')); ?></li>
        <li><?php echo $this->Html->link(__('List States'), array('controller' => 'states', 'action' => 'index')); ?> </li>
        <li><?php echo $this->Html->link(__('New State'), array('controller' => 'states', 'action' => 'add')); ?> </li>
    </ul>
</div>
