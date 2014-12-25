<?php echo $this->Html->css('jquery-ui.css'); ?>
<?php echo $this->Html->script('jquery.js'); ?>
<?php echo $this->Html->script('jquery-ui.js'); ?>
<?php echo $this->Html->script('jquery.validate.js'); ?>
<?php //print_r($schooltype);?>
<script type="text/javascript">
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
<?php  echo $this->Html->addCrumb("Student Admission", '/StudentRegistrations'); ?>
<div class="studentRegistrations form col4">
           <?php echo $this->Form->create('StudentRegistration',array('url'=>array('controller'=>'StudentRegistrations','action'=>'add'),'onsubmit'=>"return checkdate();",'id'=>"addstudentregistration",'enctype'=>'multipart/form-data' )); ?>
        <fieldset>
            <?php
            
            $cityID = array();
            $countryID = array();
            $stateID = array();
            $streamID = array();
            	if(!empty($this->data['StudentRegistration']['country_id'])){ 
                    $countryID = $this->data['StudentRegistration']['country_id']; 
                    
                    }
                    if(!empty($this->data['StudentRegistration']['state_id'])){ 
                    $stateID = $this->data['StudentRegistration']['state_id']; 
                    
                    }
                    if(!empty($this->data['StudentRegistration']['city_id'])){ 
                    $cityID = $this->data['StudentRegistration']['city_id']; 
                    
                    }
                    
                    if(!empty($this->data['StudentRegistration']['stream'])){ 
                    $streamID = $this->data['StudentRegistration']['stream']; 
                    
                    }
                    $nationalityID = '';
                    if(!empty($this->data['StudentRegistration']['nationality'])){ 
                    $nationalityID = $this->data['StudentRegistration']['nationality']; 
                    
                    }
                    
                    
                    $schooltypeID = '';
                    if(!empty($this->data['StudentRegistration']['school_type'])){ 
                    $schooltypeID = $this->data['StudentRegistration']['school_type']; 
                    
                    }
                    $marital_statusID = '';
                    if(!empty($this->data['StudentRegistration']['marital_status'])){ 
                    $marital_statusID = $this->data['StudentRegistration']['marital_status']; 
                    
                    }
                    
                    if(!empty($isalloted)){
                    
                    	$admissionType = array('P' => 'Private');
                    }else{
                    	$admissionType = array('N' => 'Normal', 'P' => 'Private');
                    }
            
            $gender = array('M' => 'Male', 'F' => 'Female');
            $empreference = array('Y' => 'Yes', 'N' => 'No');
            $isdistance = array('Y' => 'Yes', 'N' => 'No');
            $ismature = array('Y' => 'Yes', 'N' => 'No');
            $marksgrade = array('G' => 'Grade', 'M' => 'Marks');
            ?>
            <div class='heading'><span><?php echo __('ADMISSION FORM'); ?></span><br /><?php echo __('ACADEMIC YEAR'); echo " ".date('Y')." - "; echo date('Y')+1; ?></div>
            <div class="photo">
                <div class="photo-area"></div>
                <?php echo $this->Form->input('photo', array('id' => 'student_pic', 'type' => 'file', 'label' => false)); ?>
            </div><div id="error_message" style="color:red"></div>
            <div class="form-area2">
                <div class="left-area">
                    <?php
                    
                    if(!empty($isalloted)){
                           echo $this->Form->input('admission_type', array('id' => 'admissiontype', 'type' => 'select', 'options' => $admissionType, 'style' => 'width:200px;', 'required' => false, 'onclick' => 'collegelist()'));
                    }else{
                           echo $this->Form->input('admission_type', array('empty' => 'Select', 'id' => 'admissiontype', 'type' => 'select', 'options' => $admissionType, 'style' => 'width:200px;', 'required' => false, 'onclick' => 'collegelist()'));
                    }
                    
                    echo $this->Form->input('applicant_name', array('tabindex' => '1', 'required' => false));
                    echo $this->Form->input('Address1', array('tabindex' => '2' ,'required' => false));
                    echo $this->Form->input('Address2', array('tabindex' => '3'));
                    echo $this->Form->input('Address3', array('tabindex' => '4'));
                    echo $this->Form->input('closest_relative_name', array('tabindex' => '4'));
                    echo $this->Form->input('closest_relative_add', array('tabindex' => '4'));
                    echo $this->Form->input('country_id', array('tabindex' => '5','options' => array('' => ' Select ',$countries), 'empty' => 'Select', 'id' => 'studentcountry','default'=>$countryID, 'style' => 'width:200px;','required'=>false));
                    echo $this->Form->input('state_id', array('tabindex' => '6', 'options' => array('' => ' Select ',$states), 'id' => 'countryState', 'style' => 'width:200px','selected'=>$stateID,'required'=>false));
                    echo $this->Form->input('city_id', array('tabindex' => '7', 'options' => array('' => ' Select ',$cities), 'id' => 'statecity', 'style' => 'width:200px','selected'=>$cityID,'required'=>false)); ?> 
                    
                    <?php
                    echo $this->Form->input('pincode', array('tabindex' => '8','maxlength'=>'8'));
                    echo $this->Form->input('gender', array('tabindex' => '9', 'type' => 'radio', 'class' => 'radio', 'checked' => 'checked', 'options' => $gender));
                    echo $this->Form->input('religion_id', array('tabindex' => '10', 'empty' => 'Select', 'id' => 'religion', 'style' => 'width:200px;', 'required' => false));
                    echo $this->Form->input('date_of_birth', array('tabindex' => '11', 'type' => 'text', 'id' => 'datepicker', 'required' => false,'dateformat'=>'d-m-Y','readonly'));
                    echo $this->Form->input('place_of_birth', array('tabindex' => '12','maxlength'=>'50','required' => false));
                    echo $this->Form->input('type_of_certificate', array('tabindex' => '12', 'required' => false));
                    echo $this->Form->input('certificate_index', array('tabindex' => '13', 'required' => false));
                    echo $this->Form->input('date_of_certificate', array('tabindex' => '14', 'type' => 'text','dateformat'=>'d-m-Y', 'id' => 'datepicker1', 'required' => true,'date','readonly'));
                    echo $this->Form->input('school_type', array('tabindex' => '15', 'empty' => 'Select','options'=>$schooltypes, 'required' => false,'selected'=>$schooltypeID));
                    echo $this->Form->input('secondary_school_name', array('tabindex' => '15', 'required' => false));
                    echo $this->Form->input('stream', array('tabindex' => '16', 'empty' => 'Select','options'=>$streams, 'required' => false,'selected'=>$streamID));
                    echo $this->Form->input('course_id', array('tabindex' => '17', 'empty' => 'Select', 'id' => 'studentcourse', 'style' => 'width:200px;', 'required' => false));
                    ?>
                </div>
                <div class="right-area"> 
                    <?php
                        echo $this->Form->input('nationality', array('tabindex' => '18', 'empty' => 'Select','options'=>$nationalities, 'required' => false,'selected'=>$nationalityID,'onchange' => 'addforeign(), collegelist()'));
                    ?>
                    <div style="margin-left:180px;"><?php echo $this->Form->input('foreign_nationality', array('type'=>'hidden','tabindex' => '18','maxlength' => '30', 'required' => false,'label'=>false));?></div>
                    <?php 
                    echo $this->Form->input('nationality_number', array('maxlength' => '20','tabindex' => '18', 'required' => false));
                    echo $this->Form->input('nationality_issue_date', array('tabindex' => '19', 'type' => 'text', 'id' => 'datepicker2','required' => false,'readonly'));
                    echo $this->Form->input('marital_status', array('tabindex' => '15', 'empty' => 'Select','options'=>$marital_status, 'required' => false,'selected'=>$marital_statusID));
                    echo $this->Form->input('passport_number', array('maxlength' => '20','tabindex' => '20', 'required' => false));
                    echo $this->Form->input('passport_issue_date', array('tabindex' => '21', 'type' => 'text', 'id' => 'datepicker3', 'required' => false,'readonly','value'=>''));
                    echo $this->Form->input('admission_office', array('tabindex' => '22'));
                    //echo $this->Form->input('temporary_office', array('tabindex' => '23'));
                    echo $this->Form->input('submission_office', array('tabindex' => '24'));
                    echo $this->Form->input('guardian_name', array('tabindex' => '25', 'required' => false));
                    echo $this->Form->input('guardian_occupation', array('tabindex' => '26', 'required' => false));
                    echo $this->Form->input('guardian_nationality_number', array('maxlength' => '20','tabindex' => '27', 'required' => false));
                    echo $this->Form->input('guardian_nationality_issue_date', array('tabindex' => '28', 'type' => 'text', 'id' => 'datepicker4', 'required' => false,'readonly'));
                    echo $this->Form->input('guardian_annual_income', array('maxlength' => '20','tabindex' => '29', 'required' => false));
                    echo $this->Form->input('is_distance', array('tabindex' => '30', 'type' => 'radio', 'class' => 'radio', 'checked' => 'checked', 'options' => $isdistance, 'name' => 'distanceoption', 'onclick' => 'chkdistanceoption()'));
                    $emprefer = '';
                    if(!empty($this->data['StudentRegigstration']['is_emp_referance'])){
                    	$emprefer = $this->data['StudentRegigstration']['is_emp_referance'];
                    }
                    ?>
                    <div id="empreferer">
                   <?php echo $this->Form->input('is_emp_referance', array('tabindex' => '30', 'type' => 'radio', 'class' => 'radio','required'=>false, 'checked' => 'checked','options' => $empreference, 'name' => 'employee', 'onclick' => 'selectEmployee()','selected'=>$emprefer));
                    ?></div>
                    <div id="employeediv" style="display:none"><?php echo $this->Form->input('employee_id', array('empty' => 'Select','required'=>false)); ?></div><label style="margin-left:170px;">.pdf,.doc or jpeg files are uploaded in size not more than 1 MB/</label>
                    <?php echo $this->Form->input('student_document', array('tabindex' => '31', 'type' => 'file')); ?>
                </div>
                <div id ='grade' style="display:none;"><?php echo $this->Form->input('Percentage_marks', array('type' => 'radio', 'class' => 'radio', 'checked' => 'checked', 'options' => $marksgrade, 'name' => 'marks', 'label' => 'select grade or percentage marks', 'onchange' => 'changeHtml()','value'=>'')); ?></div>
                <div id="subject"></div>
                <div id="totalpercentage" style="display:none;">Total Percentage/Grade: &nbsp;&nbsp;&nbsp; <?php echo $this->Form->input('total_percentage', array('type' => 'hidden', 'id' => 'totalPercentage', 'readonly')); ?><span id="totalm"></span></div>
                <div id="college" style="display:none;">Select Colleges According to priority*</div>
                <div id="collegelist" ></div>
                <div id="ismaturediv"><?php echo $this->Form->input('is_mature', array('type' => 'radio', 'class' => 'radio', 'checked' => 'checked', 'options' => $ismature, 'name' => 'matureStudent', 'onclick' => 'matureStudentoption()')); ?></div>
               
               
                <div id="maturestudent" style='display:none;'><div id='maturestdiv'><h3>For Mature students</h3><div><label>Work Experience </label><input type='text' name='workexp' id='workexp' value='' number='number' maxlength='2'></div><div class='second-block'><label>Birth Certificate Issue Date</label> <input type='text' name='certissuedate' value='' id='datepicker5' onclick='return getcalendar()'></div><div class="non-star" style='margin-top:50px;'><input type='checkbox' id='isworking' name='isworking' value='Y'> <label style='width:55%;' >Are you currently working?</label></div><div class='second-block'><label>Address</label> <textarea required='false' id='address' name='address'></textarea><label>Company Name</label> <input type='text' name='compamyname' id='compamyname' value=''></div></div></div>
            
            </div>
        </fieldset>
        <div id="form-button">
            <?php echo $this->Form->end(__('Submit')); ?>
            <div class="submit">
			<?php echo $this->Form->reset('Reset', array('title' => 'Reset','value'=>'Reset','type' => 'submit')); ?>
            </div>
        </div>
 
