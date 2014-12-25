<?php
// pr($selectedCollegeData); exit;
if(!empty($colleges) || !empty($selectedCollegeData)){
if(empty($admission_type)){
$option = '<table border="0" style="margin:auto;" cellpadding="0" cellspacing="0">
  <tr>
    <td align="left" valign="top" style="width:37%;">
	<div class="first-block"><select name="left-select" id="left-select" size="5" multiple="multiple" style="min-height:100px;">
	';
if(!empty($colleges)){
for ($a=0;$a<count($colleges);$a++) {
	
	for ($b=0;$b<count($colleges[$a]);$b++) {

   $option .= "<option value='{$colleges[$a][$b]['CollegeGroupsubid']}','rel'={$a}{$b}>{$colleges[$a][$b]['UniversityName']}  {$colleges[$a][$b]['CollegeCode']}  {$colleges[$a][$b]['GroupsubjectName']}</option>";
   }
}
}
$option .='</div></td>
    <td align="left" valign="top" style="width:15%;">
	<div class="mid-block">
	
    <a onclick="sendSelectedOptions();" style="cursor:pointer;"> <img src='.$this->webroot.'img/swap-right.png /></a>
    <br/><a onclick="removeSelectedOptions();" style="cursor:pointer;"> <img src='.$this->webroot.'img/swap-left.png /> </a></div>
    </td>
     <td align="left" valign="top" style="width:33%;">
	 <div class="last-block"><select name="right-select[]" id="right-select" size="5" multiple="multiple" style="min-height:100px;">';
	
    
    if(!empty($selectedCollegeData)) {
   		for ($a=0;$a<count($selectedCollegeData);$a++) {
   			for ($b=0;$b<count($selectedCollegeData[$a]);$b++) {
			
				$option .= "<option selected='selected' value='{$selectedCollegeData[$a][$b]['CollegeGroupsubid']}','rel'={$a}{$b}>{$selectedCollegeData[$a][$b]['UniversityName']}  {$selectedCollegeData[$a][$b]['CollegeCode']}  {$selectedCollegeData[$a][$b]['GroupsubjectName']}</option>";
				}
				
		}
		
	}
		
    $option .='</select></div>
    </td>
  </tr>
</table>'; 

echo $option; exit;
	}elseif($admission_type == 'P'){
	
	
$option = '<select name="right-select[]" id="privateStudentcollege" style="width:21%!important;">';
	
	if(!empty($colleges)){
		
		foreach($colleges[0] as $privatecollegeoption){
		if(!empty($selectedCollegeData['0']['0']['CollegeCode']) && $selectedCollegeData['0']['0']['CollegeCode']==$privatecollegeoption['CollegeCode']){
		$option .= "<option selected='selected' value='{$privatecollegeoption['CollegeGroupsubid']}'>{$privatecollegeoption['CollegeName']}</option>";
		}else{
		$option .= "<option value='{$privatecollegeoption['CollegeGroupsubid']}'>{$privatecollegeoption['CollegeName']}</option>";
		
		}
		
		}
		}
		$option .= "</select>";
		echo $option; exit;
	}
}else{
$option = '<table border="0" style="margin:auto;" cellpadding="0" cellspacing="0">
  <tr>
    <td align="left" valign="top" style="width:37%;color:red;font-size:10pt;">*No College found for these subjects match. Please enter your right combinational subjects</td></tr></table>';
    
    echo $option; exit;
    
}
?>
