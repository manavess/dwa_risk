<?php  $option = "<option value=''>Select</option>";
if(!empty($colleges)){

	foreach($colleges as $key=>$val){
	$option .= "<option value='{$key}'>{$val}</option>"; 
	}
	echo $option;
}else{
	echo "No College found for this University";
	echo $option = "<option value=''>Select</option>";
}

?>
