<?php echo $this->Html->css('jquery-ui.css'); ?>
<?php echo $this->Html->script('jquery.js'); ?>
<?php echo $this->Html->script('jquery-ui.js'); ?>
<?php //echo $this->Html->script('jquery.validate.js');  ?>


<script>
    $(function() {
        $("#student_pic").bind("change", previewImages);
        $("#datepicker").datepicker({dateFormat: 'dd-mm-yy'});
        $("#datepicker1").datepicker({dateFormat: 'dd-mm-yy'});
        $("#datepicker2").datepicker({dateFormat: 'dd-mm-yy'});
        $("#datepicker3").datepicker({dateFormat: 'dd-mm-yy'});
        $("#datepicker4").datepicker({dateFormat: 'dd-mm-yy'});
        $("#datepicker5").datepicker({dateFormat: 'dd-mm-yy'});
    });
</script>
<?php echo $this->Html->addCrumb("Student Admission", '/StudentRegistrations'); ?>
<div class="studentRegistrations form col4">

    <?php echo $this->Form->create('StudentRegistration', array('url' => array('controller' => 'StudentRegistrations', 'action' => 'edit'), 'onsubmit' => "return checkdate()", 'id' => "addstudentregistration", 'enctype' => 'multipart/form-data')); ?>
    <fieldset>
        <?php
        //pr($this->data);die;
        $admissionType = array();
        if ($this->data['StudentRegistration']['admission_type'] == 'P') {
            $admissionType = array('P' => 'Private');
        } else if ($this->data['StudentRegistration']['admission_type'] == 'N') {
            $admissionType = array('N' => 'Normal');
        }

        // $admissionType = array('N' => 'Normal', 'P' => 'Private');
        $genderValue = $this->data['StudentRegistration']['gender'];
        $isemployeeValue = $this->data['StudentRegistration']['is_emp_referance'];
        $isdistanceValue = $this->data['StudentRegistration']['is_distance'];
        $ismatureValue = $this->data['StudentRegistration']['is_mature'];

        $gender = array('M' => 'Male', 'F' => 'Female');
        $empreference = array('Y' => 'Yes', 'N' => 'No');
        $isdistance = array('Y' => 'Yes', 'N' => 'No');
        $ismature = array('Y' => 'Yes', 'N' => 'No');
        $marksgrade = array('G' => 'Grade', 'M' => 'Marks');

        $schooltypeID = '';
        if (!empty($this->data['StudentRegistration']['school_type'])) {
            $schooltypeID = $this->data['StudentRegistration']['school_type'];
        }
        $marital_statusID = '';
        if (!empty($this->data['StudentRegistration']['marital_status'])) {
            $marital_statusID = $this->data['StudentRegistration']['marital_status'];
        }

        $nationalityID = '';
        if (!empty($this->data['StudentRegistration']['nationality'])) {
            $nationalityID = $this->data['StudentRegistration']['nationality'];
        }
        ?>
        <div class='heading'><span><?php echo __('ADMISSION FORM'); ?></span><br /><?php echo __('ACADEMIC YEAR 2012-2013.'); ?></div>
        <div class="photo">
            <div class="photo-area"> <?php if (!empty($this->data['StudentRegistration']['photo'])) { ?>
                    <img width="120" height="150" src="data:image/jpeg;base64, <?php echo base64_encode($this->data['StudentRegistration']['photo']); ?>" />
    <?php
}
?></div>

        </div>
        <div id="error_message" style="color:red"></div>
        <div class="form-area2">
            <div class="left-area">
<?php
echo $this->Form->input('id');
echo $this->Form->input('photo', array('id' => 'student_pic', 'type' => 'file', 'label' => false));
echo $this->Form->input('id', array('type' => 'hidden', 'id' => 'studentRegistrationID'));

