<ul class="breadcrum breadcrum1">
    <li><?php echo $this->Html->addCrumb('Contact Us >>', '#'); ?>      
        Contact Ministry
    </li>
</ul>

<div class="contactForms form">
    <?php echo $this->Form->create('ContactMinistry', array('onsubmit' => 'return validate()')); ?>
    <fieldset>
        <legend><?php echo __('Contact Ministry'); ?></legend>
        <?php
        echo $this->Form->input('name',array('onblur'=> 'return validate()','onkeyup' => 'return hidediv()'));?>
        <div id="errormsg" style="display: none;float: right;color: red"></div>
        <?php
        echo $this->Form->input('email', array('type' => 'text', 'lower' => true, 'onblur' => 'return validatemail()','onkeyup' => 'return hidediv()'));
        ?>
        <div id="errormail" style="display: none;float: right;color: red">  </div>
        <?php
        echo $this->Form->input('phone');
        echo $this->Form->input('subject');
        echo $this->Form->input('comment');
        ?>
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
<script type="text/javascript">
    function validate() {
        if ($("#ContactMinistryName").val() == '') {
            //alert("Please enter your name!");
            $("#errormsg").html("Please enter your name");
            $("#errormsg").css('display', '');
            //$("#ContactMinistryName").focus();
            return false;
        }
        if ($("#ContactMinistryEmail").val() == '') {
            alert("Please enter your email id");
            $("#ContactMinistryEmail").focus();
            return false;
        }
        if ($("#ContactMinistryPhone").val() == '') {
            alert("Please enter your phone number");
            $("#ContactMinistryPhone").focus();
            return false;
        }
        if ($("#ContactMinistrySubject").val() == '') {
            alert("Please provide subject detail");
            $("#ContactMinistrySubject").focus();
            return false;
        }
        if ($("#ContactMinistryComment").val() == '') {
            alert("Please provide comments");
            $("#ContactMinistryComment").focus();
            return false;
        }
        return(true);
    }
    function validatemail() {
        emailID = $("#ContactMinistryEmail").val();
        atpos = emailID.indexOf("@");
        dotpos = emailID.lastIndexOf(".");
        if (atpos < 1 || (dotpos - atpos < 2))
        {
            $("#errormail").html("Please enter correct email ID");
            $("#errormail").css('display', '');
            return false;
        }
    }
    function hidediv() {
        $("#errormsg").css('display', 'none');
        $("#errormail").css('display', 'none');

    }
</script>
