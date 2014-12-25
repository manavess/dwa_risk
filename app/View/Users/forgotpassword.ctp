<ul class="breadcrum"><li><?php echo $this->Html->addCrumb('Forgot Password','#'); ?>      
     </li></ul>
<div id="container">
    <table width="100%" cellspacing="0" cellpadding="0" border="0" align="center">
        <tbody><tr>
                <td align="center"><div class="headingform"> 
                        <span class="forgot-password-text" > Forgot your password? </span> <br>
                    </div></td>
            </tr>
        </tbody>
    </table>
<div class="forgot-password-main-outer" style="text-align:center">

<span >Please Enter your E-Mail Id to reset your password.</span>
<div>&nbsp;</div>
   <div class="forgot-password-main" ><div id="forgot-password"> 
   <?php
    echo $this->Form->create('User');
    echo $this->Form->input('email',array('required'=>false));
    ?>
     <div id="forgot-password-submit"> <?php echo $this->Form->end(__('Submit')); ?> </div>
</div>
</div></div></div>
