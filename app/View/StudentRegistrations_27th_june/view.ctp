<div class="studentRegistrations view">
<?php  echo $this->Html->addCrumb("Student Admission", '/StudentRegistrations'); ?>
    <h2><?php echo __('Student Registration'); ?></h2>

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
            <dt><?php echo __('Photo'); ?></dt>
            <dd>
                <img width="150" height="150" src="data:image/jpeg;base64, <?php echo base64_encode($studentRegistration['StudentRegistration']['photo']); ?>" />	
                &nbsp;
            </dd>
            <dt><?php echo __('Religion'); ?></dt>
            <dd>
                <?php echo $this->Html->link($studentRegistration['Religion']['name'], array('controller' => 'religions', 'action' => 'view', $studentRegistration['Religion']['id'])); ?>
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
            <dt><?php echo __('Closest Relative Name'); ?></dt>
            <dd>
                <?php echo h($studentRegistration['StudentRegistration']['closest_relative_name']); ?>
                &nbsp;
            </dd>
            <dt><?php echo __('Closest Relative Address'); ?></dt>
            <dd>
                <?php echo h($studentRegistration['StudentRegistration']['closest_relative_add']); ?>
                &nbsp;
            </dd>
            <dt><?php echo __('City'); ?></dt>
            <dd>
                <?php echo $this->Html->link($studentRegistration['City']['name'], array('controller' => 'cities', 'action' => 'view', $studentRegistration['City']['id'])); ?>
                &nbsp;
            </dd>
            <dt><?php echo __('State'); ?></dt>
            <dd>
                <?php echo $this->Html->link($studentRegistration['State']['name'], array('controller' => 'states', 'action' => 'view', $studentRegistration['State']['id'])); ?>
                &nbsp;
            </dd>
            <dt><?php echo __('Country'); ?></dt>
            <dd>
                <?php echo $this->Html->link($studentRegistration['Country']['name'], array('controller' => 'countries', 'action' => 'view', $studentRegistration['Country']['id'])); ?>
                &nbsp;
            </dd>
            <dt><?php echo __('Date Of Birth'); ?></dt>
            <dd>
                <?php echo h(date('d-m-Y', strtotime($studentRegistration['StudentRegistration']['date_of_birth']))); ?>
                &nbsp;
            </dd>
           <dt><?php echo __('Place of Birth'); ?></dt>
            <dd>
                <?php echo h($studentRegistration['StudentRegistration']['place_of_birth']); ?>
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
           <dt><?php echo __('Secondary School Type'); ?></dt>
            <dd>
                <?php echo h($studentRegistration['StudentRegistration']['school_type']); ?>
                &nbsp;
            </dd>
            <dt><?php echo __('Secondary School Name'); ?></dt>
            <dd>
                <?php echo h($studentRegistration['StudentRegistration']['secondary_school_name']); ?>
                &nbsp;
            </dd>
            
        </dl>
    </div>
    <div class="right-side">
        <dl> 
            <dt><?php echo __('Nationality'); ?></dt>
            <dd>
                <?php echo h($studentRegistration['StudentRegistration']['nationality']); ?>
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
            <dt><?php echo __('Marital Status'); ?></dt>
            <dd>
                <?php echo h($studentRegistration['StudentRegistration']['marital_status']); ?>
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
            <dt><?php echo __('Guardian Annual Income'); ?></dt>
            <dd>
                <?php echo "$ ".h($studentRegistration['StudentRegistration']['guardian_annual_income']); ?>
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
            
            <dt><?php echo __('Total Percentage'); ?></dt>
            <dd>
                <?php echo h($studentRegistration['StudentRegistration']['total_percentage']); ?>
                &nbsp;
            </dd>
            <dt><?php echo __('Is Emp Referance'); ?></dt>
            <dd>
                <?php
                if ($studentRegistration['StudentRegistration']['is_emp_referance'] == 'Y') {
                    $reference = "Yes";
                } else {
                    $reference = "No";
                } echo h($reference);
                ?>
                &nbsp;
            </dd>
            <dt><?php echo __('Is Distance'); ?></dt>
            <dd>
                <?php
                if ($studentRegistration['StudentRegistration']['is_distance'] == 'Y') {
                    $distance = "Yes";
                } else {
                    $distance = "No";
                } echo h($distance);
                ?>
                &nbsp;
            </dd>
            <dt><?php echo __('Is Mature'); ?></dt>
            <dd>
                <?php
                if ($studentRegistration['StudentRegistration']['is_mature'] == 'Y') {
                    $mature = "Yes";
                } else {
                    $mature = "No";
                } echo h($mature);
                ?>
                &nbsp;
            </dd>
            <?php if ($studentRegistration['StudentRegistration']['is_mature'] == 'Y') { ?>
                <dt><?php echo __('Employee'); ?></dt>
                <dd>
                    <?php echo $this->Html->link($studentRegistration['Employee']['name'], array('controller' => 'employees', 'action' => 'view', $studentRegistration['Employee']['id'])); ?>
                    &nbsp;
                </dd>
            <?php } ?>
            <dt><?php echo __('Ip Address'); ?></dt>
            <dd>
                <?php echo h($studentRegistration['StudentRegistration']['ip_address']); ?>
                &nbsp;
            </dd>
            <dt><?php echo __('Submission Date'); ?></dt>
            <dd>
                <?php echo h(date('d-m-Y', strtotime($studentRegistration['StudentRegistration']['submission_date']))); ?>
                &nbsp;
            </dd>
            <dt><?php echo __('Created'); ?></dt>
            <dd>
                <?php echo h($studentRegistration['StudentRegistration']['created']); ?>
                &nbsp;
            </dd>
            <dt><?php echo __('Created By'); ?></dt>
            <dd>
                <?php echo h($createuser); ?>
                &nbsp;
            </dd>
            <dt><?php echo __('Modified'); ?></dt>
            <dd>
                <?php echo h($studentRegistration['StudentRegistration']['modified']); ?>
                &nbsp;
            </dd>
            <dt><?php echo __('Modified By'); ?></dt>
            <dd>
                <?php echo h($modifyuser); ?>
                &nbsp;
            </dd>
            <dt><?php echo __('Student Document'); ?></dt>
          
                 <?php if(!empty($studentRegistration['StudentRegistration']['student_document'])){ ?>
            <a href="<?php echo $this->webroot; ?>StudentRegistrations/download_document/<?php echo $studentRegistration['StudentRegistration']['id'] ?>"><input type="button" value="Download"></a>
            <?php } ?>
            
        </dl>
    </div>
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
                    <th><?php echo __('Marks'); ?></th>
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
    <?php endif; ?>&nbsp;
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
                <th colspan="4"><?php echo __('Group Subject');  ?></th></tr>
            <?php  if(!empty($stdselectedcollege)) { $a = 1; foreach ($stdselectedcollege as $value) { ?>
                <tr>
                    <td><?php echo $a;
                        ?>
                    </td>
                    <td>

                        <?php  echo htmlentities($value['collegename'], ENT_COMPAT); ?></td>
                    <td><?php //echo '' . htmlentities($value['universityname'], ENT_COMPAT) . "\n";
                    echo $this->StdRegistrations->getuniversity($value['university_id']);    
                    ?>
                    </td>
                    <?php if (isset($value['groupsubjectName']) && !empty($value['groupsubjectName'])):  ?>
                        <td><?php echo $value['groupsubjectName']; ?></td>


                            <?php endif; ?>

                </tr>
            <?php $a++; } } ?>
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