echo $this->Form->input('admission_type', array('id' => 'admissiontype', 'type' => 'select', 'options' => $admissionType, 'style' => 'width:200px;', 'required' => true, 'message' => 'please select admission type', 'onclick' => 'collegelist()'));
echo $this->Form->input('applicant_name', array('tabindex' => '1', 'class' => 'applicantname'));
echo $this->Form->input('application_number', array('readonly', 'class' => 'disableinput'));
echo $this->Form->input('Address1', array('tabindex' => '2', 'class' => 'applicantname'));
echo $this->Form->input('Address2', array('tabindex' => '3'));
echo $this->Form->input('Address3', array('tabindex' => '4'));
echo $this->Form->input('closest_relative_name', array('tabindex' => '4'));
echo $this->Form->input('closest_relative_add', array('tabindex' => '4'));
echo $this->Form->input('country_id', array('tabindex' => '5', 'empty' => 'Select', 'id' => 'studentcountry', 'style' => 'width:200px;', 'required' => true, 'message' => 'Please select an item'));
echo $this->Form->input('state_id', array('tabindex' => '6', 'options' => $states, 'id' => 'countryState', 'style' => 'width:200px', 'required' => true, 'select' => true, 'message' => 'Please select an item', 'selected' => $this->data['StudentRegistration']['state_id']));
echo $this->Form->input('city_id', array('tabindex' => '7', 'options' => $cities, 'id' => 'statecity', 'selected' => $this->data['StudentRegistration']['city_id'], 'style' => 'width:200px', 'required' => true, 'message' => 'Please select an item'));
echo $this->Form->input('pincode', array('tabindex' => '8'));
if ($this->data['StudentRegistration']['gender'] == 'M') {
    echo $this->Form->input('gender', array('tabindex' => '9', 'type' => 'radio', 'class' => 'radio', 'options' => $gender, 'selected' => $this->data['StudentRegistration']['gender']));
} else {
    echo $this->Form->input('gender', array('tabindex' => '9', 'type' => 'radio', 'class' => 'radio', 'options' => $gender));
}
echo $this->Form->input('religion_id', array('tabindex' => '10', 'empty' => 'Select', 'id' => 'religion', 'style' => 'width:200px;', 'required' => true, 'message' => 'Please select an item'));
$dateofbirth = date('d-m-Y', strtotime($this->data['StudentRegistration']['date_of_birth']));
$date1 = date('Y-m-d', strtotime($this->data['StudentRegistration']['date_of_birth']));
$dateofcertificate = date('d-m-Y', strtotime($this->data['StudentRegistration']['date_of_certificate']));
echo $this->Form->input('date_of_birth', array('tabindex' => '11', 'type' => 'text', 'value' => $dateofbirth, 'readonly', 'class' => 'disableinput'));
echo $this->Form->input('place_of_birth', array('tabindex' => '12', 'maxlength' => '50', 'required' => false));
echo $this->Form->input('type_of_certificate', array('tabindex' => '12', 'readonly', 'class' => 'disableinput'));
echo $this->Form->input('certificate_index', array('tabindex' => '13', 'readonly', 'class' => 'disableinput'));
echo $this->Form->input('date_of_certificate', array('tabindex' => '14', 'type' => 'text', 'value' => $dateofcertificate, 'readonly', 'class' => 'disableinput'));
$schtype = 0;
$selectedSchtype = '';
foreach ($schooltypes as $data) {
    if ($data == $this->data['StudentRegistration']['school_type']) {
        $selectedSchtype = $schtype;
    }
    $schtype++;
}
echo $this->Form->input('school_type', array('tabindex' => '15', 'empty' => 'Select', 'options' => $schooltypes, 'required' => false, 'selected' => $selectedSchtype));
echo $this->Form->input('secondary_school_name', array('tabindex' => '15'));


//Display selected Stream for the student

$i = 0;
foreach ($streams as $data) {
    if ($data == $this->data['StudentRegistration']['stream']) {
        $streamdata = $i;
    }
    $i++;
}

