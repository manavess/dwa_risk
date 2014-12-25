<?php
//pr($studentTotalsubmarks); die;
error_reporting(0);
ini_set('display_errors','Off');
$a = 0;
$stsub = 7;
if(!empty($studentTotalsubmarks) && count($studentTotalsubmarks)>=7){
    $stsub = 7;
}else if(!empty($studentTotalsubmarks) && count($studentTotalsubmarks)>=5 && count($studentTotalsubmarks)<7){
    $stsub = 5;
}
for ($i = 1; $i <= $stsub; $i++) {

    
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
?>
