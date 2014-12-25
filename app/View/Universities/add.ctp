<div class="universities form">
<?php  echo $this->Html->addCrumb("University", '/Universities'); ?>
    <?php echo $this->Form->create('University',array('enctype'=>'multipart/form-data')); ?>
    <fieldset>
        <legend><?php echo __('Add University'); ?></legend>
        <div class="form-area">
        <div class="left-area">
            <?php
            echo $this->Form->input('name', array('required'=>false));
            echo $this->Form->input('address2');
            echo $this->Form->input('state_id', array('empty' => 'Select', 'id' => 'state', 'style' => 'width:200px','required'=>false));
            echo $this->Form->input('pincode');
            echo $this->Form->input('contact_person', array('required'=>false));
             echo $this->Form->input('website');
            ?>
        </div>
        <div class="right-area"> 
            <?php
	    echo $this->Form->input('address1', array('required'=>false));
            echo $this->Form->input('address3');
            echo $this->Form->input('city_id', array('empty' => ' Select ', 'id' => 'city', 'style' => 'width:200px','required'=>false));
	    echo $this->Form->input('email_id', array('type' => 'text','required'=>false,'lower'=>true));
            echo $this->Form->input('contact_no', array('required'=>false));
            echo $this->Form->input('image', array('required'=>false,'type'=>'file'));
            ?>
        </div>
        </div>
    </fieldset>
    <div id="form-button">
    	<?php echo $this->Form->end(__('Submit')); ?>
    		<div class="submit">
                <?php echo $this->Form->reset('Reset', array('title' => 'Reset','value'=>'Reset','type' => 'submit')); ?>
            </div>
            </div>
</div>
<div class="actions">
    <h3><?php echo __('Actions'); ?></h3>
    <ul>

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
    $('#state').change(function() {
        $.ajax({
            type: 'POST',
            data: {State: $("#state option:selected").val()},
            url: "<?php echo $this->webroot; ?>universities/getcitylist",
            success: function(data) {
                $('#city').html(data);
            }
        });
        return true;
    });

</script>
