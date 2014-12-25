<!--
To change this template, choose Tools | Templates
and open the template in the editor.
-->
<div class="studentRegistrations index">
<?php  echo $this->Html->addCrumb("Student Admission", '/StudentRegistrations'); ?>
	<h2><?php echo __('Student Amendment Form'); ?></h2>
<?php echo $this->Form->create('StudentRegistration', array('url'=>array('controller'=>'StudentRegistrations','action'=>'changecollege',$editId))); ?>
	<div class="form-area2">
    
    <div class="left-area" style="width:41%!important">
    	<?php if(!empty($universityID)) { $universityID = $universityID;}else{ $universityID = '';}?>
	<?php echo $this->Form->input('university_id',array('label'=>'Select University','id'=>'universityID','empty'=>'select','selected'=>$universityID,'options'=>$universities));
        
        ?><?php echo $this->Form->input('application_number',array('type'=>'hidden','value'=>$studentRegistration['StudentRegistration']['application_number']));
        echo $this->Form->input('alotmentID',array('type'=>'hidden','value'=>(isset($studentalotmentID) ? $studentalotmentID:'')));
        ?>
	
	</div>
    
    <div class="right-area" style="width:41%!important">
    

    
    <?php  if(!empty($collegeid)){ $collegeid = $collegeid; } else { $collegeid = ''; }
    echo $this->Form->input('college_id',array('label'=>'Select College','id'=>'collegeID','empty'=>'select','select'=>true,'options'=>$colleges,'selected'=>$collegeid));?>
    </div>

            
            <div class="left-area">
	<div id="form-button">
	
	<?php echo $this->Form->end(__('Submit')); ?>
	
	</div>
	</div>

   <div class="left-side">
        <dl>
        <dt><?php echo __('Application number'); ?></dt>
            <dd>
                <?php
                    echo $studentRegistration['StudentRegistration']['application_number'];
                ?>
                &nbsp;
            </dd>
            <dt><?php echo __('Admission Type'); ?></dt>
            <dd>
                <?php
                if ($studentRegistration['StudentRegistration']['admission_type'] == 'N') {
                    $admissionType = "Normal";
                } else {
                    $admissionType = "Private";
                } echo h($admissionType);
                ?>
                &nbsp;
            </dd>
            <dt><?php echo __('Gender'); ?></dt>
            <dd>
                <?php
                if ($studentRegistration['StudentRegistration']['gender'] == 'M') {
                    $Gender = "Male";
                } else {
                    $Gender = "Female";
                } echo h($Gender);
                ?>
                &nbsp;
            </dd>
            <dt><?php echo __('Course'); ?></dt>
            <dd>
                <?php echo $this->Html->link($studentRegistration['Course']['name'], array('controller' => 'courses', 'action' => 'view', $studentRegistration['Course']['id'])); ?>
                &nbsp;
            </dd>
            <dt><?php echo __('Applicant Name'); ?></dt>
            <dd>
                <?php echo h($studentRegistration['StudentRegistration']['applicant_name']); ?>
                &nbsp;
            </dd>
     
        </dl>
    </div>

</div>
        </div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('New Student Registration'), array('action' => 'add')); ?></li>
	</ul>
</div><?php //echo $this->element('sql_dump');?>

<script>
$('#universityID').change(function() {
        $.ajax({
            type: 'POST',
            data: {university_id: $("#universityID option:selected").val()},
            url: "<?php echo $this->webroot; ?>StudentAlotments/getcollegelist",
            success: function(data) {
                $('#collegeID').html(data);
            }
        });
        return true;
    });
    
    function checkvalidation(){
    var universityID = $("#universityID option:selected").val();
    var collegeID = $('#collegeID option:selected').val();
    var status='';
    
		if(universityID==''){
			alert("Please select University");
			status = false;
		}else{
		status = true;
		}
		
		if(collegeID==''){
			alert("Please select College");
			status = false;
		}
		
		if(universityID!='' && collegeID==''){
			alert("Please select College");
			status = false;
		}
		
		if(status==true){
		return true;
		}else{
		return false;
		}
    
    }

</script>
