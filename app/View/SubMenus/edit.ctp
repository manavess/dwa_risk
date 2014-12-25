<div class="subMenus form">
<?php  echo $this->Html->addCrumb("Sub Menu", '/SubMenus'); ?>
    <?php echo $this->Form->create('SubMenu'); ?>
    <fieldset>
        <legend><?php echo __('Edit Sub Menu'); ?></legend>
        <?php
        echo $this->Form->input('id');
        echo $this->Form->input('name', array('required'=>'false','lower' => true));
        echo $this->Form->input('menu_id',array('empty'=>'select','required'=>'false'));
        echo $this->Form->input('url', array('required'=>'false','lower' => true));
        ?>
        <div>
            <legend>Require Login</legend>
            <?php
            echo $this->Form->input('require_login', array(
                'type' => 'radio', 'legend' => false,
                'options' => array('Y' => 'YES', 'N' => 'NO')
            ));
            ?>
        </div>
        <div>
            <legend>Status</legend>
            <?php
            echo $this->Form->input('status', array(
                'type' => 'radio', 'legend' => false,
                'options' => array('Y' => 'YES', 'N' => 'NO')
            ));
            ?>
        </div>
    </fieldset>
    <?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
    <h3><?php echo __('Actions'); ?></h3>
    <ul>

        <li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('SubMenu.id')), null, __('Are you sure you want to delete # %s?', $this->Form->value('SubMenu.id'))); ?></li>
        <li><?php echo $this->Html->link(__('List Sub Menus'), array('action' => 'index')); ?></li>
        <li><?php echo $this->Html->link(__('List Menus'), array('controller' => 'menus', 'action' => 'index')); ?> </li>
        <li><?php echo $this->Html->link(__('New Menu'), array('controller' => 'menus', 'action' => 'add')); ?> </li>
    </ul>
</div>
