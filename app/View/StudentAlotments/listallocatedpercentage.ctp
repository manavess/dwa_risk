<div class="studentAlotments index">
<?php  echo $this->Html->addCrumb("Student Alotment", '/StudentAlotments'); ?>
    <h2><?php echo __('Percentage Of Last Nominated Students'); ?></h2>
	<?php echo $this->Form->create('StudentAlotment',array('url'=>array('controller'=>'StudentAlotments','action'=>'listallocatedpercentage'),'onsubmit'=>'return validatelistallocation()')); ?>
    <div class="form-area2">

        <div class="left-area" style="width:41%!important">
	<?php echo $this->Form->input('university_id',array('id'=>'universityID','empty'=>'select','options'=>$universities,'required'=>true));?>

        </div>

        <div class="right-area" style="width:41%!important">

    <?php if(!empty($collegeid)){ $collegeid =$collegeid; } else { $collegeid = ''; }
    echo $this->Form->input('college_id',array('id'=>'collegeID','empty'=>'select','select'=>true,'options'=>$colleges,'selected'=>$collegeid,'required'=>true));?>
        </div>

    </div>
    <div class="right-area">
        <div id="form-button">
	<?php echo $this->Form->end(__('Search')); ?>
        </div>
    </div>
    <table cellpadding="0" cellspacing="0">
        <tr class="headblock">

            <th><?php echo 'S.No'; ?></th>
            <th><?php echo 'College code'; ?></th>
            <th><?php echo 'College'; ?></th>
            <th><?php echo 'Marks(%)'; ?></th>
            <th><?php echo 'Allocation year'; ?></th>

        </tr>
	<?php
        $i = 1;
        if(!empty($listallocatedpercentage)){
	 foreach ($listallocatedpercentage as $listallocatedpercentage): ?>
	 <?php if(!empty($listallocatedpercentage['Colleges']['name']) && !empty($listallocatedpercentage[0]['total_percentage'])){?>
        <tr>
            <td><?php echo $i; ?></td>
            <td><?php echo @$listallocatedpercentage['Colleges']['college_code']; ?>&nbsp;</td>		
            <td><?php echo @$listallocatedpercentage['Colleges']['name']; ?>&nbsp;</td>		
            <td><?php echo @$listallocatedpercentage[0]['total_percentage']; ?>&nbsp;</td>
            <td><?php echo @$listallocatedpercentage['StudentAlotment']['allocation_year']; ?>&nbsp;</td>		

        </tr>
        <?php } $i++; endforeach; }else{ ?>
        <tr><td colspan="5">No Record Found!</td></tr>
       <?php } ?>
    </table>
    <p>
	<?php
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
        <li><?php echo $this->Html->link('Download last allocated percentage',array('action'=>'download_listallocated_percentage'))?></li>


    </ul>
</div>
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

    function validatelistallocation() {
        var universityID = $("#universityID option:selected").val();
        var collegeID = $('#collegeID option:selected').val();
        var status = '';


        if (collegeID == '') {
            alert("Please select College");
            status = false;
        } else {
            status = true;
        }

        if (universityID != '' && collegeID == '') {
            alert("Please select College");
            status = false;
        } else {

            status = true;
        }

        if (status == true) {
            return true;
        } else {
            return false;
        }

    }
</script>