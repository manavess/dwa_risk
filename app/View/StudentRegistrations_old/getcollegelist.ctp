<?php

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
               
                    if (!empty($selected['Colleges']['id'])) {
                        if ($selected['Colleges']['id'] == $college['Colleges']['id']) {
                            $isvalid = false;
                            break;
                        }
                    }
                }
                
               if(!empty($group_subject) && array_search($college['Colleges']['id'], $group_subject)){
                  $subkey = array_search($college['Colleges']['id'], $group_subject);
                  $collegegrpid = $college['Colleges']['id'].",".$subkey;
                  
                if ($isvalid)
                    $option .= "<option style='background: yellow;' value='{$collegegrpid}','rel'=''>{$this->StdRegistrations->getuniversity($college['Colleges']['university_id'])}  {$college['Colleges']['college_code']}  {$college['Colleges']['name']} </option>";
               }else{
                   if ($isvalid)
                       $collegegrpid = $college['Colleges']['id'].",".$subkey;
                   $option .= "<option value='{$collegegrpid}','rel'=''>{$this->StdRegistrations->getuniversity($college['Colleges']['university_id'])}  {$college['Colleges']['college_code']}  {$college['Colleges']['name']}</option>";
               }
               $subkey='';
            }
        }
        $option .='</div></td>
    <td align="left" valign="top" style="width:15%;">
	<div class="mid-block">
	
    <a onclick="sendSelectedOptions();" style="cursor:pointer;"> <img src=' . $this->webroot . 'img/swap-right.png /></a>
    <br/><a onclick="removeSelectedOptions();" style="cursor:pointer;"> <img src=' . $this->webroot . 'img/swap-left.png /> </a></div>
    </td>
     <td align="left" valign="top" style="width:33%;">
	 <div class="last-block"><select name="right-select[]" id="right-select" multiple="multiple" size="5"  style="min-height:100px;">';

        if (!empty($selectedCollegeData)) {
            foreach ($selectedCollegeData as $selected) {
                if (!empty($selected['Colleges']['id'])) {
                    
                    if(!empty($selected['StudentPreferedColleges']['college_group_subject_id'])){
                    $selectedgrpid = $selected['Colleges']['id'].",".$selected['StudentPreferedColleges']['college_group_subject_id'];
                    }else{
                        $selectedgrpid = $selected['Colleges']['id'].",".'';
                    }
                    
                    $option .= "<option selected='selected' value='{$selectedgrpid}','rel'=''>{$this->StdRegistrations->getuniversity($selected['Colleges']['university_id'])}  {$selected['Colleges']['college_code']}  {$selected['Colleges']['name']}</option>";
                }
            }
        }

        $option .='</select></div>
    </td>
  </tr>
