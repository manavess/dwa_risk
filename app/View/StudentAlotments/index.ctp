<div class="studentAlotments index">
<?php  echo $this->Html->addCrumb("Student Alotment", '/StudentAlotments'); ?>
<?php 
$gender = array('M' => 'Male', 'F' => 'Female');?>
    <h2><?php echo __('Student Alotments'); ?></h2>
	<?php echo $this->Form->create('StudentAlotment',array('url'=>'index','onsubmit'=>'return checkvalidation()')); ?>
    <div class="form-area2">

        <div class="left-area">
	<?php echo $this->Form->input('student_name');?>

        </div>

        <div class="right-area">


	<?php echo $this->Form->input('application_number');?>
        </div>

        <div style="clear:both; margin: 0px 0px 0px 0px;"></div>
        <div class="left-area">
	<?php if(!empty($universityID)) { $universityID = $universityID;}else{ $universityID = '';}?>
	<?php echo $this->Form->input('university_id',array('select'=>true,'options'=>array('' => ' Select ',$universities),'style' => 'width:200px;','id'=>'universityID','selected'=>$universityID));?>

        </div>

        <div class="right-area">
	<?php if(!empty($stateID)) { $stateID = $stateID;}else{ $stateID = '';}?>
	<?php echo $this->Form->input('state_id',array('options' => array('' => ' Select ',$states),'id' => 'countryState','style' => 'width:200px;','selected'=>$stateID));?>

        </div>
        <div style="clear:both; margin: 0px 0px 0px 0px;"></div>
        <div class="left-area">
	<?php if(!empty($collegeID)) { $collegeID = $collegeID;}else{ $collegeID = '';}?>
	<?php echo $this->Form->input('college_id',array('select'=>true,'options'=>array('' => ' Select ',$colleges),'style' => 'width:200px;','selected'=>$collegeID));?>
        </div>
        <div class="right-area">
	<?php if(!empty($cityID)){ $cityid =$cityID; } else { $cityid =''; } ?>
	<?php echo $this->Form->input('city_id',array('style' => 'width:200px;','id'=>'statecity','options'=>array('' => ' Select ',$cities),'default'=>$cityid)); ?>


        </div>
        <div style="clear:both; margin: 0px 0px 0px 0px;"></div>
        <div class="left-area">
	<?php if(!empty($genderID)) { $genderID = $genderID;}else{ $genderID = '';}?>
	<?php echo $this->Form->input('gender',array('selected'=>$genderID,'options'=>array(''=>'Select',$gender)));?>
        </div>
        <div class="right-area">
	<?php if(!empty($courseID)){ $courseID = $courseID; } else { $courseID =''; } ?>
	<?php echo $this->Form->input('course_id',array('style' => 'width:200px;','id' => 'alotmentcourse','options'=>array('' => ' Select ',$courses),'default'=>$courseID)); ?>


        </div>

        <div class="right-area">
            <div id="form-button">

	<?php echo $this->Form->end(__('Search')); ?>
                <div class="submit" style="padding-left:8px;">

	<?php echo $this->Form->reset('Reset', array('title' => 'Reset','value'=>'Reset','type' => 'submit')); ?>
                </div>
            </div>
        </div>

    </div>
    <table cellpadding="0" cellspacing="0">
        <tr>
            <th width="40px"><?php echo $this->Paginator->sort('S.No.'); ?></th>
            <th><?php echo $this->Paginator->sort('applicant_name'); ?></th>
            <th><?php echo $this->Paginator->sort('application_number'); ?></th>
            <th><?php echo $this->Paginator->sort('Alloted College'); ?></th>
            <th><?php echo "University"; ?></th>
            <th><?php echo "Course"; ?></th>
            <th><?php echo $this->Paginator->sort('total_percentage'); ?></th>
            <th><?php echo $this->Paginator->sort('Rank'); ?></th>
            <th><?php echo $this->Paginator->sort('allocation_year'); ?></th>
            <th>Allotted</th>
            <th class="actions actions1"><?php echo __('Actions'); ?></th>
        </tr>
	<?php   $i=1; foreach ($studentAlotments as $studentAlotment): 
            //echo "<pre>";print_r($studentAlotment);die;
            ?>
        <tr>
            <td><?php echo $i ; ?>&nbsp;</td>
            <td>
                <?php echo $this->Html->link($studentAlotment['StudentRegistration']['applicant_name'], array('controller' => 'student_registrations', 'action' => 'view', $studentAlotment['StudentRegistration']['id'])); ?>
            </td>
            <td>
                <?php echo $this->Html->link($studentAlotment['StudentRegistration']['application_number'], array('controller' => 'student_registrations', 'action' => 'view', $studentAlotment['StudentRegistration']['id'])); ?>
            </td>
            <td>
            <?php if(!empty($studentAlotment['Colleges']['name'])){ 
                echo $studentAlotment['Colleges']['name']; 
            } 
            ?>
            </td>
            <td>
                <?php echo $this->StdRegistrations->getuniversity($studentAlotment['Colleges']['university_id']); ?>
            </td>
            <td>
                <?php echo $this->StdRegistrations->getcourse($studentAlotment['StudentAlotment']['course_id']); ?>
            </td>
            <td><?php 
            if($this->StdRegistrations->getpercentage($studentAlotment['StudentRegistration']['total_percentage'])){
                echo $this->StdRegistrations->getpercentage($studentAlotment['StudentRegistration']['total_percentage']); 
                
            }else{
                echo h($studentAlotment['StudentRegistration']['total_percentage']); 
                }
            ?>&nbsp;
            </td>

            <td><?php if(!empty($studentAlotment['StudentAlotment']['grade'])){
                echo $studentAlotment['StudentAlotment']['grade']; 
                
            } else{ 
                echo "N/A";
                
            }
            ?>&nbsp;
            </td>
            <td><?php echo $studentAlotment['StudentAlotment']['allocation_year']; ?>&nbsp;</td>
            <td><?php if($this->StdRegistrations->isallotted($studentAlotment['StudentAlotment']['student_registration_id'])){ 
                echo "Yes"; 
            }else{ 
                echo "No"; 
            } ?>
            </td>
            <td>
                <?php echo $this->Html->image('view.png', array('url' => array('controller'=>'StudentRegistrations','action' => 'view', $studentAlotment['StudentRegistration']['id']),'title'=>'View')); ?>
                <?php echo $this->Html->image('edit_button.png', array('url' => array('controller'=>'StudentRegistrations','action' => 'changecollege', $studentAlotment['StudentAlotment']['student_registration_id'],$studentAlotment['StudentAlotment']['id'],$studentAlotment['StudentAlotment']['course_id']))); ?>
            </td>
        </tr>
