<?php echo $this->Html->addCrumb('Student Statement', '/StudentStatements/student_admisson_statement'); ?>

<div class="studentRegistrations form col4"  id="formelement">
<h2>Admission Statements</h2>

        <?php echo $this->Form->create('StudentRegistration',array('url'=>array('controller'=>'StudentStatements','action'=>'student_admisson_statement'))); ?>
        <fieldset>
        <fieldset>
            <div class='heading'><?php echo __('DIRECTORATE OF ADMISSION, EVALUATION & AUTHENTICATION'); ?><br /><br /><span><?php echo __('Admission Statement '); ?></span><br /><br /><?php echo __('ACADEMIC YEAR ' . date('Y', strtotime('-2 year')) . '/' . date('Y', strtotime('-1 year'))); ?></div>    
        <div class="form-area2">
                <div class="left-area">
                <?php 
                 echo $this->Form->input('application_number', array('label'=>'Student Application Number','tabindex' => '1', 'id' => 'applicantnumber'));
                  
                ?><span id="message" style="color:red"></span>
                
                
                </div>
                <div class="right-area">
                <label>Student Name: </label>
                <span id="studentID"></span>
                </div>
                
                <div class="right-area">
                <label>Admission Year: </label>
                <span id="admission_year"></span>               
                </div>
                <div id="studentdetails">
               		<table>
					<tr>
						<th><?php echo "University"; ?></th>
						<th><?php echo "College"; ?></th>
						<th><?php echo "Course"; ?></th>
						<th><?php echo "Preference No"; ?></th>
						<th><?php echo "% of last student"; ?></th>
								
					</tr>

					<tr>
						<td><label id="univeristyname"></label></td>
						<td><label id="collegename"></label></td>
						<td><label id="groupsubjectname"></label></td>
						<td><label id="preferenceno"></label></td>
						<td><label id="laststdpercentage"></label></td>
								
					</tr>
					</table>
                </div>
                
                
                <div id="blankstd_details" style="display:none">
               		<table>
					<tr>
						<th><?php echo "University"; ?></th>
						<th><?php echo "College"; ?></th>
						<th><?php echo "Course"; ?></th>
						<th><?php echo "Preference No"; ?></th>
						<th><?php echo "% of last student"; ?></th>
								
					</tr>

					<tr>
						<td>Please enter right application number to view statement</td>
						
								
					</tr>
					</table>
                </div>
                                
                </div>
                
                </fieldset>
                <div id="form-button"><?php echo $this->Form->end(__('Print', array('id' => 'printbox'))); ?></div>
                
       
</div>

<?php //echo $this->element('sql_dump');?>

<script>
$(document).ready(function(){
$("#message").html("*Enter a valid application number above in the textbox");
});
$("#applicantnumber").blur(function(){
var appnum = $("#applicantnumber").val();


	if(appnum!='' && /^\d+$/.test(appnum)){
	$("#message").html('');
        $.ajax({
            type: 'POST',
            data: {applicationNum: $("#applicantnumber").val()},
            url: "<?php echo $this->webroot; ?>StudentStatements/getcourse_year",
            success: function(data) {
            
            
              var courseyear = $.parseJSON(data);
             
              $("#studentID").html(courseyear.studentID);
              $("#admission_year").html(courseyear.year);
            }
        });
        return true;
	
        }else{
        	
        	if(appnum=='' || appnum==null){
        	
        		$("#message").html("*Please Enter application number");

        		
        	}else{
		    	if(/^\d+$/.test(appnum)==false){
		    	$("#message").html("*Please Enter a valid application number");

		    	}
        	}
        	
        	
        	$("#studentID").html('');
            $("#admission_year").html('');	
           // $("#message").html("*Enter Application Number above in the textbox");
            $("#applicantnumber").focus()
        }


	
});

$("#applicantnumber").blur(function(){

	if($("#applicantnumber").val()!='' && $("#applicantnumber").val()!=null){
        $.ajax({
            type: 'POST',
            data: {applicationNum: $("#applicantnumber").val()},
            url: "<?php echo $this->webroot; ?>StudentStatements/getstudentdetails",
            success: function(data) {
            $("#blankstd_details").hide();
            $("#studentdetails").html(data);
            }
        });
        return true;
	
        }else{
        $("#blankstd_details").show();
        $("#studentdetails").html('');
        }


	
});

$('#form-button').click(function() {
        var formelement = $("#formelement").html();
        Popup($("#formelement").html());

        return false;
    });

function Popup(data)
    {
        if($("#applicantnumber").val()!=''){
        var mywindow = window.open('', 'Admission Statement', 'height=400,width=600');
        mywindow.document.write('<html><head><title>Admission Statement</title>');
        /*optional stylesheet*/ 

        mywindow.document.write('</head><body><img src="<?php echo $this->webroot; ?>img/demo/logo00.png" width="83" height="70">&nbsp;&nbsp;<img src="<?php echo $this->webroot; ?>img/demo/logo12.png" width="267"><div>Application Number: '+$("#applicantnumber").val()+'</div>');
        mywindow.document.write(data);
        mywindow.document.write('</body></html>');
        mywindow.document.close();
        mywindow.focus();
        mywindow.print();
        mywindow.close();

            return true;
        }else{
            return false;
        }
    }
</script>