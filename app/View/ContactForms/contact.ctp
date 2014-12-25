<ul class="breadcrum breadcrum1">
    <li><?php echo $this->Html->addCrumb('Contact Us >>','#'); ?>      
        Contact
    </li>
</ul>

<div class="contactForms form">
    <?php echo $this->Form->create('ContactAuthority'); ?>
    <fieldset>
        <legend><?php echo __('Contact'); ?></legend>

        <div class="form-area2">
            <div class="left-area">
            <?php
                echo $this->Form->input('name', array(''));
                echo $this->Form->input('email', array('required', 'type' => 'text','lower' => true));
                echo $this->Form->input('comment', array('required'));
                ?>
            </div>
            <div class="right-area">
            <?php 
                echo $this->Form->input('phone', array('required'));
                echo $this->Form->input('subject', array('required'));
            ?>
            </div>
        </div>
    </fieldset>
    <div id="form-button">
        <!--        <div class="submit" style="margin-top:6px;">
            <?php //echo $this->Form->reset('Reset', array('title' => 'Custom Title','type'=>'submit','value'=>'Reset')); ?>
                </div>-->
        <div class="submit">
        <?php echo $this->Form->end(__('Submit')); ?>
        </div>
    </div>

</div>
<!--<script>
    $("#ContactAuthorityContactForm").validate();
</script>-->
<script>

    $(function() {

        $("#ContactAuthorityContactForm").validate({
            // Specify the validation rules
            rules: {
                name: "required",
                email: {
                    required: true,
                    email: true
                },
                comment: "required",
                phone: {
                    required: true,
                    number: true
                },
                subject: "required"
            },
            // Specify the validation error messages
            messages: {
                name: "Please enter your name",
                email: "Please enter a valid email address",
                comment: "Please provide your comments",
                phone: "Please enter a valid phone number",
                subject: "Please enter subject"
            },
            submitHandler: function(form) {
                form.submit();
            }
        });

    });

</script>
