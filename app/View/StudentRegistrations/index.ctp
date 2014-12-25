<div class="studentRegistrations index">
<?php  echo $this->Html->addCrumb("Student Admission", '/StudentRegistrations'); ?>
	<h2><?php echo __('Student Registrations'); ?></h2>
	

	<?php /*search student by colleges*/ 
        $years = array(date('Y')-10=>date('Y')-10,date('Y')-9=>date('Y')-9,date('Y')-8=>date('Y')-8,date('Y')-7=>date('Y')-7,date('Y')-6=>date('Y')-6,date('Y')-5=>date('Y')-5,date('Y')-4=>date('Y')-4,date('Y')-3=>date('Y')-3,date('Y')-2=>date('Y')-2,date('Y')-1=>date('Y')-1,date('Y')=>date('Y')); ?>

	<?php echo $this->Form->create('StudentRegistration', array('url' => "index",'onsubmit'=>'return checkvalidation()')); ?>
	<div class="form-area2">
    
    <div class="left-area" style="width:41%!important">
    	<?php if(!empty($universityID)) { $universityID = $universityID;}else{ $universityID = '';}?>
	<?php echo $this->Form->input('university_id',array('id'=>'universityID','empty'=>'select','selected'=>$universityID,'options'=>$universities));?>
	
	</div>
    
    <div class="right-area" style="width:41%!important">
    

    
    <?php  if(!empty($collegeid)){ $collegeid = $collegeid; } else { $collegeid = ''; }
    echo $this->Form->input('college_id',array('id'=>'collegeID','empty'=>'select','select'=>true,'options'=>$colleges,'selected'=>$collegeid));?>
    </div>
    
    <div class="left-area" style="width:41%!important">
    	<?php if(!empty($selectedyear)) { $selectedyear = $selectedyear; }else{ $selectedyear = '';}?>
	<?php echo $this->Form->input('year',array('id'=>'year','empty'=>'select','selected'=>$selectedyear,'options'=>$years));?>
	
	</div>
    </div>
    <div class="right-area">
	<div id="form-button">
	
	<?php echo $this->Form->end(__('Search')); ?>
	<div class="submit" style="padding-left:8px;">

	<?php echo $this->Form->reset('Reset', array('title' => 'Reset','value'=>'Reset','type' => 'submit')); ?>
	</div>
	</div>
	</div>
	<?php /**/?>
	<?php if(!empty($studentRegistrations)) { ?>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('admission_type'); ?></th>
			<th><?php echo $this->Paginator->sort('application_number'); ?></th>
			<th><?php echo $this->Paginator->sort('certificate_index'); ?></th>
                        <th><?php echo $this->Paginator->sort('applicant_name'); ?></th>
			<th><?php echo $this->Paginator->sort('country_id'); ?></th>
			
			<th><?php echo $this->Paginator->sort('stream'); ?></th>

			<th><?php echo $this->Paginator->sort('total_percentage'); ?></th>
			<th><?php echo $this->Paginator->sort('Allotted'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php 
	foreach ($studentRegistrations as $studentRegistration):
	?>
	<tr>
		<td><?php if($studentRegistration['StudentRegistration']['admission_type']=='N'){ $admissionType =  "Normal";}else{ $admissionType =  "Private"; } echo h($admissionType); ?>&nbsp;</td>

		<td>
			<?php echo $studentRegistration['StudentRegistration']['application_number']; ?>
		</td>
               <td><?php echo h($studentRegistration['StudentRegistration']['certificate_index']); ?>&nbsp;</td>
                <td><?php echo h($studentRegistration['StudentRegistration']['applicant_name']); ?>&nbsp;</td>

		<td>
			<?php echo $this->Html->link($studentRegistration['Country']['name'], array('controller' => 'countries', 'action' => 'view', $studentRegistration['Country']['id'])); ?>
		</td>
		
		
		
		<td><?php echo h($studentRegistration['StudentRegistration']['stream']); ?>&nbsp;</td>
		
		
                    <td><?php if($this->StdRegistrations->getpercentage($studentRegistration['StudentRegistration']['total_percentage'])){ echo $this->StdRegistrations->getpercentage($studentRegistration['StudentRegistration']['total_percentage']); }else{ echo h($studentRegistration['StudentRegistration']['total_percentage']); } ?>&nbsp;</td>
		
		<td> <?php //$this->StdRegistrations->isallotted($studentRegistration['StudentRegistration']['id']); ?>
                        <?php if($this->StdRegistrations->isallotted($studentRegistration['StudentRegistration']['id'])){ echo "Yes"; }else{ echo "No"; }//echo $this->Html->link($studentRegistration['Employee']['name'], array('controller' => 'employees', 'action' => 'view', $studentRegistration['Employee']['id'])); ?>
		</td>
		
		<td>
		<?php  $status = $studentRegistration['StudentRegistration']['active'];
		if(!empty($status) && $status=='Y'){
		$activeimage =  'icon_enabled.gif';
		$title = 'Inactive';
		}else if(!empty($status) && $status=='N'){
		$activeimage =  'icon_disabled.gif';
		$title = 'Active';

		}else{
		$activeimage =  '';
		$title = '';
		}
		echo $this->Form->postLink($this->Html->image($activeimage), array('action' => 'change_status', $studentRegistration['StudentRegistration']['id']), array('escape' => false,'title'=>$title), __('Are you sure you want to change status to '.$title.'  # %s?', $studentRegistration['StudentRegistration']['id'])); ?>
		
                    <?php echo $this->Html->image('view.png', array('url' => array('action' => 'view', $studentRegistration['StudentRegistration']['id']),'title'=>"View")); ?>
                    <?php if(!empty($isalloted) && $isalloted == 'Y') { ?>
                        <?php echo $this->Html->image('edit_button.png', array('url' => array('action' => 'changecollege', $studentRegistration['StudentRegistration']['id']),'title'=>"Change College"));?>
                    <?php }else { ?>
                        <?php echo $this->Html->image('edit_button.png', array('url' => array('action' => 'edit', $studentRegistration['StudentRegistration']['id']),'title'=>"Edit")); ?>
                        
                    <?php echo $this->Form->postLink($this->Html->image('delete_button.png'), array('action' => 'delete', $studentRegistration['StudentRegistration']['id']), array('escape' => false,'title'=>"Delete"), __('Are you sure you want to delete # %s?', $studentRegistration['StudentRegistration']['id'])); ?>
                    <?php } ?>
                </td>
	</tr>
<?php endforeach;   ?>
	</table>
	<p>
	<?php
	$this->Paginator->options(array('url' => $this->passedArgs));
	echo $this->Paginator->counter(array(
	'format' => __('Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}')
	));
	?>
	</p>
	<div class="paging">
	<?php
		echo $this->Paginator->prev('< ' . __('previous'), array(), null, array('class' => 'prev disabled'));
		echo $this->Paginator->numbers(array('separator' => ''));
		echo $this->Paginator->next(__('next') . ' >', array(), null, array('class' => 'next disabled'));
	?>
	</div>
	<?php }else{ ?>
	<table cellpadding="0" cellspacing="0">
	<tr><td><h3><?php echo "No record found";?></h3></td></tr>
	</table>
	<?php } ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('New Student Registration'), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Courses'), array('controller' => 'courses', 'action' => 'index')); ?> </li>
		
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
                <li><?php echo $this->Form->postLink(__('Run Allocation Process'), array('controller' => 'StudentRegistrations', 'action' => 'Allocation'),array('escape' => false,'title'=>'Allocation Process'), __('Are you sure you want to Reallocate  # %s?','Alloted Seats')); ?> </li>
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
