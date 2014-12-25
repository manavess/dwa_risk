<?php //?>
<table>
<tr>
	<th><?php echo "University"; ?></th>
	<th><?php echo "College"; ?></th>
	<th><?php echo "Course"; ?></th>
	<th><?php echo "Preference No"; ?></th>
	<th><?php echo "% of last student"; ?></th>
                
</tr> 
<?php  if(!empty($prefferedcolleges)){
 $i=0; foreach($prefferedcolleges as $college){ 
		if($allotedcollege['Colleges']['id']==$college['colleges']['id']){
                    $universityname = $this->StdRegistrations->getuniversity($college['colleges']['university_id']);
		}
	?>
<tr>   <?php //pr($college); die; ?>
	<td><?php echo $this->StdRegistrations->getuniversity($college['colleges']['university_id']); ?></td>
	<td><?php echo $college['colleges']['name']; ?></td>
        <td><?php if(!empty($totalpercentage['Course']['name'])) { echo $totalpercentage['Course']['name']; } ?></td>
        <td><?php if(!empty($college['student_prefered_colleges']['college_preference'])){ echo $college['student_prefered_colleges']['college_preference']; } ?></td>
        <td><?php if(!empty($college['student_prefered_colleges']['college_id'])){ echo $this->StdRegistrations->getlastadmper($college['student_prefered_colleges']['college_id'],$grade['StudentAlotment']['allocation_year']); } ?></td>
                
</tr>
<?php $i++; } ?>

<tr>
	
	<td colspan="4" align="left"><strong>Percentage/Grade achieved by student based on available plans</strong></td>
	<td><?php echo $totalpercentage['StudentRegistration']['total_percentage'];?></td>
                
</tr>
<?php if(!empty($grade) && $grade['StudentAlotment']['isCancelled']=='N') { ?>
<tr>
	
	<td colspan="1" align="left"><strong>Alloted College</strong></td>
	<td colspan="3" align="left"><strong>
	<?php echo $allotedcollege['Colleges']['name'] ?></strong></td>
	<td><?php if(!empty($universityname)){ echo $universityname; } ?></td>
	       
</tr>

<tr>
<td><strong>Rank:</strong></td>
<td colspan="4" align="left"><strong>
	<?php if(!empty($grade)){echo $grade['StudentAlotment']['grade']; }?></strong></td>


	<?php  }else{?>
	<td colspan="5" align="left" style="color:red"><strong>Admission cancelled</strong></td>
	</tr>
<?php	} ?>

<?php }else{ ?>



<tr>
	<td colspan="5">No Record Found!</td>
	
			
</tr>

<?php } ?>
</table>