</table>';

        echo $option;
        exit;
    } elseif ($admission_type == 'P' && $nationality==0) {
$option = '<table border="0" style="margin:auto;" cellpadding="0" cellspacing="0">
  <tr>
    <td align="left" valign="top" style="width:37%;">
	<div class="first-block"><select name="left-select" id="left-select" size="5" style="min-height:100px;">
	';
        if (!empty($colleges)) {
            foreach ($colleges as $college) {
                $isvalid = true;

                foreach ($selectedCollegeData as $selected) {
                    if (!empty($selected['Colleges']['id'])) {
                        if ($selected['Colleges']['id'] == $college['Colleges']['id']) {
                            $isvalid = false;
                            break;
                        }
                    }
                }
                if(!empty($group_subject) && array_search($college['Colleges']['id'], $group_subject)){
                    $subkey = array_search($college['Colleges']['id'], $group_subject);
                    $collegegrpid = $college['Colleges']['id'].",".$subkey;
                if ($isvalid)
                    $option .= "<option style='background: yellow;' value='{$collegegrpid}','rel'=''>{$this->StdRegistrations->getuniversity($college['Colleges']['university_id'])}  {$college['Colleges']['college_code']}  {$college['Colleges']['name']} </option>";
                }else{
                if ($isvalid)
                    $collegegrpid = $college['Colleges']['id'].",".$subkey;
                    $option .= "<option value='{$collegegrpid}','rel'=''>{$this->StdRegistrations->getuniversity($college['Colleges']['university_id'])}  {$college['Colleges']['college_code']}  {$college['Colleges']['name']}</option>";
                }
                $subkey='';
            }
        }
        $option .='</div></td>
    <td align="left" valign="top" style="width:15%;">
	<div class="mid-block">
	
    <a onclick="sendSelectedOptions();" style="cursor:pointer;"> <img src=' . $this->webroot . 'img/swap-right.png /></a>
    <br/><a onclick="removeSelectedOptions();" style="cursor:pointer;"> <img src=' . $this->webroot . 'img/swap-left.png /> </a></div>
    </td>
     <td align="left" valign="top" style="width:33%;">
	 <div class="last-block"><select name="right-select[]" id="right-select" multiple="multiple" size="5"  style="min-height:100px;">';

        if (!empty($selectedCollegeData)) {
            
            foreach ($selectedCollegeData as $selected) {
            
                if(!empty($selected['StudentPreferedColleges']['college_group_subject_id'])){
                    $selectedgrpid = $selected['Colleges']['id'].",".$selected['StudentPreferedColleges']['college_group_subject_id'];
                    }else{
                        $selectedgrpid = $selected['Colleges']['id'].",".'';
                    }
                
                if (!empty($selected['Colleges']['id'])) {
                    $option .= "<option selected='selected' value='{$selectedgrpid}','rel'=''>{$this->StdRegistrations->getuniversity($selected['Colleges']['university_id'])}  {$selected['Colleges']['college_code']}  {$selected['Colleges']['name']}</option>";
                }
            }
        }

        $option .='</select></div>
    </td>
  </tr>
</table>';

        echo $option;
        exit;
    }elseif ($admission_type == 'P' && $nationality=='1') {

        
        $option = '<select name="right-select[]" id="privateStudentcollege" style="width:21%!important;">';
        
        if (!empty($colleges)) {
            foreach ($colleges as $privatecollegeoption) {
                $isvalid = true;

                
                    foreach ($selectedCollegeData as $selected) {
                        $subkey = array_search($privatecollegeoption['Colleges']['id'], $group_subject);
                        $collegegrpid = $privatecollegeoption['Colleges']['id'].",".$subkey; 
                        if ($selected['Colleges']['id'] == $privatecollegeoption['Colleges']['id']) {
                            $option .= "<option selected='selected' value='{$collegegrpid}'>{$this->StdRegistrations->getuniversity($privatecollegeoption['Colleges']['university_id'])}  {$privatecollegeoption['Colleges']['college_code']}  {$privatecollegeoption['Colleges']['name']}</option>";
                        }
                    }
                
                
                if(!empty($group_subject) && array_search($privatecollegeoption['Colleges']['id'], $group_subject)){
                    $subkey = array_search($privatecollegeoption['Colleges']['id'], $group_subject);
                    $collegegrpid = $privatecollegeoption['Colleges']['id'].",".$subkey; 
                    $option .= "<option style='background: yellow;' value='{$collegegrpid}'>{$this->StdRegistrations->getuniversity($privatecollegeoption['Colleges']['university_id'])}  {$privatecollegeoption['Colleges']['college_code']}  {$privatecollegeoption['Colleges']['name']} {$subkey}</option>";
                }else{
                    $collegegrpid = $privatecollegeoption['Colleges']['id'].",".$subkey; 
                    $option .= "<option value='{$collegegrpid}'>{$this->StdRegistrations->getuniversity($privatecollegeoption['Colleges']['university_id'])}  {$privatecollegeoption['Colleges']['college_code']}  {$privatecollegeoption['Colleges']['name']}</option>";
                }
                $subkey='';
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
