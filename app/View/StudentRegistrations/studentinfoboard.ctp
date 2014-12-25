<ul class="breadcrum"><li><?php echo $this->Html->addCrumb('Admission >>','#'); ?>      
		&nbsp;&nbsp;&nbsp;&nbsp;Student Information Board</li></ul>
		<div>&nbsp;</div>
<div class="studentRegistrations view">
    <h2><?php echo __('Student Registration'); ?></h2>
    <div class="left-side"> <dl>

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
                    $admissionType = "Priavate";
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
                <?php echo $studentRegistration['Course']['name']; ?>
                &nbsp;
            </dd>
            <dt><?php echo __('Applicant Name'); ?></dt>
            <dd>
                <?php echo h($studentRegistration['StudentRegistration']['applicant_name']); ?>
                &nbsp;
            </dd>
            <dt><?php echo __('Photo'); ?></dt>
            <dd>

                <?php if (!empty($studentRegistration['StudentRegistration']['photo'])) { ?>
                    <img width="150" height="150" src="data:image/jpeg;base64, <?php echo base64_encode($studentRegistration['StudentRegistration']['photo']); ?>" /><?php } ?>
                &nbsp;
            </dd>
            <dt><?php echo __('Religion'); ?></dt>
            <dd>
                <?php echo $studentRegistration['Religion']['name']; ?>
                &nbsp;
            </dd>
            <dt><?php echo __('Address1'); ?></dt>
            <dd>
                <?php echo h($studentRegistration['StudentRegistration']['Address1']); ?>
                &nbsp;
            </dd>
            <dt><?php echo __('Address2'); ?></dt>
            <dd>
                <?php echo h($studentRegistration['StudentRegistration']['Address2']); ?>
                &nbsp;
            </dd>
            <dt><?php echo __('Address3'); ?></dt>
            <dd>
                <?php echo h($studentRegistration['StudentRegistration']['Address3']); ?>
                &nbsp;
            </dd>
            <dt><?php echo __('City'); ?></dt>
            <dd>
                <?php echo $studentRegistration['City']['name']; ?>
                &nbsp;
            </dd>
            <dt><?php echo __('State'); ?></dt>
            <dd>
                <?php echo $studentRegistration['State']['name']; ?>
                &nbsp;
            </dd>
            <dt><?php echo __('Country'); ?></dt>
            <dd>
                <?php echo $studentRegistration['Country']['name']; ?>
                &nbsp;
            </dd>
            <dt><?php echo __('Date Of Birth'); ?></dt>
            <dd>
                <?php echo h(date('d-m-Y', strtotime($studentRegistration['StudentRegistration']['date_of_birth']))); ?>
                &nbsp;
            </dd>
            <dt><?php echo __('Type Of Certificate'); ?></dt>
            <dd>
                <?php echo h($studentRegistration['StudentRegistration']['type_of_certificate']); ?>
                &nbsp;
            </dd>
            <dt><?php echo __('Certificate Index'); ?></dt>
            <dd>
                <?php echo h($studentRegistration['StudentRegistration']['certificate_index']); ?>
                &nbsp;
            </dd>
            <dt><?php echo __('Date Of Certificate'); ?></dt>
            <dd>
                <?php echo h(date('d-m-Y', strtotime($studentRegistration['StudentRegistration']['date_of_certificate']))); ?>
                &nbsp;
            </dd>
            <dt><?php echo __('Secondary School Name'); ?></dt>
            <dd>
                <?php echo h($studentRegistration['StudentRegistration']['secondary_school_name']); ?>
                &nbsp;
            </dd>

            <dt><?php echo __('Nationality Number'); ?></dt>
            <dd>
                <?php echo h($studentRegistration['StudentRegistration']['nationality_number']); ?>
                &nbsp;
            </dd>
            <dt><?php echo __('Nationality Issue Date'); ?></dt>
            <dd>
                <?php echo h(date('d-m-Y', strtotime($studentRegistration['StudentRegistration']['nationality_issue_date']))); ?>
                &nbsp;
            </dd>
            <dt><?php echo __('Passport Number'); ?></dt>
            <dd>
                <?php echo h($studentRegistration['StudentRegistration']['passport_number']); ?>
                &nbsp;
            </dd>
            <dt><?php echo __('Passport Issue Date'); ?>&nbsp;</dt>
            <dd>
                <?php echo h(date('d-m-Y', strtotime($studentRegistration['StudentRegistration']['passport_issue_date']))); ?>
                &nbsp;
            </dd>
        </dl></div>
    <div class="right-side"><dl>
            
            <dt><?php echo __('Guardian Name'); ?></dt>
            <dd>
                <?php echo h($studentRegistration['StudentRegistration']['guardian_name']); ?>
                &nbsp;
            </dd>
            <dt><?php echo __('Guardian Occupation'); ?></dt>
            <dd>
                <?php echo h($studentRegistration['StudentRegistration']['guardian_occupation']); ?>
                &nbsp;
            </dd>
            <dt><?php echo __('Guardian Nationality Number'); ?></dt>
            <dd>
                <?php echo h($studentRegistration['StudentRegistration']['guardian_nationality_number']); ?>
                &nbsp;
            </dd>
            <dt><?php echo __('Guardian Nationality Issue Date'); ?></dt>
            <dd>
                <?php echo h(date('d-m-Y', strtotime($studentRegistration['StudentRegistration']['guardian_nationality_issue_date']))); ?>
                &nbsp;
            </dd>
            <dt><?php echo __('Stream'); ?></dt>
            <dd>
                <?php echo h($studentRegistration['StudentRegistration']['stream']); ?>
                &nbsp;
            </dd>
            <dt><?php echo __('Admission Office'); ?></dt>
            <dd>
                <?php echo h($studentRegistration['StudentRegistration']['admission_office']); ?>
                &nbsp;
            </dd>
            
            <dt><?php echo __('Submission Office'); ?></dt>
            <dd>
                <?php echo h($studentRegistration['StudentRegistration']['submission_office']); ?>
                &nbsp;
            </dd>
            <dt><?php echo __('Group Subject'); ?></dt>
            <dd>
                <?php echo $this->Html->link($studentRegistration['GroupSubject']['name'], array('controller' => 'group_subjects', 'action' => 'view', $studentRegistration['GroupSubject']['id'])); ?>
                &nbsp;
            </dd>
            <dt><?php echo __('Total Percentage'); ?></dt>
            <dd>
                <?php echo h($studentRegistration['StudentRegistration']['total_percentage']); ?>
                &nbsp;
            </dd>
            <dt><?php echo __('Is Emp Referance'); ?></dt>
            <dd>
                <?php echo h($studentRegistration['StudentRegistration']['is_emp_referance']); ?>
                &nbsp;
            </dd>
            <dt><?php echo __('Is Distance'); ?></dt>
            <dd>
                <?php echo h($studentRegistration['StudentRegistration']['is_distance']); ?>
                &nbsp;
            </dd>
            <dt><?php echo __('Is Mature'); ?></dt>
            <dd>
                <?php echo h($studentRegistration['StudentRegistration']['is_mature']); ?>
                &nbsp;
            </dd>
            <dt><?php echo __('Employee'); ?></dt>
            <dd>
                <?php echo $this->Html->link($studentRegistration['Employee']['name'], array('controller' => 'employees', 'action' => 'view', $studentRegistration['Employee']['id'])); ?>
                &nbsp;
            </dd>

            <dt><?php echo __('Submission Date'); ?></dt>
            <dd>
                <?php echo h(date('d-m-Y', strtotime($studentRegistration['StudentRegistration']['submission_date']))); ?>
                &nbsp;
            </dd>

            <dt><?php echo __('Student Document'); ?></dt>
            <dd style="width:150px;">
                <a href="<?php echo $this->webroot; ?>StudentRegistrations/download_document/<?php echo $studentRegistration['StudentRegistration']['id'] ?>"><input type="button" value="Download" size="20px"></a>
                &nbsp;
            </dd>
            <dt><?php echo __('Number of selected college'); ?></dt>
            <dd>
                <?php echo h($num_of_choice); ?>
                &nbsp;
            </dd>
            <dt><?php echo __('Applicant Name'); ?></dt>

            <dt><?php echo __('Receipt Number'); ?></dt>
            <dd>    <?php
                echo $studentRegistration['StudentRegistration']['id'];
                ?>
                &nbsp;
            </dd>
            <dt><?php echo __('Certificate Number'); ?></dt>
            <dd>    <?php echo $studentRegistration['StudentRegistration']['certificate_index']; ?>

                &nbsp;
            </dd>
            <dt><?php echo __('Date of Certificate'); ?></dt>
            <dd>   
                <?php echo $studentRegistration['StudentRegistration']['date_of_certificate'];
                ?>     &nbsp;
            </dd>

        </dl>
    </div>&nbsp;
       <?php if (!empty($finalsubjectarray)): ?>
        <div style="width:100%;">
            <table style="width:100%;">
                <tr>
                    <td colspan="6">
                        <h3><?php echo __('Subjects and Marks'); ?></h3>
                    </td>
                </tr>
                <tr>
                    <th><?php echo __('Subject'); ?></th>
                    <th><?php echo __('Marks/Grade'); ?></th>
                </tr>
                <?php foreach ($finalsubjectarray as $key => $val) { ?>

                    <tr>
                        <td>
                            <?php echo $val['Subjectname']; ?>
                        </td>
                        <td>
                            <?php echo $val['marks']; ?>
                        </td>
                    </tr>
                <?php } ?>
            </table>
        </div>
    <?php endif; ?>

    <div style="width:100%;">
        <table style="width:100%;">
            <tr>
                <td colspan="6">
                    <h3><?php echo __('Prefered Colleges and University'); ?></h3>
                </td>
            </tr>
            <tr>
                <th><?php echo __('Preferences'); ?></th>
                <th><?php echo __('College'); ?></th>
                <th><?php echo __('University'); ?></th>
                <th colspan="4"><?php echo __('Group Subject'); ?></th></tr>
            <?php if(!empty($stdselectedcollege)) { $a = 1; foreach ($stdselectedcollege as $value) { ?>
                <tr>
                     <td><?php echo $a;
                        ?>
                    </td>
                    <td>

                        <?php echo htmlentities($value['collegename'], ENT_COMPAT); ?></td>
                    <td><?php echo $this->StdRegistrations->getuniversity($value['university_id']);
                        ?>
                    </td>
                    <?php if (!empty($value['groupsubjectName'])):  ?>
                            <td><?php echo $value['groupsubjectName']; ?></td>


                            <?php endif; ?>
                  
                </tr>
            <?php $a++; } }?>
        </table>
    </div> &nbsp;
    
    <div style="width:100%;">
        <table style="width:100%;">
            <tr>
                <td colspan="6">
                    <h3><?php echo __('Payment Status'); ?></h3>
                </td>
            </tr>
            <tr>
                <td style="font-size:12px">
                    <?php if($paymentstatus) { echo "Paid"; }else{ echo "Unpaid" ; } ?>
                </td>
                <td colspan="5">&nbsp;</td>
            </tr>
       </table>
   </div>

    
    <div style="width:100%;">
        <table style="width:100%;">
            <tr>
                <td colspan="2">
                    <h3><?php echo __('Admission Status'); ?></h3>
                </td>
            </tr>
            <tr><?php if(!empty($allotedcollege) && $allotedcollege['StudentAlotment']['isCancelled']=='Y'){ ?>
                <td><h3><?php echo "Your admission has been cancelled. Please contact immediately to College Administration"; ?></h3></td>
                <td><h3><?php echo "Reason : ".$cancelledinfo['AdmissionCancellation']['remarks']; ?></h3></td>
                <?php }elseif(!empty($allotedcollege) && $allotedcollege['StudentAlotment']['isCancelled']=='N'){ ?>
                <td colspan="2"><h3><?php echo __('Admission Confirmed. Please view admission statement'); ?></h3></td>
                <?php }else{ ?>
                <td colspan="2"><strong><?php echo __('College alotment in progress...'); ?></strong></td>
                <?php } ?>
               </tr>
            
        </table>
 </div> &nbsp;
<div style="width:100%; text-align:center">
 <div class="submit" align="center" width="100%" title="Receipt"><?php //echo $this->Html->link(__('View Receipt'), array('controller'=>'StudentRegistrations','action' => 'reciept',$studentRegistration['StudentRegistration']['id'])); ?> 
  <?php //if(!empty($allotedcollege) && $allotedcollege['StudentAlotment']['isCancelled']=='N'){ 
 //echo $this->Html->link(__('View Admission Statement'), array('controller'=>'StudentStatements','action' => 'admissionstatement')); 
      
  //}
 echo $this->Html->link(__('Receipt'), array('controller'=>'StudentRegistrations','action' => 'reciept')); ?>
 </div>

 </div>
 
</div>


