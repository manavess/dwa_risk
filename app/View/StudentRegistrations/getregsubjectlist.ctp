<?php
//pr($studentsubject); die;
$isfound = 0;
$a = 0;

//$stsub = isset($studentsubject) ? count($studentsubject):'';
if(!empty($studentsubject) && count($studentsubject)>=7){
    $stsub = 7;
}else if(!empty($studentsubject) && count($studentsubject)>=5 && count($studentsubject)<7){
    $stsub = 5;
}

for ($i = 1; $i <= $stsub; $i++) {

    
        $option = '';
        //<!--div class='diplomacourse'-->
        $option .= "<span><select class='subjects' name='subjectid[]' onchange='collegelist(),getmarks(this)'><option value=''>Select Subject</option>";
      	
      	$diplomasubjectmarks = '';
        foreach ($subject as $value) {
          if(@$studentsubject[$a]['subject_id']==$value['Subject']['id']){
            $option .= "<option selected='selected' value='{$value['Subject']['id']}'>{$value['Subject']['name']}</option>";
            $diplomasubjectmarks = $studentsubject[$a]['marks'];
          }else{
            $option .= "<option value='{$value['Subject']['id']}'>{$value['Subject']['name']}</option>";
           }

        }
        $a++;
         if(!empty($markingtype)){
            $option.="</select><input style='float:right' type='text' name='percentage[]'  class='subject_marks' value='{$diplomasubjectmarks}' onblur='calculateValue()' maxlength='2'></span></div>";
        }else{
            $option .="</select><input style='float:right' type='text' name='percentage[]' class='subject_marks' value='{$diplomasubjectmarks}' onblur='calculateValue()' maxlength='2' readonly='readonly'></span>";
        }
       
        echo "<div>".$option."</div>";
    
    
}
?>