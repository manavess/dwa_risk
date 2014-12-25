<div class="change-pass">
    <?php  echo $this->Html->addCrumb("User", '/Users'); ?>
    <?php __('Forget Password'); ?>

    <?php //echo $this->Form->create('User', array('action' => 'reset')); ?>

    <?php
    if (isset($errors)) {
        echo '<div class="error">';
        echo "<ul>";
        foreach ($errors as $error) {
            echo"<li><div class='error-message'>$error</div></li>";
        }
        echo"</ul>";
        echo'</div>';
    }
    ?> </fieldset>

    <form method="post" onsubmit="return checkreset()">

 <fieldset>
        <legend><?php echo __('Reset your password'); ?></legend>
        <?php
        echo $this->Form->input('password', array("type" => "password", "name" => "data[User][password]",'id'=>'pwdid'));
        echo $this->Form->input('password_confirm', array("type" => "password", "name" => "data[User][password_confirm]",'id'=>'cpwdid'));
        ?>
        <div id="message" style="color:red"></div>
         <div class="submit"> <input type="submit"  value="Save" /></div>

        <?php //echo $this->Form->end();?>
    </form>
</div>
<script>
function checkreset(){

var msg = '';
pstatus = '';
pcstatus = '';

var password = $("#pwdid").val();
var cpassword = $("#cpwdid").val();
if(password==''){
	msg = msg+"Please enter Password!";
	pstatus = 'false';
}else{
	pstatus = 'true';
}
if(cpassword==''){
	msg = msg+"<br>Please enter Confirm password!";
	pcstatus = 'false';
}else{
	pcstatus = 'true';
}
//alert(status);
if(pstatus == 'true' && pcstatus== 'true')
{
	return true;
	
}else{
	$("#message").html(msg);
	return false;
}

}
</script>
