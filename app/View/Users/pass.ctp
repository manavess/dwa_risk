<div style="margin:0 auto; width:960px;">
<?php  echo $this->Html->addCrumb("User", '/Users'); ?>
    <div class="change-pass" style="float:left;">

    <?php echo $this->Session->flash(); ?>
    <?php echo $this->Form->create('User'/*,array('onsubmit'=>'return checkpasswordvalidation()')*/); ?>
        <fieldset>
            <legend>
                <?php echo __('Change Password'); $oldpass = ''; 
                if(!empty($this->data['User']['current_password'])){ 
                    $oldpass=$this->data['User']['current_password']; 
                }else{ 
                    $oldpass=''; 
                }?>
            </legend>
        <?php 
            if(!empty($userdata)){ 
                $username = $userdata['User']['username']; 
            }else{ 
                $username = ''; 
            }
        echo $this->Form->input('username', array('label' => 'User name','value'=>$username,'readonly','lower'=>true));
        echo $this->Form->input('current_password', array('onkeyup'=>'hidediv()','onblur'=>'checkpasswordvalidation()','label' => 'Old password', 'value' => $oldpass, 'type' => 'password','id'=>'oldpass','required'=>false,'maxlength'=>'10'));
        ?>
            <div id="oldpasserror" style="display: none; color: red"></div>
        <?php 
        echo $this->Form->input('password', array('onkeyup'=>'hidediv()','onblur'=>'checkpasswordvalidation()','label' => 'New password', 'type' => 'password','id'=>'newpass','required'=>false,'maxlength'=>'10'));
        ?>
            <div id="newpasserror" style="display: none; color: red"></div>
        <?php
        echo $this->Form->input('password_confirm', array('onkeyup'=>'hidediv()','onblur'=>'checkpasswordvalidation()','label' => 'Confirm password', 'type' => 'password', 'required' => true,'id'=>'confirmpass','required'=>false,'maxlength'=>'10'));
        ?>
            <div id="cnfpasserror" style="display: none; color: red"></div>

        </fieldset>
        <div id="form-button">
        <?php echo $this->Form->end(__('Submit')); ?>
            <div class="submit">
	<?php echo $this->Form->reset('Reset', array('title' => 'Reset','value'=>'Reset','onclick'=>'blankval()')); ?>
            </div>
        </div>    
    </div>
</div>

<script>
    function checkpasswordvalidation() {

        var currentpass;
        var newpass_status;
        var confirmpass_status;

        if ($("#oldpass").val() == '') {
            //alert("Please enter your old password");
            $("#oldpasserror").html("Please enter your old password");
            $("#oldpasserror").css('display', '');
            currentpass = false;

        } else {
            currentpass = true;
        }

        if ($("#newpass").val() == '') {
            //alert("Please enter your new password");
            $("#newpasserror").html("Please enter your new password");
            $("#newpasserror").css('display', '');
            newpass_status = false;
        } else {
            newpass_status = true;
        }

        if ($("#confirmpass").val() == '') {
            //alert("Please enter your new password again to confirm");
            $("#cnfpasserror").html("Please enter your new password again to confirm");
            $("#cnfpasserror").css('display', '');
            confirmpass_status = false;
        } else {
            confirmpass_status = true;
        }

        if (currentpass == true && confirmpass_status == true && newpass_status == true) {
            return true;
        } else {
            return false;
        }

    }

    function hidediv() {
        $("#oldpasserror").css('display', 'none');
        $("#newpasserror").css('display', 'none');
        $("#cnfpasserror").css('display', 'none');
    }

    function blankval() {
        //$('#oldpass').attr('value', '');
        $('#newpass').attr('value', '');
        $('#confirmpass').attr('value', '');
    }
</script>
