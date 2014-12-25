<div class="countries form">
<?php echo $this->Html->addCrumb('Country', '/Countries');?>
<?php echo $this->Form->create('Country'); ?>
	<fieldset>
		<legend><?php echo __('Edit Country'); ?></legend>
	<?php //print_r($this->data);
                 $options = array(
                'Y' => 'Yes',
	        'N' => 'No'
	        );
		echo $this->Form->input('id');
		echo $this->Form->input('name', array('required'=>false));
         ?> 
         <div>      
                <label>Status: </label>
           <?php 
                 echo $this->Form->input('status', array(
		    'type'      =>  'radio',
		    'legend'    =>  false,
		    'options'   =>  $options,
                     'value'    => $this->data['Country']['status']
		));
	?>
    </div>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('Country.id')), null, __('Are you sure you want to delete # %s?', $this->Form->value('Country.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Countries'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List States'), array('controller' => 'states', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New State'), array('controller' => 'states', 'action' => 'add')); ?> </li>
	</ul>
</div>
