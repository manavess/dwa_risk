<div class="menus form">
<?php echo $this->Html->addCrumb("Menu", '/Menus'); ?>
    <?php echo $this->Form->create('Menu'); ?>
    <fieldset>
        <legend><?php echo __('Edit Menu'); ?></legend>
        <?php
        echo $this->Form->input('id');
        echo $this->Form->input('name', array('required'=>'false','lower' => true));
        echo $this->Form->input('url', array('lower' => true));
		?>
        <div>
        <label>Require Login</label>
        <?php
        echo $this->Form->input('require_login', array(
            'type' => 'radio', 'legend'=>false,           
            'options' => array('Y' => 'YES', 'N' => 'NO')
        ));
		?>
        </div>
         <div>
         <label>Status</label>
        <?php
        echo $this->Form->input('status', array(
            'type' => 'radio', 'legend'=>false,             
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

        <li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('Menu.id')), null, __('Are you sure you want to delete # %s?', $this->Form->value('Menu.id'))); ?></li>
        <li><?php echo $this->Html->link(__('List Menus'), array('action' => 'index')); ?></li>
    </ul>
</div>
