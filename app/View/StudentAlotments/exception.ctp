<div class="studentAlotments index">
<?php  echo $this->Html->addCrumb("Student Alotment", '/StudentAlotments'); ?>
    <h2><?php echo __('Results'); ?></h2>

    <?php echo $this->Form->create('StudentAlotment', array('url' => "exception")); ?>
    <div class="form-area2">

        <div class="left-area" style="width:41%!important">
                <?php if (!empty($universityID)) {
                    $universityID = $universityID;
                } else {
                    $universityID = '';
                } ?>
<?php echo $this->Form->input('university_id', array('id' => 'universityID', 'empty' => 'select', 'selected' => $universityID, 'options' => $universities)); ?>
        </div>
        <div class="right-area" style="width:41%!important">
                <?php if (!empty($courseID)) {
                    $courseID = $courseID;
                } else {
                    $courseID = '';
                } ?>
<?php echo $this->Form->input('course_id', array('id' => 'courseID', 'empty' => 'select', 'selected' => $courseID, 'options' => $courses)); ?>
        </div>
    </div>
    <div class="right-area">
        <div id="form-button">

        <?php echo $this->Form->end(__('Search')); ?>
            <div class="submit" style="padding-left:8px;">

        <?php echo $this->Form->reset('Reset', array('title' => 'Reset', 'value' => 'Reset', 'type' => 'submit')); ?>
            </div>
        </div>
    </div>

    <table cellpadding="0" cellspacing="0">
        <tr class="headblock">

            <th><?php echo 'University'; ?></th>
            <th><?php echo 'College'; ?></th>
            <th><?php echo 'Course'; ?></th>
            <th><?php echo 'College Code'; ?></th>
            <th><?php echo 'Planned Nos'; ?></th>
            <th><?php echo 'Nominated Nos'; ?>
        <table><tr><td>Male</td><td>Female</td><td>Total</td></tr></table>
        </th>
        <th>Percentage</th>
        <th>Differentiation</th>
        <th>Remarks</th>

        </tr>
	<?php
	 $cssclass='';
	 foreach ($exceptionallotment as $exceptionallotment):
	 if(!empty($exceptionallotment['Colleges']['no_of_seats']) && $exceptionallotment['Colleges']['no_of_seats']<$exceptionallotment[0]['opt']):
	 $cssclass="class='exception'";
	 endif;
	  ?>
        <tr>
            <td><?php echo $this->StdRegistrations->getuniversity(@$exceptionallotment['Colleges']['university_id']); ?>&nbsp;</td>	
            <td><?php echo @$exceptionallotment['Colleges']['name']; ?>&nbsp;</td>		
            <td><?php echo $this->StdRegistrations->getcourse(@$exceptionallotment['StudentAlotment']['course_id']); ?>&nbsp;</td>		
            <td><?php echo @$exceptionallotment['Colleges']['college_code']; ?>&nbsp;</td>		
            <td <?php echo $cssclass;?>><?php echo @$exceptionallotment['Colleges']['no_of_seats']; ?>&nbsp;</td>
            <td <?php echo $cssclass;?>>
                <table>
                    <tr>
                        <td><?php echo @$exceptionallotment[0]['malecount']; ?>&nbsp;</td>
                        <td><?php echo @$exceptionallotment[0]['femalecount']; ?>&nbsp;</td>
                        <td><?php echo @$exceptionallotment[0]['opt']; ?>&nbsp;</td>
                    </tr>
                </table>

            </td>		
            <td><?php if(!empty($exceptionallotment['Colleges']['id'])){ 
                echo $this->StdRegistrations->getlastadmper($exceptionallotment['Colleges']['id'],$exceptionallotment['StudentAlotment']['allocation_year']); 
                
            } ?><?php //echo "%"; ?>
            </td>
            <td><?php echo $this->StdRegistrations->getsummationspecialized($exceptionallotment['Colleges']['id'],$exceptionallotment['StudentAlotment']['allocation_year']); ?></td>
            <td><?php echo (String) $remarks =  @$exceptionallotment[0]['opt']-@$exceptionallotment['Colleges']['no_of_seats'];?></td>

        </tr>
         <?php endforeach; ?>
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
        <li><?php echo $this->Html->link(__('New Student Registration'), array('controller' => 'student_registrations', 'action' => 'add')); ?> </li>
        <li><?php echo $this->Html->link(__('List College Group Subjects'), array('controller' => 'college_group_subjects', 'action' => 'index')); ?> </li>
        <li><?php //echo $this->Html->link(__('Nominated Student list'), array('action' => 'nominatedstudent')); ?> </li>
        <li><?php echo $this->Html->link(__('Last Nominated Percentage'), array('action' => 'listallocatedpercentage')); ?> </li>
        <li><?php echo $this->Html->link('Download Results',array('action'=>'download_exceptions'))?></li>

    </ul>
</div>