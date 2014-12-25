<ul class="breadcrum" style="margin-left:127px!important">
<li><?php echo $this->Html->getCrumbs('Home',array('controller'=>'StudentRegistrations','action'=>'login')); ?><a href="#"><?php echo "  >> Admission"?></a>    
		&nbsp;>>&nbsp;Student Login</li></ul>
	&nbsp;
<div class="change-pass">
    <?php echo $this->Html->css('jquery-ui.css'); ?>
<?php echo $this->Html->script('jquery.js'); ?>
<?php echo $this->Html->script('jquery-ui.js'); ?>
<script>
    $(function() {
        $("#datepicker").datepicker({dateFormat: 'dd-mm-yy'});
    });
</script>
<?php 
    $admissionyear = array(date('Y')-1=>'Last Year',date('Y')=>'Current Year');
?>
<div id="loginbg">
    <div id="login-form-body">
        <?php echo $this->Form->create('LoginDetails',array('url'=>array('controller'=>'StudentRegistrations','action'=>'login'),'onsubmit'=>'return validation()')); ?>
       <fieldset>

        <legend><?php echo __('Login'); ?></legend>
            
            <?php echo $this->Form->input('admissionYear',array('type' => 'radio', 'class' => 'radio', 'checked' => 'checked', 'options' => $admissionyear,'required'=>false));?>
            <?php echo $this->Form->input('certificate_number', array('tabindex' => '1','id'=>'certificateNum')); ?>
            <?php echo $this->Form->input('date_of_birth', array('type' => 'text', 'tabindex' => '2', 'id'=> 'datepicker','readonly')); ?>

        </fieldset>
        <?php echo $this->Form->end(__('Submit', array('id' => 'formsubmit'))); ?>
    </div>
</div>
</div>

<script>
function validation(){
var certificatenum = $("#certificateNum").val();
var dateofbirth = $("#datepicker").datepicker("getDate");

var status = '';
var dobstatus = '';
	
	 if(certificatenum=='' || certificatenum==null){
	 	alert("Certificate number should not be empty");
	 	status = false;
	 }else{
	 status = true;
	 }
	 
	 if(dateofbirth==null || dateofbirth==''){
	 	alert("Date of birth should not be empty");
	 	dobstatus = false;
	 }else{
	 dobstatus = true;
	 }

	 if(status==true && dobstatus==true){
	 return true;
	 }else{
	 return false;
	 }
	 
}
</script>
