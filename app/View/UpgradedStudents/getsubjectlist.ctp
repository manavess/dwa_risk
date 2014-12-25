<?php
if(!empty($coursedetails)){
$a = 0;
for ($i = 1; $i <= $coursedetails['Course']['no_of_subject']; $i++) {

    if (!empty($coursedetails['Course']['compulsary_subject'])) {
        $complusarysubject = explode(',', $coursedetails['Course']['compulsary_subject']);
        $totalComplusarySubject = count($complusarysubject);
        $optionalSubject = $coursedetails['Course']['no_of_subject'] - $totalComplusarySubject;

        $option = '<strong class="student-registration"> Qualifying Subjects and their marks (*In case of Grade please fill value in Capital letter) :</strong>';
        $option1 = '';
        $i = 0;
        foreach ($subject as $key => $value) {
            $option .= "<span><label><span>{$value}</span></lable>";
            
            $option .= "<input type='hidden' class='subjects' id='subject{$i}' name='subjectid[]' onchange='validatesubject()' value='{$key}',size='20px'><input type='text' name='percentage[]' value='' class='subject_marks' onblur='calculateValue()' maxlength='2'></span>";
           
            
        }
        $option = "<div>$option</div>";
		
        for ($i = 1; $i <= $optionalSubject; $i++) {
        
            $option1 .= "<span><select  class='subjects' id='subjectid{$i}' name='subjectid[]' onchange='validatesubject()' style='margin:5px 5px 5px 5px;'><option value=''>Select Subject</option>";

            foreach ($qualifying_subjects as $value) {
            	
                $option1 .= "<option value='{$value['Subject']['id']}'>{$value['Subject']['name']}</option>";
                
                
            }
            
            $option1 .= "</select>";
           
            $option1 .= "<input type='text' name='percentage[]'  class='subject_marks' value='' onblur='calculateValue()' maxlength='2'></span>";
            
        }
        $option .="<div class='a'>$option1</div>";

        echo $option;
    exit;
    
      }else {
        $option = '';
//        <div class='diplomacourse'>
        $option .= "<div><span><select class='subjects' id='subjectid{$i}' name='subjectid[]'  onchange='validatesubject()'><option value=''>Select Subject</option>";
      	
      	$diplomasubjectmarks = '';
        foreach ($subject as $value) {
          
         $option .= "<option value='{$value['Subject']['id']}'>{$value['Subject']['name']}</option>";
           }
       
        $option.='</select><input style="float:right" type="text" name="percentage[]"  class="subject_marks" value=""  onblur="calculateValue()" maxlength="2"></span></div>';
        
        //echo "<div class='a'></div>";
    
}
echo $option;
}
}
exit;
?>
