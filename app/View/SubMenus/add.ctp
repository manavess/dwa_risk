<div class="subMenus form">
<?php  echo $this->Html->addCrumb("Sub Menu", '/SubMenus'); ?>
    <?php echo $this->Form->create('SubMenu'); ?>
    <fieldset>
        <legend><?php echo __('Add Sub Menu'); ?></legend>
        <?php
        echo $this->Form->input('name', array('required'=>'false','lower' => true));
        echo $this->Form->input('menu_id',array('empty'=>'select','required'=>'false'));
        echo $this->Form->input('url', array('required'=>'false','lower' => true));
       echo $this->Form->input('require_login', array(
                                'type' => 'radio',
                                'options' => array('Y' => 'YES', 'N' => 'NO'),
                                'default' => 'Y'
                        )
                );
        echo $this->Form->input('status', array(
                                'type' => 'radio',
                                'options' => array('Y' => 'YES', 'N' => 'NO'),
                                'default' => 'Y'
                        )
                );
        ?>
    </fieldset>
    <?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
    <h3><?php echo __('Actions'); ?></h3>
    <ul>

        <li><?php echo $this->Html->link(__('List Sub Menus'), array('action' => 'index')); ?></li>
        <li><?php echo $this->Html->link(__('List Menus'), array('controller' => 'menus', 'action' => 'index')); ?> </li>
        <li><?php echo $this->Html->link(__('New Menu'), array('controller' => 'menus', 'action' => 'add')); ?> </li>
    </ul>
</div>