<?php /*listing admission status*/?>

 <div style="width:100%;">
        <table style="width:100%;">
            <tr>
                <td colspan="2">
                    <h3><?php echo __('Admission Status'); ?></h3>
                </td>
            </tr>
            <tr><?php if(!empty($allotedcollege) && $allotedcollege['StudentAlotment']['isCancelled']=='Y'){ ?>
                <td><h3><?php echo "This admission has been cancelled. Please contact immediately to College Administration"; ?></h3></td>
                <td><h3><?php if(!empty($cancelledinfo['AdmissionCancellation']['remarks'])) { echo "Reason : ".$cancelledinfo['AdmissionCancellation']['remarks']; } ?></h3></td>
                <?php }elseif(!empty($allotedcollege) && $allotedcollege['StudentAlotment']['isCancelled']=='N'){ ?>
                <td colspan="2"><h3><?php echo __('Admission Confirmed. Please view admission statement'); ?></h3></td>
                <?php }else{ ?>
                <td colspan="2"><strong><?php echo __('College alotment in progress...'); ?></strong></td>
                <?php } ?>
               </tr>
            
        </table>
 </div> &nbsp;


   
</div>

<div class="actions">
    <h3><?php echo __('Actions'); ?></h3>
    <ul>
        <li><?php echo $this->Html->link(__('Edit Student Registration'), array('action' => 'edit', $studentRegistration['StudentRegistration']['id'])); ?> </li>
        <li><?php echo $this->Form->postLink(__('Delete Student Registration'), array('action' => 'delete', $studentRegistration['StudentRegistration']['id']), null, __('Are you sure you want to delete # %s?', $studentRegistration['StudentRegistration']['id'])); ?> </li>
        <li><?php echo $this->Html->link(__('List Student Registrations'), array('action' => 'index')); ?> </li>
        <li><?php echo $this->Html->link(__('New Student Registration'), array('action' => 'add')); ?> </li>
        <li><?php echo $this->Html->link(__('List Courses'), array('controller' => 'courses', 'action' => 'index')); ?> </li>
        <li><?php echo $this->Html->link(__('New Course'), array('controller' => 'courses', 'action' => 'add')); ?> </li>
        <li><?php echo $this->Html->link(__('List Religions'), array('controller' => 'religions', 'action' => 'index')); ?> </li>
        <li><?php echo $this->Html->link(__('New Religion'), array('controller' => 'religions', 'action' => 'add')); ?> </li>
        <li><?php echo $this->Html->link(__('List Cities'), array('controller' => 'cities', 'action' => 'index')); ?> </li>
        <li><?php echo $this->Html->link(__('New City'), array('controller' => 'cities', 'action' => 'add')); ?> </li>
        <li><?php echo $this->Html->link(__('List States'), array('controller' => 'states', 'action' => 'index')); ?> </li>
        <li><?php echo $this->Html->link(__('New State'), array('controller' => 'states', 'action' => 'add')); ?> </li>
        <li><?php echo $this->Html->link(__('List Countries'), array('controller' => 'countries', 'action' => 'index')); ?> </li>
        <li><?php echo $this->Html->link(__('New Country'), array('controller' => 'countries', 'action' => 'add')); ?> </li>
        <li><?php echo $this->Html->link(__('List Group Subjects'), array('controller' => 'group_subjects', 'action' => 'index')); ?> </li>
        <li><?php echo $this->Html->link(__('New Group Subject'), array('controller' => 'group_subjects', 'action' => 'add')); ?> </li>
        <li><?php echo $this->Html->link(__('List Employees'), array('controller' => 'employees', 'action' => 'index')); ?> </li>
        <li><?php echo $this->Html->link(__('New Employee'), array('controller' => 'employees', 'action' => 'add')); ?> </li>

    </ul>
</div>
