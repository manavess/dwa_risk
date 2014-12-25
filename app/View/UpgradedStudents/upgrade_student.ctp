<div class="studentRegistrations form">
<?php  echo $this->Html->addCrumb("UpgradedStudent", '/UpgradedStudents'); ?>
    <?php echo $this->Form->create('UpgradedStudent',array('url'=>array('controller'=>'UpgradedStudents','action'=>'upgrade_student'),'onsubmit'=>'return checksubmit();')); ?>
    <fieldset>
        <?php $marksgrade = array('G' => 'Grade', 'M' => 'Marks');?>
        <div class='heading'><span><?php echo __('UPGRADING ADMISSION'); ?></span><br><?php echo __('ACADEMIC YEAR 2012/2013'); ?></div>

        <div class="form-area2">
            <div class="left-area">
                <?php
                echo $this->Form->input('application_number', array('type' => 'text', 'id' => 'application_num','required'=>'false','maxlength'=>'16'));
                echo $this->Form->input('student_registration_id', array('type' => 'hidden', 'id' => 'stdID'));
                echo $this->Form->input('applicant_name', array('label' => 'Applicant Name', 'type' => 'text', 'id' => 'stdname', 'readonly'));
                echo $this->Form->input('remarks',array('type' => 'textarea', 'id' => 'remarks', 'required'=>'false')); 
              ?>
                
            </div>
            <div class="right-area">    
                <?php
                echo $this->Form->input('from_course_id', array('type' => 'hidden', 'id' => 'from_course_id'));
                
                echo $this->Form->input('from_course', array('label' => 'Current Course', 'type' => 'text', 'id' => 'course_id', 'readonly'));
                if(!empty($this->data['UpgradedStudent']['to_course_id'])){ $tocourse = $this->data['UpgradedStudent']['to_course_id'];}else{ $tocourse = ''; }
                echo $this->Form->input('to_course_id', array('id' => 'studentcourse', 'empty' => 'Select', 'label' => 'Upgrade To Course', 'options' => $coursedata,'selected'=>'Select'));
                ?>
            </div>
            <div id ='grade' style="display:none;"><?php echo $this->Form->input('Percentage_marks', array('type' => 'radio', 'class' => 'radio', 'checked' => 'checked', 'options' => $marksgrade, 'name' => 'marks', 'label' => 'select grade or percentage marks', 'onchange' => 'changeHtml()')); ?></div>
            <div id="subject"></div>
            <div id="totalpercentage" style="display:none;"><?php echo $this->Form->input('total_percentage', array('type' => 'text', 'id' => 'totalPercentage', 'readonly')); ?></div>

            
        </div>
    </fieldset>
    <?php echo $this->Form->end(__('Submit')); ?>
   
</div>
<div class="actions">
    <h3><?php echo __('Actions'); ?></h3>
    <ul>

        <li><?php echo $this->Html->link(__('List Upgraded Students'), array('action' => 'index')); ?></li>
    </ul>
</div>



<script>
    $('#studentcourse').change(function() {
        $('#totalPercentage').val('');
     if($("#studentcourse option:selected").val()!=''){
        $.ajax({
            type: 'POST',
            data: {Course: $("#studentcourse option:selected").val(), Coursename: $("#studentcourse option:selected").text()},
            url: "<?php echo $this->webroot; ?>UpgradedStudents/getsubjectlist",
            success: function(data) {
                $('#subject').html(data);
                $('#totalpercentage').show();
                $('#grade').show();
            }
        });
        return true;
        
      }
    });
 
   
    $('#application_num').blur(function() {
        $('#totalPercentage').val('');
      
        var appnum = $('#application_num').val();
        if(appnum!=''){
        $.ajax({
            type: 'POST',
            data: {applicationum: appnum},
            url: "<?php echo $this->webroot; ?>UpgradedStudents/getstudentdetails",
            success: function(data) {

                studentdetail = $.parseJSON(data);
                $("#stdname").val(studentdetail.studentName);
                $("#stdID").val(studentdetail.studentregID);
               
                $("#course_id").val(studentdetail.coursename);
                $("#from_course_id").val(studentdetail.coursenameid);                
                if(studentdetail.coursenameid=='1') {
                $("#studentcourse").html("<option>Select</option><option value='2'>DIPLOMA</option>");
                }
                else if(studentdetail.coursenameid=='2') {
                $("#studentcourse").html("<option>Select</option><option value='1'>DEGREE</option>");
                }  
                

            }
            
        });
        return true;
        }else{
        $("#stdname").val('');
                $("#stdID").val('');
               
                $("#course_id").val('');
                $("#from_course_id").val('');
                return false;
        }
        
    });

    function changeHtml() {
       $(".subject_marks").val('');
        $('#totalpercentage').val('');
        return false;
        }
        
        function validatesubject(){
            
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
                //status = false;
            }
            if(status){
                return true;
                
            }else{
                return false;
            }
        });
    
    }
    

     function  calculateValue() {
   	   
   	   var arr='<?php echo json_encode($listgrade); ?>';
   	   	arr=$.parseJSON(arr);
   	   	
   	   	var point = '9';
        var indexToSplit = arr.indexOf(point);
		var first = arr.slice(0, indexToSplit+1);
		var second = arr.slice(indexToSplit + 1);
		var grdpointval = new Array();
   	   	
		var marks_system = $('input[name=marks]:checked').val();
   	  
   	    var i = 0;
   	   
   	    var j = 0;
   	    
   	    var k=0;
   	    
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
    
    function checksubmit(){
    
    var totalpercentage = $('#totalPercentage').val();
    var status = '';
    
    var substatus = '';
    var arr = '<?php echo json_encode($listgrade); ?>';
        arr = $.parseJSON(arr);
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

                    alphbeticval[j++] = $(this).val();

                } else {

                    numeric[k++] = $(this).val();

                }

                data[i++] = $(this).val();

            }
        });
        
        if (alphbeticval.length === $(".subject_marks").length || numeric.length == $(".subject_marks").length) {
            substatus = true;
        }else{
            alert("Please select subjects and enter marks");
            $('#totalPercentage').val('');
             substatus = false;
        }
    
    
    if(totalpercentage=='' || totalpercentage=='Fail'){
        alert("Please select subjects and enter marks properly in Number or in Grade");
        status = false;
        
    }else{
        status = true;
    }
    
    if(substatus==true && status==true){
        
        
        return true;
    }else{
        
        alert("Please select subjects and enter marks before submit");
        return false;
    }
    
    
    
    }
</script>
