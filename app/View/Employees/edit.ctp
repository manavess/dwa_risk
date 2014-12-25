<?php echo $this->Html->css('jquery-ui.css'); ?>
<?php echo $this->Html->script('jquery.js'); ?>
<?php echo $this->Html->script('jquery-ui.js'); ?>
<script>
    $(function() {
        $("#datepicker").datepicker({dateFormat: 'dd-mm-yy'});
        $("#datepicker1").datepicker({dateFormat: 'dd-mm-yy'});
        $("#datepicker2").datepicker({dateFormat: 'dd-mm-yy'});
    });
</script>

<div class="employees form">
    <!---<form action="" enctype="multipart/form-data" method="post"> -->
    <?php echo $this->Html->addCrumb('Employee', '/Employees');?>
        <?php echo $this->Form->create('Employee',array("onsubmit"=>"return findme()",'enctype'=>'multipart/form-data')); ?>
        <fieldset>
            <legend><?php echo __('Edit Employee'); ?></legend>
            <?php
            echo $this->Form->input('id');
            echo $this->Form->input('code', array('required'=>false));
            echo $this->Form->input('name', array('required'=>false));
            echo $this->Form->input('date_of_joining', array('type' => 'text', 'id' => 'datepicker','readonly'));
            echo $this->Form->input('date_of_confirm_joining', array('type' => 'text', 'id' => 'datepicker1','readonly'));
            echo $this->Form->input('experiance', array('required'=>false));
            ?><div class="input text required employee-add" > <?php  echo $this->Form->input('date_of_resignation', array('type' => 'text', 'id' => 'datepicker2','readonly'));

            ?>
            <label style="margin-left:220px;">Only .pdf,.doc,.jpeg files are uploaded in size not more than 1 MB/</label>
            <?php 
            echo $this->Form->input('document', array('type' => 'file'));
            
            ?></div>
            
            <div class="button-area">
            
                <a href="<?php echo $this->webroot; ?>employees/download/<?php echo $editid ?>"><input type="button" value="Download Document"></a>
            </div>
        </fieldset>
        <?php echo $this->Form->end(__('Submit')); ?>
    <!----</form> --->   
</div>
<div class="actions">
    <h3><?php echo __('Actions'); ?></h3>
    <ul>

        <li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('Employee.id')), null, __('Are you sure you want to delete # %s?', $this->Form->value('Employee.id'))); ?></li>
        <li><?php echo $this->Html->link(__('List Employees'), array('action' => 'index')); ?></li>
    </ul>
</div>

<script>
function findme(){
	var filestatus = '';
		
		var input, file;
		input = document.getElementById('EmployeeDocument');
		file = input.files[0];
		var filesize = file.size/1024/1024;
		if(filesize>1){
		alert("Please upload a document with maximum size of 1 MB");
		filestatus = false;
		}else{
		
		filestatus = true;
		}
	if(filestatus==true){
	return true;
	}else{
		return false;
	}
}
</script>