<?php $i++; endforeach; ?>
    </table>
    <p>
	<?php
	$this->Paginator->options(array('url' => $this->passedArgs));
	echo $this->Paginator->counter(array(
	'format' => __('Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}')
	));
	?>	</p>
    <div class="paging">
	<?php
		echo $this->Paginator->prev('< ' . __('previous'), array(), null, array('class' => 'prev disabled'));
		echo $this->Paginator->numbers(array('separator' => ''));
		echo $this->Paginator->next(__('next') . ' >', array(), null, array('class' => 'next disabled'));
	?>
    </div>
</div>
<div class="actions">
    <h3><?php echo __('Actions'); ?></h3>
    <ul>
        <li><?php //echo $this->Html->link(__('New Student Alotment'), array('action' => 'add')); ?></li>
        <li><?php echo $this->Html->link(__('List Student Registrations'), array('controller' => 'student_registrations', 'action' => 'index')); ?> </li>
        <li><?php //echo $this->Html->link(__('New Student Registration'), array('controller' => 'student_registrations', 'action' => 'add')); ?> </li>
        <li><?php echo $this->Html->link(__('List College Group Subjects'), array('controller' => 'college_group_subjects', 'action' => 'index')); ?> </li>
        <li><?php //echo $this->Html->link(__('New College Group Subject'), array('controller' => 'college_group_subjects', 'action' => 'add')); ?> </li>
        <li><?php //echo $this->Html->link(__('Nominated Student list'), array('action' => 'nominatedstudent')); ?> </li>
        <li><?php echo $this->Html->link(__('Last Nominated Percentage'), array('action' => 'listallocatedpercentage')); ?> </li>
        <li><?php echo $this->Html->link(__('Results Report'), array('action' => 'exception')); ?> </li>
        <li><?php echo $this->Html->link('Download Nominated Students',array('action'=>'download_nominated_student'))?></li>
    </ul>
</div>
<script>

    $('#countryState').change(function() {
        $.ajax({
            type: 'POST',
            data: {State: $("#countryState option:selected").val()},
            url: "<?php echo $this->webroot; ?>universities/getcitylist",
            success: function(data) {
                $('#statecity').html(data);
            }
        });
        return true;
    });


    $('#universityID').change(function() {
        $.ajax({
            type: 'POST',
            data: {university_id: $("#universityID option:selected").val()},
            url: "<?php echo $this->webroot; ?>StudentAlotments/getcollegelist",
            success: function(data) {
                $('#StudentAlotmentCollegeId').html(data);
            }
        });
        return true;
    });


</script>