if (!empty($this->data['StudentRegistration']['stream'])) {
    echo $this->Form->input('stream', array('options' => $streams, 'select' => true, 'selected' => array($streamdata), 'required' => 'true'));
} else {
    echo $this->Form->input('stream', array('options' => $streams, 'select' => true, 'required' => 'true'));
}
echo $this->Form->input('course_id', array('tabindex' => '17', 'empty' => 'Select', 'id' => 'studentcourse', 'style' => 'width:200px;', 'required' => true, 'message' => 'Please select an item'));
echo $this->Form->input('course_id', array('type' => 'hidden', 'empty' => 'Select', 'id' => 'selectedCourse', 'selected' => $this->data['StudentRegistration']['course_id']));
?>
            </div>
            <div class="right-area"> 
                <?php
                if (!empty($this->data['StudentRegistration']['nationality']) && $this->data['StudentRegistration']['nationality'] == 'South Sudan') {
                    $nationalityID = 0;
                } else {
                    $nationalityID = 1;
                }

                echo $this->Form->input('nationality', array('maxlength' => '50', 'tabindex' => '18', 'empty' => 'Select', 'options' => $nationalities, 'required' => false, 'selected' => $nationalityID, 'onchange' => 'addforeign(), collegelist()', 'onload' => 'collegelist()'));
                ?>
                <?php
                if (!empty($this->data['StudentRegistration']['foreign_nationality'])) {
                    $isforeign = 'text';
                } else {
                    $isforeign = 'hidden';
                }
                ?>
                <div style="margin-left:180px;"><?php echo $this->Form->input('foreign_nationality', array('type' => $isforeign, 'tabindex' => '18', 'required' => false, 'label' => false)); ?></div>

                <?php
                echo $this->Form->input('nationality_number', array('tabindex' => '18'));
                echo $this->Form->input('nationality_issue_date', array('tabindex' => '19', 'type' => 'text', 'id' => 'datepicker2', 'readonly'));
                $isingle = 0;
                foreach ($marital_status as $data) {
                    if ($data == $this->data['StudentRegistration']['marital_status']) {
                        $mari_status = $isingle;
                    } else {
                        $mari_status = '';
                    }
                    $isingle++;
                }
                echo $this->Form->input('marital_status', array('tabindex' => '15', 'empty' => 'Select', 'options' => $marital_status, 'required' => false, 'selected' => array($mari_status)));
                echo $this->Form->input('passport_number', array('tabindex' => '20'));

                echo $this->Form->input('passport_issue_date', array('tabindex' => '21', 'type' => 'text', 'id' => 'datepicker3', 'readonly', 'date', 'value' => isset($this->data['StudentRegistration']['passport_issue_date']) ? $this->data['StudentRegistration']['passport_issue_date'] : ''));
                echo $this->Form->input('admission_office', array('tabindex' => '22'));
                //echo $this->Form->input('temporary_office', array('tabindex' => '23'));
                echo $this->Form->input('submission_office', array('tabindex' => '24'));
                echo $this->Form->input('guardian_name', array('tabindex' => '25'));
                echo $this->Form->input('guardian_occupation', array('tabindex' => '26'));
                echo $this->Form->input('guardian_nationality_number', array('tabindex' => '27'));
                echo $this->Form->input('guardian_nationality_issue_date', array('tabindex' => '28', 'type' => 'text', 'id' => 'datepicker4', 'readonly', 'date'));
                echo $this->Form->input('guardian_annual_income', array('tabindex' => '29', 'required' => false));
                if (!empty($this->data['StudentRegistration']['is_distance']) == 'Y') {
                    $isdis = 'Y';
                } else {
                    $isdis = 'N';
                }
                echo $this->Form->input('is_distance', array('tabindex' => '29', 'type' => 'radio', 'class' => 'radio', 'options' => $isdistance, 'default' => $isdis, 'name' => 'distanceoption', 'onclick' => 'chkdistanceoption()'));

                if ($this->data['StudentRegistration']['is_emp_referance'] == 'Y') {
                    ?>
                    <div id="empreferer">
                    <?php echo $this->Form->input('is_emp_referance', array('type' => 'radio', 'class' => 'radio', 'options' => $empreference, 'name' => 'employee', 'onclick' => 'selectEmployee()', 'default' => $this->data['StudentRegistration']['is_emp_referance'])); ?>
                    </div>
                    <div id="employeediv" style="display:block"><?php echo $this->Form->input('employee_id', array('empty' => 'Select', 'selected' => $this->data['StudentRegistration']['employee_id'])); ?></div>

<?php } else { ?>
                    <div id="empreferer">
                    <?php echo $this->Form->input('is_emp_referance', array('type' => 'radio', 'class' => 'radio', 'options' => $empreference, 'name' => 'employee', 'onclick' => 'selectEmployee()')); ?>
                    </div>
                    <?php } ?>

                <div id="employeediv" style="display:none"><?php echo $this->Form->input('employee_id', array('empty' => 'Select', 'selected' => $this->data['StudentRegistration']['employee_id'])); ?></div>


                <label style="margin-left:170px;">.pdf,.doc or jpeg files are uploaded in size not more than 1 MB/</label>
<?php echo $this->Form->input('student_document', array('tabindex' => '30', 'type' => 'file')); ?>
                <div class="button-area">
                <?php if (!empty($this->data['StudentRegistration']['student_document'])) { ?>
                        <a href="<?php echo $this->webroot; ?>StudentRegistrations/download_document/<?php echo $this->data['StudentRegistration']['id'] ?>"><input type="button" value="Download Document"></a>
                    <?php } ?>

                </div>
            </div>
