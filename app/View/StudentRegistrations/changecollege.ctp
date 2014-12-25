<div class="studentRegistrations index">
<?php  echo $this->Html->addCrumb("Student Admission", '/StudentRegistrations'); ?>
    <h2>
        <?php echo __('Student Amendment Form'); ?>
    </h2>
<?php echo $this->Form->create('StudentRegistration', array('url'=>array('controller'=>'StudentRegistrations','action'=>'changecollege',$editId))); ?>
    <div class="form-area2">

        <div class="left-area" style="width:41%!important">
    	<?php 
//        if(!empty($groupSubjectID)) { 
//            $groupSubjectID = $groupSubjectID;
//            
//        }else{ 
//            $groupSubjectID = '';
//        }
        
//        echo $this->Form->input('groupsubject_id',array('label'=>'Select Group Subject','id'=>'groupSubjectID','empty'=>'select','selected'=>$groupSubjectID,'options'=>$groupsubjects));
        echo $this->Form->input('application_number',array('type'=>'hidden','value'=>$studentRegistration['StudentRegistration']['application_number']));
        echo $this->Form->input('alotmentID',array('type'=>'hidden','value'=>(isset($studentalotmentID) ? $studentalotmentID:'')));
        ?>

        </div>

        <div class="right-area" style="width:41%!important">

            <?php  
            if(!empty($collegeid)){ 
                
                $collegeid = $collegeid; 

            } else { 
                
                $collegeid = ''; 

            }//pr($colleges);die;
            //echo $this->Form->input('college_id',array('label'=>'Select College','id'=>'collegeID','empty'=>'select','select'=>true,'options'=>$colleges,'selected'=>$collegeid));
            echo $collegeoptions;
            ?>
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
                <dt><?php echo __('Applicant Name'); ?></dt>
                <dd>
                <?php echo h($studentRegistration['StudentRegistration']['applicant_name']); ?>
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
                    <td><input type="hidden" class='subjects' name="subjectid[]" value="<?php echo $val['sub_id'];?>">
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

    </div>
</div>
<div class="actions">
    <h3><?php echo __('Actions'); ?></h3>
    <ul>
        <li><?php echo $this->Html->link(__('New Student Registration'), array('action' => 'add')); ?></li>
    </ul>
</div><?php //echo $this->element('sql_dump');?>

<script>
    $('#groupSubjectID').change(function() {
        $.ajax({
            type: 'POST',
            data: {groupsubject_id: $("#groupSubjectID option:selected").val()},
            url: "<?php echo $this->webroot; ?>StudentAlotments/getcollegelist",
            success: function(data) {
                $('#collegeID').html(data);
            }
        });
        return true;
    });

    function checkvalidation() {
        var groupSubjectID = $("#groupSubjectID option:selected").val();
        var collegeID = $('#collegeID option:selected').val();
        var status = '';

        if (groupSubjectID == '') {
            alert("Please select Group Subject");
            status = false;
        } else {
            status = true;
        }

        if (collegeID == '') {
            alert("Please select College");
            status = false;
        }

        if (groupSubjectID != '' && collegeID == '') {
            alert("Please select College");
            status = false;
        }

        if (status == true) {
            return true;
        } else {
            return false;
        }

    }
    $(document).ready(function() {
//var val = new Array();
        $i = 0;

        var arr = new Array();

        $('.subjects').each(function() {
            arr[i++] = $(this).val();
            alert(arr);
        });
//alert(val);

        str = arr.toString();

//alert(str); return false;

        var str = arr.toString();
        var admissiontype = $('#admissiontype option:selected').val();
        var status = false;
        if (status)
        {
            $.ajax({
                type: 'POST',
                data: {GroupSubject: str, admissiontype: admissiontype, nationality: $("#StudentRegistrationNationality").val()},
                url: "<?php echo $this->webroot; ?>StudentRegistrations/getcollegelist",
                success: function(data) {

                    $('#collegelist').html(data);

                    $('#college').show();
                    //calculateValue();

                }
            });
        }
    });

</script>
