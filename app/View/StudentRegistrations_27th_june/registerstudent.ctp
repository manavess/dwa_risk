<?php echo $this->Html->css('jquery-ui.css'); ?>
<?php echo $this->Html->script('jquery.js'); ?>
<?php echo $this->Html->script('jquery-ui.js'); ?>
<?php echo $this->Html->script('jquery.validate.js'); ?>

<script>
    $(function() {
     $("#student_pic").bind("change", previewImages);
        $("#datepicker").datepicker({dateFormat: 'dd-mm-yy'});
        $("#datepicker1").datepicker({dateFormat: 'dd-mm-yy'});
        $("#datepicker2").datepicker({dateFormat: 'dd-mm-yy'});
        $("#datepicker3").datepicker({dateFormat: 'dd-mm-yy'});
        $("#datepicker4").datepicker({dateFormat: 'dd-mm-yy'});
    });
</script>
<ul class="breadcrum"><li><?php echo $this->Html->addCrumb('Admission >>','#'); ?>      
		&nbsp;&nbsp;&nbsp;Admission Form</li></ul>
		
<div id="container">
<div class="studentRegistrations form col4">
   
        <?php echo $this->Form->create('StudentRegistration',array('url'=>array('controller'=>'StudentRegistrations','action'=>'registerstudent'),'id'=>'studentregistration','enctype'=>'multipart/form-data', 'onsubmit'=>'return checkdate();')); ?>
        <fieldset>
            <?php 
            $cityID = array();
            $countryID = array();
            $stateID = array();
            	if(!empty($this->data['StudentRegistration']['country_id'])){ 
                    $countryID = $this->data['StudentRegistration']['country_id']; 
                    
                    }
                    if(!empty($this->data['StudentRegistration']['state_id'])){ 
                    $stateID = $this->data['StudentRegistration']['state_id']; 
                    
                    }
                    if(!empty($this->data['StudentRegistration']['city_id'])){ 
                    $cityID = $this->data['StudentRegistration']['city_id']; 
                    
                    }
                    
                    $streamID = '';
                    if(!empty($this->data['StudentRegistration']['stream'])){ 
                    $streamID = $this->data['StudentRegistration']['stream']; 
                    
                    }
                    $schooltypeID = '';
                    if(!empty($this->data['StudentRegistration']['school_type'])){ 
                    $schooltypeID = $this->data['StudentRegistration']['school_type']; 
                    
                    }
                    
                    $marital_statusID = '';
                    if(!empty($this->data['StudentRegistration']['marital_status'])){ 
                    $marital_statusID = $this->data['StudentRegistration']['marital_status']; 
                    
                    }
                    
                    $nationalityID = '';
                    if(!empty($this->data['StudentRegistration']['nationality'])){ 
                    $nationalityID = $this->data['StudentRegistration']['nationality']; 
                    
                    }
                    
                    $cours = '';
                    if(!empty($this->data['StudentRegistration']['course_id'])){ 
                    $cours = $this->data['StudentRegistration']['course_id']; 
                    
                    }
                    
            $gender = array('M' => 'Male', 'F' => 'Female');
            $marksgrade = array('M' => 'Marks');
            ?>
            <input type="hidden" name="certificateId" value="<?php echo $certificateData['SecondarySchoolCertificate']['id']; ?>" />
            <div class='heading'><span><?php echo __('ADMISSION FORM'); ?></span><br /><?php echo __('ACADEMIC YEAR'); echo " ".date('Y')." - "; echo date('Y')+1;  ?></div>
            <div class="photo">
                <div class="photo-area"></div>
                <?php echo $this->Form->input('photo', array('id' => 'student_pic','type' => 'file', 'label' => false)); ?>
            </div>
            <div class="form-area2">
                <div class="left-area">
                    <?php
                    echo $this->Form->input('applicant_name', array('tabindex' => '1', 'class' => 'applicantname','readonly','default'=>$secstdname['StudentSecondarySchDetail']['name'],'required'=>false));
                    echo $this->Form->input('Address1', array('tabindex' => '2', 'required'=>false));
                    echo $this->Form->input('Address2', array('tabindex' => '3','required'=>false));
                    echo $this->Form->input('Address3', array('tabindex' => '4','required'=>false));
                    echo $this->Form->input('closest_relative_name', array('tabindex' => '4'));
                    echo $this->Form->input('closest_relative_add', array('tabindex' => '4'));
                    echo $this->Form->input('country_id', array('tabindex' => '5','options' => array('' => ' Select ',$countries), 'empty' => 'Select', 'id' => 'studentcountry','default'=>$countryID, 'style' => 'width:200px;','required'=>false));
                    echo $this->Form->input('state_id', array('tabindex' => '6', 'options' => array('' => ' Select ',$states), 'id' => 'countryState', 'style' => 'width:200px','selected'=>$stateID,'required'=>false));
                    echo $this->Form->input('city_id', array('tabindex' => '7', 'options' => array('' => ' Select ',$cities), 'id' => 'statecity', 'style' => 'width:200px','selected'=>$cityID,'required'=>false));
                    echo $this->Form->input('pincode', array('tabindex' => '8','required'=>false));
                    echo $this->Form->input('gender', array('tabindex' => '9', 'type' => 'radio', 'class' => 'radio', 'checked' => 'checked', 'options' => $gender,'required'=>false));
                    echo $this->Form->input('religion_id', array('tabindex' => '10', 'empty' => 'Select', 'id' => 'religion', 'style' => 'width:200px;','required'=>false,'required'=>false));
                    
                    echo $this->Form->input('date_of_birth', array('tabindex' => '11', 'type' => 'text','default'=>date('Y-m-d',strtotime($certificateData['SecondarySchoolCertificate']['date_of_birth'])),'readonly','required'=>false,'date'=>'date'));
                    echo $this->Form->input('place_of_birth', array('tabindex' => '12','maxlength'=>'50','required' => false));
                    echo $this->Form->input('type_of_certificate', array('tabindex' => '12','default'=>$certificateData['SecondarySchoolCertificate']['certificate_type'],'readonly','required'=>false));
                    echo $this->Form->input('certificate_index', array('tabindex' => '13','default'=>$certificateData['SecondarySchoolCertificate']['certificate_number'],'readonly','required'=>false));
                    echo $this->Form->input('date_of_certificate', array('tabindex' => '14', 'type' => 'text','default'=>date('Y-m-d',strtotime($certificateData['SecondarySchoolCertificate']['certificate_date'])),'readonly','date'=>'date'));
                    echo $this->Form->input('school_type', array('tabindex' => '15', 'empty' => 'Select','options'=>$schooltypes, 'required' => false,'selected'=>$schooltypeID));
                    echo $this->Form->input('secondary_school_name', array('tabindex' => '15','required'=>false));
                    echo $this->Form->input('stream', array('tabindex' => '16', 'empty' => 'Select','required'=>false));
                    echo $this->Form->input('course_id', array('tabindex' => '17', 'empty' => 'Select', 'id' => 'studentcourse','style' => 'width:200px;','required'=>false));
                    ?>
                </div>
                <div class="right-area"> 
                    <?php
                    echo $this->Form->input('nationality', array('maxlength' => '50', 'tabindex' => '18', 'empty' => 'Select','default'=>'South Sudan','readonly', 'required' => false));
                    echo $this->Form->input('nationality_number', array('maxlength' => '20','tabindex' => '18','required'=>false));
                    echo $this->Form->input('nationality_issue_date', array('tabindex' => '19', 'type' => 'text', 'id' => 'datepicker2','readonly','required'=>false));
                    echo $this->Form->input('marital_status', array('tabindex' => '20', 'empty' => 'Select','options'=>$marital_status, 'required' => false,'selected'=>$marital_statusID));
                    echo $this->Form->input('passport_number', array('maxlength' => '30','tabindex' => '21','required'=>false));
                    echo $this->Form->input('passport_issue_date', array('tabindex' => '22', 'type' => 'text', 'id' => 'datepicker3','readonly','required'=>false));
                    echo $this->Form->input('admission_office', array('tabindex' => '23','required'=>false));
                    //echo $this->Form->input('temporary_office', array('tabindex' => '23','required'=>false));
                    echo $this->Form->input('submission_office', array('tabindex' => '24'));
                    echo $this->Form->input('guardian_name', array('tabindex' => '25','required'=>false));
                    echo $this->Form->input('guardian_occupation', array('tabindex' => '26','required'=>false));
                    echo $this->Form->input('guardian_nationality_number', array('maxlength' => '20','tabindex' => '27','required'=>false));
                    echo $this->Form->input('guardian_nationality_issue_date', array('tabindex' => '28', 'type' => 'text', 'id' => 'datepicker4','readonly','required'=>false));
                    echo $this->Form->input('guardian_annual_income', array('maxlength' => '20','tabindex' => '29', 'required' => false));
                    echo $this->Form->input('student_document', array('tabindex' => '30', 'type' => 'file','required'=>false));
                    ?>
                </div>
                	<div id ='grade' style="display:none;">
                            <?php echo $this->Form->input('Percentage_marks',array('type' => 'radio', 'class' => 'radio', 'checked' => 'checked', 'options' => $marksgrade, 'name' => 'marks','label'=>'select grade or percentage marks','onchange'=>'changeHtml()'));?>
                        </div>
                <div id="subject"></div>
                <div id="totalpercentage" style="display:none;">Total Percentage/Grade: &nbsp;&nbsp;&nbsp; <?php echo $this->Form->input('total_percentage', array('type' => 'hidden', 'id' => 'totalPercentage', 'readonly')); ?><span id="totalm"><?php if(!empty($this->data['StudentRegistration']['total_percentage'])){ echo $this->data['StudentRegistration']['total_percentage']; }?></span></div>
                <div id="college" style="display:none;">Select Colleges According to priority*</div>
                <div id="collegelist" ></div>
                <div id="distancecourse"></div>
                <div id="maturestudent"></div>
            </div>
        </fieldset>
        <div id="form-button">
            <?php echo $this->Form->end(__('Submit', array('id' => 'formsubmit'))); ?>
            <div class="submit">
			<?php echo $this->Form->reset('Reset', array('title' => 'Reset','value'=>'Reset','type' => 'submit')); ?>
            </div>
        </div>
    </form>