<?php if (!empty($studentsgrade)) {
    $marksystem = 'G'; ?>
                <input type = "hidden" id="gradingsystem" value="G" />
            <?php } else {
                $marksystem = 'M'; ?>
                <input type = "hidden" id="gradingsystem" value="M" />
            <?php } ?>
            <div id ='grade' style="display:block;"><?php echo $this->Form->input('Percentage_marks', array('type' => 'radio', 'class' => 'radio', 'default' => $marksystem, 'options' => $marksgrade, 'name' => 'marks', 'label' => 'select grade or percentage marks', 'onchange' => 'changeHtml()')); ?></div>


            <div id="subject"></div>

            <div id="totalpercentage"><?php echo $this->Form->input('total_percentage', array('id' => 'totalPercentage', 'readonly')); ?></div>
            <input type="hidden" id="subjectdata" />
            <div id="college" style="display:none;">Select Colleges According to priority*</div>
            <div id="collegelist" ></div>

            <div id="ismaturediv"><?php
                if ($this->data['StudentRegistration']['is_mature'] == 'Y' && !empty($this->data['MatureStudent'])) {

                    echo $this->Form->input('is_mature', array('type' => 'radio', 'class' => 'radio', 'selected' => $this->data['StudentRegistration']['is_mature'], 'options' => $ismature, 'name' => 'matureStudent', 'onclick' => 'matureStudentoption()'));
                    ?>

                    <div id="maturestudent"><div><h3>For Mature students</h3><div><label>Work Experience </label>
                                <input type='text' name='workexp' id='workexp' value="<?php echo $this->data['MatureStudent'][0]['job_experience'] ?>">
                            </div>
                            <div class='second-block'><label>Birth Certificate Issue Date</label> 
                                <input type="text" name="certissuedate" value="<?php echo date('d-m-Y', strtotime($this->data['MatureStudent'][0]['birth_certificate_issue_date'])); ?>" date="date" id="datepicker5" onclick="getcalendar()"/>
                            </div>
                            <div class="non-star" style='margin-top:50px;'><?php if ($this->data['MatureStudent'][0]['working'] == 'Y') { ?><input type='checkbox' id='isworking' name='isworking' value="Y" checked="checked">
    <?php } else { ?>
                                    <input type='checkbox' id='isworking' name='isworking' value='N'>
                                <?php } ?><label style='width:55%;'>Are you currently working?</label>
                            </div>
                            <div class='second-block'><label>Address</label> 
                                <textarea id='address' name='address'><?php echo trim($this->data['MatureStudent'][0]['address']); ?>
                                </textarea>
                                <label>Company Name</label> 
                                <input type='text' name='compamyname' id='compamyname' value="<?php echo $this->data['MatureStudent'][0]['company_name']; ?>"></div></div></div>
    <?php
} else {

    echo $this->Form->input('is_mature', array('type' => 'radio', 'class' => 'radio', 'options' => $ismature, 'name' => 'matureStudent', 'onclick' => 'matureStudentoption()'));
}
?></div>
            <div id="maturestudent"></div>

        </div>
    </fieldset>
    <div id="form-button">
<?php echo $this->Form->end(__('Submit')); ?>
<?php echo $this->Form->end(__('Cancel', array('action' => 'index'))); ?>

    </div>

</div>
<div class="actions">
    <h3><?php echo __('Actions'); ?></h3>
    <ul>

        <li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('StudentRegistration.id')), null, __('Are you sure you want to delete # %s?', $this->Form->value('StudentRegistration.id'))); ?></li>
        <li><?php echo $this->Html->link(__('List Student Registrations'), array('action' => 'index')); ?></li>
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

        <li><?php echo $this->Html->link(__('List Employees'), array('controller' => 'employees', 'action' => 'index')); ?> </li>
        <li><?php echo $this->Html->link(__('New Employee'), array('controller' => 'employees', 'action' => 'add')); ?> </li>
    </ul>
