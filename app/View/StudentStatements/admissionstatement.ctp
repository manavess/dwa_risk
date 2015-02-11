<?php

echo $this->Html->script('jquery.js'); ?>
<?php if(!$loggedIn){?>

<ul class="breadcrum"><li><?php echo $this->Html->addCrumb('Admission >>','#'); ?>      
        &nbsp;&nbsp;&nbsp;Student Admission Statement</li></ul>

		<?php }?>
<div class="studentRegistrations form col4">
    <h1><?php if(!empty($totalpercentage)) { echo "Applicant Name : ".$totalpercentage['StudentRegistration']['applicant_name']; } ?></h1>
    <form id="addstudentregistration" action="<?php echo $this->webroot; ?>studentRegistrations/add" enctype="multipart/form-data" method="post" onsubmit = "checkdate()">
        <?php echo $this->Form->create('StudentRegistration'); ?>
        <fieldset>

            <div class="form-area2">

                <table>
                    <tr>
                        <th><?php echo "University"; ?></th>
                        <th><?php echo "College"; ?></th>
                        <th><?php echo "Course"; ?></th>
                        <th><?php echo "Preference No"; ?></th>
                        <th><?php echo "% of last student"; ?></th>

                    </tr>
						<?php if(!empty($studentallocation)){
							 $i=1;
							 $universityname = '';
							 foreach($studentallocation as $college)
							{ 
								if($allotedcollege['College']['id']==$college['CollegeGroupSubject']['College']['id']){
	
									$universityname = $college['CollegeGroupSubject']['College']['University']['name'];
								}
								?>
                    <tr>
                        <td><?php echo $college['CollegeGroupSubject']['College']['University']['name']; ?></td>
                        <td><?php echo $college['CollegeGroupSubject']['College']['name']; ?></td>
                        <td><?php //echo $college['CollegeGroupSubject']['GroupSubjects']['name']; ?><?php if(!empty($totalpercentage['Course']['name'])) { echo $totalpercentage['Course']['name']; } ?></td>
                        <td><?php if(!empty($preferences[$college['CollegeGroupSubject']['id']])){ echo $preferences[$college['CollegeGroupSubject']['id']]; } ?></td>
                        <td><?php echo $college['0']['total_percentage']; ?></td>

                    </tr>
							<?php $i++; } ?>

                    <tr>

                        <td colspan="4" align="left"><strong>Percentage/Grade achieved by student based on available plans</strong></td>
                        <td><?php if(!empty($totalpercentage['totalmarks'])){ echo $totalpercentage['totalmarks'].'/'.$totalpercentage['StudentRegistration']['total_percentage']; }else{ echo $totalpercentage['StudentRegistration']['total_percentage'];}?></td>

                    </tr>
						<?php if(!empty($grade) && $grade['StudentAlotment']['isCancelled']=='N') { ?>
                    <tr>

                        <td colspan="1" align="left"><strong>Alloted College</strong></td>
                        <td  colspan="3" align="left"><strong>
							<?php echo $allotedcollege['College']['name'] ?></strong></td>
                        <td><?php if(!empty($universityname)) { 
                            echo $universityname; 
                            
                        } ?></td>


                    </tr>

                    <tr>
                        <td><strong>Rank:</strong></td>
                        <td colspan="4" align="left"><strong>
								<?php if(!empty($grade)){ echo $grade['StudentAlotment']['grade']; }?></strong></td>


								<?php  }else{?>
                        <td colspan="5" align="left" style="color:red"><strong>Admission cancelled</strong></td>
                    </tr>
							<?php	} ?>
							<?php } ?>
                </table>

            </div>

        </fieldset>

    </form>
			<?php if(!empty($totalpercentage['StudentRegistration']['id'])) {?>
    <div style="width:100%; text-align:center">
        <div class="submit" align="center" width="100%" title="Student information board"><?php echo $this->Html->link(__('Student information board'), array('controller'=>'StudentRegistrations','action' => 'studentinfoboard')); ?>
			<?php //echo $this->Html->link(__('Admission Receipt'), array('controller'=>'StudentRegistrations','action' => 'reciept',$totalpercentage['StudentRegistration']['id'])); ?>
        </div>
			<?php }else{ echo "Check Application Number"; } ?>  
    </div>
</div>

<script>
    $("#applicantnumber").blur(function() {

        $.ajax({
            type: 'POST',
            data: {applicationNum: $("#applicantnumber").val()},
            url: "<?php echo $this->webroot; ?>StudentStatements/getstudentdetails",
            success: function(data) {
                alert(data);
            }
        });
        return true;
    });
</script>