</div>
<div class="actions">
    <h3><?php echo __('Actions'); ?></h3>
    <ul>

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
</div>
<script type="text/javascript">

    function getcalendar() {
        $("#datepicker5").datepicker({dateFormat: 'dd-mm-yy'});


    }
    
    function addforeign(){
        var nationalityType = $("#StudentRegistrationNationality").val();
        if(nationalityType=='1'){
            $("#StudentRegistrationForeignNationality").attr('type','text');
        }else{
         $("#StudentRegistrationForeignNationality").attr('type','hidden');   
         $("#StudentRegistrationForeignNationality").val('');
        }
    }
    
$(document).ready(function(){
	if($("#admissiontype").val()=='N'){
    		$("#ismaturediv").hide();
    		$("#empreferer").hide();
    		
    	}else if($("#admissiontype").val()=='P'){
    		$("#ismaturediv").show();
    		$("#empreferer").show();
    		
    	}
});

	$("#admissiontype").change(function() {
    	if($("#admissiontype").val()=='N'){
    		$("#ismaturediv").hide();
    		$("#empreferer").hide();
    		
    		
    	}else if($("#admissiontype").val()=='P'){
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
    /*Course selection*/
    $(document).ready(function(){
     $('#totalPercentage').val('');
        $('#collegelist').html('');
        $('#totalm').html('');
       
        $.ajax({
            type: 'POST',
            data: {Course: $("#studentcourse option:selected").val(), Coursename: $("#studentcourse option:selected").text(),nationality:$("#StudentRegistrationNationality").val(),AdmissionType:$("#admissiontype").val()},
            url: "<?php echo $this->webroot; ?>StudentRegistrations/getsubjectlist",
            success: function(data) {
                $('#subject').html(data);
               
                //$('#totalpercentage').show();
                 
                $('#grade').show();
            }
        });
        return true;
    
    });
    $('#studentcourse').change(function() {
        $('#totalPercentage').val('');
        $('#collegelist').html('');
        $('#totalm').html('');
       
        $.ajax({
            type: 'POST',
            data: {Course: $("#studentcourse option:selected").val(), Coursename: $("#studentcourse option:selected").text(),nationality:$("#StudentRegistrationNationality").val(),AdmissionType:$("#admissiontype").val()},
            url: "<?php echo $this->webroot; ?>StudentRegistrations/getsubjectlist",
            success: function(data) {
                $('#subject').html(data);
               
                //$('#totalpercentage').show();
                 
                $('#grade').show();
            }
        });
        return true;
        
    });
    
    $("#admissiontype").change(function() {
        $('#totalPercentage').val('');
        $('#collegelist').html('');
        $('#totalm').html('');
       
        $.ajax({
            type: 'POST',
            data: {Course: $("#studentcourse option:selected").val(), Coursename: $("#studentcourse option:selected").text(),nationality:$("#StudentRegistrationNationality").val(),AdmissionType:$("#admissiontype").val()},
            url: "<?php echo $this->webroot; ?>StudentRegistrations/getsubjectlist",
            success: function(data) {
                $('#subject').html(data);
               
                //$('#totalpercentage').show();
                 
                $('#grade').show();
            }
        });
        return true;
        
    });
    function changeHtml() {
        $(".subject_marks").val('');
        $('#totalpercentage').val('');
        $('#totalm').html('');


    }


function  calculateValue() {

		var arr = '<?php echo json_encode($listgrade); ?>';
                
		arr = $.parseJSON(arr);
		var point = '9';
		var indexToSplit = arr.indexOf(point);
			var first = arr.slice(0, indexToSplit+1);
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

						 }else if ($.inArray($(this).val(), second) > -1) { 
						          
		            	alphbeticval[j++] = $(this).val();
						 }
						 


		        }
		        
		         else {

		            numeric[k++] = $(this).val();

		        }

		        data[i++] = $(this).val();

		    }
		});
	      
              
	      if(grdpointval.length>1){grdpointval = cleanArray(grdpointval); }
	      if(alphbeticval.length>1){ alphbeticval = cleanArray(alphbeticval); }
	      if(numeric.length>1){ numeric  = cleanArray(numeric); }
		       
            if(grdpointval.length === $(".subject_marks").length || alphbeticval.length === $(".subject_marks").length || numeric.length == $(".subject_marks").length) {
		             
		}else{
		
			$('#totalpercentage').css('display','none');
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
								$('#totalpercentage').css('display','block');
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
								$('#totalpercentage').css('display','block');
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
								$('#totalpercentage').css('display','block');
		                    $('#totalPercentage').val(data);
		                    $('#totalm').html(data);
		                    
		                }
		            });
		            return true;
		        } else {
		            alert('please select grade to enter marks as grade');
		            $('#totalpercentage').css('display','none');
		            $('#totalPercentage').val('');
		            $('#totalm').html('');
		        }
		    }

		} else if (data.length === $(".subject_marks").length) {
		    if (alphbeticval.length != $(".subject_marks").length || grdpointval.length != $(".subject_marks").length ||numeric.length != $(".subject_marks").length) {
                        alert(alphbeticval.length);
                        alert($(".subject_marks").length);
                        
		         if(marks_system=='M'){
		        	alert('please fill right marks');
		        	$('#totalpercentage').css('display','none');
		       		$('#totalPercentage').val('');
		            $('#totalm').html('');
		            
					}else{
						alert('please fill right grade');
						$('#totalpercentage').css('display','none');
						$('#totalPercentage').val('');
		            $('#totalm').html('');
					}
		        return false;
		    }
		    $('#totalpercentage').css('display','none');
		    $('#totalPercentage').val('');
		    $('#totalm').html('');
		}

	    }
    
    function cleanArray(actual){
	  var newArray = new Array();
	  for(var i = 0; i<actual.length; i++){
		  if (actual[i]){
		    newArray.push(actual[i]);
		}
	  }
	  return newArray;
	}

    function collegelist() {

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
            return a - b
        });

        str = arr.toString();
        var admissiontype = $('#admissiontype option:selected').val();

        if (status)
        {	
            $.ajax({
                type: 'POST',
                data: {GroupSubject: str, admissiontype: admissiontype,nationality:$("#StudentRegistrationNationality").val()},
                url: "<?php echo $this->webroot; ?>StudentRegistrations/getcollegelist",
                success: function(data) {

                    $('#collegelist').html(data);
                    
                    $('#college').show();
                    //calculateValue();
                    
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
	//$("#datepicker5").datepicker({dateFormat: 'dd-mm-yy'});
        var selectedRB = $('input[name=matureStudent]:checked').val();
        if (selectedRB == 'Y') {
            //var data = "";
            $("#maturestudent").show();
        } else if (selectedRB == 'N') {
            $("#maturestudent").hide('');
        }

    }
$(document).ready(function(){
	var selectedRB = $('input[name=employee]:checked').val();

        if (selectedRB == 'Y') {

            $("#employeediv").show();


        } else if (selectedRB == 'N') {

            $("#employeediv").hide();
        }
});
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
        var admissiontype = $('#admissiontype option:selected').val();
        //alert(admissiontype); return false;
        $("select#left-select option:selected").each(function() {
            var o1 = new Option($(this).text(), $(this).val(), true, true);
            //alert($(this).val());
            var position = $(this).attr("rel");
            o1.setAttribute("rel", position);
            if (admissiontype == 'P') {

                var swaptext = $("select#right-select option:selected").text();
                var swapvalue = $("select#right-select option:selected").val();
                var swapval = new Option(swaptext, swapvalue, true, true);
                var position = $("#right-select").attr("rel");
                swapval.setAttribute("rel", position);
                $("select#left-select").append(swapval);

                //$("select#right-select option:selected").remove();
                $("select#right-select").append(o1);
            } else {
                $("select#right-select").append(o1);
            }

        });

        $("select#left-select option:selected").remove();

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
	function checkdate() {
       
      	var selectedRB = $('input[name=matureStudent]:checked').val();
		var status = '';
		var maturestdstatus = '';
		var agestatus = '';
		var qualifyper = '';
		var stream='';
		var message = '';
	
		var iscity = '';
		var iscourses = '';
		var isColleges = '';
		
		var dob = $('#datepicker').datepicker('getDate');
		var qualifyingpercentage = $('#totalPercentage').val();
		var stdcity = $("#statecity option:selected").val();
		var stdcourse = $('#studentcourse').val();
		var stdcollege = $("#right-select option:selected").val();
		var streamtype = $("#StudentRegistrationStream").val();
	
		if(stdcity==''){
		//alert("City should not be empty.");
		message = message+'</br>* City should not be empty';

		iscity=false;
		}else{
		iscity = true;
		}
		
		if(stdcourse==''){

		message = message+'</br>* Course name should not be empty';

		iscourses=false;
		}else{
		iscourses = true;
		}
		
		if(stdcollege==''){
		message = message+'</br>* College should not be empty';
		isColleges=false;
		}else{
		isColleges = true;
		}
		
		if(streamtype==''){

			message = message+'</br>* Stream should not be empty';
			stream=false;
		}else{
			stream = true;
		}
	
	
		if(qualifyingpercentage=='Fail'){
	
		message = message+'</br>* You are not eligible for Admission in courses as you are failed in some subject';
		qualifyper = false; 
		}else if(qualifyingpercentage==''){
		/*alert("You are not eligible for Admission in courses as you did not fill your marks properly");*/
		message = message+'</br>* You are not eligible for Admission in courses as you did not fill your marks properly';
		qualifyper = false; 
		}else{
		qualifyper = true; 
		}
		
		if(dob!='') {
		var newobject = new Date();
        var age = '';
      
    		if (dob && newobject) {
		        age = Math.floor((newobject.getTime() - dob.getTime()) / 86400000); // ms per day
		  }
		  var totalyears = age/365;

			if(totalyears>=16){
				agestatus = true;
			}else{
				/*alert("Student minimum age should be 16 yrs or greater" );*/
				message = message+'</br>* Student minimum age should be 16 yrs or greater';
				$("#datepicker").val('');
				$("#datepicker").focus();
				agestatus = false;
			}
			
			}
		
		
		
		var isEmployee = $('input[name=employee]:checked').val();
		if($("#admissiontype").val()=='N' && isEmployee=='Y'){
		/*alert("With Employee reference Admission Type must be Private");*/
		message = message+'</br>* With Employee reference Admission Type must be Private';
		$("#admissiontype").focus();
		status = false;
		}else if($("#admissiontype").val()=='P' && isEmployee=='N'){
		message = message+'</br>* For Private Admission Type employee reference must be selected';
		/*alert("With Private Admission Type employee reference must be selected");*/
		$("#admissiontype").focus();
		status = false;
		}else{
		status = true;
		}
		
		var dob = $('#datepicker').datepicker('getDate');
        if (selectedRB == 'Y') {
        //var dob = $('#datepicker').datepicker('getDate');
        var newobject = new Date();
        var diff = '';
     
    	if (dob && newobject) {
		        diff = Math.floor((newobject.getTime() - dob.getTime()) / 86400000); // ms per day
		  }
		  var years = diff/365;

			if(years>=30){
				maturestdstatus = true;
			}else{
				/*alert("Mature student's age must be greater or equal to 30 yrs. Please check Date of Birth" );*/
				message = message+"</br>* Mature student's age must be greater or equal to 30 yrs. Please check Date of Birth";
				$("#datepicker").val('');
				$("#datepicker").focus();
				maturestdstatus = false;
			} 
			
		}else{
			maturestdstatus = true;
		
		}

		var birthissuedate = '';
		

		if (selectedRB == 'Y') {
			var birthcerissuedate = $("#datepicker5").datepicker('getDate');
			var newobject = new Date();
        var diff = '';
      
    	if (birthcerissuedate && newobject) {
		        diff = Math.floor((newobject.getTime() - birthcerissuedate.getTime()) / 86400000); // ms per day
		  }
		  var years = diff/365;

		  if(birthcerissuedate=='' || birthcerissuedate=='null'){
		  
				/*alert("Birth certificate issue date should not be empty");*/
				message = message+"</br>* Birth certificate issue date should not be empty";
				birthissuedate = false;
				

			}else if(years>=2 && birthcerissuedate.getTime() > dob.getTime()){

				birthissuedate = true;
				
			}else{


			/*alert("Birth certificate issue date should not be empty and it should be atleast two year before admission date and should be after date of birth ");*/
			message = message+"</br>* Birth certificate issue date should not be empty and it should be atleast two year before admission date and should be after date of birth";

				birthissuedate = false;
			}

		}else{
		birthissuedate = true;
		}
		
		var compstatus='';
		
		if (selectedRB == 'Y') {
		
		var iswrknow = document.getElementById("isworking").checked;
		
		var compname = $("#compamyname").val();

			if(compname=='' && iswrknow==true){
				/*alert("Company name should not be empty");*/
				message = message+"</br>* Company name should not be empty";
				compstatus = false;
			}else if(compname!='' && iswrknow==false){
			
				/*alert("Please check the checkbox 'Are you currently working' in case you want to enter company name");*/
				message = message+"</br>* Please check the checkbox 'Are you currently working' in case you want to enter company name";
				compstatus = false;
			}else{
				compstatus = true;
			}
		
		}else{
			compstatus = true;
		}
		
		var no_of_college = $('select#right-select option').length;
		var collegestatus = '';
		
		if(no_of_college!='' && no_of_college>15){
			/*alert("you cannot select more than 15 colleges");*/
			message = message+"</br>* you cannot select more than 15 colleges";
			collegestatus = false;
		}else{
			collegestatus = true;
		}
		if(message!=''){
		$("#error_message").html(message);

			window.scrollTo(screen.availHeight,0);
		}
		if(status==true && maturestdstatus==true && agestatus==true && qualifyper==true && iscity==true && iscourses==true && isColleges==true && stream==true && collegestatus==true && birthissuedate==true && compstatus==true){

		
			return true;
		}else{
		
			return false;
		}
	
    }
</script>
<?php echo $this->Html->script('registrationform.js'); ?>