</div> 
<script type="text/javascript">



    $(document).ready(function() {
        if ($("#admissiontype").val() == 'N') {
            $("#ismaturediv").hide();
            $("#empreferer").hide();

        } else if ($("#admissiontype").val() == 'P') {
            $("#ismaturediv").show();
            $("#empreferer").show();


        }
    });

    $("#admissiontype").change(function() {
        if ($("#admissiontype").val() == 'N') {
            $("#ismaturediv").hide();
            $("#empreferer").hide();



        } else if ($("#admissiontype").val() == 'P') {
            $("#ismaturediv").show();
            $("#empreferer").show();


        }
    });



    $('#studentcountry').change(function() {
        $.ajax({
            type: 'POST',
            data: {countryID: $("#studentcountry option:selected").val()},
            url: "<?php echo $this->webroot; ?>studentRegistrations/getstatelist",
            success: function(data) {
                $('#countryState').html(data);
            }
        });
        return true;
    });

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
    /*Course Selection and display*/

    $(document).ready(function() {
        var currentcourse = $("#selectedCourse").val();
        var courseoption = $("#studentcourse option:selected").val();
        var stdregID = $("#studentRegistrationID").val();
        marks_system = $('input[name=marks]:checked').val();


        $("#subjectdata").val($('#totalPercentage').val());

        if (currentcourse == courseoption) {
            //alert(currentcourse);
            $.ajax({
                type: 'POST',
                data: {Course: currentcourse, stdregistrationID: stdregID, markingtype: marks_system, nationality: $("#StudentRegistrationNationality").val(), AdmissionType: $("#admissiontype").val()},
                url: "<?php echo $this->webroot; ?>StudentRegistrations/getsubjectlist",
                success: function(data) {
                    $('#subject').html(data);
                    $('#totalpercentage').show();

                }
            });
            return true;
        }
    });

    /*Course selection*/
    $('#studentcourse').change(function() {
        var currentcourse = $("#selectedCourse").val();
        var courseoption = $("#studentcourse option:selected").val();
        var stdregID = $("#studentRegistrationID").val();
        marks_system = $('input[name=marks]:checked').val();
        $('#collegelist').hide('');

        if (currentcourse == courseoption) {
            //  alert(currentcourse);
            $.ajax({
                type: 'POST',
                data: {Course: currentcourse, stdregistrationID: stdregID, markingtype: marks_system, nationality: $("#StudentRegistrationNationality").val(), AdmissionType: $("#admissiontype").val()},
                url: "<?php echo $this->webroot; ?>StudentRegistrations/getsubjectlist",
                success: function(data) {
                    $('#subject').html(data);
                    $('#totalPercentage').val($("#subjectdata").val());
                    $('#totalpercentage').show();
                    $('#collegelist').show();

                }
            });
            return true;
        } else {

            $('#totalPercentage').val('');
            $.ajax({
                type: 'POST',
                data: {Course: $("#studentcourse option:selected").val(), Coursename: $("#studentcourse option:selected").text(), nationality: $("#StudentRegistrationNationality").val(), AdmissionType: $("#admissiontype").val()},
                url: "<?php echo $this->webroot; ?>StudentRegistrations/getsubjectlist",
                success: function(data) {
                    $('#subject').html(data);
                    $('#totalpercentage').show();
                    $('#collegelist').hide();
                }
            });
            return true;
        }
    });
    /*switch from grade to marks and marks to grade*/
    function changeHtml() {
        //alert($('input[name=marks]:checked').val());
        var markssystem = $("#gradingsystem").val();
        var onchangeradio_option = $('input[name=marks]:checked').val();
        if (markssystem != onchangeradio_option) {
            $(".subject_marks").val('');
            $('#totalPercentage').val('');
        }

        /*getting values from ajax call on change of grade and marks option*/
        if (markssystem == onchangeradio_option) {

            var currentcourse = $("#selectedCourse").val();
            var courseoption = $("#studentcourse option:selected").val();
            var stdregID = $("#studentRegistrationID").val();
            var marks_system = $("#gradingsystem").val();

            if (currentcourse == courseoption) {
                //  alert(currentcourse);
                $.ajax({
                    type: 'POST',
                    data: {Course: currentcourse, stdregistrationID: stdregID, markingtype: marks_system, nationality: $("#StudentRegistrationNationality").val(), AdmissionType: $("#admissiontype").val()},
                    url: "<?php echo $this->webroot; ?>StudentRegistrations/getsubjectlist",
                    success: function(data) {
                        $('#subject').html(data);
                        $('#totalPercentage').val($("#subjectdata").val());
                        $('#totalpercentage').show();
                    }
                });
                return true;
            } else {

                $('#totalPercentage').val('');
                $.ajax({
                    type: 'POST',
                    data: {Course: $("#studentcourse option:selected").val(), Coursename: $("#studentcourse option:selected").text(), nationality: $("#StudentRegistrationNationality").val(), AdmissionType: $("#admissiontype").val()},
                    url: "<?php echo $this->webroot; ?>StudentRegistrations/getsubjectlist",
                    success: function(data) {
                        $('#subject').html(data);
                        $('#totalpercentage').show();
                    }
                });
                return true;
            }

        }

    }



    function  calculateValue() {

        var arr = '<?php echo json_encode($listgrade); ?>';
        arr = $.parseJSON(arr);

        var point = '9';
        var indexToSplit = arr.indexOf(point);
        var first = arr.slice(0, indexToSplit + 1);
        var second = arr.slice(indexToSplit + 1);
        var grdpointval = new Array();

        var marks_system = $('input[name=marks]:checked').val();

        var i = 0;

        var j = 0;

        var k = 0;

        var data = new Array();

        var alphbeticval = new Array();
        //var patt=/[^0-9f-zF-Z]/;
        var numeric = new Array();

        $(".subject_marks").each(function() {

            if ($(this).val() != '')
            {
                //if(isNaN($(this).val()) && $(this).val().match(patt)){
                if ($.inArray($(this).val(), arr) > -1) {
                    if ($.inArray($(this).val(), first) > -1) {

                        grdpointval[j++] = $(this).val();

                    } else if ($.inArray($(this).val(), second) > -1) {

                        alphbeticval[j++] = $(this).val();
                    }



                }

                else {

                    numeric[k++] = $(this).val();

                }

                data[i++] = $(this).val();

            }
        });

        if (grdpointval.length > 1) {
            grdpointval = cleanArray(grdpointval);
        }
        if (alphbeticval.length > 1) {
            alphbeticval = cleanArray(alphbeticval);
        }
        if (numeric.length > 1) {
            numeric = cleanArray(numeric);
        }

        if (grdpointval.length === $(".subject_marks").length || alphbeticval.length === $(".subject_marks").length || numeric.length == $(".subject_marks").length) {

        } else {

            $('#totalpercentage').css('display', 'none');
            $('#totalPercentage').val('');
            $('#totalm').html('');
        }

        if (alphbeticval.length === $(".subject_marks").length || grdpointval.length === $(".subject_marks").length || numeric.length == $(".subject_marks").length) {
            if (marks_system == 'G') {
                if (alphbeticval.length == 7 || alphbeticval.length == 5) {

                    $.ajax({
                        type: 'POST',
                        data: {comp_subject: alphbeticval, markssystem: marks_system, gradesystem: 'G'},
                        url: "<?php echo $this->webroot; ?>StudentRegistrations/calculatepercentage",
                        success: function(data) {
                            $('#totalpercentage').css('display', 'block');
                            $('#totalPercentage').val(data);
                            $('#totalm').html(data);
                        }
                    });
                    return true;
                }

                if (grdpointval.length == 7 || grdpointval.length == 5) {

                    $.ajax({
                        type: 'POST',
                        data: {comp_subject: grdpointval, markssystem: marks_system, gradesystem: 'G'},
                        url: "<?php echo $this->webroot; ?>StudentRegistrations/calculatepercentage",
                        success: function(data) {
                            $('#totalpercentage').css('display', 'block');
                            $('#totalPercentage').val(data);
                            $('#totalm').html(data);
                        }
                    });
                    return true;
                }


            } else {
                if (marks_system == 'M' && numeric.length == 7 || numeric.length == 5) {

                    $.ajax({
                        type: 'POST',
                        data: {comp_subject: numeric, markssystem: marks_system},
                        url: "<?php echo $this->webroot; ?>StudentRegistrations/calculatepercentage",
                        success: function(data) {
                            $('#totalpercentage').css('display', 'block');
                            $('#totalPercentage').val(data);
                            $('#totalm').html(data);

                        }
                    });
                    return true;
                } else {
                    alert('please select grade to enter marks as grade');
                    $('#totalpercentage').css('display', 'none');
                    $('#totalPercentage').val('');
                    $('#totalm').html('');
                }
            }

        } else if (data.length === $(".subject_marks").length) {
            if (alphbeticval.length != $(".subject_marks").length || grdpointval.length != $(".subject_marks").length || numeric.length != $(".subject_marks").length) {

                if (marks_system == 'M') {
                    alert('please fill right marks');
                    $('#totalpercentage').css('display', 'none');
                    $('#totalPercentage').val('');
                    $('#totalm').html('');

                } else {
                    alert('please fill right grade');
                    $('#totalpercentage').css('display', 'none');
                    $('#totalPercentage').val('');
                    $('#totalm').html('');
                }
                return false;
            }
            $('#totalpercentage').css('display', 'none');
            $('#totalPercentage').val('');
            $('#totalm').html('');
        }

    }

    function cleanArray(actual) {
        var newArray = new Array();
        for (var i = 0; i < actual.length; i++) {
            if (actual[i]) {
                newArray.push(actual[i]);
            }
        }
        return newArray;
    }

    $(document).ready(function() {
        var stdregID = $("#studentRegistrationID").val();

        var subid = '<?php echo json_encode($studentSelectedSub); ?>';
        subid = $.parseJSON(subid);

        str = subid.toString();
        var status = true;

        var admissiontype = $('#admissiontype option:selected').val();

        if (status)
        {
            $.ajax({
                type: 'POST',
                data: {GroupSubject: str, admissiontype: admissiontype, stdregistrationid: stdregID, nationality: $("#StudentRegistrationNationality").val()},
                url: "<?php echo $this->webroot; ?>StudentRegistrations/getcollegelist",
                success: function(data) {

                    $('#collegelist').html(data);

                    $('#college').show();
                }
            });
        }
        else {
            $('#collegelist').hide('');
            $('#college').hide();
        }
        return true;


    });



    function collegelist() {
        var stdregID = $("#studentRegistrationID").val();
        var currentcourse = $("#selectedCourse").val();
        var courseoption = $("#studentcourse option:selected").val();
        var str = '';
        var status = true;
        var arr = new Array();
        var i = 0;

        $('.subjects').each(function() {
            var val = arr.indexOf($(this).val());
            if ($(this).val())
            {
                if (val < 0)
                {
                    arr[i++] = $(this).val();

                }
                else {
                    alert('You already Select this Subject');
                    $(this).val('');
                    status = false;
                }
            }
            else
            {
                status = false;
            }
        });


        arr.sort(function(a, b) {
            return b - a
        });
        $.unique(arr);
        str = arr.toString();


        var admissiontype = $('#admissiontype option:selected').val();

        if (status)
        {

            $.ajax({
                type: 'POST',
                data: {GroupSubject: str, admissiontype: admissiontype, stdregistrationid: stdregID, nationality: $("#StudentRegistrationNationality").val()},
                url: "<?php echo $this->webroot; ?>StudentRegistrations/getcollegelist",
                success: function(data) {

                    $('#collegelist').html(data);

                    $('#college').show();
                }
            });
        }
        else {
            $('#collegelist').html('');
            $('#college').hide();
        }
        return true;
    }

    function matureStudentoption() {


        var selectedRB = $('input[name=matureStudent]:checked').val();
        if (selectedRB == 'Y') {
            if ($("#maturestudent").html() != '') {
                data = $("#maturestudent").html();
            } else {
                var data = "<div><h3>For Mature students</h3><div><label>Work Experience </label><input type='text' name='workexp' id='workexp' value=''></div><div class='second-block'><label>Birth Certificate Issue Date</label> <input type='text' name='certissuedate' id='datepicker5' onclick='getcalendar()'></div><div class='non-star' style='margin-top:50px;'><input type='checkbox' id='isworking' name='isworking' value='Y'> <label style='width:55%;'>Are you currently working?</label></div><div class='second-block'><label>Address</label> <textarea id='address' name='address'></textarea><label>Company Name</label> <input type='text' name='compamyname' id='compamyname' value=''></div></div>";
            }
            $("#maturestudent").html(data);
            $("#maturestudent").show();
        } else if (selectedRB == 'N') {


            $("#maturestudent").hide();
        }

    }

    function selectEmployee() {

        var selectedRB = $('input[name=employee]:checked').val();
        if (selectedRB == 'Y') {

            $("#employeediv").show();


        } else if (selectedRB == 'N') {

            $("#employeediv").hide();
        }
    }

    function  validateValue() {
        var textval = $("#percentage").val();
        if (textval == '') {
            alert('Please enter data');
        }
    }

    function validatediplamaValue() {
        var textval = $("#diplomasubject").val();
        if (textval == '') {
            alert('Please enter data');
        }
    }




    /*Functions for College selections*/
    function sendSelectedOptions() {
        $("select#left-select option:selected").each(function() {
            var o1 = new Option($(this).text(), $(this).val(), true, true);

            var position = $(this).attr("rel");
            o1.setAttribute("rel", position);
            var rightelement = new Array();
            var i = 0;

            //rightelement = $.map($('#right-select :selected'),
            //function(e) { return $(e).val(); } );

            //alert(rightelement);
            //if($.inArray($(this).val(),rightelement)){
            $("select#right-select").append(o1);
            $("select#left-select option:selected").remove();

            //else{
            //alert('you already have this college in the choice list');
            //return false;
            //}


        });



        // sortDropDownListByText('right-select');
        $("select#right-select option").prop('selected', 'selected');
        $("select#left-select option").prop('selected', '');
    }

    function removeSelectedOptions() {
        $("select#right-select option:selected").each(function() {
            var o1 = new Option($(this).text(), $(this).val(), true, true);
            var position = $(this).attr("rel");
            o1.setAttribute("rel", position);

            $("select#left-select").append(o1);
        });

        $("select#right-select option:selected").remove();

        //sortDropDownListByText('left-select');
        $("select#right-select option").prop('selected', 'selected');
        $("select#left-select option").prop('selected', '');
    }

    function sortDropDownListByText(selectID) {
        // Loop for each select element on the page.
        $("select#" + selectID).each(function() {
            // Keep track of the selected option.
            var selectedValue = $(this).val();
            // Sort all the options by text. I could easily sort these by val.
            $(this).html($("option", $(this)).sort(function(a, b) {
                return a.text == b.text ? 0 : a.text < b.text ? -1 : 1
            }));
            // Select one option.
            $(this).val(selectedValue);
        });
    }

    function getcalendar() {
        $("#datepicker5").datepicker({dateFormat: 'dd-mm-yy'});

    }
    function checkdate() {

        var selectedRB = $('input[name=matureStudent]:checked').val();

        var status = '';
        var maturestdstatus = '';
        var agestatus = '';
        var qualifyper = '';
        var filestatus = '';

        message = '';
        var dob = $('#datepicker').datepicker('getDate');
        var qualifyingpercentage = $('#totalPercentage').val();

        if (qualifyingpercentage == 'Fail') {
            message = message + "</br>* You are not eligible for Admission in courses as you are failed in some subject";
            /*alert("You are not eligible for Admission in courses as you are failed in some subject");*/
            qualifyper = false;
        } else {
            qualifyper = true;
        }

        empstatus = '';
        var isEmployee = $('input[name=employee]:checked').val();
        if ($("#admissiontype").val() == 'N' && isEmployee == 'Y') {
            message = message + "</br>* With Employee reference Admission Type must be Private";
            /*alert("With Employee reference Admission Type must be Private");*/
            $("#admissiontype").focus();
            empstatus = false;
        } else if ($("#admissiontype").val() == 'P' && isEmployee == 'N') {
            message = message + "</br>* With Private Admission Type employee reference must be selected";
            /*alert("With Private Admission Type employee reference must be selected");*/
            $("#admissiontype").focus();
            empstatus = false;
        } else {
            empstatus = true;
        }



        if (selectedRB == 'Y') {
            var dob = "<?php echo $date1; ?>"
            //dob = new Date(dob).getTime();
            var dob = new Date(dob);
            newobject = new Date();
            var diff = '';

            if (dob && newobject) {
                diff = Math.floor((newobject.getTime() - dob.getTime()) / 86400000);  // ms per day

            }

            var years = diff / 365;

            if (years >= 30) {
                maturestdstatus = true;
            } else {
                /*alert("Mature student's age must be greater or equal to 30 yrs. Please check Date of Birth" );*/
                message = message + "</br>* Mature student's age must be greater or equal to 30 yrs. Please check Date of Birth";
                $("#datepicker").val('');
                $("#datepicker").focus();
                maturestdstatus = false;
            }

        } else {
            maturestdstatus = true;

        }

        var birthissuedate = '';

        if (selectedRB == 'Y') {
            var birthcerissuedate = $("#datepicker5").datepicker('getDate');

            var newobject1 = new Date();
            var diff = '';

            if (birthcerissuedate) {
                diff = Math.floor((newobject1.getTime() - birthcerissuedate.getTime()) / 86400000); // ms per day
            } else {
                diff = 1;
            }
            var years = diff / 365;

            if (years >= 2 && birthcerissuedate.getTime() > dob.getTime()) {

                birthissuedate = true;

            } else {

                message = message + "</br>* Birth certificate issue date should not be empty and it should be atleast two year before admission date and should be after date of birth";
                /*alert("Birth certificate issue date should not be empty and it should be atleast two year before admission date and should be after date of birth");*/
                birthissuedate = false;
            }

        } else {
            birthissuedate = true;
        }

        var compstatus = '';

        if (selectedRB == 'Y') {

            var iswrknow = document.getElementById("isworking").checked;

            var compname = $("#compamyname").val();

            if (compname == '' && iswrknow == true) {
                message = message + "</br>* Company name should not be empty";
                /*alert("Company name should not be empty");*/
                compstatus = false;
            } else if (compname != '' && iswrknow == false) {
                message = message + "</br>* Please check the checkbox 'Are you currently working' in case you want to enter company name";
                /*alert("Please check the checkbox 'Are you currently working' in case you want to enter company name");*/
                compstatus = false;
            } else {
                compstatus = true;
            }

        } else {
            compstatus = true;
        }
        var addresstatus = '';

        if (selectedRB == 'Y') {

            var address1 = $("#address").val();
            if (address1 == '') {
                /*alert("Address should not be empty");*/
                message = message + "</br>* Address should not be empty";
                addresstatus = false;
            } else {
                addresstatus = true;
            }

        } else {
            addresstatus = true;
        }

        var workexpstatus = '';

        if (selectedRB == 'Y') {

            var workexp1 = $("#workexp").val();
            if (workexp1 == '') {
                /*alert("Work experience should not be empty");*/
                message = message + "</br>* Work experience should not be empty";
                workexpstatus = false;
            } else {
                workexpstatus = true;
            }

        } else {
            workexpstatus = true;
        }



        var no_of_college = $('select#right-select option').length;
        var collegestatus = '';

        if (no_of_college != '' && no_of_college > 15) {
            message = message + "</br>* you cannot select more than 15 colleges";
            /*alert("you cannot select more than 15 colleges");*/
            collegestatus = false;
        } else {
            collegestatus = true;
        }

        var input, file;

        input = document.getElementById('StudentRegistrationStudentDocument');

        if (input.files[0] == undefined) {
            filestatus = true;
        } else {
            fileobj = input.files[0];
            if (fileobj.size > 1) {
                var filesize = fileobj.size / 1024;
                filesize = filesize / 1024;
            }
            if (filesize > 1) {
                /*alert("Please upload a document with maximum size of 1 MB");*/
                message = message + "</br>* Please upload a document with maximum size of 1 MB";
                filestatus = false;

            } else {

                filestatus = true;
            }
        }
        if (message != '') {
            $("#error_message").html(message);

            window.scrollTo(screen.availHeight, 0);
        }
        if (maturestdstatus == true && qualifyper == true && filestatus == true && collegestatus == true && compstatus == true && birthissuedate == true && empstatus == true && addresstatus == true && workexpstatus == true) {

            return true;
        } else {
            return false;
        }

    }
    function addforeign() {

        var nationalityType = $("#StudentRegistrationNationality").val();
        if (nationalityType == '1') {
            $("#StudentRegistrationForeignNationality").attr('type', 'text');
        } else {
            var fnationality = $("#StudentRegistrationForeignNationality").val();
            $("#StudentRegistrationForeignNationality").attr('type', 'hidden');
            $("#StudentRegistrationForeignNationality").val(fnationality);
        }
    }


</script>
<?php echo $this->Html->script('registrationform.js'); ?>
