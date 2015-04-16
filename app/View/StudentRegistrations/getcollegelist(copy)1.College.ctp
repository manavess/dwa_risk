<?php

$collegegrpid = '';
$subkey = '';

if (!empty($colleges) || !empty($selectedCollegeData)) {
    if (empty($admission_type)) {
        $option = '<table border="0" style="margin:auto;" cellpadding="0" cellspacing="0">
  <tr>
    <td align="left" valign="top" style="width:37%;">
	<div class="first-block"><select name="left-select" id="left-select" size="5" style="min-height:100px;">
	';
        if (!empty($colleges)) {
            foreach ($colleges as $college) {
                $isvalid = true;

                foreach ($selectedCollegeData as $selected) {
               
                    if (!empty($selected['CollegeGroupSubject']['id'])) {
                        if ($selected['CollegeGroupSubject']['id'] == $college['CollegeGroupSubject']['id']) {
                            $isvalid = false;
                            break;
                        }
                    }
                }
                
              
                  //$subkey = array_search($college['College']['id'], $group_subject);
                 $collegegrpid = $college['CollegeGroupSubject']['college_id'].",".$college['CollegeGroupSubject']['id'];
                  
                if ($isvalid)
                    $option .= "<option value='{$collegegrpid}','rel'=''>{$this->StdRegistrations->getuniversity($college['College']['university_id'])}  {$college['College']['college_code']} {$college['College']['name']} </option>";
    
            }
        }
        $option .='</div></td></tr><tr>
    <td align="left" valign="top" style="width:15%;">
	<div class="mid-block">
	
    <a onclick="sendSelectedOptions();" style="cursor:pointer;float:left;margin-left:248px;"> <img src=' . $this->webroot . 'img/swap-right.png /></a>
    <br/><a onclick="removeSelectedOptions();" style="cursor:pointer;float:left;margin-left:10px;"> <img src=' . $this->webroot . 'img/swap-left.png /> </a></div>
    </td></tr>
    <tr>
     <td align="left" valign="top" style="width:33%;">
	 <div class="last-block"><select name="right-select[]" id="right-select" multiple="multiple" size="5"  style="min-height:100px;">';

        if (!empty($selectedCollegeData)) {
            
            foreach ($selectedCollegeData as $selected) {
                
                if (!empty($selected['StudentPreferedColleges']['college_id'])) {
                    
                    if(!empty($selected['StudentPreferedColleges']['college_group_subject_id'])){
                        $selectedgrpid = $selected['StudentPreferedColleges']['college_id'].",".$selected['StudentPreferedColleges']['college_group_subject_id'];
                    }else{
                        $selectedgrpid = $selected['StudentPreferedColleges']['college_id'].",".'';
                    }
                    
                    $option .= "<option selected='selected' value='{$selectedgrpid}','rel'=''>{$this->StdRegistrations->getuniversity($selected['CollegeGroupSubject']['College']['university_id'])}  {$selected['CollegeGroupSubject']['College']['college_code']} {$selected['CollegeGroupSubject']['College']['name']} </option>";
                }
            }
        }

        $option .='</select></div>
    </td>
  </tr>
</table>';

        echo $option;
        exit;
    } elseif ($admission_type == 'P' && $nationality==0 && $allotted=='no') {
        
$option = '<table border="0" style="margin:auto;" cellpadding="0" cellspacing="0">
  <tr>
    <td align="left" valign="top" style="width:37%;">
	<div class="first-block"><select name="left-select" id="left-select" size="5" style="min-height:100px;">
	';
        if (!empty($colleges)) {
            
             foreach ($colleges as $college) {
                $isvalid = true;

                foreach ($selectedCollegeData as $selected) {
                    if (!empty($selected['CollegeGroupSubject']['id'])) {
                        if ($selected['CollegeGroupSubject']['id'] == $college['CollegeGroupSubject']['id']) {
                            $isvalid = false;
                            break;
                        }
                    }
                }
                $collegegrpid = $college['CollegeGroupSubject']['college_id'].",".$college['CollegeGroupSubject']['id'];
                if ($isvalid)
                    $option .= "<option value='{$collegegrpid}','rel'=''>{$college['College']['University']['name']}  {$college['College']['college_code']} {$college['College']['name']} </option>";
            }
        }
        
        $option .='</div></td></tr><tr>
    <td align="left" valign="top" style="width:15%;">
	<div class="mid-block">
	
    <a onclick="sendSelectedOptions();" style="cursor:pointer;float:left;margin-left:248px;"> <img src=' . $this->webroot . 'img/swap-right.png /></a>
    <br/><a onclick="removeSelectedOptions();" style="cursor:pointer;float:left;margin-left:10px;"> <img src=' . $this->webroot . 'img/swap-left.png /> </a></div>
    </td></tr><tr>
     <td align="left" valign="top" style="width:33%;">
	 <div class="last-block"><select name="right-select[]" id="right-select" multiple="multiple" size="5"  style="min-height:100px;">';

        if (!empty($selectedCollegeData)) {
            
            foreach ($selectedCollegeData as $selected) {
           // pr($selected); die;
                if(!empty($selected['StudentPreferedColleges']['college_group_subject_id'])){
                    $selectedgrpid = $selected['StudentPreferedColleges']['college_id'].",".$selected['StudentPreferedColleges']['college_group_subject_id'];
                    }else{
                        $selectedgrpid = $selected['CollegeGroupSubject']['College']['id'].",".'';
                    }
                
                if (!empty($selected['StudentPreferedColleges']['college_id'])) {
                    $option .= "<option selected='selected' value='{$selectedgrpid}','rel'=''>{$this->StdRegistrations->getuniversity($selected['CollegeGroupSubject']['College']['university_id'])}  {$selected['CollegeGroupSubject']['College']['college_code']} {$selected['CollegeGroupSubject']['College']['name']} </option>";
                }
            }
        }

        $option .='</select></div>
    </td>
  </tr>
</table>';

        echo $option;
        exit;
    } elseif ($admission_type == 'P' && $nationality==0 && $allotted=='yes') {
        
$option = '<select name="right-select[]" id="privateStudentcollege" style="width:15%!important;">';
        
        if (!empty($colleges)) {
            foreach ($colleges as $privatecollegeoption) {
                $isvalid = true;

                
                    foreach ($selectedCollegeData as $selected) {
                        
                        //$subkey = array_search($privatecollegeoption['College']['id'], $group_subject);
                        $collegegrpid = $selected['StudentPreferedColleges']['college_id'].",".$selected['StudentPreferedColleges']['college_group_subject_id']; 
                        if ($selected['StudentPreferedColleges']['college_id'] == $privatecollegeoption['CollegeGroupSubject']['College']['id']) {
                            $option .= "<option selected='selected' value='{$collegegrpid}'>{$this->StdRegistrations->getuniversity($privatecollegeoption['CollegeGroupSubject']['College']['university_id'])}  {$privatecollegeoption['CollegeGroupSubject']['College']['college_code']} {$privatecollegeoption['CollegeGroupSubject']['College']['name']} </option>";
                        }
                    }
                
                
                if(!empty($group_subject) && array_search($privatecollegeoption['College']['id'], $group_subject)){
                    //$subkey = array_search($privatecollegeoption['College']['id'], $group_subject);
                    $collegegrpid = $privatecollegeoption['College']['id'].",".$privatecollegeoption['CollegeGroupSubject']['id']; 
                    $option .= "<option value='{$collegegrpid}'>{$this->StdRegistrations->getuniversity($privatecollegeoption['College']['university_id'])}  {$privatecollegeoption['College']['college_code']} {$privatecollegeoption['College']['name']}  {$subkey}</option>";
                }
                $subkey='';
            }
        }
        $option .= "</select>";
        echo $option;
     
        exit;
    }elseif ($admission_type == 'P' && $nationality==1) {
             
        $option = '<select name="right-select[]" id="privateStudentcollege" style="width:60%!important;">';
        
        if (!empty($colleges)) {
            foreach ($colleges as $privatecollegeoption) {
                
                if(!empty($selectedCollegeData)){
                    foreach ($selectedCollegeData as $selected) {
                        
                
                        $collegegrpid = $selected['StudentPreferedColleges']['college_id'].",".$selected['StudentPreferedColleges']['college_group_subject_id']; 
                
                        if ($selected['StudentPreferedColleges']['college_id'] == $privatecollegeoption['CollegeGroupSubject']['college_id']) {
                            $option .= "<option selected='selected' value='{$collegegrpid}'>{$this->StdRegistrations->getuniversity($selected['CollegeGroupSubject']['College']['university_id'])}  {$selected['CollegeGroupSubject']['College']['college_code']} {$selected['CollegeGroupSubject']['College']['name']} </option>";
                        }
                    }
                }

                    $collegegrpid = $privatecollegeoption['College']['id'].",".$privatecollegeoption['CollegeGroupSubject']['id']; 
                    $option .= "<option value='{$collegegrpid}'>{$this->StdRegistrations->getuniversity($privatecollegeoption['College']['university_id'])}  {$privatecollegeoption['College']['college_code']} {$privatecollegeoption['College']['name']} </option>";
                
            }
        }
        $option .= "</select>";
        echo $option;
        exit;
    }
} else {
    $option = '<table border="0" style="margin:auto;" cellpadding="0" cellspacing="0">
  <tr>
    <td align="left" valign="top" style="width:37%;color:red;font-size:10pt;">*No College found for these subjects match. Please enter your right combinational subjects</td></tr></table>';

    echo $option;
    exit;
}
?>
