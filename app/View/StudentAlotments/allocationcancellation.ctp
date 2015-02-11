<div class="AllocationCancellation form">
<?php echo $this->Html->addCrumb('Admission', '/AllocationCancellations');?>
<?php echo $this->Form->create('StudentAlotment', array('url' => 'allocationcancellation','name' => 'allocationcancellation', 'id' => 'Allocationcancellation', 'onsubmit'=>'return show_confirm()')); ?>
    <fieldset>
        <legend><?php echo __('Cancel Allocation'); ?></legend>
	<?php
            echo $this->Form->input('year', array('options'=>array(''=>'Select',$allocatedyear)));
        ?>

    </fieldset>
<?php echo $this->Form->end(__('Cancel Allocation')); ?>

    <script>
        function show_confirm() {
            var cancel = confirm('Are you sure you want to cancel the allocation for this year.');
            if (cancel === true) {
                alert('Click ok to delete the allocation');
            } 
            else {
                alert('Click ok to cancel');
                return false;
            }
        }
    </script>
</div>