<div class="universities form">
<?php  echo $this->Html->addCrumb("University", '/Universities'); ?>
<?php echo $this->Form->create('University',array('enctype'=>'multipart/form-data')); ?>
	<fieldset>
		<legend><?php echo __('Edit University'); ?></legend>
         <div class="form-area2">
                <div class="left-area">
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('name', array('required'=>false));
		echo $this->Form->input('address2');
                echo $this->Form->input('state_id', array('empty' => 'Select', 'id' => 'editstate','style'=> 'width:200px','required'=>false));
		echo $this->Form->input('pincode');
                echo $this->Form->input('contact_person', array('required'=>false));
                echo $this->Form->input('website');
		?>
        </div>
        <div class="right-area">
        <?php
                echo $this->Form->input('address1', array('required'=>false));
                echo $this->Form->input('address3');
		echo $this->Form->input('city_id', array('empty' => 'Select','id' => 'editcity','style'=> 'width:200px','required'=>false));
		echo $this->Form->input('email_id',array('type'=>'text','required'=>false));
		echo $this->Form->input('contact_no', array('required'=>false));
                echo $this->Form->input('image', array('required'=>false,'type'=>'file'));
    	?>
        </div>
        </div>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php //echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('University.id')), null, __('Are you sure you want to delete # %s?', $this->Form->value('University.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Universities'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Cities'), array('controller' => 'cities', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New City'), array('controller' => 'cities', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List States'), array('controller' => 'states', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New State'), array('controller' => 'states', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Colleges'), array('controller' => 'colleges', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New College'), array('controller' => 'colleges', 'action' => 'add')); ?> </li>
	</ul>
</div>
<script type="text/javascript">
    $('#editstate').change(function() {
        $.ajax({
            type: 'POST',
            data: {State: $("#editstate option:selected").val()},
            url: "<?php echo $this->webroot; ?>universities/getcitylist",
            success: function(data) {
                $('#editcity').html(data);
            }
        });
        return true;
    });

</script>
