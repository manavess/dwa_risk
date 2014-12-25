
<div class="change-pass">
    <?php echo $this->Html->css('jquery-ui.css'); ?>
<?php echo $this->Html->script('jquery.js'); ?>
<?php echo $this->Html->script('jquery-ui.js'); ?>
<script>
    $(function() {
        $("#datepicker").datepicker({dateFormat: 'dd-mm-yy'});
    });
</script>

<div id="loginbg">
    <div id="login-form-body">
        <?php echo $this->Form->create('LoginDetails'); ?>
       <fieldset>
        <legend><?php echo __('Login'); ?></legend>
            <?php echo $this->Form->input('certificate_number', array('tabindex' => '1')); ?>
            <?php echo $this->Form->input('date_of_birth', array('type' => 'text', 'tabindex' => '2', 'id'=> 'datepicker')); ?>
        </fieldset>
        <?php echo $this->Form->end(__('Submit', array('id' => 'formsubmit'))); ?>
    </div>
</div>
</div>
