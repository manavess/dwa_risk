<?php echo $this->Html->script('jquery-1.9.1.js'); ?>
<?php echo $this->Html->script('jquery-ui.js'); ?>
<?php echo $this->Html->addCrumb('Admission Cancellation', '/AdmissionCancellations');?>
<div class="studentRegistrations form ">
<?php echo $this->Form->create('AdmissionCancellation'); ?>
	<fieldset>
		
		 <div class='heading'><span><?php echo __('CANCELLATION OF ADMISSION'); ?></span><br/><?php echo __('ACADEMIC YEAR 2012/2013.'); ?></div>
		
		<div class="form-area">
		<div class="left-area">
		<?php
		
		echo $this->Form->input('application_number',array('type'=>'text','id'=>'application_num','onblur'=>'getadmission_data()'));
		echo $this->Form->input('university_name',array('id'=>'university_name', 'readonly'));
		
		echo $this->Form->input('studentID',array('id'=>'registration_id', 'readonly'));
		
		echo $this->Form->input('course_name',array('id'=>'course_name', 'readonly'));
		
	
	?></div><div class="right-area">
	<?php 
		echo $this->Form->input('student_name',array('type'=>'text','id'=>'stdname', 'readonly'));
		echo $this->Form->input('college_name',array('id'=>'collegename', 'readonly'));
		
		echo $this->Form->input('date_of_application',array('id'=>'date_of_app', 'readonly'));
		//echo $this->Form->input('contact_no');
	?>
	
	</div>
	<span style=""><?php echo $this->Form->input('remarks', array('required'=>false));?></span>
	</div>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Admission Cancellations'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Student Registrations'), array('controller' => 'student_registrations', 'action' => 'index')); ?> </li>
		<li><?php //echo $this->Html->link(__('New Student Registration'), array('controller' => 'student_registrations', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('Cancellation Report'), array('controller' => 'AdmissionCancellations', 'action' => 'download_cacellationreport')); ?> </li>
	</ul>
</div>

<script>
function getadmission_data(){

var application_number = $("#application_num").val();
 
 if(application_number!=''){
 	$.ajax({
            type: 'POST',
            data: {application_number: application_number},
            url: "<?php echo $this->webroot; ?>AdmissionCancellations/getcancellationdetails",
            success: function(data) {
           

          	
            var std_details = $.parseJSON(data);
            
            //alert(std_details.applicant_name); 
            
            $("#application_num").val(std_details.app_number);
            $("#stdname").val(std_details.applicant_name);
            $("#university_name").val(std_details.university_name);
            $("#collegename").val(std_details.college_name);
            $("#registration_id").val(std_details.student_registration_id);
            $("#date_of_app").val(std_details.dateofapplication);
            $("#course_name").val(std_details.courseName);
				
            }
        });
        return true;
	}else{
                $("#application_num").val('');
                $("#stdname").val('');
                $("#university_name").val('');
                $("#collegename").val('');
                $("#registration_id").val('');
                $("#date_of_app").val('');
                $("#course_name").val('');
	}
}
</script>
