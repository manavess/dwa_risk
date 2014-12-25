<?php

$a = 0;
for ($i = 1; $i <= $coursedetails['Course']['no_of_subject']; $i++) {

    if (!empty($coursedetails['Course']['compulsary_subject'])) {
        $complusarysubject = explode(',', $coursedetails['Course']['compulsary_subject']);
        $totalComplusarySubject = count($complusarysubject);
        $optionalSubject = '';
/*from total compulsary subject 1 has been subtracted because from basic and specialized only one can be chosed at a time*/
        if(!empty($totalComplusarySubject)){
            $optionalSubject = $coursedetails['Course']['no_of_subject'] - ($totalComplusarySubject-1);
        }

        $option = '<strong class="student-registration"> Qualifying Subjects and their marks (*Grade Range 1 to 9 OR A to E (Only Capital letter)) :</strong>';
        $option1 = '';
        $i = 0;
        foreach ($subject as $key => $value) {
            $option .= "<span><label><span>{$value}</span></lable>";
            if(!empty($markingtype) && array_key_exists(0, $studentTotalsubmarks)){
 		$option .= "<input type='hidden' class='subjects' id='subject{$i}' name='subjectid[]' value='{$studentTotalsubmarks[$i]['subject_id']}',size='20px'><input type='text' name='percentage[]' value='{$studentTotalsubmarks[$i]['marks']}' class='subject_marks' onblur='calculateValue()' maxlength='2'></span>";
            }else{
                $option .= "<input type='hidden' class='subjects' id='subject{$i}' name='subjectid[]' value='{$key}',size='20px'><input type='text' name='percentage[]' value='' class='subject_marks' onblur='calculateValue()' maxlength='2'></span>";
            }
            $i++;
        }
        $option .= "<select width='100px' class='subjects' name='subjectid[]' onchange='collegelist()'>";
      
        
        foreach($mathsarray as $key=>$value){
           
            $option .= "<option selected ='selected' value='{$key}'>{$value}</option>";
            
        }
        $option .= "</select>";
        
        if(!empty($markingtype) && array_key_exists(0, $studentTotalsubmarks)){
            $option .= "<input type='text' name='percentage[]' value='{$studentTotalsubmarks[$i]['marks']}' class='subject_marks' onblur='calculateValue()' maxlength='2'>";
        }else{
              $option .= "<input type='text' name='percentage[]' value='' class='subject_marks' onblur='calculateValue()' maxlength='2'>";
        }
        //$option = "<div>$option</div>";
        $option = "<div>$option</div>";
	/*1 has been added to comply with the value of i in order to also count the maths subject array separted from subject loop*/	
        $g=$i+1; 
                
        for ($i = 1; $i <= $optionalSubject; $i++) {
        
            $option1 .= "<span><select  class='subjects' id='subjectid{$i}' name='subjectid[]' style='margin:5px 5px 5px 5px;' onchange='collegelist()' ><option value=''>Select Subject</option>";

            foreach ($qualifying_subjects as $value) {
            	
            	if(!empty($markingtype) && !empty($studentTotalsubmarks[$g]['subject_id']) && $studentTotalsubmarks[$g]['subject_id']==$value['Subject']['id']) {
            	
                $option1 .= "<option selected ='selected' value='{$value['Subject']['id']}'>{$value['Subject']['name']}</option>";
                $subjvalue = $studentTotalsubmarks[$g]['marks']; /*this is the selected subject marks and goes to input box next to option*/
                }else{
                $option1 .= "<option value='{$value['Subject']['id']}'>{$value['Subject']['name']}</option>";
                }
                
            }
            $g++;
            $option1 .= "</select>";
            if(!empty($subjvalue)){
            $option1 .= "<input type='text' name='percentage[]'  class='subject_marks' value='{$subjvalue}' onblur='calculateValue()' maxlength='2'></span>";
            }else{
            $option1 .= "<input type='text' name='percentage[]'  class='subject_marks' value='' onblur='calculateValue()' maxlength='2'></span>";
            }
        }
        $option .="<div class='a'>$option1</div>";

        echo $option;
        
        exit;
    } else {
        $option = '';
        //<!--div class='diplomacourse'-->
        $option .= "<span><select class='subjects' name='subjectid[]' onchange='collegelist()'><option value=''>Select Subject</option>";
      	
      	$diplomasubjectmarks = '';
        foreach ($subject as $value) {
          if(!empty($markingtype) && $studentTotalsubmarks[$a]['subject_id']==$value['Subject']['id']){
         $option .= "<option selected='selected' value='{$value['Subject']['id']}'>{$value['Subject']['name']}</option>";
         $diplomasubjectmarks = $studentTotalsubmarks[$a]['marks'];
          }else{
         $option .= "<option value='{$value['Subject']['id']}'>{$value['Subject']['name']}</option>";
           }

        }
        $a++;
         if(!empty($markingtype)){
         $option.="</select><input style='float:right' type='text' name='percentage[]'  class='subject_marks' value='{$diplomasubjectmarks}' onblur='calculateValue()' maxlength='2'></span></div>";
        }else{
        $option.='</select><input style="float:right" type="text" name="percentage[]"  class="subject_marks" value=""  onblur="calculateValue()" maxlength="2"></span>';
        }
       
        echo "<div>".$option."</div>";
    }
    
}
?>