</div>
</div>
<script type="text/javascript">

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
        $('#totalm').html('');
        $('#collegelist').html('');
        var certnum = $("#StudentRegistrationCertificateIndex").val();
        $.ajax({
            type: 'POST',
            data: {Course: $("#studentcourse option:selected").val(), Coursename: $("#studentcourse option:selected").text(),AdmissionType:'N',certificate_index:certnum},
            url: "<?php echo $this->webroot; ?>StudentRegistrations/getregsubjectlist",
            success: function(data) {
                $('#subject').html(data);
                $('#totalpercentage').show();
                $('#grade').show();
                calculateValue();
                collegelist();
            }
        });
        return true;
});    
$('#studentcourse').change(function() {

        $('#totalPercentage').val('');
        $('#totalm').html('');
        $('#collegelist').html('');
        var certnum = $("#StudentRegistrationCertificateIndex").val();
        $.ajax({
            type: 'POST',
            data: {Course: $("#studentcourse option:selected").val(), Coursename: $("#studentcourse option:selected").text(),AdmissionType:'N',certificate_index:certnum},
            url: "<?php echo $this->webroot; ?>StudentRegistrations/getregsubjectlist",
            success: function(data) {
                $('#subject').html(data);
                $('#totalpercentage').show();
                $('#grade').show();
                calculateValue();
                collegelist();
            }
        });
        return true;
    });
     function changeHtml(){
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

                } else {

                    numeric[k++] = $(this).val();

                }

                data[i++] = $(this).val();

            }
        });
        
      if(grdpointval.length>1){grdpointval = cleanArray(grdpointval); }
      if(alphbeticval.length>1){ alphbeticval = cleanArray(alphbeticval); }
      if(numeric.length>1){ numeric  = cleanArray(numeric); }
	if (grdpointval.length === $(".subject_marks").length || alphbeticval.length === $(".subject_marks").length || numeric.length == $(".subject_marks").length) {
            
        }else{
                      
            $('#totalpercentage').css('display','none');
            $('#totalPercentage').val('');
            $('#totalm').html('');
        }
		
        if (grdpointval.length === $(".subject_marks").length || alphbeticval.length === $(".subject_marks").length || numeric.length == $(".subject_marks").length) {
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
                } else if (grdpointval.length == 7 || grdpointval.length == 5) {

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
                } else if(numeric.length == 7 || numeric.length == 5){
                	alert('please select Marks to enter marks in number');
                	$(".subject_marks").val('');
                	return false;
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
                    
                    return false;
                }
            }

        } else if (data.length === $(".subject_marks").length) {
            if (alphbeticval.length != $(".subject_marks").length || grdpointval.length != $(".subject_marks").length ||numeric.length != $(".subject_marks").length) {

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
            $('#totalPercentage').val('');
            $('#totalm').html('');
            return false;
        }
		
    }

    function calculatevaluefordiploma() {
        var diplomasubjectMarks = $("input[id='subject_id']").map(function() {
            return $(this).val();
        }).get();
        $.ajax({
            type: 'POST',
            data: {diploma_subject: diplomasubjectMarks},
            url: "<?php echo $this->webroot; ?>StudentRegistrations/calculatepercentage",
            success: function(data) {
                $('#totalPercentage').val(data);
            }
        });
        return true;
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
        if (status)
        {
            $.ajax({
                type: 'POST',
                data: {GroupSubject: str},
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

    function getmarks(s){
    var subject_id = s[s.selectedIndex].value;
    $(s).next('input').val('');
        //alert($(s).next('input').val());
    
        $.ajax({
                type: 'POST',
                data: {SubjectID: subject_id,CertificateIndex:$("#StudentRegistrationCertificateIndex").val()},
                url: "<?php echo $this->webroot; ?>StudentRegistrations/getsubmarks",
                success: function(data) {
                    if(data)
                      //alert(data);
                    $(s).next('input').val(data);
                    calculateValue();
                    
                }
            });
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
            //alert($(this).val());
            var position = $(this).attr("rel");
            o1.setAttribute("rel", position);

            $("select#right-select").append(o1);
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
   
		var filestatus = '';
		
		var input, file;
		input = document.getElementById('StudentRegistrationStudentDocument');
		file = input.files[0];
		var filesize = file.size/1024/1024;
		if(filesize>1){
		alert("Please upload a document with maximum size of 1 MB");
		filestatus = false;
		}else{
		
		filestatus = true;
		}
		//alert("hi");
		var qualifyper = '';
		
		
		var qualifyingpercentage = $('#totalPercentage').val();
		
		if(qualifyingpercentage=='Fail'){
                    alert("You are not eligible for Admission in courses as you are failed in some subject");
                    qualifyper = false; 
		}else if(qualifyingpercentage==''){
                    alert("Selected subject marks is not available with us, Please check subject");
                    qualifyper = false; 
		}else{
                    qualifyper = false; 
                }
		
		var no_of_college = $('select#right-select option').length;
		var collegestatus = '';
		
		if(no_of_college!='' && no_of_college>15){
			alert("you cannot select more than 15 colleges");
			collegestatus = false;
		}else{
			collegestatus = true;
		}
		
			

		if(qualifyper==true && filestatus==true && collegestatus==true){
		
			return true;
		}else{
		
			return false;
		}
	
    }
    
    

</script>
<?php echo $this->Html->script('registrationform.js'); ?>
