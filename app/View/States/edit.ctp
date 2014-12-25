<div class="states form">
<?php  echo $this->Html->addCrumb("State", '/States'); ?>
<?php echo $this->Form->create('State'); ?>
	<fieldset>
		<legend><?php echo __('Edit State'); ?></legend>
	<?php
        
                $options = array(
                'Y' => 'Yes',
                'N' => 'No'
	        );
		echo $this->Form->input('id');
		echo $this->Form->input('name', array('required'=>false));
         ?>  
         <?php
		echo $this->Form->input('country_id', array('empty' => 'Select', 'id' => 'country'));
	?>    
          <div>      
                <label>Status: </label>
                
          <?php 
                 echo $this->Form->input('status', array(
		    'type'      =>  'radio',
		    'legend'    =>  false,
		    'options'   =>  $options,
                    'value'    => $this->data['State']['status'] 
		));
		?>
		</div>
		
    
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('State.id')), null, __('Are you sure you want to delete # %s?', $this->Form->value('State.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List States'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Countries'), array('controller' => 'countries', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Country'), array('controller' => 'countries', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Cities'), array('controller' => 'cities', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New City'), array('controller' => 'cities', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Colleges'), array('controller' => 'colleges', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New College'), array('controller' => 'colleges', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Universities'), array('controller' => 'universities', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New University'), array('controller' => 'universities', 'action' => 'add')); ?> </li>
	</ul>
</div>
